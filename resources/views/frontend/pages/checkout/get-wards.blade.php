<option value="">
    Xã / Phường
</option>
@foreach($wards as $item)
    <option value="{{$item->id}}">
        {{$item->ward_name}}
    </option>
@endforeach