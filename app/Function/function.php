<?php

/*use function foo\func;*/

define("__IMAGE_DEFAULT__", asset('public/backend/img/placeholder.png'));
define("__BASE_URL__", url('public/frontend'));

use App\Models\Options;
use Carbon\Carbon;

function renderImage($link)
{
    if (!empty($link)) {
        return $link;
    }
    return asset('public/backend/img/no-image.png');
}

function text_limit($str, $limit = 10)
{
    if (stripos($str, " ")) {
        $ex_str = explode(" ", $str);
        if (count($ex_str) > $limit) {
            $str_s = null;
            for ($i = 0; $i < $limit; $i++) {
                $str_s .= $ex_str[$i] .
                    " ";
            }
            return $str_s;
        } else {
            return $str;
        }
    } else {
        return $str;
    }
}

function format_datetime($date,$setting)

{   

    $date_format = Carbon::parse($date);

    return $date_format->format($setting);

}

function menuChildren($data, $id, $item)
{
    if (count($item->get_child_cate()) > 0) {
        echo '<ol class="dd-list">';
        foreach ($item->get_child_cate() as $item) {
            if ($item->parent_id == $id) {
                echo '<li class="dd-item" data-id="' . $item->id . '">';
                echo '  <div class="dd-handle">' . $item->title . '(<i>' . $item->url . '</i>)</div>
                                    <div class="button-group">
                                        <a href="javascript:;" class="modalEditMenu" data-id="' . $item->id . '"> 
                                            <i class="fa fa-pencil fa-fw"></i> Sửa
                                        </a> &nbsp; &nbsp; &nbsp;
                                        <a class="text-danger" href="' . route('setting.menu.delete', $item['id']) . '" onclick="return confirm(\'Bạn có chắc chắn xóa không ?\')" title="Xóa"> <i class="fa fa-trash-o fa-fw"></i> Xóa</a>
                                    </div>';
                menuChildren($data, $item->id, $item);
                echo '</li>';
            }
        }
        echo '</ol>';
    }
}

function renderLinkAddPostType()
{
    $type = request()->get('type');
    if ($type == 'blog') {
        return [
            'title'    => 'Bài Viết',
            'linkAdd'  => route('posts.create', ['type' => 'blog']),
            'linkList' => route('posts.index', ['type' => 'blog']),
        ];
    }
}

function listCate($data, $parent_id = 0, $str = '')

{

    foreach ($data as $value) {

        $id   = $value->id;

        $name = $value->name;

        if ($value->parent_id == $parent_id) {

            if ($str == '') {

                $strName = '<b>' . $str . $name . '</b>';

            } else {



                $strName = $str . $name;

            }

            echo '<tr class="odd">';

            echo '<td><input type="checkbox" name="chkItem[]" value="' . $id . '"></td>';

            echo '<td>

                        <a class="text-default" href="' . route('category.edit', $id) . '" title="Sửa">' . $strName . '</a></br>

                        <a href="' . asset('danh-muc/' . $value->slug) . '" target="_blank"> <i class="fa fa-hand-o-right" aria-hidden="true"></i> Link: ' . asset('danh-muc/' . $value->slug) . ' </a>

                    </td>';

            echo '<td><a class="text-default" href="' . route('category.edit', $id) . '" title="Sửa"> ' . count($value->get_child_cate()) ?: '_' . ' </a>

                        </td>';

            echo ' <td><a href="' . route('category.edit', $id) . '" title="Sửa">
                            <span class="label label-primary">Sửa <i class="fa fa-pencil fa-fw"></i></span>
                        </a> &nbsp;

                        <a href="javascript:;" class="btn-destroy" data-href="' . route('category.destroy', $id) . '" data-toggle="modal" data-target="#confim">

                            <span class="label label-danger">Xóa <i class="fa fa-trash-o fa-fw"></i></span>

                        </a>

                    </td>';

            echo '</tr>';



            listCate($data, $id, $str . '---| ');

        }

    }

}

function checkBoxCategory($data, $id, $item, $list_id = null)
{
    if (count($item->get_child_cate()) > 0) {
        echo '<div style="padding-left:15px;">';
        foreach ($item->get_child_cate() as $value) {
            $checked = null;
            if (!empty($list_id)) {
                if (in_array($value->id, $list_id)) {
                    $checked = 'checked';
                }
            }
            if ($value->parent_id == $id) {
                echo '<label class="custom-checkbox">
                            <input type="checkbox" class="category" name="category[]" value="' . $value->id . '" ' . $checked . ' > ' . $value->name . '
                        </label>';
                checkBoxCategory($data, $value->id, $item);
            }
        }
        echo '</div>';
    }
}

function checkBoxCategoryName($data, $id, $item, $list_id = null, $name = null)
{
    if (count($item->get_child_cate()) > 0) {
        echo '<div style="padding-left:15px;">';
        foreach ($item->get_child_cate() as $value) {
            $checked = null;
            if (!empty($list_id)) {
                if (in_array($value->id, $list_id)) {
                    $checked = 'checked';
                }
            }
            if ($value->parent_id == $id) {
                echo '<label class="custom-checkbox">
                            <input type="checkbox" class="category" name="'.$name.'" value="' . $value->id . '" ' . $checked . ' > ' . $value->name . '
                        </label>';
                checkBoxCategory($data, $value->id, $item);
            }
        }
        echo '</div>';
    }
}


function dequy($datas)
{
    $list_ids = [];
    foreach ($datas as $data) {
        $list_ids[] = $data->id;
        if ($data->get_child_cate()->count() > 0) {
            $list_ids = array_merge($list_ids, dequy($data->get_child_cate()));
        }
    }
    return $list_ids;
}

function get_list_ids($datas)
{
    return $datas ? dequy($datas->get_child_cate()) : null;
}

function getlistcate($data, $id)
{
    foreach ($data as $item) {
        if ($item->parent_id == $id) {
            echo '<li class="active"><a href="' . route('home.getActive', ['slug' => $item->slug, 'id' => $item->id]) . '">' . $item->name . '</a></li>';
            getlistcate($data, $item->id);
        }
    }
}

function getListParent($data)
{
    $parent = $data;
    if ($data->parent_id > 0) {
        $parent = $data->getParent();
        $parent = getListParent($parent);
    }
    return $parent;
}

function menuMulti($data, $parent_id = 0, $str = '---| ', $select = 0)
{
    foreach ($data as $value) {
        $id   = $value->id;
        $name = $value->name;
        if ($value->parent_id == $parent_id) {
            if ($select != 0 && $id == $select) {
                echo '<option value=' . $id . ' selected> ' . $str . $value->name . ' </option>';
            } else {
                echo '<option value=' . $id . '> ' . $str . $value->name . ' </option>';
            }
            menuMulti($data, $id, $str . '---|  ', $select);
        }
    }
}
function getOptions($key = null, $field = null)
{
    if(!empty($key)){
        $data = Options::where('type', $key)->first();
        if(!empty($data)){
            $data = json_decode($data->content);
            if(!empty($field)){
                return !empty($data->{ $field }) ? $data->{ $field } : $data;
            }
            return $data;
        }
        return 'key does not exist';
    }
    return 'error';
}


    function renderAction($method)
    {
        return isUpdate($method) ? 'Cập nhật' : 'Thêm mới' ;
    }


    function isUpdate($method)
    {
        return (bool)$method == 'update';
    }

    function updateOrStoreRouteRender($method, $model, $data)
    {
        return isUpdate($method) ? route($model . '.update', $data) : route($model . '.store');
    }

    
    function generateRandomCode() 
    {
        return substr(str_shuffle(str_repeat($x='0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(5/strlen($x)) )),1, 5);
    }

    function getConsts() {
        return [
            'sort-trans' => [
                'cu-nhat' => 'Cũ nhất',
                'gia-tu-cao-den-thap' => 'Giá từ cao đến thấp',
                'gia-tu-thap-den-cao' => 'Giá từ thấp đến cao',
            ],
            'sort-attrs' => [
                'cu-nhat' => 'created_at',
                'gia-tu-cao-den-thap' => 'price',
                'gia-tu-thap-den-cao' => 'price',
            ]
        ];
    }

    function getYoutubeEmbedUrl($url)
    {
         $shortUrlRegex = '/youtu.be\/([a-zA-Z0-9_-]+)\??/i';
         $longUrlRegex = '/youtube.com\/((?:embed)|(?:watch))((?:\?v\=)|(?:\/))([a-zA-Z0-9_-]+)/i';
         
        if (preg_match($longUrlRegex, $url, $matches)) {
            $youtube_id = $matches[count($matches) - 1];
        }

        if (preg_match($shortUrlRegex, $url, $matches)) {
            $youtube_id = $matches[count($matches) - 1];
        }
        return $youtube_id ;
    }

    function listCatePosts($data, $parent_id = 0, $str = '')
{
    foreach ($data as $value) {
        $id   = $value->id;
        $name = $value->name;
        $name_en = $value->name_en;
        if ($value->parent_id == $parent_id) {
            if ($str == '') {
                $strName = '<b>' . $str . $name . '</b>';
            } else {
                $strName = '<p>' . $str . $name . '</p>';
            }
            echo '<tr class="odd">';
            echo '<td><input type="checkbox" name="chkItem[]" value="' . $id . '"></td>';
            // echo "<td><img src='$value->image' class='img-responsive imglist'></td>";
            echo '<td>
                        <a class="text-default" href="' . route('categories-post.edit', $id) . '" title="Sửa">' . $strName . '</a>
                    </td>';

            echo '<td><a class="text-default" href="' . route('categories-post.edit', $id) . '" title="Sửa"> ' . count($value->get_child_cate()) ?: '_' . ' </a>
                        </td>';
            
            echo ' <td><a href="' . route('categories-post.edit', $id) . '" title="Sửa">
                        <span class="label label-primary">Sửa <i class="fa fa-pencil fa-fw"></i></span>
                    </a> &nbsp;
                        <a href="javascript:;" class="btn-destroy" data-href="' . route('categories-post.destroy', $id) . '" data-toggle="modal" data-target="#confim">
                            <span class="label label-danger">Xóa <i class="fa fa-trash-o fa-fw"></i></span>
                        </a>
                    </td>';
            echo '</tr>';

            listCatePosts($data, $id, $str . '---| ');
        }
    }
}
    function listCateNd($data, $parent_id = 0, $str = '')
{
    foreach ($data as $value) {
        $id   = $value->id;
        $name = $value->name;
        $name_en = $value->name_en;
        if ($value->parent_id == $parent_id) {
            if ($str == '') {
                $strName = '<b>' . $str . $name . '</b>';
            } else {
                $strName = '<p>' . $str . $name . '</p>';
            }
            echo '<tr class="odd">';
            echo '<td><input type="checkbox" name="chkItem[]" value="' . $id . '"></td>';
            // echo "<td><img src='$value->image' class='img-responsive imglist'></td>";
            echo '<td>
                        <a class="text-default" href="' . route('categories-nd.edit', $id) . '" title="Sửa">' . $strName . '</a>
                    </td>';

            
            echo ' <td><a href="' . route('categories-nd.edit', $id) . '" title="Sửa">
                        <span class="label label-primary">Sửa <i class="fa fa-pencil fa-fw"></i></span>
                    </a> &nbsp;
                        <a href="javascript:;" class="btn-destroy" data-href="' . route('categories-nd.destroy', $id) . '" data-toggle="modal" data-target="#confim">
                            <span class="label label-danger">Xóa <i class="fa fa-trash-o fa-fw"></i></span>
                        </a>
                    </td>';
            echo '</tr>';

            listCateNd($data, $id, $str . '---| ');
        }
    }
}

function listCateBds($data, $parent_id = 0, $str = '')
{
    foreach ($data as $value) {
        $id   = $value->id;
        $name = $value->name;
        $name_en = $value->name_en;
        if($value->category_nd !=''){
            $nd = $value->getCateNd()->name;
        }else{
            $nd = '';
        }
        if ($value->parent_id == $parent_id) {
            if ($str == '') {
                $strName = '<b>' . $str . $name . '</b>';
            } else {
                $strName = '<p>' . $str . $name . '</p>';
            }
            echo '<tr class="odd">';
            echo '<td><input type="checkbox" name="chkItem[]" value="' . $id . '"></td>';
            // echo "<td><img src='$value->image' class='img-responsive imglist'></td>";
            echo '<td>
                        <a class="text-default" href="' . route('categories-bds.edit', $id) . '" title="Sửa">' . $strName . '</a>
                    </td>';

            echo '<td><a class="text-default"> ' . count($value->get_child_cate()) ?: '_' . ' </a>
                        </td>';
            echo '<td><a class="text-default"> ' . $nd .' </a>
                    </td>';
            
            echo ' <td><a href="' . route('categories-bds.edit', $id) . '" title="Sửa">
                        <span class="label label-primary">Sửa <i class="fa fa-pencil fa-fw"></i></span>
                    </a> &nbsp;
                        <a href="javascript:;" class="btn-destroy" data-href="' . route('categories-bds.destroy', $id) . '" data-toggle="modal" data-target="#confim">
                            <span class="label label-danger">Xóa <i class="fa fa-trash-o fa-fw"></i></span>
                        </a>
                    </td>';
            echo '</tr>';

            listCateBds($data, $id, $str . '---| ');
        }
    }
}

    function listCateProjects($data, $parent_id = 0, $str = '')
{
    foreach ($data as $value) {
        $id   = $value->id;
        $name = $value->name;
        $name_en = $value->name_en;
        if ($value->parent_id == $parent_id) {
            if ($str == '') {
                $strName = '<b>' . $str . $name . '</b>';
            } else {
                $strName = '<p>' . $str . $name . '</p>';
            }
            echo '<tr class="odd">';
            echo '<td><input type="checkbox" name="chkItem[]" value="' . $id . '"></td>';
            // echo "<td><img src='$value->image' class='img-responsive imglist'></td>";
            echo '<td>
                        <a class="text-default" href="' . route('categories-projects.edit', $id) . '" title="Sửa">' . $strName . '</a>
                    </td>';

            echo '<td><a class="text-default" href="' . route('categories-projects.edit', $id) . '" title="Sửa"> ' . count($value->get_child_cate()) ?: '_' . ' </a>
                        </td>';
            
            echo ' <td><a href="' . route('categories-projects.edit', $id) . '" title="Sửa">
                    <span class="label label-primary">Sửa <i class="fa fa-pencil fa-fw"></i></span>
                    </a> &nbsp;
                        <a href="javascript:;" class="btn-destroy" data-href="' . route('categories-projects.destroy', $id) . '" data-toggle="modal" data-target="#confim">
                            <span class="label label-danger">Xóa <i class="fa fa-trash-o fa-fw"></i></span>
                        </a>
                    </td>';
            echo '</tr>';

            listCateProjects($data, $id, $str . '---| ');
        }
    }
}

function menuMultiEditPost($data, $parent_id = 0, $str = '', $select = 0)
{
    foreach ($data as $value) {

        $id   = $value->id;
        $name = $value->name;
        if($select!='' && in_array($id,$select)){
            $checked = 'checked';
        }else{
            $checked = '';
        }
        if ($value->parent_id == $parent_id) {
            echo '<label class="custom-checkbox">'.$str .'<input '.$checked.' value=' . $id . ' name="category[]" type="checkbox"> ' .  $value->name .'</label>';
            
            menuMultiEditPost($data, $id, '&nbsp&nbsp&nbsp&nbsp&nbsp '.$str, $select);
        }
    }
}

function huongNha($id)
{
    $array = [
        '1' => 'Đông',
        '2' => 'Tây',
        '3' => 'Nam',
        '4' => 'Bắc',
        '5' => 'Đông bắc',
        '6' => 'Tây bắc',
        '7' => 'Tây nam',
        '8' => 'Đông nam',
    ];

    return $array[$id];
}

function getAddress($id_city,$id_district,$id_ward){
    $city = \App\Models\City::find($id_city)->city_name;
    $district = \App\Models\District::find($id_district)->district_name;
    $wards ='';
    if($id_ward !=''){

        $wards = \App\Models\Wards::find($id_ward)->ward_name;
    }
    return $wards.', '.$district.' ,'.$city;
}

function convert_number_to_words($number) {
 
    $hyphen      = ' ';
    $conjunction = ' ';
    $separator   = ' ';
    $negative    = 'âm ';
    $decimal     = ' phẩy ';
    $one		 = 'mốt';
    $ten         = 'lẻ';
    $dictionary  = array(
    0                   => 'Không',
    1                   => 'Một',
    2                   => 'Hai',
    3                   => 'Ba',
    4                   => 'Bốn',
    5                   => 'Năm',
    6                   => 'Sáu',
    7                   => 'Bảy',
    8                   => 'Tám',
    9                   => 'Chín',
    10                  => 'Mười',
    11                  => 'Mười một',
    12                  => 'Mười hai',
    13                  => 'Mười ba',
    14                  => 'Mười bốn',
    15                  => 'Mười lăm',
    16                  => 'Mười sáu',
    17                  => 'Mười bảy',
    18                  => 'Mười tám',
    19                  => 'Mười chín',
    20                  => 'Hai mươi',
    30                  => 'Ba mươi',
    40                  => 'Bốn mươi',
    50                  => 'Năm mươi',
    60                  => 'Sáu mươi',
    70                  => 'Bảy mươi',
    80                  => 'Tám mươi',
    90                  => 'Chín mươi',
    100                 => 'trăm',
    1000                => 'ngàn',
    1000000             => 'triệu',
    1000000000          => 'tỷ',
    1000000000000       => 'nghìn tỷ',
    1000000000000000    => 'ngàn triệu triệu',
    1000000000000000000 => 'tỷ tỷ'
    );
     
    if (!is_numeric($number)) {
        return false;
    }
     
    // if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
    // 	// overflow
    // 	trigger_error(
    // 	'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
    // 	E_USER_WARNING
    // 	);
    // 	return false;
    // }
     
    if ($number < 0) {
        return $negative . convert_number_to_words(abs($number));
    }
     
    $string = $fraction = null;
     
    if (strpos($number, '.') !== false) {
        list($number, $fraction) = explode('.', $number);
    }
     
    switch (true) {
        case $number < 21:
            $string = $dictionary[$number];
        break;
        case $number < 100:
            $tens   = ((int) ($number / 10)) * 10;
            $units  = $number % 10;
            $string = $dictionary[$tens];
            if ($units) {
                $string .= strtolower( $hyphen . ($units==1?$one:$dictionary[$units]) );
            }
        break;
        case $number < 1000:
            $hundreds  = $number / 100;
            $remainder = $number % 100;
            $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
            if ($remainder) {
                $string .= strtolower( $conjunction . ($remainder<10?$ten.$hyphen:null) . convert_number_to_words($remainder) );
            }
        break;
        default:
            $baseUnit = pow(1000, floor(log($number, 1000)));
            $numBaseUnits = (int) ($number / $baseUnit);
            $remainder = $number - ($numBaseUnits*$baseUnit);
            $string = convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
            if ($remainder) {
                $string .= strtolower( $remainder < 100 ? $conjunction : $separator );
                $string .= strtolower( convert_number_to_words($remainder) );
            }
        break;
    }
     
    if (null !== $fraction && is_numeric($fraction)) {
        $string .= $decimal;
        $words = array();
        foreach (str_split((string) $fraction) as $number) {
            $words[] = $dictionary[$number];
        }
        $string .= implode(' ', $words);
    }
     
    return $string;
}

function formatMoney($money)
{
    switch ($money) {
        case $money  < 10000000:
            # code...
            break;
        
        default:
            # code...
            break;
    }
}


