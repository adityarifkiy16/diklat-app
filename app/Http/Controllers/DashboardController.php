<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __invoke()
    {
        return view('dashboard', [
            'title' => 'Dashboard',
            'head' => 'Home',
            'headUrl' => route('dashboard'),
            'body' => 'Dashboard Overview'
        ]);
    }
}
