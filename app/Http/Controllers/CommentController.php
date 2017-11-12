<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewCommentRequest;
use App\Repositories\CommentRepository;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    protected $commentRepository;

    public function __construct(CommentRepository $commentRepository) {
        $this->commentRepository = $commentRepository;
    }

    public function store(NewCommentRequest $request, $id)
    {
        $data = [
            'topic_id' => $id,
            'user_id' => Auth::id(),
            'body' => $request->get('body')
        ];

        $comment = $this->commentRepository->create($data);
        $comment->topic()->increment('num_comments');
        $comment->user()->increment('num_comments');

        return back();
    }
}
