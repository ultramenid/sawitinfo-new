@extends('layouts.indexLayout')

@section('meta')
    @include('partials.metaDetail')
@endsection

@section('content')
    @include('partials.topbarDetail')
    @include('partials.topbarMobileDetail')

    {{-- hero --}}
    <div class="sm:h-106 h-full bg-gray-sawit sm:relative">
        <div class="absolute   bottom-0 right-0 ">
            <img src="{{ asset('img/elemen.png') }}" alt="auriga nusantara" class="w-72 sm:block hidden">
        </div>
        <div >
            <div class="max-w-7xl mx-auto sm:px-0 px-4 sm:py-12 py-4 flex w-full justify-between relative">
                <a href="{{ route('insights', app()->getlocale() )}}">
                    <div class="flex space-x-2 items-center">
                        <div class="rounded-full  border-black border md:flex justify-center items-center px-1 py-1 ">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="sm:w-4 w-2 sm:h-4 h-2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                            </svg>
                        </div>
                        <h2 class="font-semibold sm:text-base text-xs">VIEW ALL POSTS</h2>
                    </div>
                </a>
                <div class="flex space-x-4 py-1 border border-white px-2 text-xs items-center">
                    <h2 class="font-semibold">SHARE</h2>
                    <div class="flex space-x-2 ">
                        <div class=" bg-black rounded-full border border-black px-[0.12rem] py-[0.1rem] flex items-center">
                            <img src="{{ asset('img/facebook.svg') }}" alt="" class="w-3">
                        </div>
                        <div class=" bg-black rounded-full border border-black px-[0.12rem] py-[0.12rem] flex items-center">
                            <img src="{{ asset('img/twitter.svg') }}" alt="" class="w-3">
                        </div>
                        <div class=" bg-black rounded-full border border-black px-[0.12rem] py-[0.1rem] flex items-center">
                            <img src="{{ asset('img/wa.png') }}" alt="" class="w-3">
                        </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="max-w-5xl mx-auto sm:px-0 px-4">
                <h1 class="text-auriga-biru font-bold sm:text-5xl text-3xl max-w-xl sm:mb-12 mb-4">{{$data->title}}</h1>
                <div class="flex space-x-4 items-center">
                    <a class="text-auriga-biru text-xl">{{$data->category}}</a>
                    <a> - </a>

                    <h5 class="text-sm font-light text-gray-600">
                        @php
                            $date = \Carbon\Carbon::parse($data->publishdate)->locale(App::getLocale());
                            $date->settings(['formatFunction' => 'translatedFormat']);
                            echo $date->format('F Y');
                        @endphp
                    </h5>

                </div>


            </div>
        </div>

        <div class="max-w-5xl mx-auto flex sm:flex-row flex-col space-x-4 items-end sm:-mt-32 relative sm:px-0 px-4">
            <div class="sm:w-4/12 w-full sm:order-first order-last">
                <a href="mailto:sawitinfo@auriga.or.id" class="font-semibold uppercase text-sm px-4">contact: admin@sawit.info</a>
            </div>
            <img src="{{ asset('storage/public/files/photos/'.$data->img) }}" alt="" class=" sm:order-last order-first sm:w-8/12 w-full sm:h-96 h-64  object-cover object-center border border-gray-50">
        </div>
    </div>

    <div class="max-w-2xl mx-auto text-auriga-biru sm:mt-24 mt-4 px-4 flex flex-col space-y-4 prose">
        {!! $data->content !!}
        <div class="mt-12">
            @foreach ($tags as $key => $value)
                <a class="inline-flex justify-between text-sm  mr-4 mt-2 bg-gray-sawit dark:bg-newgray-700 text-newgray-700 dark:text-gray-300 rounded py-2 px-2 focus:outline-none items-center">{{$value}}</a>
            @endforeach
        </div>
    </div>



     @include('partials.footer')


@endsection
