@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <a href="{{ route('lang.switch', 'en') }}">English</a>
                    <a href="{{ route('lang.switch', 'ru') }}">Русский</a>
                    <p>{{ __('Welcome to our application') }}</p>
                    <p>Текущий язык: {{ app()->getLocale() }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
