@extends('layouts.indexLayout')

@section('meta')
    @include('partials.metaIndex')
@endsection

@section('content')
    @include('partials.topbarPC')
    @include('partials.topbarMobile')

    {{-- hero --}}
    <div class="max-w-6xl mx-auto grid md:grid-cols-2 grid-cols-1 sm:py-8 gap-10 ">
        {{-- left side --}}
        <div class="w-full">
            <img src="{{ asset('storage/public/files/photos/'.$posts[0]->img) }}" alt="sawit.info" class="w-full object-center h-80 object-cover sm:px-4 px-0 ">

            <div class="text-gray-500 space-x-6 flex sm:mt-6 mt-2 px-4">
                {{-- <h1 class="font-semibold md:text-3xl text-md">{{$posts[0]->category}}</h1> --}}
                <span class="font-semibold md:text-3xl text-md">•</span>
                <h1 class="font-semibold md:text-3xl text-md">
                    @php
                        $date = \Carbon\Carbon::parse($posts[0]->publishdate)->locale(App::getLocale());
                        $date->settings(['formatFunction' => 'translatedFormat']);
                        echo $date->format('d F Y');
                    @endphp</h1>
            </div>

            <a href="{{ route('slug', [app()->getLocale(),  $posts[0]->slug]) }}"><h1  class="text-wrap cusrsor-pointer px-4 sm:mt-6 mt-2 sm:mb-8 mb-3 md:text-5xl text-2xl font-semibold text-auriga-biru">{{$posts[0]->title}}</h1></a>
            <a href="{{ route('slug', [app()->getLocale(),  $posts[0]->slug]) }}" class=" cursor-pointer px-4 text-auriga-biru sm:text-xl text-base font-semibold hover:cursor-pointer hover:underline ">READ THE ARTICLE</a>
        </div>

        {{-- right side --}}
        <div class="w-full px-4 sm:border-l-hero border-black">
            <div class="md:px-10">
                {{-- <h1 class="font-black text-auriga-biru text-4xl mb-2">Featured</h1> --}}
                {{-- card --}}
                @foreach($posts as $key => $data)
                    @if($key > 0)
                    <div class="py-2">
                        <div class="text-gray-500 space-x-4 flex  ">
                        {{-- <h1 class="font-semibold text-sm">{{$data->category}}</h1> --}}
                            <span class="font-semibold text-sm">•</span>
                            <h1 class="font-semibold text-sm">
                                @php
                                    $date = \Carbon\Carbon::parse($data->publishdate)->locale(App::getLocale());
                                    $date->settings(['formatFunction' => 'translatedFormat']);
                                    echo $date->format('d F Y');
                                @endphp
                            </h1>
                            </h1>
                        </div>
                        <div class="flex  w-full justify-between mt-1 space-x-6  ">
                            <img src="{{ asset('storage/public/files/photos/thumbnail/'.$data->img) }}" alt="sawit.info" class="md:w-5/12 w-6/12 sm:h-28 h-24 object-cover border border-gray-50">
                            <a href="{{ route('slug', [app()->getLocale(),  $data->slug]) }}" class="text-wrap cursor-pointer text-auriga-biru sm:text-xl text-base font-bold">{{$posts[1]->title}}</a>
                        </div>
                        <div class="flex justify-end mt-4">
                            <a href="{{ route('slug', [app()->getLocale(),  $data->slug]) }}" class="cursor-pointer text-auriga-biru font-bold sm:text-base text-sm">READ THE ARTICLE</a>
                        </div>
                    </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>

    <div class="max-w-6xl mx-auto bg-auriga-biru flex w-full justify-between px-6 py-4">
        <a href="{{ route('insights', app()->getlocale() )}}" class=" cursor-pointer text-white font-semibold">VIEW ALL ARTICLES</a>

        <a href="{{ route('insights', app()->getlocale() )}}" class="cursor-pointer">
            <div class="rounded-full  border-white border md:flex justify-center items-center px-1 py-1 ">
            <svg xmlns="http://www.w3.org/2000/svg"  fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 font-bold text-white">
                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
              </svg>
            </div>
        </a>
    </div>

    {{-- ngopini --}}
    <div class="bg-auriga-hijau sm:py-20 py-6 relative mt-12 mb-12  px-4">
        <div class=" max-w-6xl mx-auto grid sm:grid-cols-2 grid-cols-1 sm:gap- gap-0 ">
            <div class="z-40">
                <img src="{{ asset('storage/public/files/photos/'.$ngopinis->img) }}" alt="" class=" sm:h-80 h-60 w-full object-cover">
            </div>
            <div class="sm:px-10">
                <div class="flex space-x-4 sm:mt-10 mt-4 items-center text-gray-200">
                    <h1 class="font-semibold sm:text-base text-sm">ngopini</h1>
                </div>
                <a href="{{ route('ngopini', [app()->getLocale(), $ngopinis->slug]) }}">
                    <h1 class="sm:mt-8 mt-5 sm:text-2xl text-xl font-bold text-white">
                        {{$ngopinis->title}}
                    </h1>
                </a>
                <div class="sm:mt-10 mt-5 text-white">
                    <a class="font-semibold text-sm">
                    @php
                        $date = \Carbon\Carbon::parse($ngopinis->publishdate)->locale(App::getLocale());
                        $date->settings(['formatFunction' => 'translatedFormat']);
                        echo $date->format('d F Y');
                    @endphp
                    </a><span> | </span><a>{{$ngopinis->description}}</a>
                </div>
            </div>
        </div>
        <div class="absolute z-10  bottom-0 left-0   text-white w-3/12">
            <img src="{{ asset('img/elemen-light.png') }}" alt="auriga nusantara" class="z-10">
        </div>
    </div>
    <div class="max-w-6xl mb-12 mx-auto bg-auriga-biru flex w-full justify-between px-6 py-4">
        <a href="{{ route('ngopinis', app()->getlocale() )}}" class="text-white font-semibold">VIEW ALL NGOPINI</a>
        <a href="{{ route('ngopinis', app()->getlocale() )}}">
        <div class="rounded-full  border-white border md:flex justify-center items-center px-1 py-1 ">
            <svg xmlns="http://www.w3.org/2000/svg"  fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 font-bold text-white">
                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
              </svg>
        </div>
        </a>
    </div>

    {{-- report --}}
    <div class="bg-gray-200 sm:py-12 py-6">
        <div class="max-w-6xl mx-auto px-4">
            <div class=" grid md:grid-cols-2 grid-cols-1 md:gap-10 gap-36 sm:mt-32 mt-24">

                @foreach ($reports as $item)
                <!-- card -->
                    <div class="card md:px-12 bg-white py-6 grid">
                        <div class="card-header flex justify-center mx-4 -mt-24">
                            <img
                                class="h-96 object-center object-cover w-72"
                                src="{{ asset('storage/public/files/photos/'.$item->img) }}"
                                alt="tailwind-card-image"
                            />
                        </div>
                        <div class="card-body  md:w-96 w-full px-7">
                            <div class="flex space-x-4 mt-6  items-center text-gray-500">
                                <h1 class="font-semibold md:text-xl text-md">report</h1>
                            </div>
                            <a href="{{ asset('storage/public/files/reports/'.$item->file) }}">
                                <h1 class="mt-6 md:text-2xl text-xl font-bold  text-auriga-biru">
                                    {{$item->title}}
                                </h1>
                            </a>
                            <div class="mt-6  text-auriga-biru">
                                <a class="font-bold">
                                    @php
                                        $date = \Carbon\Carbon::parse($item->publishdate)->locale(App::getLocale());
                                        $date->settings(['formatFunction' => 'translatedFormat']);
                                        echo $date->format('d F Y');
                                    @endphp
                                </a><span> | </span><a>{{$item->description}}</a>
                            </div>
                        </div>
                    </div>
                @endforeach

                <div class="flex space-x-4 items-center sm:-mt-0 -mt-52">
                     <a href="{{ route('reports', app()->getlocale() )}}" class=" cursor-pointer text-black font-semibold">VIEW ALL REPORTS</a>

                    <a href="{{ route('reports', app()->getlocale() )}}" class="cursor-pointer">
                        <div class="rounded-full  border-black border md:flex justify-center items-center px-1 py-1 ">
                        <svg xmlns="http://www.w3.org/2000/svg"  fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 font-bold text-black">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                        </svg>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>



    @include('partials.footer')


@endsection
