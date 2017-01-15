@extends('layouts.aironepage')
@section('header')
    <!--========== SLIDER ==========-->
    <div class="promo-block">
        <div class="container">
            <div class="margin-b-40">
                <h1 class="promo-block-title">Minecraft SkyRack</h1>
                <p class="promo-block-text">เซิฟเวอร์มายคราฟสไตร์คลาสสิค</p>
            </div>
            <a class="btn-theme btn-theme-md btn-white-bg text-uppercase" href="{{ action('BoardController@show', ['id' => 4]) }}">IP: play.mc-skyrack.tk</a>
        </div>
    </div>
    <!--========== SLIDER ==========-->
@endsection