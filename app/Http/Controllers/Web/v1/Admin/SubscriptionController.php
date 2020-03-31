<?php

namespace App\Http\Controllers\Web\v1\Admin;

use App\Exceptions\WebServiceErroredException;
use App\Http\Controllers\Controller;
use App\Http\Controllers\WebBaseController;
use App\Models\Histories\History;
use App\Models\Histories\HistoryType;
use App\Models\Profiles\User;
use App\Models\Subscriptions\Subscription;
use App\Models\Subscriptions\SubscriptionType;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;
use Yajra\DataTables\Facades\DataTables;

class SubscriptionController extends WebBaseController
{

    public function index()
    {
        $subscriptionType = SubscriptionType::where('price', 0)->first();
        $subscriptions = Subscription::where('subscription_type_id', '!=', $subscriptionType->id)
            ->orderBy('created_at', 'desc')
            ->with('user', 'subscriptionType')
            ->paginate(10);
        return view('admin.userActions.subscriptions.index', compact('subscriptions'));
    }

    public function freeSubscribe(Request $request, $id)
    {
        $subscriptionType = SubscriptionType::find($request->type_id);
        $date = new DateTime();
        $date->modify('+' . $subscriptionType->expired_at . 'days');
        $user = User::find($id);
        $userSubscription = $user->lastSubscription();
        if ($userSubscription) {
            $date = new DateTime($userSubscription->expired_at);
            $date->modify('+' . $subscriptionType->expired_at . 'days');
        }

        DB::beginTransaction();
        try {
            $subscription = Subscription::create([
                'user_id' => $user->id,
                'subscription_type_id' => $subscriptionType->id,
                'expired_at' => $date,
                'actual_price' => $subscriptionType->price
            ]);
            History::create([
                'balance_id' => $user->balance->id,
                'history_type_id' => HistoryType::SUBSCRIPTION,
                'amount' => $subscriptionType->price,
                'subscription_id' => $subscription->id,
            ]);

            DB::commit();
            $this->edited();
            return redirect()->route('users.index');
        } catch (Exception $e) {
            DB::rollBack();
            throw new WebServiceErroredException(trans('admin.error') . ': ' . $e->getMessage());
        }
    }


    public function subscriptionAwaitingUsers()
    {
        return view('admin.users.awaiting');
    }

    public function awaitingUsersDataTable()
    {
        $select = DB::table('users as u')
            ->select([
                'u.name',
                'u.surname',
                'u.father_name',
                'u.email',
                'u.phone',
                'u.platform'
            ])
            ->leftJoin('subscriptions as s', 's.user_id', '=', 'u.id')
            ->where(function ($query) {
                $query->whereNull('s.id')
                    ->orWhereRaw('now() > s.expired_at');
            })
            ->where('u.device_token');
        return DataTables::of($select)->make(true);
    }
}
