<?php

namespace App\Models\Profiles;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class City extends Model
{
    use SoftDeletes;

    public $timestamps = false;

    protected $fillable = [
        'name','country_id'
    ];
    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }

}
