@extends('layouts.aironepage-header')
@section('content')
    <div id="fb-root"></div>
    <script>(function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.8&appId=776272905731034";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>
    <div id="products">
        <div class="container content-lg">
            <div class="row text-center margin-b-40">
                <div class="col-sm-6 col-sm-offset-3">
                    <h2>Server Status</h2>
                    <h2 id="server-status" class="server--on">[กำลังตรวจสอบสถานะ]</h2>
                    <h3><b>IP:</b>
                        <div class="server-ip">play.mc-skyrack.tk</div>
                    </h3>
                    <h3><b>VERSION:</b>
                        <div class="server-ip">1.11.2</div>
                    </h3>
                    <p></p>
                </div>
            </div>
            <!--// end row -->
        </div>
    </div>

    <!-- Service -->
    <div id="service">
        <div class="bg-color-sky-light" data-auto-height="true">
            <div class="content-lg container">
                <div class="row row-space-2 margin-b-4">
                    <div class="col-sm-4 sm-margin-b-4">
                        <div class="service" data-height="height">
                            <div class="service-element">
                                <i class="service-icon icon-chemistry"></i>
                            </div>
                            <div class="service-info">
                                <h3>เล่นฟรี ไม่ต้องเติมเงิน</h3>
                                <p class="margin-b-5">เซิฟเวอร์ของเราเล่นได้ฟรี
                                    ไม่ต้องเติมเงินก็ทำได้ทุกอย่างที่เซิฟเวอร์เรามี</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4 sm-margin-b-4">
                        <div class="service bg-color-base wow fadeInDown" data-height="height" data-wow-duration=".3"
                             data-wow-delay=".1s">
                            <div class="service-element">
                                <i class="service-icon color-white icon-speedometer"></i>
                            </div>
                            <div class="service-info">
                                <h3 class="color-white">เปิดยาวแน่นอน</h3>
                                <p class="color-white margin-b-5">ไม่ต้องกลัวปิดหนี เซิฟเวอร์เราเปิดยาวแน่นอน</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="service" data-height="height">
                            <div class="service-element">
                                <i class="service-icon icon-badge"></i>
                            </div>
                            <div class="service-info">
                                <h3>ทีมงานดูแลแน่นอน</h3>
                                <p class="margin-b-5">มีปัญหา ติดขัด เจอบัค สามารถแจ้งทีมงานได้ตลอดทั้งในเกม, เฟสบุ้ค
                                    หรือเว็บไซต์</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!--// end row -->
            </div>
        </div>
    </div>
    <!-- End Service -->

    <!-- Testimonials -->
    <div class="content-md container">
        <div class="row">
            <div class="col-sm-8">
                <h2>ข่าวจากทางทีมงาน</h2>
                @foreach($topics as $topic)
                    <blockquote class="blockquote">
                        <a href="{{ action('BoardController@show', ['id' => $topic->id]) }}">
                            <div class="blockquote--header"><h3>{{ $topic->title }}</h3></div>
                        </a>
                        <div class="margin-b-20">{!!$topic->body!!}</div>
                        <p><span class="fweight-700 color-link">{{ $topic->created_at }}</span></p>
                    </blockquote>
                @endforeach
            </div>
            <div class="col-sm-4">
                <div class="fb-page" data-href="https://www.facebook.com/zoneGamer/" data-tabs="timeline" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/zoneGamer/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/zoneGamer/">ZoneGamer Community</a></blockquote></div>
                <p></p>
                <iframe src="https://discordapp.com/widget?id=213826362136330240&theme=dark" width="100%" height="400" allowtransparency="true" frameborder="0"></iframe>

            </div>
        </div>
        <!--// end row -->
    </div>
    <!-- End Testimonials -->
@endsection
@push('script')
    <script>

        $(document).ready(function () {
            var $game_info = $("#server-status");
            var request = $.ajax({
                url: "//mcapi.ca/query/mc.ezdev.me/info",
                method: "POST",
                dataType: "json"
            });

            request.done(function (msg) {
                if (msg.status === false) {
                    $game_info.text("[OFFLINE]");
                    $game_info.attr('class', 'server--off');
                } else {
                    $game_info.text("[ONLINE]");
                    $game_info.attr('class', 'server--on');
//                    $game_info.append("<b>สถานะ :: </b> เปิดปกติ");
//                    var $p = msg.players;
//                    $game_info.append("<br><b>ผู้เล่น :: </b> " + $p.online + "/" + $p.max);
                }
//                console.log(msg);
            });

            request.fail(function (jqXHR, textStatus) {
                $game_info.append("<b>สถานะ :: </b> ปิดปรับปรุงชั่วคราว");
            });

            request.always(function () {
//                $("#loading_status").remove();
            });
        });

    </script>
@endpush