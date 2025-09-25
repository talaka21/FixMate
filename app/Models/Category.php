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

public function getThumbnailUrlAttribute()
{

    if ($this->hasMedia('thumbnails')) {
        return $this->getFirstMediaUrl('thumbnails');
    }


    if (file_exists(storage_path('app/public/default.png'))) {
        return asset('storage/default.png');
    }


    if (file_exists(public_path('images/default.png'))) {
        return asset('images/default.png');
    }


    return 'https://via.placeholder.com/300x200.png?text=No+Image';
}

}
