<?php

namespace App\Models\System;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property $provider
 * @property $provider_id
 * @property $members_id
 * @property $avatar
 */
class Providers extends Model
{
    use HasFactory;

    protected $fillable = ['provider','provider_id','members_id','avatar'];
    protected $hidden = ['created_at','updated_at'];

    public function members()
    {
        return $this->hasOne(Members::class, 'id', 'members_id');
    }



}
