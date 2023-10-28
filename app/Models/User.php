<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Contracts\Translation\HasLocalePreference;

class User extends Authenticatable implements HasLocalePreference
{
    use HasApiTokens, HasFactory, Notifiable;

    const AUTH_PROVIDERS = [
        self::API_AUTH_PROVIDER,
        self::GOOGLE_AUTH_PROVIDER,
        self::APPLE_AUTH_PROVIDER,
    ];
    const PLATFORMS = [
        self::ANDROID_PLATFORM,
        self::IOS_PLATFORM,
    ];

    const DEFAULT_LOCALE = 'es';
    const API_AUTH_PROVIDER = 'api';
    const GOOGLE_AUTH_PROVIDER = 'google';
    const APPLE_AUTH_PROVIDER = 'apple';
    const ANDROID_PLATFORM = 'android';
    const IOS_PLATFORM = 'ios';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'surname',
        'email',
        'password',
        'last_activity',
        'front_version',
        'platform',
        'device',
        'auth_provider',
        'fcm_token',
        'locale'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'fcm_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class);
    }

    public function preferredLocale(): string
    {
        return $this->locale;
    }

    public function hasAnyRole(array $roles): bool
    {
        return $this->roles->contains($roles);
    }
}
