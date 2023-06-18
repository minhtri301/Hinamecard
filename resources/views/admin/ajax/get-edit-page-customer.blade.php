<div class="row">
    <input type="hidden" name="type" value="user">
    <div class="col-8">
        <div class="form-group">
        <label for="">Nhóm người dùng <span style="color: red">*</span></label>
        <div class="form-group">
            <select name="id_group" class="form-control">
                @foreach ($Cate as $item)
                    <option value="{{$item->id}}" @if($item->name=='Admin') disabled @endif >{{$item->name}}</option>
                @endforeach
            </select>
        </div>
        </div>
    </div>
    <div class="col-4">
        <div class="form-group">
        <label for="">Mã đăng nhập <span style="color: red">*</span></label>
        <div class="input-group"  data-target-input="nearest">
            <input type="text" class="form-control" value="{{$getdata->login_code}}" name="login_code" id="code">
            <a href="javascript:void(0);" class="btn btn-default btn-reload-code" data-href="{{route('management.reload.code')}}"><i class="far fa-undo"></i></a>
        </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="form-group">
        <label for="">Link đăng nhập <span style="color: red">*</span></label>
        <div class="input-group"  data-target-input="nearest">
            <input type="text" class="form-control" name="login_link" id="slug" value="{{$getdata->login_link}}" >
        </div>
        </div>
    </div>
</div>