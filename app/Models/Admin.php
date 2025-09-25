<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Filament\Models\Contracts\HasAvatar;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Translatable\HasTranslations;
class Admin extends Authenticatable
{
 use HasRoles;
    use HasTranslations;
    protected $fillable = [
    'email',
    'password',
    'name',
    'phone',
  
    ];


}
