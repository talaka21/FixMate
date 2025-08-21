<?php

namespace App\Models;

use App\Enum\stateStatusEnum;
use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    protected $fillable = [
        'name_ar',
        'name_en',
        'description',
        'thumbnail',
        'status',
        'category_id',
    ];
    protected $casts = [
        'status' => stateStatusEnum::class,
    ];
    public function category()
    {
        return $this->belongsTo(Category::class);
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
