<?php
namespace App\Http\Controllers\Site;
use App\Category;
use App\Slider;
use App\User;
use App\Subscriber;
use App\Contact;
use App\Setting;
use Validator;
use Mail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class IndexController extends Controller
{
    /**
* Create a new controller instance.
*
* @return void
*/
    public function __construct()
    {
        $category = Category::orderBy('category_name', 'ASC')->get();
        view()->share('category', $category);
    }
    /**
* Show the application dashboard.
*
* @return \Illuminate\Http\Response
*/
    public function about_us()
    {
        $title = "About us";
        return view('frontend.about_us', compact('title'));
    }
    /**
* Show the application dashboard.
*
* @return \Illuminate\Http\Response
*/
    public function contact_us()
    {
        $title = "Contact Us";
        return view('frontend.contact_us', compact('title'));
    }
    /**
* Post the contact us details.
*
* @return \Illuminate\Http\Response
*/
    public function contactus_store(Request $request)
    {
        $title = "Contact Us";
        $settings = Setting::get();
        $data = array();
        foreach($settings as $setting){
            $data[$setting->key] = $setting->value;
        }
        $SETTINGS = (object) $data;
        $messages = array(
            'name.required' => 'Please enter name',
            'reason_type.required' => 'Please select reason type',
            'reason.required' => 'Please select reason options',
            'email.required' => 'Please enter email',
            'message.required' => 'Please enter comment',
        );
        $rules = array(
            'name' => 'required|max:255',
            'reason_type' => 'required',
            'reason' => 'required',
            'email' => 'required|email|max:255',
            'message' => 'required|max:255',
        );
        $input = $request->all();
        $reason_type = ($request->has('reason_type')) ? $input['reason_type'] : NULL;
        $contact['name'] = ($request->has('name')) ? $input['name'] : NULL;
        $contact['reason'] = ($request->has('reason')) ? $input['reason'] : NULL;
        $email = $contact['email'] = ($request->has('email')) ? $input['email'] : NULL;;
        $contact['message'] = ($request->has('message')) ? $input['message'] : NULL;

        Mail::send('emails.contact',
        array(
            'reason_type' => $request->get('reason_type'),
            'reason' => ($request->has('reason')) ? $request->get('reason') : '',
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'content' => $request->get('message')
        ), function($message) use($request, $SETTINGS)
        {
            $message->from($request->get('email'));
            $message->to($SETTINGS->contact_email, $request->get('name'))->subject('Contact Us');
        });

        Mail::send('emails.contact_reply',array('name' => $request->get('name')), function($message) use($request, $SETTINGS)
        {
            $message->from($SETTINGS->contact_email);
            $message->to($request->get('email'), $request->get('name'))->subject('Contact Us Reply Feedback');
        });

        $contact = Contact::create($contact);
        if($contact){
            return redirect('contact_us')->with('contact_success', 'Contact mail has been successfully sent.');
        }else{
            return redirect('contact_us')->with('contact_error', 'Sorry, some error found. please try again after sometimes.');
        }
    }
    /**
* Show the application dashboard.
*
* @return \Illuminate\Http\Response
*/
    public function term()
    {
        $title = "Term & Conditions";
        return view('frontend.term', compact('title'));
    }
    /**
* Show the application dashboard.
*
* @return \Illuminate\Http\Response
*/
    public function privacy()
    {
        $title = "Privacy Policy";
        return view('frontend.privacy_policy', compact('title'));
    }
    /**
* Show the application subscribe.
*
* @return \Illuminate\Http\Response
*/
    public function subscribe(Request $request)
    {
        if ($request->isXmlHttpRequest())
        {
            $messages = array(
                'subscriber.required' => 'Please enter valid email',
            );
            $rules = array(
                'subscriber' => 'required|email|max:255',
            );
            $validator = Validator::make($request->all(), $rules, $messages);
            if ($validator->fails()) {
                return response()->json([
                    'validator_error' => TRUE,
                    'error' => TRUE,
                    'msg' => $validator->messages(),
                ]);
            }else{
                $input = $request->all();
                $subscriber['email'] = ($request->has('subscriber')) ? $input['subscriber'] : NULL;
                $isExist = Subscriber::where('email', $subscriber['email'])->count();
                if($isExist)
                {
                    return response()->json([
                        'error' => TRUE,
                        'msg' => 'Sorry,This subscriber email allready exist!!',
                    ]);
                }else{
                    $subscriber = Subscriber::create($subscriber);
                    if($subscriber->id){
                        return response()->json([
                            'error' => FALSE,
                            'msg' => 'User has been successfully subscribed its email.',
                        ]);
                    }else{
                        return response()->json([
                            'error' => TRUE,
                            'msg' => 'Sorry, some error found. please try again after sometimes.',
                        ]);
                    }
                }
            }
        }
        exit;
    }
}
