@extends('layouts.dashboard-layout')

@section('content')
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
                                Research Table
                                <h6><p class="text-muted">List of all your uploaded research papers.</p></h6>
                            </h5>
                        </div>
                        <div class="card-body container-fluid">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Title</th>
                                        <th>Authors</th>
                                        <th>DOI</th>
                                        <th>Keywords</th>
                                        <th>File</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($researches as $research)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $research->title }}</td>
                                            <td>{{ $research->author }}</td>
                                            <td>{{ $research->doi }}</td>
                                            <td>{{ $research->keywords }}</td>
                                            <td>
                                                <a href="{{ Storage::url($research->file_path) }}"  class = "btn btn-primary" target="_blank">View File</a>
                                            </td>
                                            <td>
                                                <form action="{{ route('delete-research', $research->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this research paper?')">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center">No research papers found.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
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
@endsection