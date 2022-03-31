<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\User;
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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function adminHome(){
        //new users this month
        $newUsers = User::whereMonth('created_at', '=', date('m'))->count();
        //total reports
        $totalReports = Report::whereMonth('created_at', '=', date('m'))->count();
        return view('admin.home', compact('newUsers', 'totalReports'));
    }
}
