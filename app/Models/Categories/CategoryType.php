<?php

namespace App\Models\Categories;

use Illuminate\Database\Eloquent\Model;

class CategoryType extends Model
{

    public const COURSES_TYPE = 1;
    public const MEDITATIONS_TYPE = 2;

    protected $fillable = [
        'name'
    ];
}
