<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class notifications_enabled extends Model
{
   protected $casts = [
    'email_verified_at' => 'datetime',
    'notifications_enabled' => 'boolean',
];

}
