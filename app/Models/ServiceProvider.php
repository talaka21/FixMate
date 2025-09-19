<?php

namespace App\Models;

use App\Enum\ServiceProviderEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
class ServiceProvider extends Model  implements HasMedia
{

  use HasTranslations , InteractsWithMedia;
    protected  $fillable =[
        'provider_name',
        'shop_name',
        'description',
        'phone',
        'whatsapp',
      'facebook',
       'instagram',
       'image',
       'gallery',
       'contract_start',
       'contract_end',
       'status',
       'views',
       'category_id',
       'subcategory_id',
       'city_id',
       'state_id',
    ];
     protected $casts = [
        'gallery' => 'array',
           'status'=>ServiceProviderEnum::class,
    ];

    public $translatable = ['name', 'description'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class);
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function offers()
    {
        return $this->hasMany(Offer::class);
    }

    public function sliders()
    {
        return $this->hasMany(Slider::class);
    }
    public function tags()
{
    return $this->belongsToMany(Tag::class, 'service_provider_tag', 'service_provider_id', 'tag_id');

}
public function getThumbnailUrlAttribute(): string
{
    // إذا عنده صورة محفوظة بالميديا
    if ($this->hasMedia('image')) {
        return $this->getFirstMediaUrl('image');
    }

    // إذا موجود default.png بمجلد storage/app/public
    if (file_exists(storage_path('app/public/default.png'))) {
        return asset('storage/default.png');
    }

    // إذا موجود default.png بمجلد public/images
    if (file_exists(public_path('images/default.png'))) {
        return asset('images/default.png');
    }

    // آخر حل → Placeholder من الإنترنت
    return 'https://via.placeholder.com/300x200.png?text=No+Image';
}
     public function registerMediaCollections(): void
    {
        $this->addMediaCollection('image')->singleFile();
    }

}
