<?php $key  = isset($key) ? $key : (int) round(microtime(true) * 1000); ?>
<tr>
	<td>
        <div class="col-sm-12 form-group">
            <input type="text" name="content[{{$key}}][type1][title]" class="form-control" value="{{@$value->title}}" placeholder="Tiêu đề khối">
        </div>
        <div class="col-sm-12 content-row-ctt">
            @if(!empty(@$value->name1))
                <?php $count = count(@$value->name1); ?>
                @for($x = 0; $x < $count; $x++)
                <div class="parent-item-cth">
                    <div class="col-sm-5">
                        <div class="form-group">
                            <input type="text" placeholder="Tiêu đề" class="form-control" name="content[{{$key}}][type1][name1][]" value="{{ @$value->name1[$x] }}">	
                        </div>
                    </div>
                    <div class="col-sm-7">
                        <div class="form-group" style="display: inline-flex;width: 100%;">
                            <input type="text" placeholder="Tiêu đề" class="form-control" name="content[{{$key}}][type1][name2][]" value="{{ @$value->name2[$x] }}">	
                            <a href="javascript:void(0);" class="text-danger buttonremove-cth" title="Xóa" style="margin-top: 6px;">
                                <i class="fa fa-trash-o fa-fw"></i>
                            </a>
                        </div>
                    </div>
                </div>
                @endfor
            @else
                <div class="parent-item-cth">
                    <div class="col-sm-5">
                        <div class="form-group">
                            <input type="text" placeholder="Tiêu đề" class="form-control" name="content[{{$key}}][type1][name1][]" value="">	
                        </div>
                    </div>
                    <div class="col-sm-7">
                        <div class="form-group" style="display: inline-flex;width: 100%;">
                            <input type="text" placeholder="Tiêu đề" class="form-control" name="content[{{$key}}][type1][name2][]" value="">	
                            <a href="javascript:void(0);" class="text-danger buttonremove-cth" title="Xóa" style="margin-top: 6px;">
                                <i class="fa fa-trash-o fa-fw"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @endif
        </div>
        <button type="button" class="btn-add___row-ctt" style="float: right" data-key="{{ $key }}">Thêm</button>
	</td>
	<td style="text-align: center;">
        <a href="javascript:void(0);" onclick="$(this).closest('tr').remove()" class="text-danger buttonremovetable" title="Xóa">
            <i class="fa fa-minus"></i>
        </a>
    </td>
</tr>