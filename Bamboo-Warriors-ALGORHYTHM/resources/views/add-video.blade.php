@extends('layouts.dashboard-layout')

@section('content')
<link href="{{ asset('css/add-video.css') }}" rel="stylesheet">
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
                    <div class="card border-0">
                        <div class="card-header">
                            <h5 class="card-title">Add Video</h5>
                            <p class="text-muted">Please fill in all fields in the form.</p>
                        </div>
                        <div class="card-body container-fluid" id="video-card-body">
                        @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <form action="{{ route('upload-video') }}" method="POST" enctype="multipart/form-data" id="add-video-form">
                                @csrf
                                <!-- Title -->
                                <div class="form-group">
                                    <label for="title" class="form-label">Title</label>
                                    <input type="text" class="form-control" id="title" name="title" required>
                                </div>

                                <!-- Creator -->
                                <div class="form-group">
                                    <label for="creator" class="form-label">Creator</label>
                                    <input type="text" class="form-control" id="creator" name="creator" required>
                                </div>

                                <!-- Publish Date -->
                                <div class="form-group">
                                    <label for="publication_date" class="form-label">Publish Date</label>
                                    <input type="date" class="form-control" id="publication_date" name="publication_date" required>
                                </div>

                                <!-- Description -->
                                <div class="form-group">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                                </div>

                                <!-- File Upload -->
                                <div class="form-group">
                                    <label for="file_path" class="form-label">File</label>
                                    <input type="file" class="form-control" id="file_path" name="file_path" accept="video/*" required>
                                </div>

                                <!-- Thumbnail -->
                                <div class="form-group">
                                    <label for="file" class="form-label">Thumbnail</label>
                                    <input type="file" class="form-control" id="cover_image" name="cover_image" accept=".jpeg,.png,.jpg,.gif,.svg" required>
                                </div>

                                <!-- Visibility -->
                                <div class="form-group">
                                    <label for="visibility" class="form-label">Visibility</label>
                                    <select class="form-control" id="visibility" name="visibility" required>
                                        <option value="" disabled selected>Select visibility</option>
                                        <option value="public">Public</option>
                                        <option value="members_only">Members Only</option>
                                    </select>
                                </div>

                                <!-- Submit Button -->
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
            <script src="{{ asset('js/dashboard.js') }}"></script>
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row text-muted">
                        <div class="col-6 text-start">
                            <p class="mb-0"><strong>Bamboo Online Catalog</strong></p>
                        </div>
                        <div class="col-6 text-end">
                            <ul class="list-inline">
                                <li class="list-inline-item"><a href="#" class="text-muted">Contact</a></li>
                                <li class="list-inline-item"><a href="#" class="text-muted">About Us</a></li>
                                <li class="list-inline-item"><a href="#" class="text-muted">Terms</a></li>
                                <li class="list-inline-item"><a href="#" class="text-muted">Booking</a></li>
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