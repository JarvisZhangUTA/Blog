@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <search-bar></search-bar>
                <topic-list></topic-list>
            </div>
        </div>
    </div>
@endsection
