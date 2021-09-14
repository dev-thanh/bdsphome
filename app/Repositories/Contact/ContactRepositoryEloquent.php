<?php

namespace App\Repositories\Contact;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Contact\ContactRepository;
use App\Entities\Contact\Contact;
use App\Validators\Contact\ContactValidator;
use Illuminate\Support\Facades\Mail;

/**
 * Class ContactRepositoryEloquent.
 *
 * @package namespace App\Repositories\Contact;
 */
class ContactRepositoryEloquent extends BaseRepository implements ContactRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return \App\Models\Contact::class;
    }

    public function saveContact($request)
    {
        try {
            $contact = new \App\Models\Contact();
            $contact->title = 'Liên hệ từ khách hàng';
            $contact->name = $request->name;
            $contact->phone = $request->phone;
            $contact->type = 1;
            $contact->email = $request->email;
            $contact->content = $request->content;
            $contact->status = 0;
            $contact->save();

            $email_admin = getOptions('general', 'email_admin');

            $content_email = [
                'title' => 'Liên hệ từ khách hàng',
                'name' => $request->name,
                'type' => 1,
                'phone' => $request->phone,
                'email' => $request->email,
                'content' => $request->content,
                'url' => route('contact.edit', $contact->id),
            ];

            Mail::send('frontend.mail.mail-contact', $content_email , function ($msg) use ($email_admin) {
        
                $msg->from(config('mail.mail_from'), 'Công ty Cổ phần D LAND');

                $msg->to($email_admin)->subject('Công ty Cổ phần D LAND');

            });
            
            return response()->json([
                'success'=>true,
                'message'=>'Gửi liên hệ thành công, chúng tôi sẽ liện hệ với bạn trong thời gian sớm nhất, xin cảm ơn!'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'success'=>false,
                'message'=>'Có lỗi xảy ra vui lòng thử lại'
            ]);
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
