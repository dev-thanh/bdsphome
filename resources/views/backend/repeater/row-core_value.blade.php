<?php $key  = isset($key) ? $key : (int) round(microtime(true) * 1000); ?>
<tr>
    <td>
        <div class="form-group col-sm-3 item-journey">
            <label for="">Hình ảnh khối</label>
            <div class="image">
                <div class="image__thumbnail">
                <img src="{{ !empty($value->image) ? url('/').$value->image : __IMAGE_DEFAULT__ }}"  
                data-init="{{ __IMAGE_DEFAULT__ }}">
                <a href="javascript:void(0)" class="image__delete" onclick="urlFileDelete(this)">
                    <i class="fa fa-times"></i></a>
                <input type="hidden" value="{{ @$value->image }}" name="content[core_value][content][{{ $key }}][image]"  />
                <div class="image__button" onclick="fileSelect(this)"><i class="fa fa-upload"></i> Upload</div>
                </div>
            </div>
        </div>
        <div class="col-sm-9">
            <div class="form-group">
                <label for="">Tiêu đề</label>
                <input type="text" name="content[core_value][content][{{ $key }}][title]" class="form-control" value="{{ @$value->title }}">
            </div>

            <div class="form-group">
                <label for="">Mô tả ngắn</label>
                <textarea class="form-control" name="content[core_value][content][{{ $key }}][desc]">{{ @$value->desc }}</textarea>
            </div>
        </div>
    </td>
    <td style="text-align: center;">
        <a href="javascript:void(0);" onclick="$(this).closest('tr').remove()" class="text-danger buttonremovetable" title="Xóa">
            <i class="fa fa-minus"></i>
        </a>
    </td>
</tr>
