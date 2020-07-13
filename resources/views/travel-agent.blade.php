@extends('layouts.app')

@section('content')
<div class="container">
    <travel-agent-component :items="{{ json_encode($travelAgents) }}"></travel-agent-component>
</div>
@endsection
