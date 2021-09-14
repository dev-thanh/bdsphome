@foreach($products as $item)
<div class="item-pr">
    <div class="img-item">
        <img src="{{url('/')}}/{{$item->image}}">
    </div>
    <div class="title">
        {{$item->name}}
    </div>
    <div>
        @if($array_spkh!='')
        <input name="product_item_checkbox" @if(in_array($item->id,$array_spkh)) checked @endif data-id="{{$item->id}}" data-img="{{$item->image}}" data-name="{{$item->name}}" type="checkbox" class="select-product">
        @else
        <input name="product_item_checkbox" data-id="{{$item->id}}" data-img="{{$item->image}}" data-name="{{$item->name}}" type="checkbox" class="select-product">
        @endif
    </div>
</div>
@endforeach