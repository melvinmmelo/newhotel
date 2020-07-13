@extends('layouts.app')

@section('content')
<div class="container">
    <room-component :items="{{ json_encode($rooms) }}"></room-component>
</div>
@endsection
