@extends('layouts.aironepage-noheader')
@section('content')
    <div id="fb-root"></div>
    <script>(function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.8&appId=776272905731034";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>
    <div id="board">
        <div class="container content-lg">
            <div class="row margin-b-40">
                <div class="col-sm-offset-2 col-sm-8">
                    <ol class="breadcrumb">
                        <li><a href="{{ url('/') }}">Home</a></li>
                        <li><a href="{{ url('/board') }}">Webboard</a></li>
                        <li><a href="{{ action('BoardController@index', ['cat' => $topic->category->id]) }}">{{ $topic->category->title }}</a></li>
                        <li class="active">{{ str_limit($topic->title, 40) }}</li>
                    </ol>
                    <div class="board-topic">
                        <h2 class="board-title">{{ $topic->title }}</h2>
                        <div class="board-body">{!! $topic->body !!}</div>
                        <div class="board-poster">Posted by {{ $topic->user->realname }} on {{ $topic->created_at }}
                            @if ($topic->canEdit())
                                <a href="{{ action('BoardController@edit', ['id' => $topic->id]) }}" class="btn btn-default"><span class="glyphicon glyphicon-wrench"></span> แก้ไข</a>
                                @if ($topic->isLock())
                                    @if ($topic->canUnlock())
                                        <a href="{{ action('BoardController@lock', ['id' => $topic->id]) }}" class="btn btn-danger"><span class="glyphicon glyphicon-ok-circle color-white"></span> เปิดกระทู้</a>
                                    @endif
                                    {{--Nothing to show--}}
                                @else
                                    <a href="{{ action('BoardController@lock', ['id' => $topic->id]) }}" class="btn btn-danger"> <span class="glyphicon glyphicon-ban-circle color-white"></span> ปิดกระทู้</a>
                                @if ($topic->canPin())
                                    <a href="{{ action('BoardController@pin', ['id' => $topic->id]) }}" class="btn btn-warning">
                                        <span class="glyphicon glyphicon-pushpin color-white"></span>   {{ $topic->isPin() ? 'ยกเลิกปักหมุด' : 'ปักหมุด' }}
                                    </a>
                                 @endif
                                @endif
                            @endif
                        </div>
                        <div class="board-footer"></div>
                    </div>
                    <div class="fb-box">
                        <div class="fb-comments" data-href="{{ url()->full() }}" data-width="100%" data-numposts="5"></div>
                    </div>
                </div>
            </div>
            <!--// end row -->
        </div>
    </div>
@endsection