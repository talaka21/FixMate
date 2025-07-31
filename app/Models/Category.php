<?php

namespace App\Models;

use App\Enum\stateStatusEnum;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name',
   'description',
   'thumbnail',
   'status'
    ];
     protected $casts = [
       'status'=>stateStatusEnum::class,
    ];
public function subcategories()
    {
        return $this->hasMany(Subcategory::class);
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
