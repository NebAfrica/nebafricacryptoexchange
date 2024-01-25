<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use App\Models\Newsletter;
use App\Models\ContactFormSubmission;

class HomeController extends Controller
{
    //define view data
    private $all_view_data;

    public function __construct(){

        $this->all_view_data = [
            'sections' => \App\Models\Section::get(),
            'faqs' => \App\Models\Faq::get(),
            'deposits' => \App\Models\Deposit::orderBy('id', 'DESC')->take(10)->get(),
            'withdrawals' => \App\Models\Withdrawal::orderBy('id', 'DESC')->take(10)->get(),
            'plans' => \App\Models\InvestmentPlan::where('status', 'active')->get(),
            'methods' => \App\Models\ManualDepositMethod::where('status', 'active')->get(),
            'teams' => \App\Models\Team::get(),
            'testimonials' => \App\Models\Testimonial::inRandomOrder()->take(10)->get(),
            'blogs' => \App\Models\Blog::orderBy('id', 'DESC')->paginate(8),
        ];
    }


    //return view of  home
    public function home()
    {
        $page_title = 'Home';
        $view_data = $this->all_view_data;
        //return $view_data;
        return view('themes.' .websiteInfo('theme'). '.front.home', compact(
            'page_title',
            'view_data'

        ));
    }

    //return about us page
    public function about()
    {
        $page_title = ucwords(str_replace('-', ' ', request()->path()));
        $view_data = $this->all_view_data;
        //return $view_data;
        return view('themes.' .websiteInfo('theme'). '.front.about', compact(
            'page_title',
            'view_data'

        ));

    }

    //return contact us page
    public function contact()
    {
        $page_title = ucwords(str_replace('-', ' ', request()->path()));
        $view_data = $this->all_view_data;
        //return $view_data;
        return view('themes.' .websiteInfo('theme'). '.front.contact', compact(
            'page_title',
            'view_data'

        ));

    }

    //validate contact form submission
    public function contactValidate(Request $request){
        $request->validate([
            'name' => 'required|max:255|regex:/^[a-zA-Z0-9.,\s]+$/' ,
            'email' => 'required|email|max:255',
            'subject' => 'required|max:255|regex:/^[a-zA-Z0-9.,\s]+$/',
            'message' => 'required|min:20|regex:/^[a-zA-Z0-9.,\s]+$/'
        ]);

        // check if google recaptcha is enabled
        if (websiteInfo('google_captcha') == 'enabled') {
            $request->validate([
                'g-recaptcha-response' => 'recaptcha'
            ], [
                'g-recaptcha-response.recaptcha' => 'We are afraid you are a robot'
            ]);
        }

        //store the form data
        $contact = New ContactFormSubmission();
        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->subject = $request->subject;
        $contact->message = json_encode($request->message);
        $is_saved = $contact->save();
        if($is_saved){
            //notify admins
           $send =  sendContactFormSubmissionEmail($request->name, $request->email, $request->subject, $request->message);
           if ($send == true){
            return back()->with('success', 'Your request has been sent, we will contact you by email shortly');
           }else {
            return back()->with('fail', 'something went wrong, try again later');
           }
        }
    }

    //return faq page
    public function faq()
    {
        $page_title = 'Frequently Asked Questions';
        $view_data = $this->all_view_data;
        //return $view_data;
        return view('themes.' .websiteInfo('theme'). '.front.faq', compact(
            'page_title',
            'view_data'

        ));

    }

    //return investment and loan plans page
    public function plans()
    {
        $page_title = ucwords(str_replace('-', ' ', request()->path()));
        $view_data = $this->all_view_data;
        //return $view_data;
        return view('themes.' .websiteInfo('theme'). '.front.plans', compact(
            'page_title',
            'view_data'

        ));

    }


    //blog archive
    public function blogs()
    {
        $page_title = ucwords(str_replace('-', ' ', request()->path()));
        $view_data = $this->all_view_data;
        //return $view_data;
        return view('themes.' .websiteInfo('theme'). '.front.blogs', compact(
            'page_title',
            'view_data'

        ));

    }

    //return view for blog details
    public function blogDetail(Request $request)
    {
        $blog = Blog::where('slug', $request->route('slug'))->first();
        //404 if not found
        if(!$blog) {
            abort(404);
        }
        $page_title = $blog->title;
        $view_data = $this->all_view_data;
        //return $view_data;
        return view('themes.' .websiteInfo('theme'). '.front.blog-detail', compact(
            'page_title',
            'view_data',
            'blog'

        ));

    }

    //ssubmit subscription
    public function subscribe(Request $request)
    {
        $request->validate([
            'email' => 'required|email|max:255',
        ]);

        //check if the user previously subscrible
        $is_subscribed = Newsletter::where('email', $request->email)->first();
        if(!$is_subscribed){
            //crete a new instance
            $sub = new Newsletter();
            $sub->email = $request->email;
            $save_sub = $sub->save();

            if($save_sub){
                return back()->with('success', 'Subscription successful');
            }else {
                return back()->withInput()->with('fail', 'Something went wrong, try again letter');
            }
        }else {
            return back()->with('success', 'Subscription successful');
        }
    }
}
