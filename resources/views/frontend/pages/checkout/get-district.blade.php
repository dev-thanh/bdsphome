<option value="">
    Quận Huyện
</option>
@foreach($district as $item)
<option value="{{$item->id}}">
    {{$item->district_name}}
</option>
@endforeach