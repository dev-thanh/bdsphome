<?php

namespace App\Repositories\Profile;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Profile\ProfileRepository;
use App\Entities\Profile\Profile;
use App\Validators\Profile\ProfileValidator;
use Image;
use File;
use App\Models\City;
use App\Models\District;
use App\Models\Wards;
use App\Models\Customer;

/**
 * Class ProfileRepositoryEloquent.
 *
 * @package namespace App\Repositories\Profile;
 */
class ProfileRepositoryEloquent extends BaseRepository implements ProfileRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    protected $customer, $city,$district;

    public function __construct(Customer $customer, City $city, District $district, Wards $ward)
    {
        $this->customer = $customer;
        $this->city = $city;
        $this->district = $district;
        $this->ward = $ward;
    }

    public function model()
    {
        return Profile::class;
    }

    public function getCity()
    {
        return $this->city->get();
    }

    public function getDistrict($id)
    {
        return $this->district->where('city_id',$id)->get();
    }

    public function getWard($id)
    {
        return $this->ward->where('district_id',$id)->get();
    }

    /* Update account */
    public function saveUpdateAccount($request,$id)
    {
        $data = $request->all();

        $member = $this->customer->findOrFail($id);

        if ($request->hasFile('file')){

            $image = $request->file('file');
    
            $new_name = $member->id.rand() . '.' . $image->getClientOriginalExtension();
    
            $fileName = public_path().'/images/avatar/'.$member->image;
    
            $image->move(public_path('images/avatar'), $new_name);
    
            $resizedImage = Image::make(public_path() . '/images/avatar/' . $new_name)->resize(150, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            // save file as jpg with medium quality
            $resizedImage->save(public_path() . '/images/avatar/' . $new_name, 60);
    
            $data['image'] = $new_name;

            if(file_exists($fileName) && $member->image !='avatar-default.jpg'){
                File::delete($fileName);
            }

        }

        $member->update($data);

        return url('/').'/public/images/avatar/'.$member->image;
        
    }
    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
