<?php

namespace App\Models;

use App\Enum\stateStatusEnum;
use Illuminate\Database\Eloquent\Model;

class city extends Model
{
    protected $fillable = [
        'name',
        'status'
    ];

    protected $casts = [
        'status' => stateStatusEnum::class,
    ];
    public function state()
    {
        return $this->belongsTo(State::class);
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
