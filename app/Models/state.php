<?php

namespace App\Models;

use App\Enum\stateStatusEnum;
use Illuminate\Database\Eloquent\Model;

class state extends Model
{
    protected $fillable = [
    'name',
    'status'
    ];
    protected $casts = [
       'status'=>stateStatusEnum::class,
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
        return $this->hasMany(ServiceProviderRequests::class);
    }
}
