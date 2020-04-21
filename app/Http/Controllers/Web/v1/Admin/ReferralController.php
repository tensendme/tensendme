<?php
/**
 * Created by PhpStorm.
 * User: air
 * Date: 22.04.2020
 * Time: 00:40
 */

namespace App\Http\Controllers\Web\v1\Admin;


use App\Http\Controllers\WebBaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class ReferralController extends WebBaseController
{
    public function index()
    {
        return view('admin.referrals.index');
    }

    public function referralUsersDataTable()
    {
        $currentUser = Auth::user();
        $select = DB::table('users as u')
            ->select([
                'u.name',
                'u.surname',
                'u.father_name',
                'u.email',
                'u.phone',
                'u.platform',
                'u.created_at',
            ])
            ->leftJoin('subscriptions as s', 's.user_id', '=', 'u.id')
            ->join('followers as f', 'u.id', '=', 'f.follower_user_id')
            ->where(function ($query) {
                $query->whereNull('s.id');
            })
            ->where('f.host_user_id', '=', $currentUser->id)
            ->orderBy('u.created_at', 'DESC');
        return DataTables::of($select)->make(true);
    }
}