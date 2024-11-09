<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Research;
use App\Models\Video;
use App\Models\Article;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class MembersOnlyController extends Controller
{
     // Dashboard view
     public function index()
     {
         // Fetch the latest members_only entries from each table
         $latestBook = Book::where('visibility', 'members_only')->latest()->first();
         $latestVideo = Video::where('visibility', 'members_only')->latest()->first();
         $latestResearch = Research::where('visibility', 'members_only')->latest()->first();
         $latestArticle = Article::where('visibility', 'members_only')->latest()->first();

         return view('members-only', compact('latestBook', 'latestVideo', 'latestResearch', 'latestArticle'));
     }
}