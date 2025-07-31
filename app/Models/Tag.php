<?php

namespace App\Models;

use App\Enum\stateStatusEnum;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
  protected $fillable = [
   'name',
   'status'
    ];
     protected $casts = [
       'status'=>stateStatusEnum::class,
    ];
    public function serviceProviders()
{
    return $this->belongsToMany(ServiceProvider::class, 'service_provider_tag', 'tag_id', 'service_provider_id');
}

}
