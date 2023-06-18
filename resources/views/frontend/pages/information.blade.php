@extends('frontend.layouts.master')
@section('main')
<main id="main">
    <div class="container">
        <div class="box-thong-tin-user update-infomation box-login" >
            <form action="{{route('home.page.update')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="img-avatar">
                    <img src="{{asset(@$customer->image ? $customer->image : 'frontend/images/user (9) 1.png')}}" class="avatar" id="imageUpload" alt="avatar">
                    <div class="file">
                        <label for="upload">
                            <img src="{{asset('frontend/images/Group 9715.png')}}" alt="" class="glyphicon glyphicon-folder-open" aria-hidden="true" alt="" >
                            <input type="file" id="upload" name="image" onchange="onFileSelected(event)">
                        </label>
                    </div>
                </div>
                <div class="content">
                   <input type="text" class="form-control text-start mb-3" placeholder="Nhập họ tên" name="name" value="{{@$customer->name}}">
                   <input type="number" class="form-control text-start mb-3" placeholder="Nhập số điện thoại" name="phone" value="{{@$customer->phone}}">
                   <textarea name="title" class="form-control" id="" cols="30" rows="4" placeholder="Nhập mô tả" value="">{{@$customer->title}}</textarea>
                   <ul class="list-group list-unstyled ">
                        <li>1. Điền thông tin bạn muốn thêm hoặc sửa.</li>
                        <li>2. Bỏ trống để loại bỏ liên hệ khỏi danh sách.</li>
                        <li>3. Click vào icon bên trái để xem thử.</li>
                        <li>4. Hướng dẫn chi tiết <a href="#">xem tại đây</a></li>
                   </ul>
                   <ul class="list-unstyled list-socal">
                    <div id="sortable dd">
                        <ol class="dd-list" style="padding-left: 0px;">
                        @foreach ($data as $item)
                            <li class=" item-list d-flex flex-row justify-content-between position-relative">
                                <div>
                                    <a href="javascript:void(0);" class="show-preview" data-content="{{$item->content}}" data-type="{{$item->infor_icon->icon_type}}" >
                                        <img src="{{asset($item->infor_icon->icon_image ? $item->infor_icon->icon_image  : __NO_IMAGE_DEFAULT__)}}" class="me-3 logo-icon" alt="" srcset="">
                                    </a>
                                    {{$item->infor_icon->icon_name}} 
                                    @if($item->content)
                                    <img class="ms-3" src="{{asset('frontend/images/check.svg')}}" alt="" srcset="">
                                    @endif
                                </div>
                                <div class="dropdown">
                                    <a class="click-share" href="#" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                        ...
                                    </a>
                                    <ul class="dropdown-menu dropdow-editor " aria-labelledby="dropdownMenuLink">
                                    <li><a href="javascript:void(0);" class="dropdown-item get-edit" data-href="{{route('home.get.edit',$item->id)}}"><img src="{{asset('frontend/images/edit.svg')}}" alt="icon" srcset="">Chỉnh sửa</a></li>
                                    <li><a href="javascript:void(0);" class="dropdown-item delete-card" data-href="{{route('home.delete.card',$item->id)}}"><img src="{{asset('frontend/images/delete.svg')}}" alt="icon" srcset="">xóa</a></li>
                                    </ul>
                                </div>
                            </li>
                        @endforeach
                        </ol>
                    </div>
                        <li class="d-flex flex-row justify-content-between" data-bs-toggle="modal" data-bs-target="#add-phone">
                            <div class="d-flex align-items-center">
                                <img src="{{asset('frontend/images/add.svg')}}" class="me-3"  alt="" srcset="">
                                <span>Thêm só điện thoại</span>
                            </div>
                        </li>
                        <li class="d-flex flex-row justify-content-between" data-bs-toggle="modal" data-bs-target="#add-link" >
                            <div class="d-flex align-items-center">
                                <img src="{{asset('frontend/images/add.svg')}}" class="me-3"  alt="" srcset="">
                                <span>Thêm liên kết</span>
                            </div>
                        </li>
                        <li class="d-flex flex-row justify-content-between" data-bs-toggle="modal" data-bs-target="#add-bank" >
                            <div class="d-flex align-items-center">
                                <img src="{{asset('frontend/images/add.svg')}}" class="me-3"  alt="" srcset="">
                                <span>Thêm tài khoản ngân hàng/ ví</span>
                            </div>
                        </li>
                   </ul>
                </div>
                
                <div class="footer d-flex flex-row gap-2">
                    <a href="{{route('home.page.index')}}" class="btn btn-huy">Hủy</a>
                    <a href="{{route('home.preview.get')}}" class="btn btn-preview">Xem trước</a>
                    <button type="submit" class="btn btn-save">Lưu</button>
                </div>
            </form>
            <div class="modal" id="modal-edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="header-modal">
                            <h5>Cập nhật thông tin</h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">&times;</button>
                        </div>
                        <div id="get_add_icon">
                        </div>
                    </div>
                </div>
            </div>
            @include('frontend.modal.show_infor_icon')
            @include('frontend.modal.add_phone')
            @include('frontend.modal.add_link')
            @include('frontend.modal.add_bank')
        </div>
    </div>
@endsection
@section('page_script')
<script type="text/javascript">

function loadCard() {
  event.preventDefault();
  var id = $('#id-bank').val();
  var idphone = $('#id-phone').val();
  var inputBank = $('#inputBank').val();
  var inputPhone = $('#inputPhone').val();
  if(inputBank != ''){
      var link = inputBank;
  }else if(inputPhone != ''){
      var link = inputPhone;
  }else{
      var link = $('#inputLink').val();
  }
  if(id != null){
      var check = id;
  }else if(idphone != null){
      var check = idphone;
  }else{
      var check = $('#id-link').val();
  }
  $.ajax({
      type: 'GET', 
      url: '{{ URL::route('home.get.loadcard') }}',
      data: {"addInput": link,"id": check}, 
      dataType: "json", 
      success: function (data){
        if (data.success == 'success') {
            Toast.fire({
                iconColor: '#89B76C',
                icon: 'success',
                title: data.message,
                customClass: {
                title: 'success-title',
                timerProgressBar: 'timer-success',
                popup: 'border-toast'
                },
            })
            $('#add-phone').modal('hide');
            $('#add-link').modal('hide');
            $('#add-bank').modal('hide');
            $('#sortable').html(data.html);
        };
        if (data.success == false) {
            $('.errorInput').show();
            $('.errorSelect').show();
            $('.errorSelect').html(null);
            $('.errorInput').html(null);
            $.each(data.errorMessage, function (field, item) {
                var html_error = '<span class="fr-error d-block mt-2" style="color: red"><i class="fas fa-exclamation-circle"></i> ' + item + '</span>';  
                if(field == 'id'){
                    $('.errorSelect').append(html_error);
                };
                if(field == 'addInput'){
                    $('.errorInput').append(html_error);
                }
            });
        }
      },
  })
};


// card update position
jQuery(document).ready(function($) {
var updateOutput = function(e){
    var list   = e.length ? e : $(e.target),
        output = list.data('output'),
        url = "{{ route('card.update.position')}}";

    if (window.JSON) {
        output.val(window.JSON.stringify(list.nestable('serialize')));
        var param = window.JSON.stringify(list.nestable('serialize'));
        $.ajax({
            url: url,
            type: 'POST',
            data: {
                _token : $('#token').val(),
                jsonMenu: param
            },
        }).done(function() {
            var Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 2500
            });
            Toast.fire({
                icon: 'success',
                title: 'Cập nhật thành công!'
            })
        })
    } else {
        output.val('JSON browser support required for this demo.');
    }
};
$('#nestable').nestable({
    group: 3,
    maxDepth : 3
}).on('change', updateOutput);
updateOutput($('#nestable').data('output', $('#nestable-output')));
});

</script>
@endsection


  