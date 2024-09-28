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

    // Catalogue: Books
    public function catalogueBooks()
    {
        // Check if the user is authenticated
        if (auth()->check()) {
            // If authenticated, fetch all books, including members_only
            $books = Book::all();
        } else {
            // If not authenticated, fetch only public books
            $books = Book::where('visibility', 'public')->get();
        }

        return view('catalogue.books', ['books' => $books]);
    }

    // Book views and actions
    public function book()
    {
        $books = Book::where('user_id', auth()->id())->get();
        return view('book', ['books' => $books]);
    }

    public function addBook()
    {
        return view('add-book');
    }

    public function uploadBook(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'description' => 'required|string',
            'rating' => 'required|integer|between:1,5|max:5',
            'publish_date' => 'required|date',
            'isbn' => 'required|string|max:13|unique:books,isbn',
            'file' => 'required|file|mimes:pdf,doc,docx,epub|max:1048576',
            'visibility' => 'required|in:public,members_only',
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
        $book->isbn = $request->input('isbn');
        $book->user_id = auth()->id();
        $book->visibility = $request->input('visibility');

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = $file->hashName();
            $path = $file->storeAs('files/books', $filename, 'public');
            $book->file = $path;
        }

        $book->save();

        return redirect()->route('book')->with('success', 'Book added successfully!');
    }

    public function deleteBook($id)
    {
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

    // Catalogue: Research Papers
    public function catalogueResearch()
    {
        // Check if the user is authenticated
        if (auth()->check()) {
            // If authenticated, fetch all research papers, including members_only
            $researchPapers = Research::all();
        } else {
            // If not authenticated, fetch only public research papers
            $researchPapers = Research::where('visibility', 'public')->get();
        }

        return view('catalogue.research', ['researchPapers' => $researchPapers]);
    }

    // Research views and actions
    public function research()
    {
        $researches = Research::where('user_id', auth()->id())->get();
        return view('research', ['researches' => $researches]);
    }

    public function addResearch()
    {
        return view('add-research');
    }

    public function uploadResearch(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'publish_date' => 'required|date',
            'doi' => 'required|string|max:255',
            'abstract' => 'required|string',
            'keywords' => 'required|string',
            'file' => 'required|file|mimes:pdf,doc,docx|max:1048576',
            'visibility' => 'required|in:public,members_only',
        ]);

        if ($validator->fails()) {
            return redirect()->route('add-research')->withErrors($validator)->withInput();
        }

        $research = new Research();
        $research->title = $request->input('title');
        $research->author = $request->input('author');
        $research->publish_date = $request->input('publish_date');
        $research->doi = $request->input('doi');
        $research->abstract = $request->input('abstract');
        $research->keywords = $request->input('keywords');
        $research->user_id = auth()->id();
        $research->visibility = $request->input('visibility');

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = $file->hashName();
            $path = $file->storeAs('files/researches', $filename, 'public');
            $research->file_path = $path;
        }

        $research->save();

        return redirect()->route('research')->with('success', 'Research added successfully!');
    }

    public function deleteResearch($id)
    {
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

    // Catalogue: Videos
    public function catalogueVideos()
    {
        // Check if the user is authenticated
        if (auth()->check()) {
            // If authenticated, fetch all videos, including members_only
            $videos = Video::all();
        } else {
            // If not authenticated, fetch only public videos
            $videos = Video::where('visibility', 'public')->get();
        }

        return view('catalogue.videos', ['videos' => $videos]);
    }

    // Video views and actions
    public function video()
    {
        $videos = Video::where('user_id', auth()->id())->get();
        return view('video', ['videos' => $videos]);
    }

    public function addVideo()
    {
        return view('add-video');
    }

    public function uploadVideo(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'title' => 'required|string|max:255',
            'creator' => 'required|string|max:255',
            'publication_date' => 'required|date',
            'description' => 'required|string',
            'file_path' => 'required|file|mimes:mp4,mov,avi,wmv|max:1048576',
            'visibility' => 'required|in:public,members_only',
        ]);
        if ($validator->fails()) {
            return redirect()->route('add-video')->withErrors($validator)->withInput();
        }
                $video = new Video();
                $video->title = $request->title;
                $video->creator = $request->creator;
                $video->publication_date = $request->publication_date;
                $video->description = $request->description;
                $video->visibility = $request->input('visibility');
                $video->user_id = auth()->id();

        if ($request->hasFile('file_path')) {
            $filePath = $request->file('file_path')->store('files/videos', 'public');
            $video->file_path = $filePath;
        
        $video->save();

            return redirect()->route('video')->with('success', 'Video uploaded successfully!');
        }

        return back()->withErrors(['file_path' => 'File upload failed.']);
    }

    public function deleteVideo($id)
    {
        $video = Video::where('id', $id)->where('user_id', auth()->id())->first();

        if (!$video) {
            return redirect()->route('video')->with('error', 'Video not found or access denied.');
        }

        if ($video->file_path && Storage::exists($video->file_path)) {
            Storage::delete($video->file_path);
        }

        $video->delete();

        return redirect()->route('video')->with('success', 'Video deleted successfully!');
    }

    // Catalogue: Articles
public function catalogueArticles()
{
    // Check if the user is authenticated
    if (auth()->check()) {
        // If authenticated, fetch all articles, including members_only
        $articles = Article::all();
    } else {
        // If not authenticated, fetch only public articles
        $articles = Article::where('visibility', 'public')->get();
    }

    return view('catalogue.articles', ['articles' => $articles]);
}
    // Article views and actions
    public function article()
    {
        $articles = Article::where('user_id', auth()->id())->get();
        return view('article', ['articles' => $articles]);
    }

    public function addArticle()
    {
        return view('add-article');
    }

    public function uploadArticle(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'publication_date' => 'required|date',
            'abstract' => 'required|string',
            'keywords' => 'required|string',
            'article_file' => 'nullable|file|mimes:pdf,doc,docx|max:1048576',
            'visibility' => 'required|in:public,members_only',
        ]);

        if ($validator->fails()) {
            return redirect()->route('add-article')->withErrors($validator)->withInput();
        }

        $article = new Article();
        $article->title = $request->input('title');
        $article->author = $request->input('author');
        $article->publication_date = $request->input('publication_date');
        $article->abstract = $request->input('abstract');
        $article->keywords = $request->input('keywords');
        $article->user_id = auth()->id();
        $article->visibility = $request->input('visibility');

        if ($request->hasFile('article_file')) {
            $file = $request->file('article_file');
            $filename = $file->hashName();
            $path = $file->storeAs('files/articles', $filename, 'public');
            $article->file_path = $path;
        }

        $article->save();

        return redirect()->route('article')->with('success', 'Article added successfully!');
    }

    public function deleteArticle($id)
    {
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
