<div class="form-group">
    <label for="">Tên nhóm <span style="color: red">*</span></label>
    <div class="input-group"  data-target-input="nearest">
        <input type="text" class="form-control name" name="name" value="{{old('name')}}"  placeholder="Nhập tên" required>
    </div>
    @error('name') <span class="text-danger error">{{ $message }}</span>@enderror
</div>
<div class="form-group">
    <label for="">Ngày tạo <span style="color: red">*</span></label>
    <div class="input-group date" id="datetimepicker5" data-target-input="nearest">
        <input type="text" name="date" placeholder="dd/mm/yyyy" value="{{old('date',$today)}}" class="form-control datetimepicker-input test date" data-target="#datetimepicker5" required/>
        <div class="input-group-append " data-target="#datetimepicker5" data-toggle="datetimepicker">
            <div class="input-group-text "><i class="far fa-calendar-alt "></i></div>
        </div>
    </div>
</div>
<div class="form-group" >
    <label for="">Banner</label>
        <div class="image">
            <div class="image__thumbnail_banner">
                <img src="{{old('image',@$image) ? old('image',@$image) : __NO_IMAGE_DEFAULT__}}"
                    data-init="{{ __NO_IMAGE_DEFAULT__ }}" style="height: 85px; ">
                <a href="javascript:void(0)" class="image__delete"
                    onclick="urlFileDelete(this)">
                    <i class="fa fa-times"></i></a>
                    <input type="hidden" name="image" value="" id="lat-span" />
                <div class="image__button" onclick="fileSelect(this)"></div>
            </div>
        </div>
        @error('image') <span class="text-danger error">{{ $message }}</span>@enderror
</div>
<div class="form-group">
    <div class="repeater" id="repeater">
        <table class="" style="width: 100%;">
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
                        @include('backend.repeater.row-title')
                    @endforeach
                @endif
            </tbody>
        </table>
        <div class="text-left" style="margin-bottom: 30px">
            <button class="btn btn-sm btn-info" style="padding:3px 8px 2px; background-color: #50818b;"
                onclick="repeater(event,this,'{{ route('get.layout') }}','.index', 'title', '.title')" >
                <i class="far fa-plus-circle" style="color: #ffffff;margin-right: 5px;"></i>Thêm mới
            </button>
        </div>
    </div>

</div>
 {{-- @livewire('livewire')
        @livewireScripts --}}


<div class="form-group">
    <label for="">Sử dụng <span style="color: red">*</span></label>
    <div class="custom-control custom-switch">
       <input type="checkbox" class="custom-control-input status" id="customSwitch1" name="status" value="on" {{old('status') == 'on' ? 'checked' : ''}}>
       <label class="custom-control-label" for="customSwitch1"></label>
    </div>
</div>




