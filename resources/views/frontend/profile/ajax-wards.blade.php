<option value="">Phường/Xã</option>
@foreach($wards as $item)
    <option value="{{$item->id}}" data-name="{{$item->ward_name}}">
        {{$item->ward_name}}
    </option>
@endforeach