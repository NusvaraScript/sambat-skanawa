@extends('layouts.auth')

@section('title', 'Login - Sembilan Bersuara')

@section('content')
    <div class="mb-3">
        @include('components.breadcrumbs', [
            'items' => [
                ['label' => 'Beranda', 'url' => route('home')],
                ['label' => 'Login'],
            ],
        ])
    </div>
    @include('components.login-form')
@endsection