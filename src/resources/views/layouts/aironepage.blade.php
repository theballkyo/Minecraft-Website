<!DOCTYPE html>
<html lang="en" class="no-js">
<!-- BEGIN HEAD -->
<head>
    <meta charset="utf-8"/>
    <title>{{ $headerTitle or 'Minecraft SkyRack' }}</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport"/>
    <meta name="description" content="{{ $headerDescription or 'Minecraft SkyRack เซิฟเวอร์ มายคราฟ สกายแร็ค เล่นฟรี เซิฟเวอร์แนวสร้างบ้านเล่น สนุกกันได้ทุกคน" name="description' }}"/>
    <meta name="keywords" content="{{ $headerKeywords or 'มายคราฟ สกายแร็ค,  minecraft skyrack, เซิฟมายคราฟล่าสุด,  minecraft server, มายคราฟ สร้างบ้าน' }}">

    <!-- GLOBAL MANDATORY STYLES -->
    <link href="//fonts.googleapis.com/css?family=Hind:300,400,500,600,700" rel="stylesheet" type="text/css">
    <link href="{{ url('/vendor/simple-line-icons/css/simple-line-icons.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ url('/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>

    <!-- PAGE LEVEL PLUGIN STYLES -->
    <link href="{{ url('/css/animate.css') }}" rel="stylesheet">
    <link href="{{ url('/vendor/swiper/css/swiper.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ url('/vendor/magnific-popup/magnific-popup.css') }}" rel="stylesheet" type="text/css"/>

    <!-- THEME STYLES -->
    <link href="{{ url('/css/layout.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ url('/css/skyrack.css') }}" rel="stylesheet" type="text/css"/>
    <!-- Favicon -->
    <link rel="shortcut icon" href="favicon.ico"/>
</head>
<!-- END HEAD -->

<!-- BODY -->
<body id="body" data-spy="scroll" data-target=".header">


<!--========== HEADER ==========-->
<header class="header navbar-fixed-top top-nav-collapse">
    <!-- Navbar -->
    <nav class="navbar" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="menu-container js_nav-item">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".nav-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="toggle-icon"></span>
                </button>

                <!-- Logo -->
                <div class="logo">
                    <a class="logo-wrap" href="{{ url('/') }}">MC SkyRack</a>
                </div>
                <!-- End Logo -->
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse nav-collapse">
                <div class="menu-container">
                    <ul class="nav navbar-nav navbar-nav-right">
                        <li class="js_nav-item nav-item active"><a class="nav-item-child nav-item-hover" href="{{ url('/') }}">Home</a></li>
                        <li class="js_nav-item nav-item"><a class="nav-item-child nav-item-hover" href="{{ url('/board') }}">Webboard</a></li>
                        @if(auth()->check())
                            <li class="js_nav-item nav-item"><a class="nav-item-child nav-item-hover">ยินดีต้อนรับ {{ auth()->user()->realname }}</a></li>
                            <li class="js_nav-item nav-item"><a class="nav-item-child nav-item-hover" href="{{ url('/logout') }}">ออกจากระบบ</a></li>
                        @else
                        <li class="js_nav-item nav-item"><a class="nav-item-child nav-item-hover" href="{{ url('/login') }}">เข้าสู่ระบบ / สมัครสมาชิก</a></li>
                        @endif
                    </ul>
                </div>
            </div>
            <!-- End Navbar Collapse -->
        </div>
    </nav>
    <!-- Navbar -->
</header>
<!--========== END HEADER ==========-->
@yield('header')
<!--========== PAGE LAYOUT ==========-->
@yield('content')
<!--========== END PAGE LAYOUT ==========-->
<!--========== FOOTER ==========-->
<footer class="footer">
    <!-- Copyright -->
    <div class="content container">
        <div class="row">
            <div class="col-xs-6">Render at {{ date(DATE_RFC2822) }}
            </div>
            <div class="col-xs-6 text-right">
                <p class="margin-b-0"><a class="fweight-700" href="https://mc-skyrack.tk">MC SkyRack</a> Theme Powered by: <a class="fweight-700" href="http://www.keenthemes.com/">KeenThemes.com</a></p>
            </div>
        </div>
        <!--// end row -->
    </div>
    <!-- End Copyright -->
</footer>
<!--========== END FOOTER ==========-->

<!-- Back To Top -->
<a href="javascript:void(0);" class="js-back-to-top back-to-top">Top</a>

<!-- JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- CORE PLUGINS -->
<script src="{{ url('/vendor/jquery.min.js') }}" type="text/javascript"></script>
<script src="{{ url('/vendor/jquery-migrate.min.js') }}" type="text/javascript"></script>
<script src="{{ url('/vendor/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>

<!-- PAGE LEVEL PLUGINS -->
<script src="{{ url('/vendor/jquery.easing.js') }}" type="text/javascript"></script>
<script src="{{ url('/vendor/jquery.back-to-top.js') }}" type="text/javascript"></script>
<script src="{{ url('/vendor/jquery.smooth-scroll.js') }}" type="text/javascript"></script>
<script src="{{ url('/vendor/jquery.wow.min.js') }}" type="text/javascript"></script>
<script src="{{ url('/vendor/swiper/js/swiper.jquery.min.js') }}" type="text/javascript"></script>
<script src="{{ url('/vendor/magnific-popup/jquery.magnific-popup.min.js') }}" type="text/javascript"></script>
<script src="{{ url('/vendor/masonry/jquery.masonry.pkgd.min.js') }}" type="text/javascript"></script>
<script src="{{ url('/vendor/masonry/imagesloaded.pkgd.min.js') }}" type="text/javascript"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBsXUGTFS09pLVdsYEE9YrO2y4IAncAO2U&amp;callback=initMap" async defer></script>

<!-- PAGE LEVEL SCRIPTS -->
<script src="{{ url('/js/layout.min.js') }}" type="text/javascript"></script>
<script src="{{ url('/js/components/wow.min.js') }}" type="text/javascript"></script>
<script src="{{ url('/js/components/swiper.min.js') }}" type="text/javascript"></script>
<script src="{{ url('/js/components/maginific-popup.min.js') }}" type="text/javascript"></script>
<script src="{{ url('/js/components/masonry.min.js') }}" type="text/javascript"></script>
<script src="{{ url('/js/components/gmap.min.js') }}" type="text/javascript"></script>

@yield('script')
</body>
<!-- END BODY -->
</html>