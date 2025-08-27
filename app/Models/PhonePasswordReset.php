<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PhonePasswordReset extends Model
{

protected $table = 'phone_password_resets';

    public $timestamps = false;
    protected $fillable = ['phone_number', 'token', 'created_at'];
}
