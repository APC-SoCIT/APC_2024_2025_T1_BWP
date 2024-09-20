@extends('layouts.dashboard-layout')

@section('content')
<link href="{{ asset('css/add-video.css') }}" rel="stylesheet">

<div class="wrapper">
    <aside id="sidebar" class="js-sidebar">
        <!-- Sidebar Content -->
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
                @auth
                    <!-- Admin and Member Menu -->
                    @if(auth()->user()->account_type === 'admin' || auth()->user()->account_type === 'member')
                        <li class="sidebar-item">
                            <a href="{{ route('members-only') }}" class="sidebar-link">
                                <i class="fa-solid fa-lock pe-2"></i>
                                Members Only
                            </a>
                        </li>
                    @endif

                    @if(auth()->user()->account_type === 'admin')
                        <!-- Admin Menu -->
                        <li class="sidebar-item">
                            <a href="#" class="sidebar-link collapsed" data-bs-target="#books" data-bs-toggle="collapse" aria-expanded="false">
                                <i class="fa-solid fa-file-lines pe-2"></i> Books
                            </a>
                            <ul id="books" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                                <li class="sidebar-item">
                                    <a href="{{ route('book') }}" class="sidebar-link">Your Book List</a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="{{ route('add-book') }}" class="sidebar-link">Add Book</a>
                                </li>
                            </ul>
                        </li>
                        <li class="sidebar-item">
                            <a href="#" class="sidebar-link collapsed" data-bs-target="#research" data-bs-toggle="collapse" aria-expanded="false">
                                <i class="fa-solid fa-file-lines pe-2"></i> Research Papers
                            </a>
                            <ul id="research" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                                <li class="sidebar-item">
                                    <a href="{{ route('research') }}" class="sidebar-link">Your Research Paper List</a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="{{ route('add-research') }}" class="sidebar-link">Add Research Paper</a>
                                </li>
                            </ul>
                        </li>
                        <li class="sidebar-item">
                            <a href="#" class="sidebar-link collapsed" data-bs-target="#videos" data-bs-toggle="collapse" aria-expanded="false">
                                <i class="fa-solid fa-file-lines pe-2"></i> Videos
                            </a>
                            <ul id="videos" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                                <li class="sidebar-item">
                                    <a href="{{ route('video') }}" class="sidebar-link">Your Video List</a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="{{ route('add-video') }}" class="sidebar-link">Add Video</a>
                                </li>
                            </ul>
                        </li>
                        <li class="sidebar-item">
                            <a href="#" class="sidebar-link collapsed" data-bs-target="#articles" data-bs-toggle="collapse" aria-expanded="false">
                                <i class="fa-solid fa-file-lines pe-2"></i> Articles
                            </a>
                            <ul id="articles" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
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
                    <!-- Guest Menu -->
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link" data-bs-toggle="modal" data-bs-target="#guestModal">
                            <i class="fa-solid fa-lock pe-2"></i> Members Only
                        </a>
                    </li>
                @endauth
            </ul>
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
                        <a href="#" data-bs-toggle="dropdown" class="flex-fill pe-md-0" id="user-link">
                            <h6 class="text-muted"><b>{{ ucfirst(auth()->user()->username) }}</b></h6>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a href="{{ route('logout') }}" class="dropdown-item">Logout</a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>

        <main class="content px-3 py-2">
            <div class="container-fluid">
                <div class="card border-0">
                    <div class="card-header">
                        <h5 class="card-title">
                            Add Video
                            <h6><p class="text-muted">Please fill in all input on the forms.</p></h6>
                        </h5>
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

                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <form id="add-video-form" method="POST" action="{{ route('upload-video') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" class="form-control" id="title" name="title" required>
                            </div>
                            <div class="mb-3">
                                <label for="creator" class="form-label">Creator</label>
                                <input type="text" class="form-control" id="creator" name="creator" required>
                            </div>
                            <div class="mb-3">
                                <label for="publication_date" class="form-label">Publication Date</label>
                                <input type="date" class="form-control" id="publication_date" name="publication_date" required>
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="file_path" class="form-label">Video File</label>
                                <input type="file" class="form-control" id="file_path" name="file_path" accept="video/*" required>
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
                            <a href="#" class="text-muted"><strong>Bamboo Online Catalog</strong></a>
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
@endsection
