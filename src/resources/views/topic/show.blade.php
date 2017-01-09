@extends('layouts.app')

@section('content')
<div class="panel panel-default">
	@if (count($errors) > 0)
		<div class="alert alert-danger">
			<ul>
				@foreach ($errors->all() as $error)
					<li>{{ $error }}</li>
				@endforeach
			</ul>
		</div>
	@endif
	<div class="panel-heading">{{ $topic->title }}</div>
	<div class="panel-body">
		<div class="media">
	  <div class="media-left">
		<a href="#">
		  <img class="media-object" src="https://avatar.yourminecraftservers.com/avatar/source/minecraft/background/starburst/bgParams/%23111111,%23cccccc/notFound/steve/figure/classic/figureSize/60/borderSize/4/borderColor/%23000000/canvasSize/128/{{$topic->user->realname}}.png" alt="...">
		</a>
	  </div>
	  <div class="media-body">
		<h4 class="media-heading">{{ $topic->user->realname }}</h4>
		@if (auth()->check())
				@if (auth()->user()->isMod())
					<a class="btn btn-success" href="{{ action('BoardController@pin', ['id' => $topic->id]) }}">{{ $topic->isPin() ? 'Unpin' : 'Pin' }}</a>
					<a class="btn btn-danger" href="{{ action('BoardController@lock', ['id' => $topic->id]) }}">{{ $topic->isLock() ? 'Unlock' : 'Lock' }}</a>
				@endif
				@if ($topic->canEdit())
					<a class="btn btn-danger" href="{{ action('BoardController@deleteConfirm', ['id' => $topic->id]) }}">Delete</a>
					<a class="btn btn-info" href="{{action('BoardController@edit', ['id' => $topic->id])}}">Edit</a>
				@endif
			@endif
			<a class="btn btn-success">Reply</a>
	  </div>
	</div>
		<hr>
		{!! $topic->body !!}
		{{--
		<p>
			<div class="fb-comments" data-href="{{ url()->current() }}" data-numposts="5" data-width="100%"></div>
		</p>
		--}}
		<div class="infomation">
			<small>Created by {{ $topic->user->realname }} :: {{ $topic->created_at }}</small>
		</div>
	</div>
</div>

@foreach ($topic->comment as $comment)
	<hr>
	<div class="media">
	  <div class="media-left">
		<a href="#">
		  <img class="media-object" src="https://avatar.yourminecraftservers.com/avatar/source/minecraft/background/starburst/bgParams/%23111111,%23cccccc/notFound/steve/figure/classic/figureSize/60/borderSize/4/borderColor/%23000000/canvasSize/128/{{$comment->user->realname}}.png" alt="...">
		</a>
	  </div>
	  <div class="media-body">
		<h4 class="media-heading">{{ $comment->user->name }}<small> Say - {{ $comment->updated_at }}</small></h4>
		<p></p>
		{!! $comment->body !!}
	  </div>
	</div>
@endforeach
<hr>
@if(Auth::guest())
<a class="btn btn-default" href="{{ url('/login') }}">Login เพื่อตอบกระทู้</a>
@elseif(!$topic->canReply())
@else
<form name="reply" class="form-horizontal" method="post" action="{{action('BoardController@storeReply')}}">
	<div class="form-group">
		<div class="col-sm-12">
			<textarea id="body" name="body"></textarea>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-12">
			<button type="submit" class="btn btn-default">ตอบกระทู้</button>
		</div>
	</div>
	<input type="hidden" name="id" value="{{ $topic->id }}">
	{!! csrf_field() !!}
</form>
@section('script')
	<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
	<script>tinymce.init({ selector:'textarea#body' });</script>
@endsection
@endif
@endsection