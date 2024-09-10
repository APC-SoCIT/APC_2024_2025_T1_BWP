<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MembersOnlyController extends Controller
{
    public function index()
    {
        return view('members-only'); // This view will display content for members
    }
}
