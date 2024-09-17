<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Research;
use App\Models\Video;
use App\Models\Article;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    // Dashboard view
    public function dashboard()
    {
        return view('dashboard');
    }

    // Book views and actions
    public function book()
    {
        $books = Book::all();
        return view('book', ['books' => $books]);
    }

    public function addBook()
    {
        return view('add-book');
    }

    public function editBook($id)
    {
        $book = Book::find($id);
        return view('update-book', compact('book'));
    }

    public function uploadBook(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'description' => 'required|string',
            'rating' => 'required|integer|between:1,5',
            'publish_date' => 'required|date',
            'file' => 'required|file|mimes:pdf,doc,docx,epub|max:102400',
        ]);

        if ($validator->fails()) {
            return redirect()->route('add-book')->withErrors($validator)->withInput();
        }

        $book = new Book();
        $book->title = $request->input('title');
        $book->author = $request->input('author');
        $book->description = $request->input('description');
        $book->rating = $request->input('rating');
        $book->publish_date = $request->input('publish_date');

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = $file->hashName();
            $path = $file->storeAs('files/books', $filename, 'public'); // Corrected path
            $book->file = $path;
        }

        $book->save();

        return redirect()->route('book')->with('success', 'Book added successfully!');
    }

    public function updateBook(Request $request, $id)
    {
        $book = Book::find($id);

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'description' => 'required|string',
            'rating' => 'required|integer|between:1,5',
            'publish_date' => 'required|date',
            'file' => 'nullable|file|mimes:pdf,doc,docx,epub|max:102400',
        ]);

        if ($validator->fails()) {
            return redirect()->route('edit-book', $id)->withErrors($validator)->withInput();
        }

        $book->title = $request->input('title');
        $book->author = $request->input('author');
        $book->description = $request->input('description');
        $book->rating = $request->input('rating');
        $book->publish_date = $request->input('publish_date');

        if ($request->hasFile('file')) {
            // Delete old file if exists
            if ($book->file && Storage::exists($book->file)) {
                Storage::delete($book->file);
            }

            $file = $request->file('file');
            $filename = $file->hashName();
            $path = $file->storeAs('files/books', $filename, 'public'); // Corrected path
            $book->file = $path;
        }

        $book->save();

        return redirect()->route('book')->with('success', 'Book updated successfully!');
    }

    // Research views and actions
    public function research()
    {
        $researches = Research::all();
        return view('research', ['researches' => $researches]);
    }

    public function addResearch()
    {
        return view('add-research');
    }

    public function editResearch($id)
    {
        $research = Research::find($id);
        return view('update-research', compact('research'));
    }

    public function uploadResearch(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'file' => 'required|file|mimes:pdf,doc,docx|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->route('add-research')->withErrors($validator)->withInput();
        }

        $research = new Research();
        $research->title = $request->input('title');
        $research->description = $request->input('description');

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = $file->hashName();
            $path = $file->storeAs('public/files/researches', $filename); // Corrected path
            $research->file_path = $path;
        }

        $research->save();

        return redirect()->route('research')->with('success', 'Research added successfully!');
    }

    public function updateResearch(Request $request, $id)
    {
        $research = Research::find($id);

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'file' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->route('edit-research', $id)->withErrors($validator)->withInput();
        }

        $research->title = $request->input('title');
        $research->description = $request->input('description');

        if ($request->hasFile('file')) {
            if (Storage::exists($research->file_path)) {
                Storage::delete($research->file_path);
            }

            $file = $request->file('file');
            $filename = $file->hashName();
            $path = $file->storeAs('public/files/researches', $filename); // Corrected path
            $research->file_path = $path;
        }

        $research->save();

        return redirect()->route('research')->with('success', 'Research updated successfully!');
    }

    // Video views and actions
    public function video()
    {
        $videos = Video::all();
        return view('video', ['videos' => $videos]);
    }

    public function addVideo()
    {
        return view('add-video');
    }

    public function editVideo($id)
    {
        $video = Video::find($id);
        return view('update-video', compact('video'));
    }

    public function uploadVideo(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'file' => 'required|file|mimes:mp4,mov,avi|max:10240',
        ]);

        if ($validator->fails()) {
            return redirect()->route('add-video')->withErrors($validator)->withInput();
        }

        $video = new Video();
        $video->title = $request->input('title');
        $video->description = $request->input('description');

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = $file->hashName();
            $path = $file->storeAs('public/videos', $filename); // Corrected path
            $video->file_path = $path;
        }

        $video->save();

        return redirect()->route('video')->with('success', 'Video added successfully!');
    }

    public function updateVideo(Request $request, $id)
    {
        $video = Video::find($id);

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'file' => 'nullable|file|mimes:mp4,mov,avi|max:10240',
        ]);

        if ($validator->fails()) {
            return redirect()->route('edit-video', $id)->withErrors($validator)->withInput();
        }

        $video->title = $request->input('title');
        $video->description = $request->input('description');

        if ($request->hasFile('file')) {
            if (Storage::exists($video->file_path)) {
                Storage::delete($video->file_path);
            }

            $file = $request->file('file');
            $filename = $file->hashName();
            $path = $file->storeAs('public/videos', $filename); // Corrected path
            $video->file_path = $path;
        }

        $video->save();

        return redirect()->route('video')->with('success', 'Video updated successfully!');
    }

    // Article views and actions
    public function article()
    {
        $articles = Article::all();
        return view('article', ['articles' => $articles]);
    }

    public function addArticle()
    {
        return view('add-article');
    }

    public function editArticle($id)
    {
        $article = Article::find($id);
        return view('update-article', compact('article'));
    }

    public function uploadArticle(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'content' => 'required|string',
            'file' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->route('add-article')->withErrors($validator)->withInput();
        }

        $article = new Article();
        $article->title = $request->input('title');
        $article->author = $request->input('author');
        $article->content = $request->input('content');

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = $file->hashName();
            $path = $file->storeAs('public/files/articles', $filename); // Corrected path
            $article->file_path = $path;
        }

        $article->save();

        return redirect()->route('article')->with('success', 'Article added successfully!');
    }

    public function updateArticle(Request $request, $id)
    {
        $article = Article::find($id);

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'content' => 'required|string',
            'file' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->route('edit-article', $id)->withErrors($validator)->withInput();
        }

        $article->title = $request->input('title');
        $article->author = $request->input('author');
        $article->content = $request->input('content');

        if ($request->hasFile('file')) {
            if (Storage::exists($article->file_path)) {
                Storage::delete($article->file_path);
            }

            $file = $request->file('file');
            $filename = $file->hashName();
            $path = $file->storeAs('public/files/articles', $filename); // Corrected path
            $article->file_path = $path;
        }

        $article->save();

        return redirect()->route('article')->with('success', 'Article updated successfully!');
    }
}
