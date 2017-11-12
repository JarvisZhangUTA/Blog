<?php

namespace App\Http\Controllers;

use App\Follow;
use Illuminate\Support\Facades\Auth;

class FollowController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function follow($topic_id) {
        Auth::user()->followTopic($topic_id);
        return back();
    }
}
