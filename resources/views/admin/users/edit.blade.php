@extends('admin.layouts.app')
@section('controller', 'Thêm mới người dùng')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2 tieu-de" style="margin-left: 69.5px;">
                <div class="col-sm-6">
                    <h4 class="m-0">Chi tiết người dùng</h4>
                </div><!-- /.col -->
        
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <div class="container-fluid">
        <div class="row row-thongtin">
            <div class="col-12 col-md-10">
                <form action="{{route('managementAdmin.post.update',$data->id)}}" method="POST" >
                    @csrf
                    <div class="card card-secondary card-outline">
                        <div class="card-body">
                            <div class="row" >
                                <div class="col-11 col-sm-10">
                                    <label for="">1. THÔNG TIN CHUNG </label>
                                </div>
                                <div class="col-1 col-sm-2 row-one-right">
                                    <div class="float-sm-right">
                                        @if($data->status==1)
                                        <span  class="badge badge-pill badge-success">Đã kích hoạt</span> 
                                        @else
                                        <span  class="badge badge-pill badge-danger">Chưa kích hoạt</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row" >
                                <div class="col-12 col-sm-4">
                                    <div class="form-group">
                                    <label for="">Tên đăng nhập <span style="color: red">*</span></label>
                                    <div class="input-group"  data-target-input="nearest">
                                        <input type="text" class="form-control" placeholder="Nhập tên" value="{{old('user_name',$data->user_name)}}" name="user_name" >
                                    </div>
                                    @if ($errors->has('user_name'))
                                    <span class="fr-error d-block mt-2" style="color: red"><i class="fas fa-exclamation-circle"></i> {{$errors->first('user_name')}}</span>    
                                    @endif
                                    </div>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="form-group">
                                        <label for="">Ngày tạo </label>
                                        <div class="input-group date" id="datetimepicker4" data-target-input="nearest">
                                            <input type="text" name="date" value="{{old('from_date',$data->date)}}" placeholder="dd/mm/yyyy" class="form-control datetimepicker-input test" data-target="#datetimepicker4"/>
                                            <div class="input-group-append " data-target="#datetimepicker4" data-toggle="datetimepicker">
                                                <div class="input-group-text "><i class="far fa-calendar-alt "></i></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="form-group">
                                        <label for="input-group">Vai trò <span style="color: red">*</span></label>
                                        <select  class="form-control" name="role_id">
                                            @foreach ($role as $item)
                                            <option value="{{$item->id}}" @if ($item->id == $data->roles->pluck('id')->first()) selected @endif>{{$item->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <input type="hidden" name="type" value="admin">
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                    <label for="">Mật khẩu <span style="color: red">*</span></label>
                                    <div class="input-group"  data-target-input="nearest">
                                        <input type="password" name="password" class="form-control">
                                    </div>
                                    @if ($errors->has('password'))
                                    <span class="fr-error d-block mt-2" style="color: red"><i class="fas fa-exclamation-circle"></i> {{$errors->first('password')}}</span>    
                                    @endif
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                    <label for="">Nhắc lại mật khẩu <span style="color: red">*</span></label>
                                    <div class="input-group"  data-target-input="nearest">
                                        <input type="password" name="repassword" class="form-control" >
                                    </div>
                                    @if ($errors->has('repassword'))
                                    <span class="fr-error d-block mt-2" style="color: red"><i class="fas fa-exclamation-circle"></i> {{$errors->first('repassword')}}</span>    
                                    @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="">Sử dụng <span style="color: red">*</span></label>
                                    <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" name="status" id="customSwitch1"  @if($data->status==1) checked @endif>
                                    <label class="custom-control-label" for="customSwitch1"></label>
                                    </div>
                                </div>
                                </div>
                            </div>
                            <label for="">2. THÔNG TIN CÁ NHÂN </label>     
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="">Avatar</label>
                                        <div class="image">
                                            <div class="image__thumbnail">
                                                <img src="{{ old('image',$data->image) ? old('image',$data->image) :  __NO_IMAGE_DEFAULT__ }}"
                                                    data-init="{{ __NO_IMAGE_DEFAULT__ }}">
                                                <a href="javascript:void(0)" class="image__delete"
                                                    onclick="urlFileDelete(this)">
                                                    <i class="fa fa-times"></i></a>
                                                <input type="hidden" value="{{ old('image',@$data->image) }}" name="image" />
                                                <div class="image__button" onclick="fileSelect(this)"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-sm-4">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label for="">Họ và tên </label>
                                            <div class="input-group"  data-target-input="nearest">
                                                <input type="text" name="name" value="{{old('name',@$data->name)}}" class="form-control" placeholder="Nhập họ tên">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-8">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label for="">Mô tả</label>
                                            <div class="input-group"  data-target-input="nearest">
                                                <input type="text"  value="{{old('title',@$data->title)}}" name="title" class="form-control" placeholder="nhập mô tả">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="text-center">
                                <a href="{{route('managementAdmin.index')}}" class="btn" style="border: 1px solid #DEDEDE;margin-right:10px"><img src="{{asset('frontend/image/cancel.png')}}" alt="">    Hủy</a>
                                <button class="btn btn-dark"><i class="fal fa-save" style="color: #ffffff;margin-right:10px"></i>lưu</button>
                            </div>
                        </div>
                    </div>
                </form>        
            </div>
            <div class="col-md-2 row-thongtin-right-button" style="padding-left: 30px;display: flex; flex-direction: column;gap: 11px;">
                <a href="{{route('managementAdmin.index')}}" style="width: 45px;" class="btn btn-default"><i class="far fa-long-arrow-left"></i></a>
                <button style="width: 45px;" class="btn btn-dark"><i class="fal fa-save" style="color: #ffffff;"></i></button>
            </div>
        </div>
	</div>
@stop
@section('page_scripts')
<script type="text/javascript">
// $('#check').on('change',function(){
//     window.history.replaceState(null, null, "?type="+$(this).val());
//     location.reload();
// })
$(function () {
    $('#datetimepicker4').datetimepicker({
        format: 'YYYY/MM/DD'
    });
});

$('.btn-reload-code').on('click', function(e){
    e.preventDefault();
    const el = $(this); 
    const url = $(this).data("href");
    $.ajax({
        type: 'GET', 
        url: url, 
        dataType: "json", 
        success: function(data){
            $('#code').val(data.string);
        }
    })
})
</script>
@endsection