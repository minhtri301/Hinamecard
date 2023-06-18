@extends('frontend.layouts.master')
@section('main')
<main id="main">
    <div class="container">
        <div class="box-thong-tin-user update-infomation box-login" >
            <div style="    width: 100%; margin-top: 16px;">
                {!! $dataSeo->content !!}
            </div>
        </div>
    </div>
@endsection


  