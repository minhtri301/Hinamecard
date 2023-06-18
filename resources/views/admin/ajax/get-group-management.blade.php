<div class="form-group">
    <label for="">Tên nhóm <span style="color: red">*</span></label>
    <div class="input-group"  data-target-input="nearest">
        <input type="text" class="form-control name" name="name" id="name" value="{{old('name',@$name)}}"  placeholder="Nhập tên" required>
    </div>
    {{-- @error('name') <span class="text-danger error">{{ $message }}</span>@enderror --}}
</div>
<div class="form-group">
    <label for="">Ngày tạo <span style="color: red">*</span></label>
    <div class="input-group date" id="datetimepicker4" data-target-input="nearest">
        <input type="text" name="date" id="date" value="{{old('date',@$date)}}" placeholder="dd/mm/yyyy" class="form-control datetimepicker-input test date" data-target="#datetimepicker4"/>
        <div class="input-group-append " data-target="#datetimepicker4" data-toggle="datetimepicker">
            <div class="input-group-text "><i class="far fa-calendar-alt "></i></div>
        </div>
    </div>
</div>
<div id="get-group-edit-image"></div>   
{{-- @livewire('edit-title-group')
@livewireScripts --}}
    

