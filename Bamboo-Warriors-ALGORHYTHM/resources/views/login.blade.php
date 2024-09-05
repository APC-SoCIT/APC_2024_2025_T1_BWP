@extends('layouts.layout')
@push('css')
    <link href="{{asset('css/login.css')}}" rel="stylesheet">
@endpush

@section('content')
<body>

<div id="shadow">
</div>

<div id="centered-container">
<center>
    <img id="logo" src="{{ asset('favicon.ico') }}">
    <p><b>Online Bamboo Catalog</b></p>
    <form id="login" action="{{route('login.post')}}" method="POST">
    @csrf
    <div class="mb-3">
        <label class="form-label">Username</label>
        <input type="text" class="form-control" id="username" name="username" require>
    </div>
    <div class="mb-3">
        <label class="form-label">Password</label>
        <input type="password" class="form-control" id="password" name="password" require>
    </div>
    <button type="submit" class="btn btn-success"><svg xmlns="http://www.w3.org/2000/svg" height="30px" viewBox="0 0 512 512"><style>svg{fill:#ffffff}</style><path d="M217.9 105.9L340.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L217.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1L32 320c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM352 416l64 0c17.7 0 32-14.3 32-32l0-256c0-17.7-14.3-32-32-32l-64 0c-17.7 0-32-14.3-32-32s14.3-32 32-32l64 0c53 0 96 43 96 96l0 256c0 53-43 96-96 96l-64 0c-17.7 0-32-14.3-32-32s14.3-32 32-32z"/></svg> Sign-in</button>
    </form>
    <?php
     if(isset($_GET['error'])){
        echo '<script>window.onload = function() { invalid_credentials(); }</script>';
    }
    ?>
</center>
</div>
</body>
@endsection
@push('script')
    <script src="{{ asset('js/login.js')}}"></script>
@endpush