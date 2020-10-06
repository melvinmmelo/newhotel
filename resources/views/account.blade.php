@extends('layouts.app')

@section('content')
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item"><a href="{{ route('reservation-add') }}">Create Reservation</a></li>
          <li class="breadcrumb-item active" aria-current="page">Data</li>
        </ol>
    </nav>
    {{-- <account-component :items="{{ json_encode($accounts) }}"></account-component> --}}
    <div class="row">
        <div class="col mb-2">
            <card>
                <template slot="header">Add Here</template>
                <template slot="body">
                    <account-form></account-form>
                </template>
            </card>
        </div>

        <div class="col-md-8">
            <card>
                <template slot="header">Guest List</template>
                <template slot="body">
                <account-list :accounts="{{ json_encode($accounts->items()) }}"></account-list>
                </template>
            </card>
            <div class="mt-2">
                {{ $accounts }}
            </div>

        </div>


    </div>
</div>
@endsection
