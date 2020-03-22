<?php


namespace App\Services\v1\impl;

use App\Exceptions\ApiServiceException;
use App\Http\Errors\ErrorCode;
use App\Models\Banners\Banner;
use App\Models\News\Location;
use App\Services\v1\BannerService;
use Illuminate\Support\Facades\Auth;

class BannerServiceImpl implements BannerService
{
    public function findAll()
    {
        $user = Auth::user();
        if ($user && $user->activeSubscriptions()->count() > 0) {
            $banners = Banner::where('is_payment_enabled', '=', false)->get();
        } else {
            $banners = Banner::all();
        }
        return $banners;
    }

    public function findAllLocations()
    {
        return Location::all();
    }

    public function findAllPaginated($perPage)
    {
//        return Banner::limit($pageSize)->offset($page * $pageSize)->get();
        $user = Auth::user();
        if ($user && $user->activeSubscriptions()->count() > 0) {
            $banners = Banner::where('is_payment_enabled', '=', false)->paginate($perPage);
        } else {
            $banners = Banner::paginate($perPage);
        }
        return $banners;
    }

    public function findAllById($id)
    {
        return Banner::where('id', $id)->get();
    }

    public function findAllByLocation($location)
    {
        $location = Location::where('name', $location)->first();
        if (!$location) {
            $result = null;
        } else {
            $result = Banner::where('location_id', $location->id)->get();

        }
        return $result;
    }
}
