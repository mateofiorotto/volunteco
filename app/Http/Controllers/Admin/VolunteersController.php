<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class VolunteersController extends Controller
{
    //
    public function index ()
    {
        $volunteers = User::whereHas('role', function ($query) {
            $query->where('type', 'volunteer');
        })
        ->with('volunteer')
        ->get();

        return view('admin.volunteers.index', compact('volunteers'));
    }
}
