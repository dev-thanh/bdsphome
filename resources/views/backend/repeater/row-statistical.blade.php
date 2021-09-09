<?php $key  = isset($key) ? $key : (int) round(microtime(true) * 1000); ?>
<tr>
    <td>
        <div class="col-sm-6">
            <div class="form-group">
                <input type="text" name="content[statistical][content][{{ $key }}][title1]" class="form-control" value="{{ @$value->title1 }}">
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <input type="text" name="content[statistical][content][{{ $key }}][title2]" class="form-control" value="{{ @$value->title2 }}">
            </div>
        </div>
    </td>
    <td style="text-align: center;">
        <a href="javascript:void(0);" onclick="$(this).closest('tr').remove()" class="text-danger buttonremovetable" title="Xóa">
            <i class="fa fa-minus"></i>
        </a>
    </td>
</tr>
