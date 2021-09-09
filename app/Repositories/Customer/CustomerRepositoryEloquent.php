<?php

namespace App\Repositories\Customer;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Customer\CustomerRepository;
use App\Entities\Customer\Customer;
use App\Validators\Customer\CustomerValidator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Validator;

/**
 * Class CustomerRepositoryEloquent.
 *
 * @package namespace App\Repositories\Customer;
 */
class CustomerRepositoryEloquent extends BaseRepository implements CustomerRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return \App\Models\Customer::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function loginAccount($request)
    {
        return response()->json(
            [
                'success' => true,
                'message'=>'Đăng nhập thành công',
                'url'=> route('admin.post-management')
            ]
        );
        
    }

    public function registerAccount($request)
    {
        $input = $request->all();

        $confirmation_code = time().uniqid(true);

        $input['password'] = Hash::make($request->password);

        $input['image'] = 'avatar-default.jpg';

        $input['confirmed'] = 1;

        $input['code'] = $confirmation_code;

        $member = $this->model->create($input);

        return response()->json(
            [
                'success' => true,
                'message'=>'Đăng ký tài khoản thành công'
            ]
        );
    }

    public function getDataPage($type)
    {
        return \App\Models\Pages::where('type',$type)->first();
    }
    
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
