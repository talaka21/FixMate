<?php

namespace App\Models;

use App\Enum\ContactStatuEnum;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
class ContactRequest extends Model
{
       use HasTranslations;
    protected $fillable = [
        'user_name',
        'phone_number',
        'message',
        'status',
    ];

    protected $casts = [
        'status' => ContactStatuEnum::class

    ];
}
