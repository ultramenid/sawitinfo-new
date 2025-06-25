@extends('layouts.indexLayout')

@section('meta')
    @include('partials.metaIndex')
@endsection

@section('content')
    @include('partials.topbarPC')
    @include('partials.topbarMobile')

    {{-- hero --}}
     <div class="bg-gray-sawit  py-4 sm:h-96 h-48 relative ">
        <div class="max-w-6xl mx-auto px-6 ">
            <p class="absolute sm:bottom-24 bottom-12 text-auriga-biru  sm:text-4xl text-2xl font-extrabold"></p>
        </div>
        <div class="absolute   bottom-0 right-0 ">
            <img src="{{ asset('img/elemen.png') }}" alt="auriga nusantara" class="sm:w-96 w-40 z-10">
        </div>
    </div>

    <div class="sm:px-0 px-4">
        <div class="max-w-3xl mx-auto bg-white relative  -mt-20 z-20 rounded sm:px-6 px-4 sm:py-12 py-4 border-b border-red-600 min-h-[40vh]">
            <a class="text-xl font-semibold ">Sawit.info</a>
            <div class="prose max-w-none mt-4 sm:text-base text-sm leading-relaxed">
                {!! $data->content !!}
            </div>
        </div>
    </div>






     @include('partials.footer')


@endsection
