<div class="row">
    <input type="hidden" name="type" value="admin">
    <div class="col-6">
        <div class="form-group">
        <label for="">Mật khẩu <span style="color: red">*</span></label>
        <div class="input-group"  data-target-input="nearest">
            <input type="password" name="password" class="form-control" value="{{@$getdata->password}}">
        </div>
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
        <label for="">Nhắc lại mật khẩu <span style="color: red">*</span></label>
        <div class="input-group"  data-target-input="nearest">
            <input type="password" class="form-control"  value="{{@$getdata->password}}">
        </div>
        </div>
    </div>
</div>