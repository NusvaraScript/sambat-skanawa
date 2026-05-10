@extends('layouts.user')

@section('title', 'Sambat Skanawa - Pengaduan Siswa')

@section('breadcrumbs')
    @include('components.breadcrumbs', [
        'title' => 'Pengaduan Siswa',
        'subtitle' => 'Sampaikan keluhan dan aspirasi Anda dengan mudah dan aman',
        'items' => [
            ['label' => 'Beranda'],
        ],
    ])
@endsection

@section('content')
    @include('components.hero-section')
    @include('components.pengaduan-form')
@endsection