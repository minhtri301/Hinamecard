@extends('admin.layouts.app')
@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h4 class="m-0">Dashboard</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Trang tổng quan</a></li>
                </ol>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-12 col-sm-12 col-md-4">
            <div class="info-box">
                <span class="info-box-icon bg-dark elevation-1"><i class="fas fa-users-cog"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Admin</span>
                    <span class="info-box-number">
                        {{$user->count()}}
                    </span>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-12 col-md-4">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Người dùng</span>
                    <span class="info-box-number">{{$customer->count()}}</span>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-12 col-md-4">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-danger elevation-1"><i class="fab fa-app-store"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Ứng dụng</span>
                    <span class="info-box-number">{{$app->count()}}</span>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Người dùng mới</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body p-0" style="display: block;">
                    <ul class="products-list product-list-in-card pl-2 pr-2">
                        @foreach ($customer as $item)
                            @if ($loop->index <= 6)
                            <li class="item">
                                <div class="product-img">
                                    <img src="{{@$item->image ? $item->image : 'backend/images/placeholder.png'}}" alt="Product Image" class="img-size-50">
                                </div>            
                                <div class="product-info">
                                    <a href="javascript:void(0)" class="product-title">{{$item->name}}
                                        <div class="float-right">
                                            @if($item->status==1)
                                                <span class="badge badge-primary">Đã kích hoạt</span>
                                            @else
                                                <span class="badge badge-danger">Chưa kích hoạt</span>
                                            @endif
                                        </div>
                                    </a>
                                    <span class="product-description">                              
                                        <span class="badge badge-info">Nhóm: {{$item->group->name}}</span>
                                    </span>
                                </div>
                            </li>
                            @endif
                        @endforeach                     
                    </ul>
                </div>
                @if (Auth::user()->level==1)
                    <div class="card-footer text-center" style="display: block;">
                        <a href="{{route('management.index')}}" class="uppercase">Xem tất cả </a>
                    </div>
                @endif
            </div>
        </div>
        <div class="col-md-6 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Admin mới</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body p-0">
                    <ul class="products-list product-list-in-card pl-2 pr-2">
                        @foreach ($user as $item)
                        @if ($loop->index <= 6)
                        <li class="item">
                            <div class="product-img">
                                <img src="{{@$item->image ? $item->image : 'backend/images/placeholder.png'}}" alt="Product Image" class="img-size-50">
                            </div>            
                            <div class="product-info">
                                <a href="javascript:void(0)" class="product-title">{{$item->name}}
                                    <div class="float-right">
                                        @if($item->status==1)
                                            <span class="badge badge-primary">Đã kích hoạt</span>
                                        @else
                                            <span class="badge badge-danger">Chưa kích hoạt</span>
                                        @endif
                                    </div>
                                </a>
                            </div>
                        </li>
                        @endif
                        @endforeach  
                    </ul>
                </div>
                @if (Auth::user()->level==1)
                    <div class="card-footer text-center">
                        <a href="{{route('managementAdmin.index')}}" class="uppercase">Xem tất cả </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
