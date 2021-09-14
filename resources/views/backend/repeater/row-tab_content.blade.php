<?php $key  = isset($key) ? $key : (int) round(microtime(true) * 1000); ?>
<tr>
    
    <td>
        <!-- <div class="col-sm-12"> -->
            <div class="form-group">
                <label for="">Tiêu đề tab</label>
                <input type="text" class="form-control" placeholder="Tiêu đề tab" name="content[{{$key}}][tab_content][title]" value="{{ @$value->title }}">
                <label for="">Nội dung tab</label>
                <textarea class="form-control" placeholder="Nội dung tab" name="content[{{$key}}][tab_content][content]">{{ @$value->content }}</textarea>
            </div>
        <!-- </div> -->
    </td>
    <td style="text-align: center;">
        <a href="javascript:void(0);" onclick="$(this).closest('tr').remove()" class="text-danger buttonremovetable" title="Xóa">
            <i class="fa fa-minus"></i>
        </a>
    </td>
</tr>
<script>
    CKEDITOR.replace( 'content[{{$key}}][tab_content][content]',{
            filebrowserBrowseUrl : '{{url('/')}}/public/backend/plugins/ckfinder/ckfinder.html',
        });
</script>