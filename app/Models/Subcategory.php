<?php

namespace App\Models;

use App\Enum\stateStatusEnum;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;


class Subcategory extends Model
{
     use HasTranslations;
    protected $fillable = [
        'name',
        'description',
        'thumbnail',
        'status',
        'category_id',
    ];
     public $translatable = ['name', 'description']; 
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
