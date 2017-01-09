@extends('layouts.app')

@section('content')
<a href="{{action('BoardController@index')}}" class="btn btn-info">ทั้งหมด</a>
@foreach($category as $cat)
<a href="{{action('BoardController@index', ['cat' => $cat->id])}}" class="btn btn-info">{{ $cat->title }}</a>
@endforeach
@if(auth()->check())
	<a href="{{action('BoardController@create')}}" class="btn btn-success">สร้างกระทู้ใหม่</a>
@else
	<a href="{{ url('/login') }}" class="btn btn-success">Login เพื่อตั้งกระทู้</a>
@endif
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
			<td><a href="{{ action('BoardController@show', ['id' => $topic->id]) }}">{{ $topic->title }} <span class="glyphicon glyphicon-{{$topic->isPin() ? 'pushpin' : ''}}{{$topic->isLock() ? 'ban-circle' : ''}}" aria-hidden="true"></span></a></td>
			<td class="text-center">{{ $topic->updated_at }}</td>
			<td class="text-center">{{ $topic->user->realname }}</td>
			<td class="text-center"><a href="{{action('BoardController@index', ['cat' => $topic->category_id])}}" class="">{{ $topic->category->title }}</a></td>
		</tr>
	@endforeach
	</tbody>
	</table>
@endsection

@section('script')
	<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
	<script>tinymce.init({ selector:'textarea#body' });</script>
@endsection