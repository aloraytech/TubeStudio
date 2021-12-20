<?php

namespace App\Models\System;

use App\Models\Business\Subscriptions;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * @property $providers
 * @property $id
 * @property $name
 * @property $email
 * @property $accessToken
 * @property $guarded
 * @property $attributes
 * @property $rememberTokenName
 */
class Members extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function providers()
    {
        return $this->hasMany(Providers::class,'members_id','id');
    }

    public function hasProvider($provider)
    {
        return (bool) $this->providers->where('provider', $provider)->count();
    }

    public function activities()
    {
        return $this->belongsToMany(Activities::class);
    }

    public function subscriptions()
    {
        return $this->belongsToMany(Subscriptions::class, 'subscriptions')->withTimestamps();
    }


}
