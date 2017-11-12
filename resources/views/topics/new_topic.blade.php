@extends('layouts.app')
@include('vendor.ueditor.assets')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                New Topic
                <form action="/topics" method="post">
                    {!! csrf_field() !!}
                    <div class="form-group">
                        <input type="text" value="{{old('title')}}" name="title" class="form-control" placeholder="title">
                    </div>
                    <editor content="{{old('body')}}"></editor>
                    <br>
                    <div>
                        @if ($errors->has('title'))
                            <span class="help-block pull-left">
                                <strong>{{ $errors->first('title') }}</strong>
                            </span>
                        @elseif($errors->has('body'))
                            <span class="help-block pull-left">
                                <strong>{{ $errors->first('title') }}</strong>
                            </span>
                        @endif

                        <button class="btn btn-primary pull-right" type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
