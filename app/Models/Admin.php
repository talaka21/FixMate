<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Filament\Models\Contracts\HasAvatar;
use Illuminate\Support\Facades\Storage;


class Admin extends Authenticatable
{

    protected $fillable = [
    'email',
    'password',
    'name',
    'phone',
    //  'avatar_url',
    ];

//  public function getFilamentAvatarUrl(): ?string
//     {
//         $avatarColumn = config('filament-edit-profile.avatar_column', 'avatar_url');

//         return $this->$avatarColumn
//             ? Storage::url($this->$avatarColumn)
//             : null;
//     }
}
