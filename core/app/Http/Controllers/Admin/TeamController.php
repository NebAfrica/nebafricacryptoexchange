<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Team;

class TeamController extends Controller
{
    //return index of teams
    public function index()
    {
        $page_title = 'Teams';
        $teams  = Team::orderBy('id', 'ASC')->get();
        
        return view('admin.teams.index', compact(
            'page_title',
            'teams'
        ));

    }

    //edit
    public function edit(Request $request)
    {
        $team = Team::where('id', $request->route('id'))->first();
        if (!$team) {
            return redirect(route('admin.teams.index'))->with('fail', 'Not Found');
        }

        $page_title = 'Edit Team';

        return view('admin.teams.edit', compact(
            'page_title',
            'team'
        ));

    }

    //validate edit
    public function editValidate(Request $request)
    {
        //validate input fill
        $request->validate([
            'photo' => 'max:20000|mimes:svg,png,jpg,jpg',
            'name' => 'required|min:3|max:255',
            'role' => 'required|min:3|max:255'
            
        ]);

        $old_photo = Team::where('id', $request->route('id'))->first();
        $photo = $old_photo->photo;
        //upload image
       if ($request->has('photo')){
            $photo = uploadImage($request->file('photo'), 'teams');
       }

        //store
        $team = Team::find($request->route('id'));
        $team->name = $request->name;
        $team->role = $request->role;
        $team->photo = $photo;

        $is_saved = $team->save();

        if($is_saved) {
            return back()->with('success', 'team updated');
        }else {
            return back()->withInput()->with('fail', 'Something went wrong');
        }

    }

    //create new
    public function new(){
        $page_title =  'Add New Team';
        return view('admin.teams.new', compact('page_title'));

    }

    //validate team creeation
    public function newValidate(Request $request)
    {

        //validate input fill
        $request->validate([
            'photo' => 'required|max:20000|mimes:svg,png,jpg,jpg',
            'name' => 'required|min:3|max:255',
            'role' => 'required|min:3|max:255'
        ]);

        //upload image
        $photo = uploadImage($request->file('photo'), 'teams');

        //store
        $team = new Team();
        $team->name = $request->name;
        $team->role = $request->role;
        $team->photo = $photo;

        $is_saved = $team->save();

        if($is_saved) {
            return back()->with('success', 'team saved');
        }else {
            return back()->withInput()->with('fail', 'Something went wrong');
        }

    }

    //delete 
    public function delete(Request $request)
    {
        $team = Team::where('id', $request->id)->first();
        if (!$team) {
            return redirect(route('admin.teams.index'))->with('fail', 'Team not found');
        }

        //detele 
        $is_deleted = $team->delete();
        if ($is_deleted) {
            return redirect(route('admin.teams.index'))->with('success', 'Team deleted successfully');
        } else {
            return redirect(route('admin.teams.index'))->with('fail', 'Something went wrong');
        }

    }
}
