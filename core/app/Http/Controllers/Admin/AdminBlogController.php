<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminBlogController extends Controller
{
    //return index  blog
    public function index(Request $request)
    {
        $page_title = 'Blogs';
        $all = Blog::orderBy('id', 'DESC');
        $blogs = $all->get();

        //retrieve posts based on qurry
        if ($request->has('status')) {
            $blogs = $all->where('status', $request->status)->get();
        }


        return view('admin.blogs.index', compact(
            'page_title',
            'blogs'
        ));
    }

    //create new blog post
    function new()
    {
        $page_title = 'Create New Blog Post';

        return view('admin.blogs.new', compact(
            'page_title'
        ));
    }

    //validate new blog post
    public function newValidate(Request $request)
    {
        //validate input
        $request->validate([
            'title' => 'required|max:255',
            'detail' => 'required',
            'category' => 'required|max:255',
            'cover_image' => 'required|mimes:png,jpg,jpeg',
            'snippet' => 'required',
        ]);

        //upload cover image
        $cover_image = uploadImage($request->cover_image, 'blogs');

        //save the blog post to the blog textable
        $blog = new Blog();
        $blog->type = 'manual';
        $blog->uuid = uniqid();
        $blog->author = 'Admin';
        $blog->title = $request->title;
        $blog->snippet = $request->snippet;
        $blog->detail = $request->detail;
        $blog->category = $request->category;
        $blog->slug = time() . '-' . Str::slug($request->title);
        $blog->img = $cover_image;
        $saved = $blog->save();

        if ($saved) {
            return redirect(route('admin.blogs.edit', $blog->id))->with('success', 'blog post created successfully');
        } else {
            return back()->with('fail', 'An error occurred');
        }
    }

    //edit blog
    public function edit(Request $request)
    {
        $page_title = 'Edit Blog';
        $blog = Blog::where('id', $request->route('id'))->first();
        if (!$blog) {
            return redirect(route('admin.blogs.index'))->with('fail', 'Blog not found');
        }

        return view('admin.blogs.edit', compact(
            'blog',
            'page_title'
        ));
    }

    //validate blog edit
    public function editValidate(Request $request)
    {

        //validate input
        $request->validate([
                    
            'title' => 'required|max:255',
            'detail' => 'required',
            'category' => 'required|max:255',
            'cover_image' => 'mimes:png,jpg,jpeg',
            'snippet' => 'required',
        ]);

        //upload image
        $cover_image = NULL;
        if ($request->file('cover_image')) {
            $cover_image = uploadImage($request->cover_image, 'blogs');
        }
        

        //save to posts table
        $blog = Blog::find($request->route('id'));
        $blog->title = $request->title;
        $blog->detail = $request->detail;
        $blog->category = $request->category;
        $blog->snippet = $request->snippet;
        
        if ($cover_image != NULL) {
            $blog->img = $cover_image;
        }
        $updated = $blog->save();

        if ($updated) {
            return back()->with('success', 'Blog has been updated successfully');
        } else {
            return back()->with('fail', 'An error occurred');
        }
    }

    

    //delete blog
    public function delete(Request $request)
    {
        $is_deleted = Blog::destroy($request->id);
        if ( $is_deleted ) {
            return redirect(route('admin.blogs.index'))->with('success', 'Blog deleted successfully');
        } else {
            return back()->with('fail', 'Something went wrong, could not delete blog post');
        }

    }

    public function action(Request $request) {
        $request->validate([
            'ids' => 'required',
            'action' => 'required'
        ]);

        $action  = $request->action;
        $ids = $request->ids;
        $errors = [];
        if ($action  == 'delete') {
            foreach ($ids as $id) {
                $is_deleted = Blog::destroy($id);
                if (!$is_deleted) {
                    array_push($errors, $id);
                } 

            }

            if (count($errors) < count($ids)) {
                return back()->with('success', 'Blogs deleted successfully');
            } elseif (count($errors) == count($ids)) {
                return back()->with('fail', 'Selected blog posts could not be deleted');
            } else {
                return back()->with('fail', 'Some of selected blog posts could not be deleted');
            }
        } else {
            return back()->with('fail', 'Unrecognized action');
        }

        
    }
}
