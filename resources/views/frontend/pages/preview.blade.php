@extends('frontend.layouts.master')
@section('main')
<main id="main">
    <div class="container">
        <div class="box-thong-tin-user preview box-login">
            <form class="update-infomation" action="">
                <div class="img-avatar">
                    <img src="{{asset(@$customer->image ? $customer->image : 'frontend/images/user (9) 1.png')}}" class="avatar" alt="avatar">
                </div>
                <div class="content">
                    <h2 class="name">{{$customer->user_name ? $customer->name : '@nguyenvana' }} 
                        <img src="{{asset('frontend/image/Vector (6).png')}}" alt="icon">
                    </h2>
                    <p class="desc">{{$customer->title ? $customer->title : 'Chưa có mô tả'}}</p>
                </div>
                    <a href="{{route('home.page.details')}}" class="btn event" >Cập nhật thông tin</a>
                <ul class="list-unstyled list-socal">
                    @foreach ($data as $item)
                        @if (!empty($item->content))
                        <a href="javascript:void(0);" class="show-preview text-decoration-none" data-content="{{$item->content}}" data-type="{{$item->infor_icon->icon_type}}" >
                            <li class=" item-list d-flex flex-row justify-content-between position-relative">
                                <div><img src="{{asset($item->infor_icon->icon_image)}}" class="me-3 logo-icon" alt="" srcset="">{{$item->infor_icon->icon_name}}</div>
                            </li>
                        </a>
                        @endif
                    @endforeach
               </ul>
            </form>
            <div class="footer-susset text-center">
                @if($customer->group->status==1)
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
                @endif
            </div>
        </div>
    </div>
    @include('frontend.modal.show_infor(share,preview)_icon')
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
</script>

@endsection