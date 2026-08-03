<?php

namespace App\Http\Controllers;

use App\Mail\ThankYouMail;
use App\Mail\VideoSubmitted;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class PageController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'video' => ['required'],
            'video_url' => ['nullable'],
            // 'title' => ['required', 'string', 'max:200'],
            'description' => ['required', 'string', 'max:3000'],
            'city' => ['required', 'string', 'max:30'],
            'state' => ['required', 'string', 'max:30'],
            'country' => ['required', 'string', 'max:30'],
            'when_filmed' => ['nullable', 'string', 'max:30'],
            'first_name' => ['required', 'string', 'max:30'],
            'last_name' => ['required', 'string', 'max:30'],
            'email' => ['required', 'string', 'max:100'],
            'birthdate' => ['nullable', 'max:100'],
            'phone' => ['nullable', 'string', 'max:200'],
            'person_who_filmed' => ['required', 'string', 'max:200'],
            'person_who_filmed_other' => ['nullable', 'string', 'max:200'],
            'submit_other_website' => ['required', 'string', 'max:200'],
            'submit_place' => ['nullable', 'string', 'max:200'],
            'did_anyone_reach' => ['required', 'string', 'max:200'],
            'share_reach_name' => ['nullable', 'string', 'max:200'],
            'aggrement_with_another_company' => ['required', 'string', 'max:200'],
            'video_credit' => ['nullable', 'string', 'max:200'],
            'people_appearing' => ['required', 'max:200'],
            'people_appearing_list' => ['required_if:people_appearing,Yes', 'max:200'],
        ]);
		if($request->signature){
			$data['signature'] = $this->storeSignature($request->signature);
		}
        $data['user_ip']=request()->ip();
        $video = Video::create($data);
		if(setting('site.cc_emails')){
			$cc_emails = setting('site.cc_emails');
		}else{
			$cc_emails = 'info@skillshands.com';
		}
        $cc_emails = explode(',', $cc_emails);
        if(setting('site.email')){
            Mail::to(setting('site.email'))->send(new VideoSubmitted($video,$cc_emails));
        }
        if($video->email){
            Mail::to($video->email)->send(new ThankYouMail($video));
        }

        return redirect()->route('thankyou');
    }
    public function index()
    {
        return view('home');
    }
    public function submit()
    {
        return view('submit');
    }
    public function thankyou()
    {
        return view('thankyou');
    }
    public function progressbar(Request $request)
    {
        $request->validate([
            'video'=>['required','file']
        ]);
        $file = $request->file('video');
        $name = Str::random(20).'.'.$file->getClientOriginalExtension();
        $path = $request->file('video')->storeAs(
            'videos',$name,config('filesystems.default')
        );
        return $path;
    }
    protected function storeSignature($canvas)
    {
        $image_parts = explode(";base64,", $canvas);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);
        $fileName = 'signature/' . uniqid() . '.' . $image_type;
        Storage::disk('public')->put($fileName, $image_base64);
        return $fileName;
    }

    public function validateEmail(Request $request){
        $response = Http::get('https://api.zerobounce.net/v2/validate',[
            'api_key'=>config('services.zerobounce.api_key'),
            'email'=>$request->email
        ]);
        if($response->json()['status'] == 'valid'){
            return true;
        }
        if ($request->isJson()) {
            $response = ['error' => 'Please enter a valid email address'];
            return response()->json($response, 422);
        }
        return false;
    }
}
