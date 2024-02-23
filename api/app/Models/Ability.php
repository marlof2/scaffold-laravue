<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ability extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug'
    ];

    protected $hidden = [
        'updated_at','pivot'
    ];

    /**
     * profiles
     *
     * @return void
     */
    public function profiles()
    {
        return $this->belongsToMany(Profile::class, 'profile_abilities', 'ability_id', 'profile_id');
    }
}
