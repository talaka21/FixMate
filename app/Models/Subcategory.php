<?php

namespace App\Models;

use App\Enum\stateStatusEnum;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\Translatable\HasTranslations;
use Spatie\MediaLibrary\InteractsWithMedia;

class Subcategory extends Model  implements HasMedia

{
       use InteractsWithMedia;
     use HasTranslations;
    protected $fillable = [
        'name',
        'description',
        'thumbnail',
        'status',
        'category_id',
    ];
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('thumbnails')
            ->singleFile(); // إذا بدك صورة وحدة فقط
    }
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
    public function getThumbnailUrlAttribute()
{
    // إذا عنده صورة محفوظة بالميديا
    if ($this->hasMedia('thumbnails')) {
        return $this->getFirstMediaUrl('thumbnails');
    }

    // إذا موجود default.png بمجلد storage/app/public
    if (file_exists(storage_path('app/public/default.png'))) {
        return asset('storage/default.png');
    }

    // إذا موجود default.png بمجلد public/images
    if (file_exists(public_path('images/default.png'))) {
        return asset('images/default.png');
    }

    // آخر حل → Placeholder من الإنترنت (مثلاً صور مجانية من placeholder.com)
    return 'https://via.placeholder.com/300x200.png?text=No+Image';
}

}
