<?php $key  = isset($key) ? $key : (int) round(microtime(true) * 1000); ?>
<tr>
    <td>
        <div class="col-sm-12">
            <div class="form-group">
                <label for="">Tiêu đề</label>
                <input type="text" name="content[{{$key}}][slide][title]" class="form-control" value="{{ @$value->title }}">
            </div>
        </div>
        <div class="col-sm-12 image">
            <button type="button" class="btn btn-success" onclick="uploadImgaeServices(this)" data-key="{{$key}}"><i class="fa fa-upload"></i>  

            Thêm hình ảnh slide

            </button>

            <br>
            <div class="image__gallery">

            @if (!empty(@$value->gallery))

                @foreach (@$value->gallery as $item)

                    <div class="image__thumbnail image__thumbnail--style-1">

                        <img src="{{ @$item }}">

                        <a href="javascript:void(0)" class="image__delete" onclick="urlFileMultiDelete(this)">

                            <i class="fa fa-times"></i>

                        </a>

                        <input type="hidden" name="content[{{$key}}][slide][gallery][]" value="{{ @$item }}">

                    </div>

                @endforeach

            @endif

            </div>
        </div>
    </td>
    <td style="text-align: center;">
        <a href="javascript:void(0);" onclick="$(this).closest('tr').remove()" class="text-danger buttonremovetable" title="Xóa">
            <i class="fa fa-minus"></i>
        </a>
    </td>
</tr>