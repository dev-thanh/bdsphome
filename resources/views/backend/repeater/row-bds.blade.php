<?php $key  = isset($key) ? $key : (int) round(microtime(true) * 1000); ?>
<tr>
    <td>
        <div class="form-group col-sm-3 item-journey">
            <label for="">Hình ảnh đại diện khu vực</label>
            <div class="image">
                <div class="image__thumbnail" style="max-width: 120px;max-height: 120px">
                    <img src="{{ !empty($value->image) ? url('/').$value->image : __IMAGE_DEFAULT__ }}"  
                    data-init="{{ __IMAGE_DEFAULT__ }}">
                    <a href="javascript:void(0)" class="image__delete" onclick="urlFileDelete(this)">
                        <i class="fa fa-times"></i></a>
                    <input type="hidden" value="{{ @$value->image }}" name="content[bds][content][{{ $key }}][image]"  />
                    <div class="image__button" onclick="fileSelect(this)"><i class="fa fa-upload"></i> Upload</div>
                </div>
            </div>
        </div>
        @php $citys = \App\Models\City::all(); @endphp
        <div class="col-sm-9">
            <div class="form-group">
                <label for="">Chọn tỉnh thành</label>
                <div>
                    <select name="content[bds][content][{{ $key }}][city_id]">
                        @foreach($citys as $city)
                        <option value="{{$city->id}}" @if(@$value->city_id == @$city->id) selected @endif>
                            {{$city->city_name}}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </td>
    <td style="text-align: center;">
        <a href="javascript:void(0);" onclick="$(this).closest('tr').remove()" class="text-danger buttonremovetable" title="Xóa">
            <i class="fa fa-minus"></i>
        </a>
    </td>
</tr>
