<div class="max-w-6xl mx-auto px-4 mt-12">
    <div class="grid md:grid-cols-3 grid-cols-1 gap-10 md:mt-12 mt-6">
        @foreach ($data as $item)
             <!-- card -->
        <div class="flex flex-col  text-auriga-biru">
            <img
            class="md:w-106 w-full h-52 object-cover border border-gray-50"
            src="{{ asset('storage/public/files/photos/'.$item->img) }}"
            alt="">
            <div class="flex space-x-4 mt-3 items-center text-gray-500">
                <h1 class="font-semibold md:text-xl text-md">{{$item->category}}</h1>
            </div>
            <a href="{{ route('slug', [app()->getLocale(),  $item->slug]) }}">
                <h1 class="md:mt-6 mt-3 md:text-3xl text-xl font-bold ">{{$item->title}}
            </a>
            </h1>
            <div class="md:mt-6 mt-3 ">
                <a class="font-bold">
                    @php
                        $date = \Carbon\Carbon::parse($item->publishdate)->locale(App::getLocale());
                        $date->settings(['formatFunction' => 'translatedFormat']);
                        echo $date->format('F Y');
                    @endphp
                </a><span> | </span><a>{{$item->description}}</a>
            </div>
       </div>
        @endforeach

    </div>

    @if ($data)
            {{ $data->links('livewire.pagination') }}
        @endif
</div>
