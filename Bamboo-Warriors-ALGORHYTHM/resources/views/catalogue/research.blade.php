@extends('layouts.dashboard-layout')

@section('content')
<body>
    <div class="wrapper">
        <aside id="sidebar" class="js-sidebar">
            <!-- Content For Sidebar -->
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
                                <a href="{{ route('video') }}" class="sidebar-link">
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
                                <a href="{{ route('article') }}" class="sidebar-link">
                                    <i class="fa-solid fa-newspaper pe-2"></i>
                                    Articles
                                </a>
                            </li>
                        </ul>
                    </li>
                    @auth
                        @if(auth()->user()->account_type === 'admin' || auth()->user()->account_type === 'member')
                            <li class="sidebar-item">
                                <a href="{{ route('members-only') }}" class="sidebar-link">
                                    <i class="fa-solid fa-lock pe-2"></i>
                                    Members Only
                                </a>
                            </li>
                        @endif

                        @if(auth()->user()->account_type === 'admin')
                            <li class="sidebar-item">
                                <a href="#" class="sidebar-link collapsed" data-bs-toggle="collapse" data-bs-target="#adminDropdown" aria-expanded="false">
                                    <i class="fa-solid fa-cog pe-2"></i>
                                    Admin Panel
                                </a>
                                <ul id="adminDropdown" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                                    <li class="sidebar-item">
                                        <a href="#" class="sidebar-link collapsed" data-bs-toggle="collapse" data-bs-target="#manageContentDropdown" aria-expanded="false">
                                            <i class="fa-solid fa-edit pe-2"></i>
                                            Manage Content
                                        </a>
                                        <ul id="manageContentDropdown" class="sidebar-dropdown list-unstyled collapse">
                                            <li class="sidebar-item">
                                                <a href="{{ route('book') }}" class="sidebar-link">Your Book List</a>
                                            </li>
                                            <li class="sidebar-item">
                                                <a href="{{ route('add-book') }}" class="sidebar-link">Add Book</a>
                                            </li>
                                            <li class="sidebar-item">
                                                <a href="{{ route('add-video') }}" class="sidebar-link">Add Video</a>
                                            </li>
                                            <li class="sidebar-item">
                                                <a href="{{ route('add-research') }}" class="sidebar-link">Add Research Paper</a>
                                            </li>
                                            <li class="sidebar-item">
                                                <a href="{{ route('add-article') }}" class="sidebar-link">Add Article</a>
                                            </li>
                                        </ul>
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
                    <h4 class="mb-3">Research Papers Catalogue</h4>
                    <div class="row">
                        @forelse ($researchPapers as $research)
                        <div class="col-md-4 mb-4">
                            <div class="card border-0 shadow-sm h-100">
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title">{{ $research->title }}</h5>
                                    <h6 class="card-subtitle mb-3 text-muted">Author: {{ $research->author }}</h6>
                                    <p class="card-text"><strong>Abstract:</strong> {{ Str::limit($research->abstract, 100) }}</p>
                                    <p class="card-text"><strong>Keywords:</strong> {{ $research->keywords }}</p>
                                    <p class="card-text"><small class="text-muted">Published Date: {{ $research->publish_date }}</small></p>
                                    @if ($research->is_members_only)
                                        <span class="badge bg-warning text-dark">Members Only</span>
                                    @endif
                                    <div class="mt-auto">
                                        <a href="{{ Storage::url($research->file) }}" class="btn btn-primary btn-block" target="_blank" rel="noopener noreferrer">Open File</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="col-12">
                            <div class="alert alert-warning text-center">No research papers available.</div>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"></script>
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
                    <p>You need to be logged in to access this section.</p>
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
