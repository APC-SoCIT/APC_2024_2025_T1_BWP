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
        // Display only books created by the authenticated user
        $books = Book::where('user_id', auth()->id())->get();
        return view('book', ['books' => $books]);
    }

    public function addBook()
    {
        return view('add-book');
    }

    public function editBook($id)
    {
        // Fetch book if it belongs to the authenticated user
        $book = Book::where('id', $id)->where('user_id', auth()->id())->first();

        if (!$book) {
            return redirect()->route('book')->with('error', 'Book not found or access denied.');
        }

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
            'isbn' => 'required|string|max:13|unique:books,isbn', // Validate ISBN as required
            'file' => 'required|file|mimes:pdf,doc,docx,epub|max:2048',
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
        $book->isbn = $request->input('isbn'); // Set ISBN
        $book->user_id = auth()->id(); // Set the user ID of the currently authenticated user

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = $file->hashName();
            $path = $file->storeAs('public/files/books', $filename);
            $book->file = $path;
        }

        $book->save();

        return redirect()->route('book')->with('success', 'Book added successfully!');
    }

    public function updateBook(Request $request, $id)
    {
        // Fetch book if it belongs to the authenticated user
        $book = Book::where('id', $id)->where('user_id', auth()->id())->first();

        if (!$book) {
            return redirect()->route('book')->with('error', 'Book not found or access denied.');
        }

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'description' => 'required|string',
            'rating' => 'required|integer|between:1,5',
            'publish_date' => 'required|date',
            'isbn' => 'required|string|max:13|unique:books,isbn,' . $id, // Validate ISBN as required and unique except for the current book
            'file' => 'nullable|file|mimes:pdf,doc,docx,epub|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->route('edit-book', $id)->withErrors($validator)->withInput();
        }

        $book->title = $request->input('title');
        $book->author = $request->input('author');
        $book->description = $request->input('description');
        $book->rating = $request->input('rating');
        $book->publish_date = $request->input('publish_date');
        $book->isbn = $request->input('isbn'); // Update ISBN

        if ($request->hasFile('file')) {
            if ($book->file && Storage::exists($book->file)) {
                Storage::delete($book->file);
            }

            $file = $request->file('file');
            $filename = $file->hashName();
            $path = $file->storeAs('public/files/books', $filename);
            $book->file = $path;
        }

        $book->save();

        return redirect()->route('book')->with('success', 'Book updated successfully!');
    }

    public function deleteBook($id)
    {
        // Fetch book if it belongs to the authenticated user
        $book = Book::where('id', $id)->where('user_id', auth()->id())->first();

        if (!$book) {
            return redirect()->route('book')->with('error', 'Book not found or access denied.');
        }

        if ($book->file && Storage::exists($book->file)) {
            Storage::delete($book->file);
        }

        $book->delete();

        return redirect()->route('book')->with('success', 'Book deleted successfully!');
    }

    // Research views and actions
    public function research()
    {
        // Display only researches created by the authenticated user
        $researches = Research::where('user_id', auth()->id())->get();
        return view('research', ['researches' => $researches]);
    }

    public function addResearch()
    {
        return view('add-research');
    }

    public function editResearch($id)
    {
        // Fetch research if it belongs to the authenticated user
        $research = Research::where('id', $id)->where('user_id', auth()->id())->first();

        if (!$research) {
            return redirect()->route('research')->with('error', 'Research not found or access denied.');
        }

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
        $research->user_id = auth()->id(); // Set the user ID of the currently authenticated user

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = $file->hashName();
            $path = $file->storeAs('public/files/researches', $filename);
            $research->file_path = $path;
        }

        $research->save();

        return redirect()->route('research')->with('success', 'Research added successfully!');
    }

    public function updateResearch(Request $request, $id)
    {
        // Fetch research if it belongs to the authenticated user
        $research = Research::where('id', $id)->where('user_id', auth()->id())->first();

        if (!$research) {
            return redirect()->route('research')->with('error', 'Research not found or access denied.');
        }

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
            $path = $file->storeAs('public/files/researches', $filename);
            $research->file_path = $path;
        }

        $research->save();

        return redirect()->route('research')->with('success', 'Research updated successfully!');
    }

    public function deleteResearch($id)
    {
        // Fetch research if it belongs to the authenticated user
        $research = Research::where('id', $id)->where('user_id', auth()->id())->first();

        if (!$research) {
            return redirect()->route('research')->with('error', 'Research not found or access denied.');
        }

        if ($research->file_path && Storage::exists($research->file_path)) {
            Storage::delete($research->file_path);
        }

        $research->delete();

        return redirect()->route('research')->with('success', 'Research deleted successfully!');
    }

    // Video views and actions
    public function video()
    {
        // Display only videos created by the authenticated user
        $videos = Video::where('user_id', auth()->id())->get();
        return view('video', ['videos' => $videos]);
    }

    public function addVideo()
    {
        return view('add-video');
    }

    public function editVideo($id)
    {
        // Fetch video if it belongs to the authenticated user
        $video = Video::where('id', $id)->where('user_id', auth()->id())->first();

        if (!$video) {
            return redirect()->route('video')->with('error', 'Video not found or access denied.');
        }

        return view('update-video', compact('video'));
    }

    public function uploadVideo(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'video_file' => 'required|file|mimes:mp4,mkv,avi|max:20480',
        ]);

        if ($validator->fails()) {
            return redirect()->route('add-video')->withErrors($validator)->withInput();
        }

        $video = new Video();
        $video->title = $request->input('title');
        $video->description = $request->input('description');
        $video->user_id = auth()->id(); // Set the user ID of the currently authenticated user

        if ($request->hasFile('video_file')) {
            $file = $request->file('video_file');
            $filename = $file->hashName();
            $path = $file->storeAs('public/files/videos', $filename);
            $video->video_file = $path;
        }

        $video->save();

        return redirect()->route('video')->with('success', 'Video added successfully!');
    }

    public function updateVideo(Request $request, $id)
    {
        // Fetch video if it belongs to the authenticated user
        $video = Video::where('id', $id)->where('user_id', auth()->id())->first();

        if (!$video) {
            return redirect()->route('video')->with('error', 'Video not found or access denied.');
        }

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'video_file' => 'nullable|file|mimes:mp4,mkv,avi|max:20480',
        ]);

        if ($validator->fails()) {
            return redirect()->route('edit-video', $id)->withErrors($validator)->withInput();
        }

        $video->title = $request->input('title');
        $video->description = $request->input('description');

        if ($request->hasFile('video_file')) {
            if ($video->video_file && Storage::exists($video->video_file)) {
                Storage::delete($video->video_file);
            }

            $file = $request->file('video_file');
            $filename = $file->hashName();
            $path = $file->storeAs('public/files/videos', $filename);
            $video->video_file = $path;
        }

        $video->save();

        return redirect()->route('video')->with('success', 'Video updated successfully!');
    }

    public function deleteVideo($id)
    {
        // Fetch video if it belongs to the authenticated user
        $video = Video::where('id', $id)->where('user_id', auth()->id())->first();

        if (!$video) {
            return redirect()->route('video')->with('error', 'Video not found or access denied.');
        }

        if ($video->video_file && Storage::exists($video->video_file)) {
            Storage::delete($video->video_file);
        }

        $video->delete();

        return redirect()->route('video')->with('success', 'Video deleted successfully!');
    }

    // Article views and actions
    public function article()
    {
        // Display only articles created by the authenticated user
        $articles = Article::where('user_id', auth()->id())->get();
        return view('article', ['articles' => $articles]);
    }

    public function addArticle()
    {
        return view('add-article');
    }

    public function editArticle($id)
    {
        // Fetch article if it belongs to the authenticated user
        $article = Article::where('id', $id)->where('user_id', auth()->id())->first();

        if (!$article) {
            return redirect()->route('article')->with('error', 'Article not found or access denied.');
        }

        return view('update-article', compact('article'));
    }

    public function uploadArticle(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'file' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->route('add-article')->withErrors($validator)->withInput();
        }

        $article = new Article();
        $article->title = $request->input('title');
        $article->content = $request->input('content');
        $article->user_id = auth()->id(); // Set the user ID of the currently authenticated user

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = $file->hashName();
            $path = $file->storeAs('public/files/articles', $filename);
            $article->file_path = $path;
        }

        $article->save();

        return redirect()->route('article')->with('success', 'Article added successfully!');
    }

    public function updateArticle(Request $request, $id)
    {
        // Fetch article if it belongs to the authenticated user
        $article = Article::where('id', $id)->where('user_id', auth()->id())->first();

        if (!$article) {
            return redirect()->route('article')->with('error', 'Article not found or access denied.');
        }

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'file' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->route('edit-article', $id)->withErrors($validator)->withInput();
        }

        $article->title = $request->input('title');
        $article->content = $request->input('content');

        if ($request->hasFile('file')) {
            if ($article->file_path && Storage::exists($article->file_path)) {
                Storage::delete($article->file_path);
            }

            $file = $request->file('file');
            $filename = $file->hashName();
            $path = $file->storeAs('public/files/articles', $filename);
            $article->file_path = $path;
        }

        $article->save();

        return redirect()->route('article')->with('success', 'Article updated successfully!');
    }

    public function deleteArticle($id)
    {
        // Fetch article if it belongs to the authenticated user
        $article = Article::where('id', $id)->where('user_id', auth()->id())->first();

        if (!$article) {
            return redirect()->route('article')->with('error', 'Article not found or access denied.');
        }

        if ($article->file_path && Storage::exists($article->file_path)) {
            Storage::delete($article->file_path);
        }

        $article->delete();

        return redirect()->route('article')->with('success', 'Article deleted successfully!');
    }
}
