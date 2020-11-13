@extends('layouts.app')

@section('content')
<div class="container">

    {{-- <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Welcome!</strong> This is EXCELLENTIA.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div> --}}

    <div id="carouselExampleSlidesOnly" class="carousel slide mb-2" data-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img class="d-block w-100" src="{{ asset('images/img1.jpg') }}" alt="First slide">
          </div>
          <div class="carousel-item">
            <img class="d-block w-100" src="{{ asset('images/img2.jpg') }}" alt="Second slide">
          </div>
          <div class="carousel-item">
            <img class="d-block w-100" src="{{ asset('images/img3.jpg') }}" alt="Third slide">
          </div>
        </div>
      </div>
    <div class="row">
        <div class="col-lg-8 col-sm-8">
            <div class="card-group">
                <div class="card text-white bg-primary mb-3 mr-2" style="max-width: 18rem;">
                    <div class="card-header">Room</div>
                    <div class="card-body">
                    <h5 class="card-title">15</h5>
                    </div>
                </div>
                <div class="card text-white bg-secondary mb-3 mr-2" style="max-width: 18rem;">
                    <div class="card-header">Room</div>
                    <div class="card-body">
                    <h5 class="card-title">10</h5>
                    </div>
                </div>
                <div class="card text-white bg-success mb-3 mr-2" style="max-width: 18rem;">
                    <div class="card-header">Room</div>
                    <div class="card-body">
                    <h5 class="card-title">20</h5>
                    </div>
                </div>
                <div class="card text-white bg-danger mb-3 mr-2" style="max-width: 18rem;">
                    <div class="card-header">Room</div>
                    <div class="card-body">
                    <h5 class="card-title">30</h5>
                    </div>
                </div>
                <div class="card text-white bg-warning mb-3 mr-2" style="max-width: 18rem;">
                    <div class="card-header">Room</div>
                    <div class="card-body">
                    <h5 class="card-title">0</h5>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <h4>Latest Reservations</h4>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Reservation ID</th>
                            <th>Guest Name</th>
                            <th>Reserved At</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
        <div class="col-lg-4 col-sm-4">
            <h4>Master Records</h4>
            <ul class="list-group mb-2">
                <li class="list-group-item d-flex justify-content-between align-items-center">
                <a href="{{ route('reservations') }}">Reservations</a>
                  <span class="badge badge-primary badge-pill">14</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <a href="#">Guests</a>
                  <span class="badge badge-primary badge-pill">2</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <a href="#">Rooms</a>
                  <span class="badge badge-primary badge-pill">1</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <a href="#">Companies</a>
                  <span class="badge badge-primary badge-pill">1</span>
                </li>
              </ul>

            <h4>Activity Logs</h4>
            <ul class="list-group">
                <li class="list-group-item"><small>9:13</small> Melvin create new reservation. </li>
                <li class="list-group-item"><small>14:10</small> Melvin update reservation. </li>
                <li class="list-group-item"><small>16:30</small> Reservation ID. 12345 confirmed. </li>
                <li class="list-group-item"><small>8:00</small> User add new housekeeping job. </li>
            </ul>
        </div>
    </div>
</div>
@endsection
