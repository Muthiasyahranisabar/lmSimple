<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileEditorController extends Controller
{
    public function index()
    {
        return view('editor.users-profile');
    }
}
