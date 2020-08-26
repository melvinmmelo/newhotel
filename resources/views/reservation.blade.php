@extends('layouts.app')

@section('content')
<div class="container">
    <reservation-list-component :reservations="{{ json_encode($reservations) }}"></reservation-list-component>
</div>
@endsection
