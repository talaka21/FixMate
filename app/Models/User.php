<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Enum\UserEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Filament\Models\Contracts\HasAvatar;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'phone_number',
        'image',
        'state_id',
        'city_id',
        'status',
        'email',
        'password',

    ];

     
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {

        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'status'=>UserEnum::class,
        ];
    }

    public function getFullNameAttribute()
{
    return "{$this->first_name} {$this->last_name}";
}

public function notifications()
    {
        return $this->hasMany(Notification::class, 'created_by');
    }
public function serviceProviderRequest()
{
    return $this->hasOne(ServiceProviderRequest::class);
}

public function city()
{
    return $this->belongsTo(City::class);
}

public function state()
{
    return $this->belongsTo(State::class);
}

}
