
<html>
    <head>
      <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script src='https://kit.fontawesome.com/a076d05399.js'></script>


    <link rel="stylesheet" type="text/css" href="{{ asset('css/slidercss.css') }}">
    </head>
    <section class="login-block">

        <div class="container">

        <div class="row">
            <div class="col-md-4 login-sec">
                <h2 class="text-center">EXCELLENTIA | PMS <i class='fas fa-bed' style='font-size:36px'></i> <br><small> Login now </small></h2>

                <form class="login-form" method="POST" action="{{ route('login') }}">
                    @csrf
      <div class="form-group">
        <label for="exampleInputEmail1" class="text-uppercase">Username</label>
        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

        @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror

      </div>
      <div class="form-group">
        <label for="exampleInputPassword1" class="text-uppercase">Password</label>
        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

        @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
      </div>


        <div class="form-check">
        <button type="submit" class="btn btn-login float-right">
            {{ __('Login') }}
        </button>
      </div>

    </form>

            </div>
            <div class="col-md-8 banner-sec">
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                     <ol class="carousel-indicators">
                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                      </ol>
                <div class="carousel-inner" role="listbox">
        <div class="carousel-item active">
          <img class="d-block img-fluid" src="{{ asset('images/w26.jpg') }}" alt="First slide">
          <div class="carousel-caption d-none d-md-block">
            <div class="banner-text">
                {{--<h2>This is First Slide</h2>
                 <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation</p> --}}
            </div>
      </div>
        </div>
        <div class="carousel-item">
          <img class="d-block img-fluid" src="{{ asset('images/img1.jpg') }}" alt="Second slide">
          <div class="carousel-caption d-none d-md-block">
            <div class="banner-text">
                {{-- <h2>This is Second Slide</h2>
                 <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation</p> --}}
            </div>
        </div>
        </div>
        <div class="carousel-item">
          <img class="d-block img-fluid" src="{{ asset('images/img2.jpg') }}" alt="Third slide">
          <div class="carousel-caption d-none d-md-block">
            <div class="banner-text">
                {{--<h2>This is Heaven</h2>
                 <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation</p> --}}
            </div>
        </div>
      </div>
                </div>

            </div>
        </div>
    </div>
    </section>
