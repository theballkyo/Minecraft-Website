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
                        <div class="board-poster">Posted by {{ $topic->user->realname }} on {{ $topic->created_at    }}</div>
                        <div class="board-body">{!! $topic->body !!}</div>
                        <div class="board-footer"></div>
                    </div>
                    <div class="fb-comments" data-href="{{ url()->full() }}" data-width="100%" data-numposts="5"></div>
                </div>
            </div>
            <!--// end row -->
        </div>
    </div>
@endsection