<?php

namespace App\Http\Controllers\Web\v1;

use App\Http\Controllers\WebBaseController;
use App\Models\Histories\History;
use App\Models\Profiles\User;
use App\Models\Rating;
use App\Models\Subscriptions\Subscription;
use App\Models\Subscriptions\SubscriptionType;
use App\Services\v1\PromoCodeAnalyticService;

class HomeController extends WebBaseController
{

    protected $promoCodeService;

    /**
     * HomeController constructor.
     * @param $promoCodeService
     */
    public function __construct(PromoCodeAnalyticService $promoCodeService)
    {
        $this->promoCodeService = $promoCodeService;
    }


    public function index()
    {
        $usersCount = User::all()->count();
        $historiesCount = History::all()->count();
        $subscriptionType = SubscriptionType::where('price', 0)->first();
        $subscriptionsCount = Subscription::where('subscription_type_id', '!=', $subscriptionType->id)->count();
        $ratingsCount = Rating::all()->count();
        return view('admin.home', compact('usersCount', 'historiesCount', 'subscriptionsCount', 'ratingsCount'));
    }

    public function welcome()
    {
        return view('welcome');
    }

    public function promoCode($promoCode)
    {

        dd($this->promoCodeService->analyze(1));
        $user = User::where('promo_code', $promoCode)->first();
        if ($user) {
            $this->promoCodeService->makePassed($user->id, $promoCode);
        }
        return view('promo-code', compact('promoCode', 'user'));
    }
}
