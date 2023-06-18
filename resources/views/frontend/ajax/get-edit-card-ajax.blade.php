<div class="body-modal">
    <div class="form-group" >
        <label for="exampleFormControlInput1" class="form-label">Tên hiển thị *</label>
        <input type="text" class="form-control" value="{{$data->infor_icon->icon_name}}" disabled>
    </div>
    <div class="form-group">
        <label for="">Icon <span style="color: red">*</span></label>
    </div>
    <div class="card-body" >
        <img class="card-title" src="{{asset($data->infor_icon->icon_image)}}" alt="" >
    </div>
    <div class="form-group">
        <label for="" class="form-label">@if($data->infor_icon->icon_type=='sdt')Số điện thoại @elseif($data->infor_icon->icon_type=='link')Liên kết @elseif($data->infor_icon->icon_type=='bank')Số tài khoản @endif <span style="color: red">*</span></label>
        <div class="input-group"  data-target-input="nearest">
            <input type="hidden" id="id" value="{{$data->id}}">
            <input type="text" id="get-content" name="content" class="form-control" value="{{@$data->content}}" >
        </div>
        <div class="errorInput_edit" style="display: none; margin-bottom: 25px;"></div>
    </div>
</div>
<div class="modal-footer d-block" >
    <button style="width: 45%;" class="btn btn-outline-danger" data-bs-dismiss="modal" aria-label="Close">Hủy</button>
    <button style="width: 45%;" class="btn btn-danger save-card" data-href="{{route('home.post.update.card')}}" >Lưu</button>   
</div>

<script>
$('.end-modal').on('click', function(){
    $('#add-icon-modal').modal('hide');
})

$('.save-card').on('click', function(){
    var href = $(this).data("href");
    var content = $('#get-content').val();
    var id = $('#id').val();
    $.ajax({
        type: 'GET', 
        url: href, 
        data: {"content":content,"id":id},
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
                $('#sortable').html(data.html);
                $('#modal-edit').modal('hide');
            };
            if (data.success == false) {
                $('.errorInput_edit').show();
                $('.errorInput_edit').html(null);
                $.each(data.errorMessage, function (field, item) {
                    var html_error = '<span class="fr-error d-block mt-2" style="color: red"><i class="fas fa-exclamation-circle"></i> ' + item + '</span>';  
                    $('.errorInput_edit').append(html_error);
                });
            };
        }
    })
})
</script>