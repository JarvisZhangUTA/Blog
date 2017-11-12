@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-body">
                    <p>Hi! {{Auth::user()->name}}</p>
                    <p>
                        Email: {{Auth::user()->email}}<br>
                        Topics: {{Auth::user()->num_topics}}<br>
                        Comments: {{Auth::user()->num_comments}}<br>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Following
                </div>

                <div class="panel-body">
                    <topic-list-thumb follower_id="{{Auth::user()->id}}"></topic-list-thumb>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">
                    Your Topics
                </div>

                <div class="panel-body">
                    <topic-list-thumb user_id="{{Auth::user()->id}}"></topic-list-thumb>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
