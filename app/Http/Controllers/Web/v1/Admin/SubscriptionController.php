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
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;
use Yajra\DataTables\Facades\DataTables;

class SubscriptionController extends WebBaseController
{

    public function index()
    {
        $subscription_types = SubscriptionType::all();
        $subscriptions = Subscription::orderBy('created_at', 'desc')
            ->with('user', 'subscriptionType')
            ->paginate(10);
        return view('admin.userActions.subscriptions.index', compact('subscriptions', 'subscription_types'));
    }

    public function filter(Request $request) {
        $subscriptions = QueryBuilder::for(Subscription::class)
            ->allowedFilters(['actual_price',
                AllowedFilter::exact('subscription_type_id'),
                AllowedFilter::exact('user_id'),
                AllowedFilter::scope('created_after'),
                AllowedFilter::scope('created_before'),
                AllowedFilter::scope('expired_after'),
                AllowedFilter::scope('expired_before'),
            ])
            ->defaultSort('-id')
            ->allowedIncludes(['user', 'subscriptionType'])
            ->allowedSorts('id', 'created_at', 'expired_at', 'actual_price',
                'subscription_type_id')
            ->paginate($request->perPage);

        return view('admin.userActions.subscriptions.table', compact('subscriptions'));
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
            });
        return DataTables::of($select)->make(true);
    }
}
