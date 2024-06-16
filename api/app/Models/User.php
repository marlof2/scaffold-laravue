<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'cpf',
        'email',
        'password',
        "primeiro_acesso",
        'profile_id',

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
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


    public  function scopeFiltro($query, $filtro)
    {
        // if (str_contains($filtro, '/')) {
        //     $filtro = Carbon::createFromFormat('d/m/Y', $filtro)->format('Y-m-d');
        // }

        return $query
            ->OrWhere('name', 'LIKE', '%' . $filtro . '%')
            ->OrWhere('cpf', 'LIKE', '%' . $filtro . '%')
            ->OrWhere('email', 'LIKE', '%' . $filtro . '%')
            ->paginate(config('app.pageLimit'));
    }


    public function profile()
    {
        return $this->hasOne(Profile::class, 'id', 'profile_id');
    }
}
