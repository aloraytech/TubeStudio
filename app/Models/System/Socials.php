<?php

namespace App\Models\System;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Socials extends Model
{
    use HasFactory;

    protected $fillable = ['social','social_id','user_id','avatar'];
    protected $hidden = ['created_at','updated_at'];

    public function members()
    {
        return $this->hasOne(Members::class, 'id', 'members_id');
    }



}
