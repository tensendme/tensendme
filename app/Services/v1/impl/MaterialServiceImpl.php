<?php


namespace App\Services\v1\impl;


use App\Exceptions\ApiServiceException;
use App\Http\Errors\ErrorCode;
use App\Models\Courses\CourseMaterial;
use App\Services\v1\MaterialService;

class MaterialServiceImpl implements MaterialService
{
    public function getMaterialById($id)
    {
        $material = CourseMaterial::find($id);
        if(!$material) throw new ApiServiceException(404, false, [
            'errors' => [
                'Такого материала не существует'
            ],
            'errorCode' => ErrorCode::RESOURCE_NOT_FOUND
        ]);
        return $material;
    }

}
