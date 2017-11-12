<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','api_token','num_topics'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function followTopic($topic_id) {
        return $this->follows()->toggle($topic_id);
    }


    public function owns(Model $model) {
        return $this->id == $model->user_id;
    }

    public function follows() {
        return $this->belongsToMany(Topic::class,'user_topics')->withTimestamps();
    }

    public function isFollowed($topic_id) {
        return $this->follows()->where('topic_id', $topic_id)->count();
    }

    public function comments() {
        return $this->hasMany(Comment::class);
    }
}
