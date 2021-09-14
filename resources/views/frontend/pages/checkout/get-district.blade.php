<option value="">
    Quận Huyện
</option>
@foreach($district as $item)
<option value="{{$item->id}}" data-name="{{$item->district_name}}">
    {{$item->district_name}}
</option>
@endforeach