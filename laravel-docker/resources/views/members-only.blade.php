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
                                <a href="#" class="sidebar-link collapsed" data-bs-target="#books" data-bs-toggle="collapse"
                                    aria-expanded="false"><i class="fa-solid fa-file-lines pe-2"></i>
                                    Books
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
                                <a href="#" class="sidebar-link collapsed" data-bs-target="#research" data-bs-toggle="collapse"
                                    aria-expanded="false"><i class="fa-solid fa-file-lines pe-2"></i>
                                    Research Papers
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
                                <a href="#" class="sidebar-link collapsed" data-bs-target="#videos" data-bs-toggle="collapse"
                                    aria-expanded="false"><i class="fa-solid fa-file-lines pe-2"></i>
                                    Videos
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
                                <a href="#" class="sidebar-link collapsed" data-bs-target="#articles" data-bs-toggle="collapse"
                                    aria-expanded="false"><i class="fa-solid fa-file-lines pe-2"></i>
                                    Articles
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
                    <div class="mb-3">
                        <h4>Members-Only Content</h4>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-6 d-flex">
                            <div class="card flex-fill border-0">
                                <div class="d-flex align-items-start">
                                    <div class="col-12">
                                        <div class="p-3 m-1">
                                            @auth
                                                <h4>Exclusive Content for You, {{ ucfirst(auth()->user()->username) }}</h4>
                                            @else
                                                <h4>Welcome to the Members-Only Section</h4>
                                            @endauth
                                            <p class="mb-0">This section contains exclusive content only available to members. Enjoy your access!</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Content Element -->
                    <div class="card border-0">
                        <div class="card-header">
                            <h5 class="card-title">
                                Latest Updates
                                <h6><p class="text-muted">For our valued members only</p></h6>
                            </h5>
                        </div>
                        <div class="card-body container-fluid">
                            <div class="text-container card-subtitle pic-container">
                                <img id="members-only-pic" src="https://via.placeholder.com/150">
                            </div>
                            <div class="text-container card-subtitle p-5 card-description">
                                <p><h5>Exclusive Content</h5></p>
                                <h6 class="card-subtitle p-3 container-fluid">
                                    <p>As a member, you have access to exclusive content that enhances your experience with our platform. Stay tuned for updates and new features!</p>
                                </h6>
                            </div>
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

</body>
@endsection
