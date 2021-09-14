<?php

namespace App\Repositories\Bds;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Bds\BdsRepository;
use App\Entities\Bds\Bds;
use Image;
use App\Validators\Bds\BdsValidator;

/**
 * Class BdsRepositoryEloquent.
 *
 * @package namespace App\Repositories\Bds;
 */
class BdsRepositoryEloquent extends BaseRepository implements BdsRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return \App\Models\Bds::class;
    }

    public function createBds($request)
    {
        $input = $request->all();

        $input['customer_id'] = auth('customer')->user()->id;

        $input['slug'] = $this->createSlug(str_slug($request->title),$id = null,$type='slug');

        $more_image = [];

        try {
            if($request->file){
                $image1 = $request->file('file');
    
                $width1 = Image::make($image1->getRealPath())->width();
    
                $new_name1 = $input['customer_id'].rand() . '.' . $image1->getClientOriginalExtension();
    
                $image1->move(public_path('images/bds'), $new_name1);
    
                if($width1 > 600){
                    $resizedImage1 = Image::make(public_path() . '/images/bds/' . $new_name1)->resize(600, null, function ($constraint) {
                        $constraint->aspectRatio();
                    });
                    // save file as jpg with medium quality
                    $resizedImage1->save(public_path() . '/images/bds/' . $new_name1, 60);
                }
    
                $input['image'] = $new_name1;
            }else{
                $input['image'] = 'default.jpg';
            }
    
            if($request->count_file != 0){
                for ($i=0; $i < $request->count_file; $i++) { 
    
                    $select = 'files-'.$i;
    
                    $image = $request->file($select);
    
                    $width = Image::make($image->getRealPath())->width();
    
                    $new_name = $input['customer_id'].rand() . '.' . $image->getClientOriginalExtension();
    
                    $image->move(public_path('images/bds'), $new_name);
        
                    if($width > 1024){
                        $resizedImage = Image::make(public_path() . '/images/bds/' . $new_name)->resize(1024, null, function ($constraint) {
                            $constraint->aspectRatio();
                        });
                        // save file as jpg with medium quality
                        $resizedImage->save(public_path() . '/images/bds/' . $new_name, 60);
                    }
    
                    array_push($more_image,$new_name);
    
                }
    
                if($more_image !=[]){
                    $input['more_image'] = json_encode($more_image);
                }
                
            }
        } catch (\Throwable $th) {
            //throw $th;
        }

        

        $this->model->create($input);

        return response()->json([
            'success'=>true,
            'message'=>'Đăng tin thành công,Vui lòng chờ duyệt từ quản trị viên'
        ]);
    }

    public function getBdsHome(){

        $data = $this->model->where('status',1)->orderBy('created_at','desc')->take(16)->get();

        return $data;

    }

    public function getAllBds(){

        $data = $this->model->where(
            [
                'customer_id' => auth('customer')->user()->id
            ]
        )->orderBy('created_at','desc')->get();

        return $data;

    }
    public function getBdsBySlug($slug){

        $data = $this->model->where(
            [
                'slug' => $slug,
                'status' => 1
            ]
        )->firstOrFail();

        return $data;

    }

    public function getBdsType($status)
    {
        $data = $this->model->where(
            [
                'customer_id' => auth('customer')->user()->id,
                'status' => $status
            ]
        )->orderBy('created_at','desc')->get();

        return $data;
    }

    public function getBdsTime()
    {
        $data = $this->model->where(
            [
                'customer_id' => auth('customer')->user()->id,
                'status' => 1,
                'endDate' < date('d/m/Y')
            ]
            );
    }

    public function createSlug($slugPost, $id = null,$type)
    {
        $slug = $slugPost;
        $index = 1;
        $baseSlug = $slug;
        while ($this->checkIfExistedSlug($slug, $id,$type)) {
            $slug = $baseSlug . '-' . $index++;
        }

        if (empty($slug)) {
            $slug = time();
        }

        return $slug;
    }


    public function checkIfExistedSlug($slug, $id = null,$type)
    {
        if($id != null) {
            $count = $this->model->where('id', '!=', $id)->where($type, $slug)->count();
            return $count > 0;
        }else{
            $count = $this->model->where($type, $slug)->count();
            return $count > 0;
        }
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
