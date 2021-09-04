<?php $id = isset($id) ? $id : (int) round(microtime(true) * 1000); ?>
<tr>
	<td class="index">{{ $index }}</td>
	<td><input type="text" class="form-control" name="content[social][{{$id}}][name]" value="{{ @$val->name }}"></td>
	<td>
    <textarea class="form-control" name="content[social][{{$id}}][image]">{{ @$val->image }}</textarea>
    </td>
	<td>
        <input type="text" class="form-control" required="" name="content[social][{{$id}}][link]" value="{{ @$val->link }}">
    </td>
    <td style="text-align: center;">
        <a href="javascript:void(0);" onclick="$(this).closest('tr').remove()" class="text-danger buttonremovetable" title="Xóa">
            <i class="fa fa-minus"></i>
        </a>
    </td>
</tr>