@extends('layouts.app')
@include('vendor.ueditor.assets')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        {{$topic->title}}
                    </div>

                    <div class="panel-body">
                        {!! $topic->body !!}
                    </div>

                    @if(Auth::check())
                        <div class="panel-footer">
                            By {{$topic->user->name}} at {{$topic->created_at}}
                            · <strong>{{$topic->num_comments}}</strong> comments

                            <div class="actions pull-right">
                                @if(Auth::user()->owns($topic))
                                    <a href="/topics/{{$topic->id}}/edit">
                                        &nbsp;Edit&nbsp;
                                    </a>
                                @else
                                    <follow-button
                                            user_id="{{Auth::id()}}"
                                            topic_id="{{$topic->id}}">
                                    </follow-button>
                                @endif
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        @if(Auth::check())
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <form action="/topics/{{$topic->id}}/comments" method="post">
                    {!! csrf_field() !!}
                    <div style="height: 180px;">
                        <editor content="{!! old('body') !!}">
                        </editor>
                    </div>
                    <br>
                    <div>
                        @if ($errors->has('body'))
                            <span class="help-block pull-left">
                                <strong>{{ $errors->first('body') }}</strong>
                            </span>
                        @endif
                        <button class="btn btn-primary" type="submit">Submit</button>
                    </div>
                    <br>
                </form>
            </div>
        </div>
        @endif


        @foreach($topic->comments as $comment)
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Replied by {{$comment->user->name}} at {{$comment->created_at}}
                    </div>

                    <div class="panel-body">
                        {!! $comment->body !!}
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
@endsection
