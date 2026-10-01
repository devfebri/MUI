<?php

namespace App\Http\Controllers;

class DashboardController extends Controller
{
    public function index()
    {
        if (auth()->user()->role === 'admin') {
            return view('admin.dashboard');
        } elseif (auth()->user()->role === 'operator') {
            return view('operator.dashboard');
        }
    }
}
