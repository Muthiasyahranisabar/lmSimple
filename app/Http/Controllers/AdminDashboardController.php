<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $authorCount = User::where('role', 'author')->count();
        $authors = User::where('role', 'author')->get();

    return view('admin.dashboard', compact('authorCount', 'authors'));
    }
}
