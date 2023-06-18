<?php $key  = isset($key) ? $key : (int) round(microtime(true) * 1000); ?>
<tr>
    <td>
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="form-group">
                    <input type="text" class="form-control"  value="{{@$value}}" name="title[{{$key}}]">
                </div>
            </div>
        </div>
    </td>
	<td class="remove-td-item" style="width: 0px;">
        <a href="javascript:void(0);" onclick="$(this).closest('tr').remove()" class="text-danger buttonremovetable" title="Xóa">
            <i class="fas fa-times"></i>
        </a>
    </td>
</tr>