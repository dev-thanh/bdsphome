<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Bds;

class Pages extends Model
{
    protected $table = 'pages';

    public static function getPostBds($city_id)
    {
        $bds = Bds::where([
            'status' => 1,
            'city_id' => $city_id
        ])->get();

        return count($bds);
    }
}
