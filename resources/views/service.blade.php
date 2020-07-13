@extends('layouts.app')

@section('content')
<div class="container">
    <service-component :items="{{ json_encode($services) }}"></service-component>
</div>
@endsection
