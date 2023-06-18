@extends('frontend.layouts.master')
@section('main')
<main id="main">
    <div class="container">
        <div class="box-thong-tin-user box-login position-relative">
            <form action="{{route('home.page.details')}}" method="GET">
                <div class="img-avatar">
                    <img src="{{asset(@$customer->image ? $customer->image : 'frontend/images/user (9) 1.png')}}" class="avatar" alt="">
                    <div class="file">
                        <img src="{{asset('frontend/images/Group 9715.png')}}" alt="avatar" >
                    </div>      
                </div>
                <div class="content">
                    <h2 class="name">{{@$customer->name ? @$customer->name : '@nguyenvana' }}</h2>
                    <p class="desc">{{@$customer->title ? @$customer->title : 'Chưa có mô tả'}}</p>
                </div>
                <button type="submit">Cập nhật thông tin</button>
                <a href="{{route('home.logout')}}" class="btn  logout" >Đăng xuất</a>
            </form>
            {{-- <div class="right-setting">
                <button class="login-button" data-bs-toggle="modal" data-bs-target="#setting"><i class="fas fa-bars"></i></button>
            </div> --}}
        </div>
    </div>
    {{-- <div class="modal" id="setting" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered justify-content-center">
            <div class="modal-content" style="max-width: 170px;">
                <div class="body-modal text-center" >
                    <a href="{{route('home.logout')}}" class="btn btn-block btn-danger" style="font-size: 14px"><i class="fa fa-bell" style="margin-right: 10px"></i>Đăng xuất</a>
                </div>
            </div>
        </div>
    </div> --}}
@endsection
