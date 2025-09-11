<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class password_resets extends Model
{
    use HasFactory;
       use HasTranslations;

      protected $table = 'phone_password_resets'; // <-- هنا الاسم الصحيح
    public $timestamps = false;
    protected $fillable = ['phone_number', 'token', 'created_at'];
}
