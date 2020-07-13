@extends('layouts.app')

@section('content')
<div class="container">
    <transaction-component :items="{{ json_encode($transactions) }}"></transaction-component>
</div>
@endsection
