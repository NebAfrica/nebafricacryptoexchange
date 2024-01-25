<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Testimonial;

class TestimonialController extends Controller
{
    //return index of teams
    public function index()
    {
        $page_title = 'Testimonials';
        $testimonials  = Testimonial::orderBy('id', 'ASC')->get();
    
        return view('admin.testimonials.index', compact(
            'page_title',
            'testimonials'
        ));

    }

    //edit
    public function edit(Request $request)
    {
        $testimonial = Testimonial::where('id', $request->route('id'))->first();
        if (!$testimonial) {
            return redirect(route('admin.testimonials.index'))->with('fail', 'Not Found');
        }

        $page_title = 'Edit Testimonial';

        return view('admin.testimonials.edit', compact(
            'page_title',
            'testimonial'
        ));

    }

    //validate edit
    public function editValidate(Request $request)
    {
        //validate input fill
        $request->validate([
            'photo' => 'max:20000|mimes:svg,png,jpg,jpg',
            'name' => 'required|min:3|max:255',
            'comment' =>  'required',
            'star_rating' => 'required|numeric'
            
        ]);

        $old_photo = Testimonial::where('id', $request->route('id'))->first();
        $photo = $old_photo->photo;
        //upload image
       if ($request->has('photo')){
            $photo = uploadImage($request->file('photo'), 'testimonials');
       }

        //store
        $testimonial = Testimonial::find($request->route('id'));
        $testimonial->name = $request->name;
        $testimonial->comment = $request->comment;
        $testimonial->photo = $photo;
        $testimonial->star_rating = $request->star_rating;

        $is_saved = $testimonial->save();

        if($is_saved) {
            return back()->with('success', 'testimonial updated');
        }else {
            return back()->withInput()->with('fail', 'Something went wrong');
        }

    }

    //create new
    public function new(){
        $page_title =  'Add New Testimonial';
        return view('admin.testimonials.new', compact('page_title'));

    }

    //validate testimonial creeation
    public function newValidate(Request $request)
    {

        //validate input fill
        $request->validate([
            'photo' => 'required|max:20000|mimes:svg,png,jpg,jpg',
            'name' => 'required|min:3|max:255',
            'comment' =>  'required',
            'star_rating' => 'required|numeric'
        ]);

        //upload image
        $photo = uploadImage($request->file('photo'), 'testimonials');

        //store
        $testimonial = new Testimonial();
        $testimonial->name = $request->name;
        $testimonial->comment = $request->comment;
        $testimonial->photo = $photo;
        $testimonial->star_rating = $request->star_rating;

        $is_saved = $testimonial->save();

        if($is_saved) {
            return back()->with('success', 'testimonial saved');
        }else {
            return back()->withInput()->with('fail', 'Something went wrong');
        }

    }

    //delete 
    public function delete(Request $request)
    {
        $testimonial = Testimonial::where('id', $request->id)->first();
        if (!$testimonial) {
            return redirect(route('admin.testimonials.index'))->with('fail', 'Testimonial not found');
        }

        //detele 
        $is_deleted = $testimonial->delete();
        if ($is_deleted) {
            return redirect(route('admin.testimonials.index'))->with('success', 'Testimonial deleted successfully');
        } else {
            return redirect(route('admin.testimonials.index'))->with('fail', 'Something went wrong');
        }

    }
}
