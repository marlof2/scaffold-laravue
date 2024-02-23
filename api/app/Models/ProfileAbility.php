<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfileAbility extends Model
{
    use HasFactory;

    protected $fillable = ['profile_id','ability_id'];
}
