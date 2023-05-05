<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function owner()
    {
        return $this->belongsTo(User::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function users()
    {
        return $this->hasManyThrough(User::class, 'members');
    }

    public function members()
    {
        return $this->hasMany(Member::class);
    }

    public function memberOf(User $user)
    {
        return $this->members()
            ->where(['user_id' => $user->id])
            ->first();
    }
}
