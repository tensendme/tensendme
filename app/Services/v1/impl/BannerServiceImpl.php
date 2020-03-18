<?php


namespace App\Services\v1\impl;

use App\Exceptions\ApiServiceException;
use App\Http\Errors\ErrorCode;
use App\Models\Banners\Banner;
use App\Models\News\Location;
use App\Services\v1\BannerService;
class BannerServiceImpl implements BannerService
{
    public function findAll()
    {
        return Banner::all();
    }
    public function findAllLocations()
    {
        return Location::all();
    }

    public function findAllPaginated($perPage)
    {
//        return Banner::limit($pageSize)->offset($page * $pageSize)->get();
        return Banner::paginate($perPage);
    }

    public function findAllById($id)
    {
        return Banner::where('id', $id)->get();
    }

    public function findAllByLocation($location)
    {
        $location = Location::where('name',$location)->first();
        if (!$location){
            $result = null;
        }else
        {
            $result = Banner::where('location_id', $location->id)->get();

        }
        return $result;
    }
}
