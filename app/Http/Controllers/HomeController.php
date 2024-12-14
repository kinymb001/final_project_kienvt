<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function index()
    {
        $role = auth()->user()->role;

        switch ($role) {
            case 'Administrator':
                return view('dashboard', ['role' => 'Admin']);
            case 'Agent':
                return view('dashboard', ['role' => 'Agent']);
            default:
                return view('dashboard', ['role' => 'User']);
        }
    }

//    public function adminDashboard()
//    {
//        return view('admin.dashboard');
//    }
//
//    public function agentDashboard()
//    {
//        return view('agent.dashboard');
//    }
//
//    public function userDashboard()
//    {
//        return view('user.dashboard');
//    }
}
