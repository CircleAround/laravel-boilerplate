<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

enum UserRole: int
{
    case Normal = 0;
    case Admin = 1;
}

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['name', 'email', 'password'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'role' => UserRole::class,
    ];

    public function isAdmin()
    {
        return $this->role == UserRole::Admin;
    }

    public function updateAttributes($attributes) {
        if(isset($attributes['password'])) {
            $this->fill($attributes);
            $this->setPassword($attributes['password']);
        } else {
            unset($attributes['password']);
            $this->fill($attributes);
        }

        $this->save();
    }

    private function setPassword($password) {
        $this->attributes['password'] = bcrypt($password);
    }
}
