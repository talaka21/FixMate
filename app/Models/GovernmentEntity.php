<?php

namespace App\Models;

use App\Enum\stateStatusEnum;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;


class GovernmentEntity extends Model
{
     use HasTranslations;
    protected $fillable = [
        'name',
        'description',
        'image',
        'phone',
        'website',
        'state_id',
        'city_id',
        'status',
    ];
     public $translatable = ['name', 'description'];
    protected $casts = [
        'status' => stateStatusEnum::class,
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
