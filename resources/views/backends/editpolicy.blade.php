@extends('layouts.backendLayout')


@section('content')
    @include('partials.backendHeader')
    @include('partials.backendNav')

    {{-- <livewire:edit-posts-component :id=$id /> --}}
    <livewire:edit-policy-component :id=$id />
@endsection
