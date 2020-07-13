@extends('layouts.app')

@section('content')
<div class="container">
    <a href="{{ route('reservation-add') }}" class="btn btn-success mb-2">Create Reservation</a>
    <reservation-list-component :reservations="{{ json_encode($reservations) }}"></reservation-list-component>
</div>
@endsection
