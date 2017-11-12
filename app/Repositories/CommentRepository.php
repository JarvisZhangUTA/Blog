<?php
/**
 * Created by PhpStorm.
 * User: jarvis
 * Date: 11/10/17
 * Time: 3:39 PM
 */

namespace App\Repositories;
use App\Comment;

class CommentRepository
{
    function create(array $data){
        return Comment::create($data);
    }
}