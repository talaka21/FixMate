<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
class PhonePasswordReset extends Model
{
       use HasTranslations;

protected $table = 'phone_password_resets';

    public $timestamps = false;
    protected $fillable = ['phone_number', 'token', 'created_at'];
}
