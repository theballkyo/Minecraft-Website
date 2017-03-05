@extends('layouts.aironepage-noheader')

@section('content')

    <div id="board">
        <div class="container content-lg">
            <div class="row margin-b-40">
                <div class="panel panel-default">
    <div class="panel panel-default">
        <div class="panel-heading">Create new topic</div>

        <div class="panel-body">
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form class="form-horizontal" method="post" action="{{action('BoardController@update', ['id' => $topic->id])}}">
                <div class="form-group">
                    <label for="title" class="col-md-2 col-sm-12 control-label">ชื่อกระทู้</label>
                    <div class="col-sm-12 col-md-10">
                        <input type="text" class="form-control" id="title" name="title" placeholder="Title" value="{{ $topic->title }}">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-12">
                        <textarea id="body" name="body">{!! $topic->body !!}</textarea>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <button type="submit" class="btn btn-default">Edit</button>
                    </div>
                </div>
                {!! csrf_field() !!}
                <input type="hidden" name="_method" value="put" />
            </form>
        </div>
    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
    <script>tinymce.init({
            selector:'textarea#body',
            height: 500,
            theme: 'modern',
            plugins: [
                'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                'searchreplace wordcount visualblocks visualchars code fullscreen',
                'insertdatetime media nonbreaking save table contextmenu directionality',
                'emoticons template paste textcolor colorpicker textpattern imagetools'
            ],
            toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
            toolbar2: 'print preview media | forecolor backcolor emoticons',
            image_advtab: true,
            templates: [
                { title: 'Test template 1', content: 'Test 1' },
                { title: 'Test template 2', content: 'Test 2' }
            ],

        });</script>
@endpush