<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $role = auth()->user()->role;

        if ($role == 'sales') {
            return view('dashboard.sales');
        }

        if ($role == 'engineering') {
            return view('dashboard.engineering');
        }

        if ($role == 'finance') {
            return view('dashboard.finance');
        }

        abort(403);
    }
}