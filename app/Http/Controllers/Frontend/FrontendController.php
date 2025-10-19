<?php
namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Project;

class FrontendController extends Controller
{
    public function home(){
        return view('frontend/home');
    }

    public function projects(){
        $projects = Project::where('enabled', true)->latest()->paginate(10);

        return view('frontend/projects', compact('projects'));
    }

    public function projectById($id){
        $project = Project::where('id', $id)->where('enabled', true)->firstOrFail();

        return view('frontend/project-details', compact('project'));
    }
}
