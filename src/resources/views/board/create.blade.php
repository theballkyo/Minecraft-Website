@extends('layouts.aironepage-noheader')

@section('content')

    <div id="board">
        <div class="container content-lg">
            <div class="row margin-b-40">
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
            <form class="form-horizontal" method="post" action="{{action('BoardController@store')}}">
                <div class="form-group">
                    <label for="title" class="col-sm-2 control-label">ชื่อหัวข้อ</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="title" name="title" placeholder="ชื่อหัวข้อ" value="{{ old('title') }}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="category" class="col-sm-2 control-label">หมวดหมู่</label>
                    <div class="col-sm-10">
                        <select class="form-control" name="category" id="category">
                            <option value="-1">กรุณาเลือกหมวดหมู่</option>
                            @foreach($category as $cat)
                                <option value="{{ $cat->id }}" {{ old('category') == $cat->id ? 'selected' : '' }}>{{$cat->title}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-12">
                        <textarea id="body" name="body">{{ old('body') }}</textarea>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <button type="submit" class="btn btn-default">Post</button>
                    </div>
                </div>
                {!! csrf_field() !!}
            </form>
        </div>
    </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
    <script>tinymce.init({ selector:'textarea#body' });</script>
@endpush