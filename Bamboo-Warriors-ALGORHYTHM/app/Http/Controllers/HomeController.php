<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Donor;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    public function index(){
        //$projects = Project::all();
        //$donors = Donor::orderBy('amount', 'desc')->get();
        //return view('index', ['projects' => $projects], ['donors' => $donors]);
        return view('login');
    }

    public function store(Request $request)
{
    $validator = Validator::make($request->all(), [
        'name' => 'required',
        'amount' => 'required|numeric', // Assuming 'amount' is numeric, adjust as needed
    ]);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    Donor::create([
        'name' => $request->input('name'),
        'amount' => $request->input('amount')
    ]);

    return redirect("https://donate.stripe.com/test_9AQ4jV6Hc9SFasgfYY");
}

}