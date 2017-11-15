<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    protected $table = 'user_topics';

    protected $fillable = [
       'user_id', 'topic_id'
    ];
}
