<?php

namespace App\Models;

use App\Enum\ContactStatuEnum;
use Illuminate\Database\Eloquent\Model;

class ContactRequest extends Model
{
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
