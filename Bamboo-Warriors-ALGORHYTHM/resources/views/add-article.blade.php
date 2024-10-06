@extends('layouts.dashboard-layout')

@section('content')
<link href="{{ asset('css/add-article.css') }}" rel="stylesheet">
<body>
    <div class="wrapper">
        <div class="wrapper">
            <aside id="sidebar" class="js-sidebar">
                <div class="h-100">
                    <div class="sidebar-logo">
                        <a href="#">Online Bamboo Catalog</a>
                    </div>
                    <ul class="sidebar-nav">
                        <li class="sidebar-item">
                            <a href="{{ route('dashboard') }}" class="sidebar-link">
                                <i class="fa-solid fa-list pe-2"></i>
                                Dashboard
                            </a>
                        </li>

                        <li class="sidebar-item">
                            <a href="#" class="sidebar-link collapsed" data-bs-toggle="collapse" data-bs-target="#catalogueDropdown" aria-expanded="false">
                                <i class="fa-solid fa-book pe-2"></i>
                                Catalogue
                            </a>
                            <ul id="catalogueDropdown" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                                <li class="sidebar-item">
                                    <a href="{{ route('catalogue.books') }}" class="sidebar-link">
                                        <i class="fa-solid fa-book-open pe-2"></i>
                                        Books
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="{{ route('catalogue.videos') }}" class="sidebar-link">
                                        <i class="fa-solid fa-video pe-2"></i>
                                        Videos
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="{{ route('catalogue.research') }}" class="sidebar-link">
                                        <i class="fa-solid fa-file-alt pe-2"></i>
                                        Research Papers
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="{{ route('catalogue.articles') }}" class="sidebar-link">
                                        <i class="fa-solid fa-newspaper pe-2"></i>
                                        Articles
                                    </a>
                                </li>
                            </ul>
                        </li>

                        @auth
                            <li class="sidebar-item">
                                <a href="{{ route('members-only') }}" class="sidebar-link">
                                    <i class="fa-solid fa-lock pe-2"></i>
                                    Members Only
                                </a>
                            </li>

                            @if(auth()->user()->account_type === 'admin')
                                <li class="sidebar-item">
                                    <a href="#" class="sidebar-link collapsed" data-bs-toggle="collapse" data-bs-target="#adminDropdown" aria-expanded="false">
                                        <i class="fa-solid fa-cog pe-2"></i>
                                        Admin Tools
                                    </a>
                                    <ul id="adminDropdown" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                                        <li class="sidebar-item">
                                            <a href="{{ route('book') }}" class="sidebar-link">Your Book List</a>
                                        </li>
                                        <li class="sidebar-item">
                                            <a href="{{ route('add-book') }}" class="sidebar-link">Add Book</a>
                                        </li>
                                        <li class="sidebar-item">
                                            <a href="{{ route('research') }}" class="sidebar-link">Your Research Paper List</a>
                                        </li>
                                        <li class="sidebar-item">
                                            <a href="{{ route('add-research') }}" class="sidebar-link">Add Research Paper</a>
                                        </li>
                                        <li class="sidebar-item">
                                            <a href="{{ route('video') }}" class="sidebar-link">Your Video List</a>
                                        </li>
                                        <li class="sidebar-item">
                                            <a href="{{ route('add-video') }}" class="sidebar-link">Add Video</a>
                                        </li>
                                        <li class="sidebar-item">
                                            <a href="{{ route('article') }}" class="sidebar-link">Your Article List</a>
                                        </li>
                                        <li class="sidebar-item">
                                            <a href="{{ route('add-article') }}" class="sidebar-link">Add Article</a>
                                        </li>
                                    </ul>
                                </li>
                            @endif
                        @else
                            <li class="sidebar-item">
                                <a href="#" class="sidebar-link" data-bs-toggle="modal" data-bs-target="#guestModal">
                                    <i class="fa-solid fa-lock pe-2"></i>
                                    Members Only
                                </a>
                            </li>
                        @endauth
                    </ul>

                    <!-- AI Chatbox Placeholder -->
                    <div class="ai-chatbox p-3">
                        <h6 class="text-muted">AI Chatbox</h6>
                        <div class="chatbox">
                            <!-- Your chatbox implementation here -->
                            <input type="text" class="form-control" placeholder="Ask me anything...">
                        </div>
                    </div>
                </div>
            </aside>

            <div class="main">
                <nav class="navbar navbar-expand px-3 border-bottom">
                    <button class="btn" id="sidebar-toggle" type="button">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="navbar-collapse navbar">
                        <ul class="navbar-nav">
                            <li class="nav-item dropdown">
                                @auth
                                    <a href="#" data-bs-toggle="dropdown" class="flex-fill pe-md-0" id="user-link">
                                        <h6 class="text-muted"><b>{{ ucfirst(auth()->user()->username) }}</b></h6>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a href="{{ route('logout') }}" class="dropdown-item">Logout</a>
                                    </div>
                                @else
                                    <a href="{{ route('login') }}" class="flex-fill pe-md-0">
                                        <h6 class="text-muted"><b>Login</b></h6>
                                    </a>
                                @endauth
                            </li>
                        </ul>
                    </div>
                </nav>
            <main class="content px-3 py-2">
                <div class="container-fluid">
                    <div class="card border-0">
                        <div class="card-header">
                            <h5 class="card-title">
                                Add Article
                                <h6><p class="text-muted">Please fill in all input on the forms.</p></h6>
                            </h5>
                        </div>
                        <div class="card-body container-fluid" id="article-card-body">
                            @if(session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif
                            @if(session('error'))
                                <div class="alert alert-danger">{{ session('error') }}</div>
                            @endif
                            <form id="add-article" enctype="multipart/form-data" method="POST" action="{{ route('upload-article') }}">
                                @csrf
                                <div class="mb-3">
                                    <label for="title" class="form-label">Title</label>
                                    <input type="text" class="form-control" id="title" name="title" required>
                                    @if($errors->has('title'))
                                        <div class="text-danger">{{ $errors->first('title') }}</div>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label for="author" class="form-label">Author</label>
                                    <input type="text" class="form-control" id="author" name="author" required>
                                    @if($errors->has('author'))
                                        <div class="text-danger">{{ $errors->first('author') }}</div>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label for="publication_date" class="form-label">Publication Date</label>
                                    <input type="date" class="form-control" id="publication_date" name="publication_date" required>
                                    @if($errors->has('publication_date'))
                                        <div class="text-danger">{{ $errors->first('publication_date') }}</div>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label for="abstract" class="form-label">Abstract</label>
                                    <textarea class="form-control" id="abstract" name="abstract" rows="3" required></textarea>
                                    @if($errors->has('abstract'))
                                        <div class="text-danger">{{ $errors->first('abstract') }}</div>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label for="keywords" class="form-label">Keywords</label>
                                    <input type="text" class="form-control" id="keywords" name="keywords" required>
                                    @if($errors->has('keywords'))
                                        <div class="text-danger">{{ $errors->first('keywords') }}</div>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label for="file" class="form-label">Article File</label>
                                    <input type="file" class="form-control" id="file" name="article_file" accept=".pdf,.doc,.docx" required>
                                    @if($errors->has('article_file'))
                                        <div class="text-danger">{{ $errors->first('article_file') }}</div>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label for="visibility" class="form-label">Visibility</label>
                                    <select class="form-select" id="visibility" name="visibility" required>
                                        <option value="" disabled selected>Select visibility</option>
                                        <option value="public">Public</option>
                                        <option value="members_only">Members Only</option>
                                    </select>
                                    @if($errors->has('visibility'))
                                        <div class="text-danger">{{ $errors->first('visibility') }}</div>
                                    @endif
                                </div>
                                <button type="submit" class="btn btn-success">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </main>
            <a href="#" class="theme-toggle">
                <i class="fa-regular fa-moon"></i>
                <i class="fa-regular fa-sun"></i>
            </a>
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row text-muted">
                        <div class="col-6 text-start">
                            <p class="mb-0">
                                <a href="#" class="text-muted">
                                    <strong>Bamboo Online Catalog</strong>
                                </a>
                            </p>
                        </div>
                        <div class="col-6 text-end">
                            <ul class="list-inline">
                                <li class="list-inline-item">
                                    <a href="#" class="text-muted">Contact</a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="#" class="text-muted">About Us</a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="#" class="text-muted">Terms</a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="#" class="text-muted">Booking</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/dashboard.js') }}"></script>
    <script src="{{ asset('js/status.js') }}"></script>
</body>
@endsection
