@extends('layouts.app')
@include('vendor.ueditor.assets')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="text-cen">
                    Edit Topic

                    <form class="pull-right" action="/topics/{{$topic->id}}" method="post">
                        {{ method_field('DELETE') }}
                        {!! csrf_field() !!}
                        <button class="btn btn-link" style="color: red; margin: 0; padding: 0;"
                                type="submit">
                            Delete
                        </button>
                    </form>
                </div>
                <form action="/topics/{{$topic->id}}" method="post">
                    {{ method_field('PATCH') }}
                    {!! csrf_field() !!}
                    <div class="form-group">
                        <input type="text" value="{{$topic->title}}" name="title" class="form-control" placeholder="title">
                    </div>
                    <script id="container" name="body" type="text/plain">
                        {!! $topic->body !!}
                    </script>
                    <div style="padding: 25px 0">
                        @if ($errors->has('title'))
                            <span class="help-block pull-left">
                                <strong>{{ $errors->first('title') }}</strong>
                            </span>
                        @elseif($errors->has('body'))
                            <span class="help-block pull-left">
                                <strong>{{ $errors->first('title') }}</strong>
                            </span>
                        @endif
                        <button class="btn btn-primary pull-right" type="submit">
                            Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- 实例化编辑器 -->
    <script type="text/javascript">

        var ele = document.getElementById('container');
        ele.style.height='60%';
        ele.style.width='100%';

        var ue = UE.getEditor('container', {
            toolbars: [
                ['bold', 'italic', 'underline', 'strikethrough', 'blockquote',
                    'insertunorderedlist', 'insertorderedlist', 'justifyleft',
                    'justifycenter', 'justifyright',  'link', 'insertimage']
            ],
            elementPathEnabled: false,
            enableContextMenu: false,
            autoClearEmptyNode:true,
            wordCount:false,
            imagePopup:false,
            autotypeset:{ indent: true,imageBlockLine: 'center' }
        });
        ue.ready(function() {
            ue.execCommand('serverparam', '_token', '{{ csrf_token() }}'); // 设置 CSRF token.
        });
    </script>
@endsection
