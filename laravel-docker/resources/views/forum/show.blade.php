@extends('layouts.dashboard-layout')

@section('content')
<body>
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
                        <a href="{{ route('forum.index') }}" class="sidebar-link">
                            <i class="fa fa-forumbee"></i>
                            Forum
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
                                <a href="#" class="nav-link dropdown-toggle d-flex align-items-center pe-md-0" id="user-link" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa-solid fa-user-circle pe-2"></i>
                                    <span class="text-muted"><b>{{ ucfirst(auth()->user()->username) }}</b></span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="user-link">
                                    <a href="{{ route('user.profile') }}" class="dropdown-item">
                                        <i class="fa-solid fa-user pe-2"></i>
                                        User Profile
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a href="{{ route('logout') }}" class="dropdown-item text-danger">
                                        <i class="fa-solid fa-right-from-bracket pe-2"></i>
                                        Logout
                                    </a>
                                </div>
                            @else
                                <a href="{{ route('login') }}" class="nav-link">
                                    <h6 class="text-muted"><b>Login</b></h6>
                                </a>
                            @endauth
                        </li>
                    </ul>

                </div>
            </nav>

            <main class="content px-3 py-4">
                <div class="container-fluid">
                    <!-- Forum Post -->
                    <div class="post-container p-4 mb-4 border rounded">
                        <h1 class="post-title">{{ $post->title }}</h1>
                        <p class="post-meta text-muted">Posted by: <strong>{{ $post->user->username }}</strong></p>
                        <div class="post-content mb-3">
                            <p>{{ $post->content }}</p>
                        </div>
                    </div>

                    <!-- Replies Section -->
                    <div class="replies-container mb-4">
                        <h3 class="mb-3">Comments:</h3>
                        @forelse($post->replies as $reply)
                            <div class="reply p-3 mb-2 border rounded">
                                <p class="reply-user text-muted">
                                    <strong>{{ $reply->user->username }}</strong>
                                </p>
                                <div class="reply-content">
                                    <p>{{ $reply->content }}</p>
                                </div>
                            </div>
                        @empty
                            <p class="text-muted">No comments yet. Be the first to respond!</p>
                        @endforelse
                    </div>

                    <!-- Add a Reply Form -->
                    <div class="reply-form p-4 border rounded">
                        <h3 class="mb-3">Add a Comment:</h3>
                        <form action="{{ route('forum.reply', $post->id) }}" method="POST">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="content">Comments:</label>
                                <textarea name="content" id="content" class="form-control" rows="4" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit Comment</button>
                        </form>
                    </div>
                </div>
            </main>




            <a href="#" class="theme-toggle">
                <i class="fa-regular fa-moon"></i>
                <i class="fa-regular fa-sun"></i>
            </a>
            <script src="{{ asset('js/dashboard.js') }}"></script>
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
<!-- AI Chat Floating Icon -->
<div id="chat-icon" class="floating-chat-icon">
                <i class="fa-solid fa-comments"></i>
            </div>

            <!-- AI Chatbox (initially hidden) -->
            <div id="chatbox" class="chatbox">
                <div class="chatbox-header">
                    <span>AI Chat</span>
                    <button id="close-chatbox" class="btn-close">×</button>
                </div>
                <div class="chatbox-body">
                    <input type="text" class="form-control" placeholder="Ask me anything...">
                </div>
            </div>
    <!-- JavaScript to open/close chatbox -->
    <script>
        document.getElementById('chat-icon').addEventListener('click', function() {
            document.getElementById('chatbox').style.display = 'block';
        });

        document.getElementById('close-chatbox').addEventListener('click', function() {
            document.getElementById('chatbox').style.display = 'none';
        });

    </script>
</body>
@endsection
@push('script')
    <script src="{{ asset('js/dashboard.js') }}"></script>
@endpush