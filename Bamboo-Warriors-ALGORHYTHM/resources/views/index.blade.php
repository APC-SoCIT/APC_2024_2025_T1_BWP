@extends('layouts.master-layout')
@push('css')
    <link href="{{asset('css/style.css')}}" rel="stylesheet">
    <link href="{{asset('css/test.css')}}" rel="stylesheet">
@endpush
    
@section('content')
        <!-- Top Bar Start -->
        <div class="top-bar d-none d-md-block">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8">
                        <div class="top-bar-left">
                            <div class="text">
                                <i class="fa fa-phone-alt"></i>
                                <p>+63 917 320 1947</p>
                            </div>
                            <div class="text">
                                <i class="fa fa-envelope"></i>
                                <p>info@acn-philippines.org</p>
                            </div>
                        </div>
                    </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Top Bar End -->


        <!-- Nav Bar Start -->
        <div class="navbar navbar-expand-lg bg-dark navbar-dark">
            <div class="container-fluid">
                <a href="index.html" class="navbar-brand">ACN Philippines</a>
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                    <div class="navbar-nav ml-auto">
                        <a href="/" class="nav-item nav-link active">Home</a>
                        <a href="/login" class="nav-item nav-link">Login</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Nav Bar End -->


        <!-- Carousel Start -->
        <div class="carousel">
            <div class="container-fluid">
                <div class="owl-carousel">
                    <div class="carousel-item">
                        <div class="carousel-img">
                            <img src="{{asset('img/carousel-1.jpg')}}" alt="Image">
                        </div>
                        <div class="carousel-text">
                            <h1>Building churches for the people</h1>
                            <p>
                                Help create meaningful contribution to help expand, and build more accessible house of worship for our fellow people.
                            </p>
                            <div class="carousel-btn">
                                <a class="btn btn-custom" href="#test">Donate Now</a>
                                
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="carousel-img">
                            <img src="img/carousel-2.jpg" alt="Image">
                        </div>
                        <div class="carousel-text">
                            <h1>Get Involved with helping hand</h1>
                            <p>
                                Be the stepping stone for those who aspire to build a brighter future, offering support, encouragement, and opportunities for growth.
                            </p>
                            <div class="carousel-btn">
                                <a class="btn btn-custom" href="#test">Donate Now</a>
                                
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="carousel-img">
                            <img src="img/carousel-3.jpg" alt="Image">
                        </div>
                        <div class="carousel-text">
                            <h1>Bringing smiles to millions</h1>
                            <p>
                               A simple gesture can make not one but a million people smile. 
                            </p>
                            <div class="carousel-btn">
                                <a class="btn btn-custom" href="#test">Donate Now</a>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Carousel End -->

        <!-- Video Modal Start-->
        <div class="modal fade" id="videoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>        
                        <!-- 16:9 aspect ratio -->
                        <div class="embed-responsive embed-responsive-16by9">
                            <iframe class="embed-responsive-item" src="" id="video"  allowscriptaccess="always" allow="autoplay"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
        <!-- Video Modal End -->
        

        <!-- About Start -->
        <div class="about">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="about-img" data-parallax="scroll" data-image-src="img/about.jpg"></div>
                    </div>
                    <div class="col-lg-6">
                        <div class="section-header">
                            <p>Learn About Us</p>
                            <h2>A Pontifical Foundation with worldwide reach</h2>
                        </div>
                        <div class="about-tab">
                            <ul class="nav nav-pills nav-justified">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="pill" href="#tab-content-1">About</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="pill" href="#tab-content-2">Mission</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="pill" href="#tab-content-3">Vision</a>
                                </li>
                            </ul>

                            <div class="tab-content">
                                <div id="tab-content-1" class="container tab-pane active">
                                    There are numerous charities that look after those in need. What distinguishes Aid to the Church in Need from these organisations? We are the only international Catholic organisation focusing on the pastoral and spiritual support of persecuted and suffering Christians.

Following our inclusion under the Vatican’s umbrella, our General Secretariat in Germany and our 23 National Sections have been successful in building a unique bridge between benefactors and those in need.
                                </div>
                                <div id="tab-content-2" class="container tab-pane fade">
                                    As a Catholic charity, we support the faithful wherever they are persecuted, oppressed or in need, through information, prayer and action.
                                </div>
                                <div id="tab-content-3" class="container tab-pane fade">
                                    A world in which Christianity can thrive everywhere.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- About End -->


        <!-- Service Start -->
        <div class="service">
            <div class="container">
                <div class="section-header text-center">
                    <p>What We Do?</p>
                    <h2>We believe that we can save more lifes with you</h2>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-md-6">
                        <div class="service-item">
                            <div class="service-icon">
                                <i class="flaticon-diet"></i>
                            </div>
                            <div class="service-text">
                                <h3>Healthy Food</h3>
                                <p>Provide nutrition for our fellow christians</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="service-item">
                            <div class="service-icon">
                                <i class="flaticon-water"></i>
                            </div>
                            <div class="service-text">
                                <h3>Pure Water</h3>
                                <p>Provide Accesible drinking water stations for those in need</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="service-item">
                            <div class="service-icon">
                                <i class="flaticon-healthcare"></i>
                            </div>
                            <div class="service-text">
                                <h3>Health Care</h3>
                                <p>Provide clinical trials for people who went short</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="service-item">
                            <div class="service-icon">
                                <i class="flaticon-education"></i>
                            </div>
                            <div class="service-text">
                                <h3>Education</h3>
                                <p>Provide education for people in need</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="service-item">
                            <div class="service-icon">
                                <i class="flaticon-home"></i>
                            </div>
                            <div class="service-text">
                                <h3>Residence Facilities</h3>
                                <p>Provide housing for families and priests</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="service-item">
                            <div class="service-icon">
                                <i class="flaticon-social-care"></i>
                            </div>
                            <div class="service-text">
                                <h3>Social Care</h3>
                                <p>Provide social care for people in need</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Service End -->
        









        
        <!-- Facts Start -->
        <div class="facts" data-parallax="scroll" data-image-src="img/facts.jpg">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="facts-item">
                            <i class="flaticon-home"></i>
                            <div class="facts-text">
                                <h3 class="facts-plus" data-toggle="counter-up">50</h3>
                                <p>Countries</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="facts-item">
                            <i class="flaticon-charity"></i>
                            <div class="facts-text">
                                <h3 class="facts-plus" data-toggle="counter-up">1000</h3>
                                <p>Volunteers</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="facts-item">
                            <i class="flaticon-kindness"></i>
                            <div class="facts-text">
                                <h3 class="facts-dollar" data-toggle="counter-up">2000</h3>
                                <p>Our Goal</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="facts-item">
                            <i class="flaticon-donation"></i>
                            <div class="facts-text">
                                <h3 class="facts-dollar" data-toggle="counter-up">10000</h3>
                                <p>Raised</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Facts End -->
        
        



        <!-- Causes Start -->
        <div class="causes">
            <div class="container">
                <div class="section-header text-center">
                    <p>Projects</p>
                    <h2>Our Projects</a2>
                </div>
                <div class="owl-carousel causes-carousel">
                  @foreach ($projects as $project)
                    <div class="causes-item">
                        <div class="causes-img">
                            <img src="http://localhost/acn/storage/app/{{ $project->path }}" alt="Image">
                        </div>
                        <div class="causes-progress">
                            <div class="progress">
                                <div class="progress-bar" role="progressbar" aria-valuenow="{{$project->progress}}" aria-valuemin="0" aria-valuemax="100">
                                    <span>{{$project->progress}}%</span>
                                </div>
                            </div>
                            <div class="progress-text">
                                <p><strong>Start-date:</strong> {{$project->start_date}}</p>
                            </div>
                            <div class="progress-text">
                                <p><strong>End-date:</strong> {{$project->end_date}}</p>
                            </div>
                        </div>
                        <div class="causes-text">
                            <h3>{{$project->title}}</h3>
                            <p>{{$project->description}}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <!-- Causes End -->
        
        
    
        <div class="donate" data-parallax="scroll" data-image-src="img/donate.jpg">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-7">
                        <div class="donate-content">
                            <div class="section-header">
                                <p>Donate Now</p>
                                <h2>Let's donate to churches in need!</h2>
                            </div>
                            <div class="donate-text">
                                <p>
                                    A simple donation from you can make a huge impact to our organization and to our fellow people. 
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="donate-form">
                            <form method="POST" action="{{ route('store.index') }}">
                                @csrf
                                <div class="control-group">
                                    <input type="text" name="name" class="form-control" placeholder="Name" required="required" />
                                </div>
                                <div class="control-group">
                                    <input type="number" name="amount" class="form-control" placeholder="Amount" required="required" />
                                </div>
                                <div>
                                    <button class="btn btn-custom" type="submit">Donate Now</button>
                                </div>
                            </form>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
   
        <div class="container" id="test">
            <div class="leaderboard">
                <div class="head">
                    <h1 style="color:#ffffff;">Top donors</h1>
                </div>
                <div class="body">
                    <ol>
                        
                        @foreach($donors->sortByDesc('amount')->take(10) as $donor)
                        
                        <li>
                            <mark>{{$donor->name}}</mark>
                            <small>{{$formatted_amount = 'P' . number_format($donor->amount, 2, '.', ',')}}</small>
                        </li>
                        @endforeach
                    </ol>
                </div>
            </div>
        </div>
        <!-- Footer Start -->
        <div class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="footer-contact">
                            <h2>Our Head Office</h2>
                            <p><i class="fa fa-map-marker-alt"></i>Room 201, CBCP Bldg., #470 General Luna Street, Intramuros, Philippines</p>
                            <p><i class="fa fa-phone-alt"></i>+63 917 320 1947</p>
                            <p><i class="fa fa-envelope"></i>info@acn-philippines.org</p>
                            <div class="footer-social">
                                <a class="btn btn-custom" href="https://www.facebook.com/acnphilippines.org"><i class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-custom" href="https://www.youtube.com/@ACN-International"><i class="fab fa-youtube"></i></a>
                            </div>
                        </div>
                       
                    </div>
                    <div class="col-lg-3 col-md-6">
                    </div>
                  
                </div>
            </div>
            <div class="container copyright">
                <div class="row">
                    <div class="col-md-6">
                        <p>&copy; <a href="https://acninternational.org/">Aid to the Church in need</a>, All Right Reserved.</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer End -->
        



        <!-- Back to top button -->
        <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>
        




        <!-- Pre Loader -->
        <div id="loader" class="show">
            <div class="loader"></div>
        </div>
@endsection
@push('script')
    <script src="{{ asset('js/main.js')}}"></script>
@endpush