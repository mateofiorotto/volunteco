<?php

namespace App\Http\Controllers\User\Host;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * vista de dashboard de anfitrion
     */
    public function index()
    {
        return view('user.host.dashboard');
    }
}
