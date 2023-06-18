@extends('frontend.layouts.master')
@section('main')
<main id="main">
    <div class="container">
        <div class="box-login">
            <img class="logo" src="{{asset(!empty($site_info->logo_login) ? $site_info->logo_login : 'sticker1.png')}}" alt="logo" srcset="">
            <div class="box-login-register">
                <a href="javascript:void(0);" class="login btn">Đăng nhập</a>
                <a href="#" class="register" >Đăng ký</a>
            </div>
            <div class="modals">
                <div class="modal-content">
                    <div class="header-modal">
                        <h3>Đăng Nhập</h3>
                        <span class="close">&times;</span>
                    </div>
                    <div class="body-modal">
                        <h5 class="title">Vui lòng nhập mã đăng nhập đã được cung cấp</h5>
                        <form action="{{route('home.login.post')}}" method="post">
                            @csrf
                            <input type="text" name="login_code" id="login-code-input" placeholder="X-X-X-X-X-X">
                            <button type="submit">Đăng nhập</button>
                        </form>
                        <p>Chưa có tài khoản?<a href="#" class="register-now"> Đăng ký ngay</a></p>
                        <a href="#" class="support">Trung tâm hỗ trợ</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

