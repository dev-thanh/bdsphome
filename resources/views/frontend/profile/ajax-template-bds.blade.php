@if(!empty($cateBds->content))
    @php $contents = json_decode($cateBds->content); @endphp
@endif
@if(isset($contents))
    @if(@$contents->direction_house==1)
    <div class="info__col">
        <span class="name__dots">Hướng nhà</span>
        <select name="direction_house">
            <option value="1">Đông</option>
            <option value="2">Tây</option>
            <option value="3">Nam</option>
            <option value="4">Bắc</option>
            <option value="5">Đông bắc</option>
            <option value="6">Tây bắc</option>
            <option value="7">Tây nam</option>
            <option value="8">Đông nam</option>
        </select>
    </div>
    @endif
    @if(@$contents->balcony_direction==1)
    <div class="info__col">
        <span class="name__dots">Hướng ban công </span>
        <select name="balcony_direction">
            <option value="1">Đông</option>
            <option value="2">Tây</option>
            <option value="3">Nam</option>
            <option value="4">Bắc</option>
            <option value="5">Đông bắc</option>
            <option value="6">Tây bắc</option>
            <option value="7">Tây nam</option>
            <option value="8">Đông nam</option>
            
        </select>
    </div>
    @endif
    @if(@$contents->way==1)
    <div class="info__col">
        <span class="name__dots">Đường rộng</span>
        <input type="text" name="way" placeholder="Nhập thông đường rộng">
    </div>
    @endif
    @if(@$contents->frontispiece==1)
    <div class="info__col">
        <span class="name__dots">Mặt tiền. m</span>
        <input type="text" name="frontispiece" placeholder="Nhập thông tin mặt tiền">
    </div>
    @endif
    @if(@$contents->show_bedroom==1)
    <div class="info__col">
        <span class="name__dots"> Phòng ngủ</span>
        <select name="bedroom">
            <option value="3">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
        </select>
    </div>
    @endif
    @if(@$contents->show_bathroom==1)
    <div class="info__col">
        <span class="name__dots"> Phòng tắm vê sinh </span>
        <select name="bathroom">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
        </select>
    </div>
    @endif
    @if(@$contents->show_floors==1)
    <div class="info__col">
        <span class="name__dots">Số tầng</span>
        <select name="number_floors">
            @for($i=1;$i<=25;$i++)
            <option value="{{$i}}">{{$i}}</option>
            @endfor
        </select>
    </div>
    @endif
    @if(@$contents->legal_papers==1)
    <div class="info__col">
        <span class="name__dots"> Giấy tờ pháp lý </span>
        <select name="legal_papers" id="">
            <option value="Sổ đổ chính chủ">Sổ đổ chính chủ</option>
            <option value="Đang chờ sổ">Đang chờ sổ</option>
        </select>
    </div>
    @endif
@endif