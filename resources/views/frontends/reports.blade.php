@extends('layouts.indexLayout')

@section('meta')
    @include('partials.metaIndex')
@endsection

@section('content')
    @include('partials.topbarPC')
    @include('partials.topbarMobile')

    <div class="bg-gray-sawit  py-4 sm:h-96 h-48 relative ">
        <div class="max-w-6xl mx-auto px-6 ">
            <p class="absolute sm:bottom-24 bottom-12 text-auriga-biru  sm:text-4xl text-2xl font-extrabold">All Reports</p>
        </div>
        <div class="absolute   bottom-0 right-0 ">
            <img src="{{ asset('img/elemen.png') }}" alt="auriga nusantara" class="sm:w-96 w-40 z-10">
        </div>
    </div>

    <livewire:page-reports-component />

    @include('partials.footer')


@endsection
