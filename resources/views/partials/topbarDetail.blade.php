{{-- topbar pc --}}
<section class="py-4 px-4 sm:block hidden sticky top-0 z-50 bg-auriga-biru">
    <div class="max-w-7xl mx-auto flex justify-end">
        <div class="sm:block hidden -mt-3">
            <div class="flex space-x-2 text-gray-300 text-sm">
                <a href="{{ route(Route::currentRouteName(), ['en', $data->slug]) }}"  class="cursor-pointer @if(App::getLocale() == 'en') text-white font-bold @endif">EN</a>
                <div class="border-l border-gray-300"></div>
                <a href="{{ route(Route::currentRouteName(), ['id', $data->slug]) }}"  class="cursor-pointer @if(App::getLocale() == 'id') text-white font-bold @endif ">ID</a>
            </div>
        </div>
    </div>
    <div class=" max-w-7xl  mx-auto flex w-full justify-between mt-3">
        <div class="text-white">
            <a href="{{ route('index', app()->getlocale() )}}" class="text-5xl  font-semibold">Sawit.Info</a>
        </div>
        <div class="space-x-6 flex justify-end items-center text-white">

            <div @click.away="open = false" class="relative py-2" x-data="{ open: false }">
                <button @click="open = !open" class="flex flex-row items-center w-full ">
                    <a  class="font-semibold text-xl">about</a>
                  <svg fill="currentColor" viewBox="0 0 20 20" :class="{'rotate-180': open, 'rotate-0': !open}" class="inline w-4 h-4 items-center mt-1 ml-1 transition-transform duration-200 transform "><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                </button>
                <div x-show="open" style="display: none !important;" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="absolute right-0 w-full mt-2 origin-top-right  shadow-lg md:w-48">
                    <div class="  bg-white shadow ">
                    <a class="text-auriga-biru block px-4 py-1 mt-2 text-sm font-semibold bg-transparent   md:mt-0 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline" href="{{ route('sawitinfo', app()->getlocale() )}}">sawit.info</a>
                  </div>
                  <div class="  bg-white shadow ">
                    <a class="text-auriga-biru block px-4 py-1 mt-2 text-sm font-semibold bg-transparent   md:mt-0 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline" href="{{ route('whoweare', app()->getlocale() )}}">who we are</a>
                  </div>
                </div>
            </div>
            <div class="py-2 hover:border-b hover:border-white">
                <a href="#" class="font-semibold text-xl">event</a>
            </div>

            <div class="py-2 hover:border-b hover:border-white">
                <a href="{{ route('insights', app()->getlocale() )}}" class="font-semibold text-xl">insight</a>
            </div>

            <div @click.away="open = false" class="relative py-2" x-data="{ open: false }">
                <button @click="open = !open" class="flex flex-row items-center w-full ">
                    <a  class="font-semibold text-xl">{{__('refrences')}}</a>
                  <svg fill="currentColor" viewBox="0 0 20 20" :class="{'rotate-180': open, 'rotate-0': !open}" class="inline w-4 h-4 items-center mt-1 ml-1 transition-transform duration-200 transform "><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                </button>
                <div x-show="open" style="display: none !important;" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="absolute right-0 w-full mt-2 origin-top-right  shadow-lg md:w-48">
                    <div class="  bg-white shadow ">
                    <a class="text-auriga-biru block px-4 py-1 mt-2 text-sm font-semibold bg-transparent   md:mt-0 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline" href="{{ route('reports', app()->getlocale() )}}">reports</a>
                  </div>
                  <div class="  bg-white shadow ">
                    <a class="text-auriga-biru block px-4 py-1 mt-2 text-sm font-semibold bg-transparent   md:mt-0 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline" href="{{ route('policyregulation', app()->getlocale() )}}">policy & regulation</a>
                  </div>
                </div>
            </div>
            <div class="py-2 hover:border-b hover:border-white">
                <a href="{{ route('ngopinis', app()->getlocale() )}}" class="font-semibold text-xl">ngopini</a>
            </div>
            {{-- <div class="py-2 hover:border-b hover:border-white">
                <a href="#" class="font-semibold text-xl">forum</a>
            </div> --}}
            {{-- <input type="text" class="bg-auriga-biru border-b border-white py-2 text-white text-sm focus:outline-none" placeholder="search sawit.info"> --}}
        </div>
    </div>
</section>
