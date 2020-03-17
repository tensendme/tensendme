<?php


namespace App\Services\v1\impl;


use App\Exceptions\ApiServiceException;
use App\Http\Errors\ErrorCode;
use App\Models\Courses\CourseMaterial;
use App\Services\v1\MaterialService;
use Auth;

class MaterialServiceImpl implements MaterialService
{
    public function getMaterialById($id)
    {
//        $user = Auth::user();
//        $subscriptions = $user->activeSubscriptions();
        $material = CourseMaterial::where('id', $id)->with(['documents', 'course'])->first();
        if(!$material) throw new ApiServiceException(404, false, [
            'errors' => [
                'Такого материала не существует'
            ],
            'errorCode' => ErrorCode::RESOURCE_NOT_FOUND
        ]);
//        if(!$subscriptions->exists() && !$material->free) throw new ApiServiceException(404, false, [
//            'errors' => [
//                'Вы можете открыть доступ к этому уроку купив подписку'
//            ],
//            'errorCode' => ErrorCode::ACCESS_DENIED
//        ]);
        return $material;
    }

}
