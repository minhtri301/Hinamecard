<div class="modal" id="add-phone" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="header-modal">
                <span class="modal-title fs-6" id="staticBackdropLabel">Thêm số điện thoại</span>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">&times;</button>
            </div>
            <div class="body-modal">
                <div class="form-group">
                    <label for="">Tên hiển thị <span style="color: red">*</span></label>
                    <select name="" class="form-control" id="id-phone" required>
                        <option value="" selected disabled>Chọn ứng dụng</option>
                        @foreach ($getPhone as $item)
                        <option value="{{$item->id}}" data-thumbnail="{{$item->icon_image}}">{{$item->icon_name}}</option>
                        @endforeach  
                    </select>
                    <div class="errorSelect" style="display: none; margin-top: -16px"></div>
                </div>    
                <div class="form-group">
                    <label for="">Thêm số điện thoại</label>
                    <div class="input-group"  data-target-input="nearest">
                        <input type="number" class="form-control" id="inputPhone" name="" >
                    </div>
                    <div class="errorInput" style="display: none; margin-top: -16px; margin-bottom: 25px;"></div>
                </div>
            </div>
            <div class="modal-footer" >
                <button class="btn btn-danger btn-sm" onclick="loadCard()">Chọn</button>   
            </div>
        </div>
    </div>
</div>