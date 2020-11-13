@extends('layouts.app')

@section('content')
<div class="container">
    <room-types :items="{{ json_encode($roomTypes) }}"></room-types>
</div>
@endsection
