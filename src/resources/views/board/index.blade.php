@extends('layouts.aironepage-noheader')
@section('content')
    <div id="board">
        <div class="container content-lg">
            <div class="row margin-b-40">
                <div class="col-sm-offset-1 col-sm-10">
                    <ol class="breadcrumb">
                        <li><a href="{{ url('/') }}">Home</a></li>

                        @if(!empty($cat))
                            <li><a href="{{ url('/board') }}">Webboard</a></li>
                            <li class="active">{{ $catName }}</li>
                            @else
                            <li class="active">Webboard</li>
                        @endif
                    </ol>
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th width="50%">Title</th>
                            <th class="text-center" width="25%">Last post</th>
                            <th class="text-center">Created by</th>
                            <th class="text-center">Category</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($topics as $topic)
                            <tr class="{{$topic->isPin() ? 'bg-success' : ''}} {{$topic->isLock() ? 'bg-danger' : ''}}">
                                <td><a href="{{ action('BoardController@show', ['id' => $topic->id]) }}">{{ $topic->title }} <span
                                                class="glyphicon glyphicon-{{$topic->isPin() ? 'pushpin' : ''}}{{$topic->isLock() ? 'ban-circle' : ''}}"
                                                aria-hidden="true"></span></a></td>
                                <td class="text-center">{{ $topic->updated_at }}</td>
                                <td class="text-center">{{ $topic->user->realname }}</td>
                                <td class="text-center"><a href="{{action('BoardController@index', ['cat' => $topic->category_id])}}"
                                                           class="">{{ $topic->category->title }}</a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!--// end row -->
        </div>
    </div>
@endsection