@extends('admin.layouts.app')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4 class="m-0">Quản lý nhóm người dùng</h4>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <div class="float-sm-right">
                        <button data-toggle="modal" data-target="#new-group-modal" class="btn btn-dark"><i class="far fa-plus-circle" style="color: #ffffff;margin-right: 5px;"></i>Thêm mới</button>
                    </div>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                    <form action="{{route('group-management.index')}}" method="get">
                        <div class="row">     
                            <div class="col-2">
                                <div class="form-group">
                                    <select name="check" class="form-control">
                                        <option value="">Tất cả trạng thái</option>
                                        <option value="2" @if (Request()->check==2) selected @endif>Chưa kích hoạt</option>
                                        <option value="1" @if (Request()->check==1) selected @endif>Đã kích hoạt</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-10">
                                <div class="form-group"> 
                                    <div class="input-group ">
                                    <input type="search" class="form-control" name="key" value="{!! old('key',Request()->key) !!}" placeholder="serach">
                                    <div class="input-group-append" style="margin-left: 10px;">
                                        <button class="btn btn-dark" style="border-radius: 6px;">
                                        <i class="fa fa-search"></i>             
                                        </button>
                                        <a href="{{route('group-management.index')}}" class="btn  btn-default" style="margin-left: 10px;"><i class="far fa-undo"></i></a>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
        
                <div class="card card-secondary card-outline">
                    <div class="card-body">
                        @include('flash::message')
                        <form action="" method="POST">
                            @csrf
                            <div class="table-responsive">
                                <table id="example3" class="table table-bordered table-hover dataTable dtr-inline">
                                    <thead>
                                        <tr>
                                            <th {{$id=0}} width="10px">STT</th>
                                            <th>Tên nhóm</th>
                                            <th>Ngày tạo</th>
                                            <th>Trạng thái</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>   
                                        @foreach ($data as $item)
                                            <tr>
                                                <td>{{$id+=1}}</td>
                                                <td>{{$item->name}}</td>
                                                <td>{{date('d/m/Y',strtotime($item->date))}}</td>
                                                <td>
                                                    @if ($item->status==1)
                                                    <span class="badge badge-pill badge-success">Đã kích hoạt</span>
                                                    @else
                                                    <span class="badge badge-pill badge-danger">Chưa kích hoạt</span>
                                                    @endif                                                  
                                                </td>
                                                <td>
                                                    <a href="javascript:void(0);" title="Chỉnh sửa"  class="btn btn-xs btn-info btn-edit edit-group" data-id="{{$item->id}}" data-href="{{route('get.group.edit',$item->id)}}" >
                                                        <i class="fas fa-edit"></i></i>
                                                    </a>
                                                    <a href="javascript:void(0);" class="btn btn-xs btn-danger btn-destroy"
                                                        title="Xóa" data-href="{{route('delete.group',$item->id)}}">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            {{-- <div class="btnAdd">
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Bạn có chắc chắn xóa không ?')"><i
                                            class="fa fa-trash-o"></i> Xóa các mục đã chọn
                                </button>
                            </div> --}}
                        </form>
                    </div>
                </div>
            </div>

          
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="modal fade" id="edit-group-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content" >
                        <div class="modal-header">
                            <span class="modal-title fs-6" id="staticBackdropLabel">CẬP NHẬT NHÓM NGƯỜI DÙNG</span>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                        </div>
                        <form action=""  method="post" id="get_group_edit">
                            @csrf 
                            <div class="modal-body">
                                @include('admin.ajax.get-group-management')
                            </div>  
                            <div class="modal-footer" >
                                <button class="btn" style="border: 1px solid #DEDEDE;margin-right:10px" data-dismiss="modal"><img src="{{asset('frontend/image/cancel.png')}}" alt="">    Hủy</button>
                                <button class="btn btn-dark"><img src="{{asset('frontend/image/save (1).png')}}" style="margin-top: -2px; margin-right: 6px;"  alt=""> lưu</button>   
                            </div>
                        </form> 
                    </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="modal fade" id="new-group-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content" >
                        <div class="modal-header">
                            <span class="modal-title fs-6" id="staticBackdropLabel">THÊM MỚI NHÓM NGƯỜI DÙNG</span>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                        </div>
                        <form action="{{route('group-management.store')}}"  method="post" >
                            @csrf 
                            <div class="modal-body">
                                @include('admin.ajax.get-modal-new-group')
                            </div>            
                            <div class="modal-footer" >
                                <div class="float-lg-right">
                                    <button class="btn" style="border: 1px solid #DEDEDE;margin-right:10px" data-dismiss="modal"><img src="{{asset('frontend/image/cancel.png')}}" alt="">    Hủy</button>
                                    <button class="btn btn-dark"><img src="{{asset('frontend/image/save (1).png')}}" style="margin-top: -2px; margin-right: 6px;"  alt=""> lưu</button>
                                </div> 
                            </div>
                            </form> 
                    </div>
                    </div>
                </div>
            </div>
        </div>
    
    
	</div>
    
    @endsection
@section('page_css')
<style>
#example1 > tbody > tr > td {
    vertical-align: middle;
}
</style>
@endsection

@section('page_scripts')

<script type="text/javascript">
$(document).ready(function(){
    $('#datetimepicker5').datetimepicker({
            format: 'YYYY/MM/DD'
        });
})
$(function () {
        $('#datetimepicker4').datetimepicker({
            format: 'YYYY/MM/DD'
        });
    });

$('.btn-destroy').on('click',function(){
    var href = $(this).data("href");
    $('#form-destroy').attr('action',href);
    $('#delete-modal').modal('show');
})

$('.edit-group').on('click',function(e){
    e.preventDefault();
    const el = $(this); 
    const url = $(this).data("href"); 
    const id = $(this).attr("data-id")
    // const urlParams = new URLSearchParams(window.location.search);
    $.ajax({
        type: 'GET', 
        url: url,
        dataType: "json",
        success: function (data) {
            // window.addEventListener('openFormModal', event => {
            // $("#edit-group-modall").modal('show');
            // })
            $('#edit-group-modal').modal('show');
            $('#name').val(data.datas.name);
            $('#date').val(data.datas.date);
            $('#get_group_edit').attr('action',data.url);
            $('#get-group-edit-image').html(data.image);
            // window.history.replaceState(null, null, "?id="+data.datas.id);
            // urlParams.set('id', data.datas.id);
            // document.location.search = urlParams;
        },
    })
})
</script>
@endsection