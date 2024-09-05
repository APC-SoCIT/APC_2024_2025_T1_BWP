<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Research;
use App\Models\Video;
use App\Models\Article;
use Illuminate\Support\Facades\Storage;

class dashboardController extends Controller
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
            'cover_photo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
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

        if ($request->hasFile('cover_photo')) {
            $file = $request->file('cover_photo');
            $filename = $file->hashName();
            $path = $file->storeAs('public/images/uploaded_books', $filename);
            $book->cover_photo = $path;
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
            'cover_photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->route('edit-book', $id)->withErrors($validator)->withInput();
        }

        $book->title = $request->input('title');
        $book->author = $request->input('author');
        $book->description = $request->input('description');
        $book->rating = $request->input('rating');
        $book->publish_date = $request->input('publish_date');

        if ($request->hasFile('cover_photo')) {
            if (Storage::exists($book->cover_photo)) {
                Storage::delete($book->cover_photo);
            }

            $file = $request->file('cover_photo');
            $filename = $file->hashName();
            $path = $file->storeAs('public/images/uploaded_books', $filename);
            $book->cover_photo = $path;
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
            // Add validators for research forms
        ]);

        if ($validator->fails()) {
            return redirect()->route('add-research')->withErrors($validator)->withInput();
        }

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = $file->hashName();
            $path = $file->storeAs('public/images/uploaded_researches', $filename);

            $research = new Research();
            $research->path = $path;
            // Add input for research forms
            $research->save();

            return redirect()->route('research')->with('success', 'Research added successfully!');
        }
        return redirect()->route('add-research')->with('error', 'Failed to upload research.');
    }

    public function updateResearch(Request $request, $id)
    {
        $research = Research::find($id);

        $validator = Validator::make($request->all(), [
            // Add validators for research forms
        ]);

        if ($validator->fails()) {
            return redirect()->route('edit-research', $id)->withErrors($validator)->withInput();
        }

        if ($request->hasFile('file')) {
            if (Storage::exists($research->path)) {
                Storage::delete($research->path);
            }

            $file = $request->file('file');
            $filename = $file->hashName();
            $path = $file->storeAs('public/images/uploaded_researches', $filename);

            $research->path = $path;
            // Update research details
            $research->save();

            return redirect()->route('research')->with('success', 'Research updated successfully!');
        }

        return redirect()->route('edit-research', $id)->with('error', 'Failed to update research.');
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
            // Add validators for video forms
        ]);

        if ($validator->fails()) {
            return redirect()->route('add-video')->withErrors($validator)->withInput();
        }

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = $file->hashName();
            $path = $file->storeAs('public/images/uploaded_videos', $filename);

            $video = new Video();
            $video->path = $path;
            // Add input for video forms
            $video->save();

            return redirect()->route('video')->with('success', 'Video added successfully!');
        }
        return redirect()->route('add-video')->with('error', 'Failed to upload video.');
    }

    public function updateVideo(Request $request, $id)
    {
        $video = Video::find($id);

        $validator = Validator::make($request->all(), [
            // Add validators for video forms
        ]);

        if ($validator->fails()) {
            return redirect()->route('edit-video', $id)->withErrors($validator)->withInput();
        }

        if ($request->hasFile('file')) {
            if (Storage::exists($video->path)) {
                Storage::delete($video->path);
            }

            $file = $request->file('file');
            $filename = $file->hashName();
            $path = $file->storeAs('public/images/uploaded_videos', $filename);

            $video->path = $path;
            // Update video details
            $video->save();

            return redirect()->route('video')->with('success', 'Video updated successfully!');
        }

        return redirect()->route('edit-video', $id)->with('error', 'Failed to update video.');
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
            // Add validators for article forms
        ]);

        if ($validator->fails()) {
            return redirect()->route('add-article')->withErrors($validator)->withInput();
        }

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = $file->hashName();
            $path = $file->storeAs('public/images/uploaded_articles', $filename);

            $article = new Article();
            $article->path = $path;
            // Add input for article forms
            $article->save();

            return redirect()->route('article')->with('success', 'Article added successfully!');
        }
        return redirect()->route('add-article')->with('error', 'Failed to upload article.');
    }

    public function updateArticle(Request $request, $id)
    {
        $article = Article::find($id);

        $validator = Validator::make($request->all(), [
            // Add validators for article forms
        ]);

        if ($validator->fails()) {
            return redirect()->route('edit-article', $id)->withErrors($validator)->withInput();
        }

        if ($request->hasFile('file')) {
            if (Storage::exists($article->path)) {
                Storage::delete($article->path);
            }

            $file = $request->file('file');
            $filename = $file->hashName();
            $path = $file->storeAs('public/images/uploaded_articles', $filename);

            $article->path = $path;
            // Update article details
            $article->save();

            return redirect()->route('article')->with('success', 'Article updated successfully!');
        }

        return redirect()->route('edit-article', $id)->with('error', 'Failed to update article.');
    }
}
