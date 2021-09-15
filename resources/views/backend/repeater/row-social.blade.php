<?php $id = isset($id) ? $id : (int) round(microtime(true) * 1000); ?>
<tr>
	<td class="index">{{ $index }}</td>
	<td>
        <div class="form-group col-sm-3 item-journey">
            <div class="image">
                <div class="image__thumbnail" style="width: 100px;height: 100px">
                <img src="{{ !empty($val->image) ? url('/').$val->image : __IMAGE_DEFAULT__ }}"  
                data-init="{{ __IMAGE_DEFAULT__ }}">
                <a href="javascript:void(0)" class="image__delete" onclick="urlFileDelete(this)">
                    <i class="fa fa-times"></i></a>
                <input type="hidden" value="{{ @$val->image }}" name="content[social][{{ $id }}][image]"  />
                <div class="image__button" onclick="fileSelect(this)"><i class="fa fa-upload"></i> Upload</div>
                </div>
            </div>
        </div>
    </td>
	<td><input type="text" class="form-control" name="content[social][{{$id}}][name]" value="{{ @$val->name }}"></td>
	<td>
        <input type="text" class="form-control" required="" name="content[social][{{$id}}][link]" value="{{ @$val->link }}">
    </td>
    <td style="text-align: center;">
        <a href="javascript:void(0);" onclick="$(this).closest('tr').remove()" class="text-danger buttonremovetable" title="Xóa">
            <i class="fa fa-minus"></i>
        </a>
    </td>
</tr>