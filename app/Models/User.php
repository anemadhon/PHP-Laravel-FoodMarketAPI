<?php

namespace App\Models;

use Carbon\Carbon;
use Laravel\Jetstream\HasTeams;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Jetstream\HasProfilePhoto;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use HasTeams;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
        'address', 'city', 'house_number',
        'phone_number', 'role',
        'profile_photo_path', 'username',
        'email_verified_at', 'provider_id', 'avatar'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public const VALIDATION_RULES = [
        'username' => ['required', 'string', 'unique:users', 'max:20'],
        'email' => ['required', 'email', 'string', 'unique:users', 'max:100'],
        'first_name' => ['required', 'string', 'min:3', 'max:100'],
        'last_name' => ['required', 'string', 'min:1', 'max:100'],
        'address' => ['required', 'string'],
        'city' => ['required', 'string'],
        'phone_number' => ['required', 'string'],
        'house_number' => ['required', 'string'],
        'role' => ['required', 'string', 'in:ADMIN,USER']
    ];

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->timestamp;
    }
    
    public function getUpdatedAtAttribute($value)
    {
        return Carbon::parse($value)->timestamp;
    }

    public function getRouteKeyName()
    {
        return 'username';
    }
}
