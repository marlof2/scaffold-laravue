<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'descricao',
    ];

    protected $hidden = [
        'updated_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'profile_id', 'id');
    }

    public function abilities()
    {
        return $this->belongsToMany(Ability::class, 'profile_abilities', 'profile_id', 'ability_id');
    }
}
