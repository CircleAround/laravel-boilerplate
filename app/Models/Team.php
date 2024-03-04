<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Team extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public static function createWithOwner(User $user, $params)
    {
        return DB::transaction(function () use ($user, $params) {
            $team = new Team($params);
            $team->owner_id = $user->id;
            $team->save();

            $member = new Member();
            $member->team_id = $team->id;
            $member->user_id = $team->owner_id;
            $member->role = 1;
            $member->save();

            return $team;
        });
    }    

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
    
    public function isManager(User $user)
    {
        return !empty(
            $this->members()
                ->where(['user_id' => $user->id, 'role' => 1])
                ->first()
        );
    }
}
