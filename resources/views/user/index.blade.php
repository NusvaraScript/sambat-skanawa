@extends('layouts.user')

@section('title', 'Sambat Skanawa - Pengaduan Siswa')

@section('breadcrumbs')
    @include('components.breadcrumbs', [
        'items' => [
            ['label' => 'Beranda'],
        ],
    ])
@endsection

@section('content')
    @include('components.hero-section')
    @include('components.pengaduan-form')
@endsection