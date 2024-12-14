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
     * @return \Illuminate\Http\RedirectResponse
     */
    public function index()
    {
        $role = auth()->user()->role;

        if ($role === 'Administrator') {
            return redirect()->route('admin.dashboard');
        } elseif ($role === 'Agent') {
            return redirect()->route('agent.dashboard');
        } else {
            return redirect()->route('user.dashboard');
        }
    }

    public function adminDashboard()
    {
        return view('admin.dashboard');
    }

    public function agentDashboard()
    {
        return view('agent.dashboard');
    }

    public function userDashboard()
    {
        return view('user.dashboard');
    }
}
