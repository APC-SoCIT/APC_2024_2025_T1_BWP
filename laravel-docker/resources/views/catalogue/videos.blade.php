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
            <main class="content px-3 py-2">
                <div class="container-fluid">
                    <h4 class="mb-4">Videos Catalogue</h4>
                    <div class="row">
                        @forelse ($videos as $video)
                        <div class="col-md-4 mb-4">
                            <div class="card border-0 shadow h-100">
                                <div class="card-header text-center">
                                    <h5 class="card-title">{{ $video->title }}</h5>
                                    @if ($video->is_members_only)
                                        <span class="badge bg-warning text-dark">Members Only</span>
                                    @endif
                                </div>
                                <div class="card-body d-flex flex-column">
                                    <h6 class="card-subtitle mb-3 text-muted">Creator: {{ $video->creator }}</h6>
                                    <p class="card-text"><strong>Description:</strong> {{ Str::limit($video->description, 100) }}</p>
                                    <p class="card-text"><small class="text-muted">Published Date: {{ $video->publication_date }}</small></p>
                                    <div class="mt-auto">
                                        <a href="{{ Storage::url($video->file) }}" class="btn btn-primary btn-block" target="_blank" rel="noopener noreferrer">Open Video</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="col-12">
                            <div class="alert alert-warning text-center">No videos available.</div>
                        </div>
                        @endforelse
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

    <script src="{{ asset('js/dashboard.js') }}"></script>

    <!-- Modal for guests -->
    <div class="modal fade" id="guestModal" tabindex="-1" aria-labelledby="guestModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="guestModalLabel">Members Only Section</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>You must log in to access the Members Only content.</p>
                </div>
                <div class="modal-footer">
                    <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</body>
@endsection