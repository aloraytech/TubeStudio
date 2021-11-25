<?php

namespace App\Models\System;

use App\Models\Business\Subscriptions;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

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


    public function socials()
    {
        return $this->hasMany(Socials::class,'members_id','id');
    }

    public function hasSocial($social)
    {
        return (bool) $this->socials->where('social', $social)->count();
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
