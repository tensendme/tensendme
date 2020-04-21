<?php

namespace App\Http\Controllers\Web\v1;

use App\Http\Controllers\WebBaseController;
use App\Models\Histories\History;
use App\Models\Profiles\Country;
use App\Models\Profiles\User;
use App\Models\Rating;
use App\Models\Subscriptions\PromoCodeAnalytic;
use App\Models\Subscriptions\Subscription;
use App\Models\Subscriptions\SubscriptionType;
use App\Services\v1\PromoCodeAnalyticService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

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
        $referralNumber = Auth::user()->followers()->count();
        return view('admin.home', compact(
            'usersCount',
            'historiesCount',
            'subscriptionsCount',
            'ratingsCount',
            'referralNumber'
        ));
    }

    public function welcome()
    {
        return view('welcome');
    }

    public function promoCode($promoCode)
    {
        $user = User::where('promo_code', $promoCode)->first();
        $countries = Country::all();
        if ($user) {
            $this->promoCodeService->makePassed($user->id, $promoCode);
        }
        return view('promo-code', compact('promoCode', 'user', 'countries'));
    }

    public function lang($locale)
    {
        app()->setLocale($locale);
        session()->put('locale', $locale);
        return redirect()->back();
    }

    public function registerPromo($promoCode, Request $request)
    {
        $userAgent = $request->userAgent();
        $platform = '';
        if ($userAgent) {
            if (strpos($userAgent, 'Android') !== false && strpos($userAgent, 'Windows Phone') == false) {
                $platform = 'Android';
            } else if (strpos($userAgent, 'iPhone') !== false || strpos($userAgent, 'iPad') !== false) $platform = 'IOS';
        }
        $country = Country::find($request->country);
        $user = User::where('promo_code', $promoCode)->first();
        $phone = preg_replace("/[^0-9]/", "",
            $country->phone_prefix . $request->phone);
        if ($user) $this->promoCodeService->makePassPhone($user->id, $promoCode, $phone);
        if ($platform == 'IOS') {
            return Redirect::to('https://apps.apple.com/kz/app/tensend/id1502844330');
        } else if ($platform == 'Android') {
            return Redirect::to('https://play.google.com/store/apps/details?id=kz.ysmaiyl.app.tensend');
        } else return redirect()->route('welcome');
    }
}
