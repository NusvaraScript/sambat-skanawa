@extends('layouts.auth')

@section('title', 'Daftar - Sembilan Bersuara')

@section('content')
    <div class="mb-3">
        @include('components.breadcrumbs', [
            'items' => [
                ['label' => 'Beranda', 'url' => route('home')],
                ['label' => 'Daftar'],
            ],
        ])
    </div>
    @include('components.register-form')
@endsection
