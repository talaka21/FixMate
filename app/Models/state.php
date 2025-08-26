<?php

namespace App\Models;

use App\Enum\stateStatusEnum;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class state extends Model
{
       use HasTranslations;
    protected $fillable = [
        'name',
        'status'
    ];
     public $translatable = ['name'];
    protected $casts = [
        'status' => stateStatusEnum::class,
    ];

    public function cities()
    {
        return $this->hasMany(City::class);
    }

    public function governmentEntities()
    {
        return $this->hasMany(GovernmentEntity::class);
    }

    public function serviceProviders()
    {
        return $this->hasMany(ServiceProvider::class);
    }

    public function serviceProviderRequests()
    {
        return $this->hasMany(ServiceProviderRequest::class);
    }
}
