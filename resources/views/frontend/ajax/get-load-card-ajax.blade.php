@foreach ($data as $item)
<li class=" item-list d-flex flex-row justify-content-between position-relative">
    <div>
        <a href="javascript:void(0);" class="show-preview" data-content="{{$item->content}}" data-type="{{$item->infor_icon->icon_type}}" >
            <img src="{{asset($item->infor_icon->icon_image ? $item->infor_icon->icon_image  : __NO_IMAGE_DEFAULT__)}}" class="me-3 logo-icon" alt="icon" srcset=""></a>
        {{$item->infor_icon->icon_name}} 
        @if($item->content)
        <img class="ms-3" src="{{asset('frontend/images/check.svg')}}" alt="" srcset="">
        @endif
    </div>
    <div class="dropdown">
        <a class="click-share" href="javascript:void(0);" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
            ...
        </a>
        <ul class="dropdown-menu dropdow-editor " aria-labelledby="dropdownMenuLink">
            <li>
                <a href="javascript:void(0);" class="dropdown-item get-edit" data-href="{{route('home.get.edit',$item->id)}}" >
                    <img src="{{asset('frontend/images/edit.svg')}}" alt="icon" srcset="">
                    Chỉnh sửa
                </a>
            </li>
            <li>
                <a href="javascript:void(0);" class="dropdown-item delete-card" data-href="{{route('home.delete.card',$item->id)}}">
                    <img src="{{asset('frontend/images/delete.svg')}}" alt="icon" srcset="">
                    xóa
                </a>
            </li>
        </ul>
    </div>
</li>
@endforeach

<script>
$('.get-edit').on('click',  function(e){
    e.preventDefault();
    const el = $(this); 
    const url = $(this).data("href"); 
    $.ajax({
        type: 'GET', 
        url: url,
        dataType: "json",
        success: function (data) {  
            $('#modal-edit').modal('show');
            $('#get_add_icon').html(data.html);
        },
    })
}) 

$('.delete-card').on('click', function(){
    const el = $(this); 
    const url = $(this).data("href"); 
    $.ajax({
        type: 'GET', 
        url: url,
        dataType: "json",
        success: function (data) {  
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
        },
    })
}) 

$('.show-preview').on('click', function(e){
    e.preventDefault();
    const content = $(this).data("content"); 
    const type = $(this).data("type"); 

    if(type=='bank'){
        $('.infor_name').html('Số tài khoản ngân hàng');
    }
    if(type=='sdt'){
        $('.infor_name').html('Số điện thoại');
    }
    if(type=='link'){
        $('.infor_name').html('Đường dẫn');
    }

    $('.icon-content').val(content);
    $('#show_icon_preview').modal('show');
})

</script>
