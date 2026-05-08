@extends('layouts.user')

@section('title', 'Status Laporan - Sambat Skanawa')

@section('breadcrumbs')
    @include('components.breadcrumbs', [
        'title' => 'Status Laporan',
        'subtitle' => 'Pantau perkembangan laporan pengaduan Anda',
        'items' => [
            ['label' => 'Beranda', 'url' => route('home')],
            ['label' => 'Status Laporan'],
        ],
    ])
@endsection

@section('content')
    @include('components.status-banner')
    @include('components.status-search-form')
    @include('components.status-table')
@endsection