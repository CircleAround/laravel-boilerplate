<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'body', 'assignee_id'];

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function assignee()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function isFinished()
    {
        return $this->status === 1;
    }

    public function appendComment(User $user, $params)
    {
        DB::transaction(function () use ($user, $params) {
            $comment = $this->comments()->make($params);
            $comment->author_id = $user->id;
            $comment->save();

            if ($comment->isFinisher()) {
                $this->status = 1;
                $this->save();
            }
        });
    }
}
