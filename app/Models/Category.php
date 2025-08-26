<?php

namespace App\Models;

use App\Enum\stateStatusEnum;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;


class Category extends Model implements HasMedia
{
     use HasTranslations;
    use InteractsWithMedia;
    protected $fillable = [
        'name',
        'description',
        'thumbnail',
        'status'
    ];
    public $translatable = ['name', 'description'];
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('thumbnails')->singleFile(); // أو بدون singleFile إذا بتسمح بعدة صور
    }
    protected $casts = [
        'status' => stateStatusEnum::class,
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
        return $this->hasMany(ServiceProviderRequest::class);
    }
}
