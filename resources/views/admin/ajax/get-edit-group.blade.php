<div class="form-group" >
    <label for="">Banner</label>
    <div class="image">
        <div class="image__thumbnail_banner">
            <img src="{{old('image',@$image) ? old('image',@$image) : __NO_IMAGE_DEFAULT__}}"
                data-init="{{ __NO_IMAGE_DEFAULT__ }}" style="height: 85px;">
            <a href="javascript:void(0)" class="image__delete"
                onclick="urlFileDelete(this)">
                <i class="fa fa-times"></i></a>
                <input type="hidden" name="image" value="{{@$image}}" id="lat-span" />
            <div class="image__button" onclick="fileSelect(this)"></div>
        </div>
    </div>
    {{-- @error('image') <span class="text-danger error">{{ $message }}</span>@enderror --}}
</div>
<div class="form-group">
    <div class="repeater" id="repeater">
        <table class="" style="width: 100%">
            <?php if(!empty($title)){
                $contents = json_decode($title);
            } ?>
            @if(old('list'))
            <?php $contents = json_decode(json_encode(old('list'))); ?>
            @endif
            <thead>
                <tr>
                    <th>Mô tả</th>
                </tr>
            </thead>
            <tbody id="sortable">
                @if(@$contents)
                    @foreach ($contents as $key => $value)
                        @include('admin.repeater.row-title')
                    @endforeach
                @endif
            </tbody>
        </table>
        <div class="text-left" style="margin-bottom: 30px">
            <button class="btn btn-sm btn-info"  style="padding:3px 8px 2px; background-color: #50818b;"
                onclick="repeater(event,this,'{{ route('get.layout') }}','.index', 'title', '.title')">
                <i class="far fa-plus-circle" style="color: #ffffff;margin-right: 5px;"></i>Thêm mới
            </button>
        </div>
    </div>
</div>
<div class="form-group">
    <label for="">Sử dụng <span style="color: red">*</span></label>
    <div class="custom-control custom-switch">
       <input type="checkbox" class="custom-control-input status" id="customSwitch1" name="status" @if (@$status==1)checked @endif >
       <label class="custom-control-label" for="customSwitch1"></label>
    </div>
    @error('status') <span class="text-danger error">{{ $message }}</span>@enderror
</div>


