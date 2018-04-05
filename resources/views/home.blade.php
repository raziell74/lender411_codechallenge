@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if (session('status'))
                <div class="card">
                    <div class="card-body">
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    </div>
                </div>
            @endif
        </div>
        <div class="col-md-8 mt-1">
            <div class="card">
                <passport-clients></passport-clients>
            </div>
        </div>
        <div class="col-md-8 mt-1">
            <div class="card">
                <passport-personal-access-tokens></passport-personal-access-tokens>
            </div>
        </div>
        <div class="col-md-8 mt-1">
            <div class="card">
                <passport-authorized-clients></passport-authorized-clients>
            </div>
        </div>
    </div>
</div>
@endsection
