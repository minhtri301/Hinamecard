@extends('frontend.layouts.master')
@section('main')
<main id="main">
    <div class="container">
        <div class="box-thong-tin-user preview box-login">
            <form class="update-infomation" action="">
                <div class="img-avatar">
                    <img src="{{asset(@$customer->image ? @$customer->image : 'frontend/images/user (9) 1.png')}}" class="avatar" alt="avatar">
                   <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#share_qr"><i class="fas fa-share-alt "></i></a>
                </div>  
                <div class="content">
                    <h2 class="name">{{$customer->name ? $customer->name : '@nguyenvana' }} 
                        <img src="{{asset('frontend/image/Vector (6).png')}}" alt="icon">
                    </h2>
                    <p class="desc">{{$customer->title ? $customer->title : 'Chưa có mô tả'}}</p>
                </div>    
                <button class="btn event" id="save-btn" data-name="{{@$customer->name}}" data-phone="{{@$customer->phone}}">Lưu vào danh bạ</button>
                <ul class="list-unstyled list-socal">
                    @foreach ($data as $item)
                        @if (!empty($item->content))
                        <a href="javascript:void(0);" class="show-preview text-decoration-none" data-content="{{$item->content}}" data-type="{{$item->infor_icon->icon_type}}"  >
                            <li class=" item-list d-flex flex-row justify-content-between position-relative">
                                <div>
                                    <img src="{{asset($item->infor_icon->icon_image)}}" class="me-3 logo-icon" alt="" srcset="">
                                    <span>{{$item->infor_icon->icon_name}}</span>
                                    {{-- <span><i class="fas fa-angle-right"></i></span> --}}
                                </div>
                            </li>
                        </a>
                        @endif
                    @endforeach
               </ul>
            </form>
            <div class="footer-susset text-center">
                <?php $check=0; ?>
                @foreach ($title as $item)
                    @if($check==0)
                        <h3 class="text-white fs-5">{{$item}}</h3>
                    @else
                        <p class="text-white fs-6">{{$item}}</p>
                    @endif
                    <?php $check++ ?>
                @endforeach
                <img class="w-100 rounded" src="{{asset($customer->group->image)}}" alt="" srcset="">
            </div>
        </div>
    </div>
    @include('frontend.modal.show_infor(share,preview)_icon')
    
    <div class="modal fade" id="share_qr" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true" >
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="header-modal">
                    <h5>Chia Sẻ Trang Hinamecard<br>
                        Của <span class="title_share_link" style="color: #0275d8;">{{@$customer->name}}</span></h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">&times;</button>
                </div>
                <div class="body-modal">
                    <div class="form-group text-center">
                        <label for="">Chia sẻ với bạn bè, đối tác bằng<br> cách nhấp vào Link dưới đây</label>
                        <div id="id_qrcode"></div>
                    </div>    
                    <div class="form-group">
                        <div class="input-group" data-target-input="nearest" >  
                            <input type="text" id="link" value="{{@$customer->login_link}}" readonly>
                            <button class="form-control" id="linkButon" onclick="copyLinkValue()">{{@$customer->login_link}}</button>
                        </div>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-dark" data-bs-dismiss="modal" aria-label="Close">Đóng</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
@section('page_script')
<script type="text/javascript">

$('.show-preview').on('click', function(e){
    e.preventDefault();
    const content = $(this).data("content"); 
    const type = $(this).data("type"); 
    if(type=='bank' || type=='sdt'){
        if(type=='bank'){
            $('.bank').show();
            $('.sdt').hide();
        }else if(type=='sdt'){
            $('.sdt').show();
            $('.bank').hide();
        }
        $('.icon-content').val(content);
        $('#show_preview').modal('show');
    }
    if(type=='link'){
        window.open(content);
    }
})

var saveBtn = document.getElementById("save-btn");
saveBtn.addEventListener("click", function (e) {
    e.preventDefault();
    const name = $(this).data("name");
    const phone = $(this).data("phone");
    if(phone!==''){
        // Get the contact information from the website
        var contact = {
            name: name,
            phone: phone,
            // email: "john@example.com"
        };
        // create a vcard file
        var vcard = "BEGIN:VCARD\nVERSION:4.0\nFN:" + contact.name + "\nTEL;TYPE=work,voice:" + contact.phone + "\nEMAIL:" + contact.email + "\nEND:VCARD";
        var blob = new Blob([vcard], { type: "text/vcard" });
        var url = URL.createObjectURL(blob);
        
        const newLink = document.createElement('a');
        newLink.download = contact.name + ".vcf";
        newLink.textContent = contact.name;
        newLink.href = url;
        
        newLink.click();
    }else{
        Toast.fire({
            icon: 'error',
            title: 'Số điện thoại chưa được cập nhật'
        })
    }
});

function copyLinkValue() {
    var linkElement = document.getElementById('link');
    linkElement.select();
    document.execCommand('copy');
    linkElement.setSelectionRange(0, 0); 

    Toast.fire({
        iconColor: '#89B76C',
        icon: 'success',
        title: 'Đường Link Đã Được Sao Chép',
        customClass: {
            title: 'success-title',
            timerProgressBar: 'timer-success',
            popup: 'border-toast'
        },
    });
}

$(document).ready(function(){
    var sub = $('#linkButon').text(); 
    var sub = sub.substring(7);
    $('#linkButon').text(sub); 
})

function onReady(){
    var link = $('#link').val(); 
    var qrcode = new QRCode("id_qrcode", {
        text:link,
        width:180,
        height:180,
        correctLevel:QRCode.CorrectLevel.L
    });
}


</script>
@endsection