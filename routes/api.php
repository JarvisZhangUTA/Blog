<?php

use Illuminate\Http\Request;


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('api')->get('/topics/{topic_id}/followers', function($topic_id) {
    $followers = \App\Follow::where('topic_id', $topic_id)->get();
    return response()->json(['followers'=> $followers]);
});

Route::middleware('api')->put('/topics/{topic_id}/followers', function(Request $request, $topic_id) {
    $user_id = $request->get('user_id');
    $follow = \App\Follow::where('topic_id', $topic_id)
                ->where('user_id', $user_id)
                ->first();
    if($follow !== null) {
        $follow->delete();
        return response()->json(['isFollowed' => false]);
    }

    \App\Follow::create(['user_id' => $user_id, 'topic_id' => $topic_id]);
    return response()->json(['isFollowed' => true]);
});


Route::middleware('api')->post('/topics/search', 'TopicController@search');

