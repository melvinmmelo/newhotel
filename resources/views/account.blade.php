@extends('layouts.app')

@section('content')
<div class="container">
    {{-- <account-component :items="{{ json_encode($accounts) }}"></account-component> --}}
    <div class="row">
        <div class="col-md-8">
            <card>
                <template slot="header">Account List</template>
                <template slot="body">
                <account-list :accounts="{{ json_encode($accounts->items()) }}"></account-list>
                </template>
            </card>

            {{ $accounts}}

        </div>

        <div class="col">
            <card>
                <template slot="header">Add Account</template>
                <template slot="body">
                    <account-form></account-form>
                </template>
            </card>
        </div>
    </div>
</div>
@endsection
