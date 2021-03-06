@extends('layouts.app')
@section('style')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/s/bs-3.3.5/jq-2.1.4,dt-1.10.10,r-2.0.0/datatables.min.css"/>
@endsection
@section('content')
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.5&appId=776272905731034";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<div class="panel panel-success">
    <div class="panel-heading">ข่าวประกาศ</div>

    <div class="panel-body">
        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="false">
        @foreach($topics as $topic)
            <div class="panel panel-info">
                <div class="panel-heading" role="tab" id="heading{{$topic->id}}">
                  <h4 class="panel-title">
                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse{{$topic->id}}" aria-expanded="false" aria-controls="collapse{{$topic->id}}">
                      {{$topic->title}} - <small>{{ $topic->updated_at }}</small>
                    </a>
                  </h4>
                </div>
                <div id="collapse{{$topic->id}}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading{{$topic->id}}">
                  <div class="panel-body">
                    {!!$topic->body!!}
                  </div>
                </div>
            </div>
        @endforeach
        </div>
    </div>
</div>

<div class="panel panel-primary">
    <div class="panel-heading">Discord</div>
    <div class="panel-body">
        <iframe src="https://discordapp.com/widget?id=213826362136330240&theme=dark" width="350" height="500" allowtransparency="true" frameborder="0"></iframe>
    </div>
</div>

<div class="panel panel-danger">
    <div class="panel-heading">Player stat</div>

    <div class="panel-body">
        <table data-order='[[ 1, "desc" ]]' id="player" class="table table-hover">
        <thead>
            <tr>
              <th class="text-center">Name</th>
              <th class="text-center">Last login</th>
            </tr>
        </thead>
        <tbody>
        @foreach($authme as $user)
            <tr>
            <td class="text-center">{{ $user->realname  }}</td>
            {{--<td class="text-center">{{ !empty($user->money->balance) ? $user->money->balance : 0.00 }}</td>--}}
            <td class="text-center">{{ date("Y-m-d H:i:s", $user->lastlogin / 1000) }}</td>
            </tr>
        @endforeach
        </tbody>
        </table>
    </div>
</div>
@endsection

@section('script')
<script type="text/javascript" src="https://cdn.datatables.net/s/bs-3.3.5/jq-2.1.4,dt-1.10.10,r-2.0.0/datatables.min.js"></script>
<script>
  $(document).ready(function(){
      $('#player').DataTable();
  });
</script>
@endsection