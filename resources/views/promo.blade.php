@extends('layouts.app')

@section('content')
<div class="container">
    <promo-component :items="{{ json_encode($promos) }}"></promo-component>
</div>
@endsection
