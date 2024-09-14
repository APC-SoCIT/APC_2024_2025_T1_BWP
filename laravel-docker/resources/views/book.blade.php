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
                <!-- Navbar Content Here -->
            </nav>
            <main class="content px-3 py-2">
                <div class="container-fluid">
                    <div class="card border-0">
                        <div class="card-header">
                            <h5 class="card-title">
                                Book Table
                                <h6><p class="text-muted">List of all your uploaded books.</p></h6>
                            </h5>
                        </div>
                        <div class="card-body container-fluid">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">Title</th>
                                        <th scope="col">Author</th>
                                        <th scope="col">Rating</th>
                                        <th scope="col">Description</th>
                                        <th scope="col">Published Date</th>
                                        <th scope="col">File</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($books as $book)
                                        <tr>
                                            <td>{{ $book->title }}</td>
                                            <td>{{ $book->author }}</td>
                                            <td>{{ $book->rating }}</td>
                                            <td>{{ $book->description }}</td>
                                            <td>{{ $book->publish_date }}</td>
                                            <td>
                                                @if($book->file)
                                                    <a href="{{ Storage::url('public/files/books/' . basename($book->file)) }}" class="btn btn-primary" target="_blank">Open File</a>
                                                @else
                                                    No file available
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
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
</body>
@endsection
