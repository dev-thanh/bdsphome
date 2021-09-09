<option value="">Phường/Xã</option>
@foreach($wards as $item)
    <option value="{{$item->id}}">
        {{$item->ward_name}}
    </option>
@endforeach