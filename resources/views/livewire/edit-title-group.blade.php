<div>
    <div>
        <div class="form-group">
            <label for="">Mô tả</label>
            @foreach($inputs as $key => $value)
                <div class="input-group"  data-target-input="nearest" >
                <input type="text" class="form-control title" placeholder="nhập mô tả" wire:model="inputs.{{$key}}" name="title[{{$key}}]" required >
                <a href="#" wire:click.prevent="removeGroup({{$key}})"  class="btn text-white btn-info btn-sm">Xóa</a>
                </div>
            @endforeach
            <div wire:click="add({{$i}})" style="width: 20%;" class="flex items-center justify-center text-blue-600 text-sm py-4 w-full cursor-pointer">
                <p class="ml-2">+  Thêm mới</p>
            </div> 
        </div>
    </div>
</div>