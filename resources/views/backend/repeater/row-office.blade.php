<?php $key  = isset($key) ? $key : (int) round(microtime(true) * 1000); ?>
<tr>
<td class="index">{{ $index }}</td>
    <td>
        <label for="">Tên văn phòng đại diện</label>
        <input type="text" class="form-control" name="content[office][{{$key}}][name]" value="{{ @$val->name }}" >
        <label for="">Địa chỉ</label>
        <textarea class="form-control" name="content[office][{{$key}}][address]">{{ @$val->address }}</textarea>
        <label for="">Số điện thoại</label>
        <input type="text" class="form-control" required="" name="content[office][{{$key}}][phone]" value="{{ @$val->phone }}">
    </td>
    
    <td style="text-align: center;">
        <a href="javascript:void(0);" onclick="$(this).closest('tr').remove()" class="text-danger buttonremovetable" title="Xóa">
            <i class="fa fa-minus"></i>
        </a>
    </td>
</tr>