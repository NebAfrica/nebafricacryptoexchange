<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Faq;

class FaqController extends Controller
{
    //return index
    public function index()
    {
        $page_title = 'All FAQs';
        $faqs  =  Faq::orderBy('id', 'DESC')->get();

        return view('admin.faqs.index', compact(
            'page_title',
            'faqs'
        ));

    }

    //return edit of a single faq
    public function edit(Request $request) 
    {
        $faq = Faq::where('id', $request->route('id'))->first();
        //!not found
        if (!$faq) {
            return redirect(route('admin.faqs.index'))->with('fail', 'FAQ not found');
        }

        $page_title = 'Edit FAQ';

        return view('admin.faqs.edit', compact(
            'page_title',
            'faq'
        ));
        
    }

    //validate edit
    public function editValidate(Request $request)
    {
        $request->validate([
            'question' => 'required|max:255',
            'answer' => 'required'
        ]);

        $faq = Faq::find($request->route('id'));
        $faq->question = $request->question;
        $faq->answer = $request->answer;
        $is_saved = $faq->save();

        if($is_saved) {
            return back()->with('success', 'Faq updated successfully');
        }else {
            return back()->with('fail', 'Something went wrong!');
        }
    }

    //create new faq

    public function new(){
        $page_title = 'Add New FAQ';
        return view('admin.faqs.new', compact(
            'page_title',
           
        ));
        
    }

    //validate the faq creation
    public function newValidate(Request $request)
    {
        //validate input
        $request->validate([
            'question' => 'required|max:255',
            'answer' => 'required',
        ]);

        //create a new instance
        $faq = new Faq();
        $faq->question = $request->question;
        $faq->answer = $request->answer;
        $is_saved = $faq->save();

        if($is_saved) {
            return back()->with('success', 'Faq has been saved');
        }else {
            return back()->with('fail', 'Something went wrong');
        }
    }

    //delete 
    public function delete(Request $request)
    {
        $faq = Faq::where('id', $request->id)->first();

        if(!$faq){
            return redirect(route('admin.faqs.index'))->with('fail', 'FAQ does not exist');
        }

        //delete
        $is_deleted = $faq->delete();
        if($is_deleted) {
            return back()->with('success', 'Faq has been deleted');
        } else {
            return back()->With('fail', 'Something went wrong, try again later');
        }
    }

}

