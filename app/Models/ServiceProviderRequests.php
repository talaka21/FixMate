<?php

namespace App\Models;

use App\Enum\statusServiceProviderRequestEnum;
use Illuminate\Database\Eloquent\Model;

class ServiceProviderRequests extends Model
{
    protected $fillable = [
        'provider_name',
        'shop_name',
        'description',
        'phone',
        'whatsapp',
      'facebook',
       'instagram',
       'image',
        'status',
        'category_id',
       'subcategory_id',
       'city_id',
       'state_id',
    ];
 protected $casts = [
       'status'=>statusServiceProviderRequestEnum::class

    ];
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
}
