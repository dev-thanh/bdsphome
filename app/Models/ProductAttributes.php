<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ProductAttributeTypes;

class ProductAttributes extends Model
{
    protected $table = 'product_attributes';
    protected $fillable = ['id_product_attribute_types', 'id_product', 'key', 'type', 'value'];

    public static function getNameAttribute($id)
    {
    	$data = ProductAttributeTypes::find($id);
    	return $data->name;
    }
    public static function getClors($id_product,$id)
    {
    	$data = ProductAttributes::where([
    		'id_product' => $id_product,
    		'id_product_attribute_types' => $id
    	])->get();
    	return $data;
    }
}
