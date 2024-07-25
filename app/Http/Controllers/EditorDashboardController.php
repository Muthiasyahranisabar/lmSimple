<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class EditorDashboardController extends Controller
{
    // Di TugasController atau controller dashboard yang sesuai
    public function index()
    {
        $adminCount = User::where('role', 'admin')->count();
        $authorCount = User::where('role', 'author')->count();
        $admins = User::where('role', 'admin')->get();
        $authors = User::where('role', 'author')->get();

        return view('editor.dashboard', compact('adminCount', 'authorCount', 'admins', 'authors'));
    }

}
