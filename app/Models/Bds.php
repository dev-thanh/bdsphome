<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bds extends Model
{
    protected $table = 'real_estate';

    protected $fillable = ['customer_id','city_id','district_id','ward_id','district_id','address','object','need','type_housing','projects_id','land_area','usable_area','price','price2','bedroom','bathroom','number_floors','direction_house','balcony_direction','frontispiece','way','image','more_image','title','slug','desc','content','status','tt','startDate','endDate','legal_papers'];  

    public function getMemberDetai($id)
    {
        return \App\Models\Customer::findOrFail($id);

    }

    public function getCountBds($id)
    {
        $bds = $this->where([
            'customer_id' => $id,
            'status' => 1
        ])->get();

        return count($bds);
    }
}
