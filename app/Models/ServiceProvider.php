<?php

namespace App\Models;

use App\Enum\ServiceProviderEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
class ServiceProvider extends Model
{

  use HasTranslations;
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

}
