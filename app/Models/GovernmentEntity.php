<?php

namespace App\Models;

use App\Enum\stateStatusEnum;
use Illuminate\Database\Eloquent\Model;

class GovernmentEntity extends Model
{
    protected $fillable = [
'entity_name',
'description',
'image',
'phone',
'website',
'state_id',
'city_id',
'status',
    ];
     protected $casts = [
       'status'=>stateStatusEnum::class,
    ];
      public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }
}


