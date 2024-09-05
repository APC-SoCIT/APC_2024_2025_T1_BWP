@extends('layouts.dashboard-layout')

@section('content')
<link href="{{asset('css/add-research.css')}}" rel="stylesheet">
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
                        <a href="{{route('dashboard')}}" class="sidebar-link">
                            <i class="fa-solid fa-list pe-2"></i>
                            Dashboard
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link collapsed" data-bs-target="#researchs" data-bs-toggle="collapse"
                            aria-expanded="false"><i class="fa-solid fa-file-lines pe-2"></i>
                            Books
                        </a>
                        <ul id="researchs" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                            <li class="sidebar-item">
                                <a href="{{route('book')}}" class="sidebar-link">Your Book List</a>
                            </li>
                            <li class="sidebar-item">
                                <a href="{{route('add-book')}}" class="sidebar-link">Add Book</a>
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
                                <a href="{{route('research')}}" class="sidebar-link">Your Research Paper List</a>
                            </li>
                            <li class="sidebar-item">
                                <a href="{{route('add-research')}}" class="sidebar-link">Add Research Paper</a>
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
                                <a href="{{route('video')}}" class="sidebar-link">Your Video List</a>
                            </li>
                            <li class="sidebar-item">
                                <a href="{{route('add-video')}}" class="sidebar-link">Add Video</a>
                            </li>
                        </ul>
                    </li><li class="sidebar-item">
                        <a href="#" class="sidebar-link collapsed" data-bs-target="#articles" data-bs-toggle="collapse"
                            aria-expanded="false"><i class="fa-solid fa-file-lines pe-2"></i>
                            Articles
                        </a>
                        <ul id="articles" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                            <li class="sidebar-item">
                                <a href="{{route('article')}}" class="sidebar-link">Your Article List</a>
                            </li>
                            <li class="sidebar-item">
                                <a href="{{route('add-article')}}" class="sidebar-link">Add Article</a>
                            </li>
                        </ul>
                    </li>
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
                                <a href="{{route('logout')}}" class="dropdown-item">Logout</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
            <main class="content px-3 py-2">
                <div class="container-fluid">
                    <!-- Table Element -->
                    <div class="card border-0">
                        <div class="card-header">
                            <h5 class="card-title">
                                Add Research
                                <h6><p class="text-muted">Please fill in all input on the forms.</p></h6>
                            </h5>
                        </div>
                        <div class="card-body container-fluid" id="research-card-body">
                            <form id="add-research-form">
                                <div class="mb-3">
                                    <label for="title" class="form-label">Title</label>
                                    <input type="text" class="form-control" id="title" name="title" required>
                                </div>
                                <div class="mb-3">
                                    <label for="author" class="form-label">Author</label>
                                    <input type="text" class="form-control" id="author" name="author" required>
                                </div>
                                <div class="mb-3">
                                    <label for="abstract" class="form-label">Abstract</label>
                                    <textarea class="form-control" id="abstract" name="abstract" rows="3" required></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="introduction" class="form-label">Introduction</label>
                                    <textarea class="form-control" id="introduction" name="introduction" rows="3" required></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="results" class="form-label">Results</label>
                                    <textarea class="form-control" id="results" name="results" rows="3" required></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="conclusion" class="form-label">Conclusion</label>
                                    <textarea class="form-control" id="conclusion" name="conclusion" rows="3" required></textarea>
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
                                    <a href="#" class="text-muted">researching</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/dashboard.js')}}"></script>
    <script src="{{ asset('js/status.js')}}"></script>
</body>
@endsection
