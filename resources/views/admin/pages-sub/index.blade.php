@extends('admin.layouts.app')
@section('content')
    <div class="content-header ">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4 class="m-0">Trang mới</h4>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{!! url('admin') !!}">Trang chủ</a></li>
                        <li class="breadcrumb-item"><a href="">Trang mới</a></li>
                        <li class="breadcrumb-item active">Danh sách</li>   
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid ">
        <div class="card card-secondary card-outline">
            <div class="card-body">
                @include('flash::message')
                <div class="table-responsive">
			        <table id="example1" class="table table-bordered table-striped table-hover w-100">
			            <thead>
			            <tr>
			                <th width="10px"><input type="checkbox" name="chkAll" id="chkAll"></th>
			                <th width="10px">STT</th>
			                <th>Tên trang</th>
                            <th>Liên kết</th>
			                <th>Thao tác</th>
			            </tr>
			            </thead>
			            <tbody>
                            @foreach($data as $item)
                                <tr>
                                    <td><input type="checkbox" name="chkItem[]" value="{{ $item->id }}"></td>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ $item->name_page }}</td>
                                    <td>
                                        <a href="{{route('home.page_sub', $item->slug)}}" target="_blank">
                                        <i class="fas fa-external-link-alt"></i> {{route('home.page_sub', $item->slug)}}
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{ route('page-sub.edit', $item->id ) }}" title="Cập nhật" class="btn btn-xs btn-info btn-edit modalEditItem">
                                            <i class="far fa-edit"></i>
                                        </a> 
                                        <a href="javascript:void(0);" class="btn btn-xs btn-danger btn-destroy" data-href="{{route('page-sub.destroy', $item->id) }}"
                                        data-toggle="modal" data-target="#confim" title="Xóa">
                                            <i class="far fa-trash-alt"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
			            </tbody>
			        </table>
                </div>
			</div>
		</div>
	</div>
@stop
@section('page_css')
<style>
#example1 > tbody > tr > td {
    vertical-align: middle;
}
</style>
@endsection