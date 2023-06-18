<form action="{{route('post.app.update')}}"  method="post" >
@csrf 
    <div class="modal-body">
        <div class="form-group" >
            <label for="">Tên ứng dụng <span style="color: red">*</span></label>
            <div class="input-group"  data-target-input="nearest">
                <input type="text" class="form-control name" name="icon_name" value="{{$data->icon_name}}"  placeholder="Nhập tên" required>
            </div>
        </div>
        <div class="form-group" >
            <label for="">Loại: <span style="color: red">*</span></label>
                <select name="icon_type" class="form-control">
                    <option value="link" @if($data->icon_type=='link') selected @endif>Liên kết</option>
                    <option value="sdt" @if($data->icon_type=='sdt') selected @endif>Số điện thoại</option>
                    <option value="bank" @if($data->icon_type=='bank') selected @endif>Số tài khoản</option>
                </select>
        </div>
        <div class="form-group" >
            <label for="">Hình ảnh <small>Kích thước hình ảnh ( 72 x 72 )</small></label>
                <div class="image">
                    <div class="image__thumbnail app-image-icon" >
                        <img src="{{asset(@$data->icon_image ? @$data->icon_image : __NO_IMAGE_DEFAULT__)}}"
                            data-init="{{ __NO_IMAGE_DEFAULT__ }}">
                        <a href="javascript:void(0)" class="image__delete" 
                            onclick="urlFileDelete(this)">
                            <i class="fa fa-times"></i></a>
                            <input type="hidden" name="icon_image" value="{{@$data->icon_image}}" id="lat-span" />
                        <div class="image__button" onclick="fileSelect(this)">
                            <i class="fa fa-upload"></i></div>
                    </div>
                </div>
                @error('image') <span class="text-danger error">{{ $message }}</span>@enderror
        </div>
    </div>  
    <div class="modal-footer" >
        <input type="hidden" value="{{$data->id}}" name="id"> 
        <div class="float-lg-right">
            <button class="btn" style="border: 1px solid #DEDEDE;margin-right:10px" data-dismiss="modal"><img src="{{asset('frontend/image/cancel.png')}}" alt="">    Hủy</button>
            <button class="btn btn-dark"><img src="{{asset('frontend/image/save (1).png')}}" style="margin-top: -2px; margin-right: 6px;"  alt=""> lưu</button>
        </div> 
    </div>    
</form> 