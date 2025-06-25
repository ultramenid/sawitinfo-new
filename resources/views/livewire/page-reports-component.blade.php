<div class="max-w-6xl mx-auto px-4 mt-12">
    <div class="grid md:grid-cols-3 grid-cols-1 gap-10 md:mt-12 mt-6">
        @foreach ($data as $item)
             <!-- card -->
        <!-- card -->
                    <div class="card px-4 bg-gray-100 py-6  mt-12 flex flex-col items-center">
                        <div class="card-header flex justify-center mx-4 -mt-24">
                            <img
                                class="h-96 object-center object-cover w-72"
                                src="{{ asset('storage/public/files/photos/'.$item->img) }}"
                                alt="tailwind-card-image"
                            />
                        </div>
                        <div class="card-body  md:w-96 w-full px-7">

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

    </div>

    @if ($data)
            {{ $data->links('livewire.pagination') }}
        @endif
</div>
