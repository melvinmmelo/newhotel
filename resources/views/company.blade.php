@extends('layouts.app')

@section('content')
<div class="container">
    <company-component :items="{{ json_encode($companies) }}"></company-component>
</div>
@endsection
