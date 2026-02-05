@extends('layouts.app')

@section('content')
<div class="container" id="app">
    <button @click="count++">
        Счётчик: @{{ count }}
    </button>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title d-inline">{{ __('') }}</h5>
                    <a href="{{route('home')}}" type="button" class="btn btn-dark btn-sm mx-2 float-end">{{ __('Back') }}</a>
                </div>
                <div class="card-body">

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
