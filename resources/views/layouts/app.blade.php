@extends('layouts.base')

@section('body')
    <div class="flex flex-col h-screen">
        <div class="w-full h-20 md:h-16 bg-primary-500 fixed md:static p-2 md:p-3 text-center md:text-left md:flex md:items-center z-10">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="w-8 h-8 fill-current text-white mr-4 hidden md:block">
                <path d="M190.171 0C295.2 0 380.343 85.143 380.343 190.171c0 47.104-17.262 90.405-45.641 123.758l7.899 7.9h23.113L512 468.114 468.114 512 321.829 365.714v-23.113l-7.9-7.899c-33.353 28.379-76.654 45.641-123.758 45.641C85.143 380.343 0 295.2 0 190.171 0 85.143 85.143 0 190.171 0zm0 58.514c-73.142 0-131.657 58.515-131.657 131.657 0 73.143 58.515 131.658 131.657 131.658 73.143 0 131.658-58.515 131.658-131.658 0-73.142-58.515-131.657-131.658-131.657z"/>
                <path d="M132.684 222.508c0 6.324 2.802 12.001 7.186 15.953v9.198a10.764 10.764 0 0010.779 10.779 10.765 10.765 0 0010.779-10.779v-3.593h57.487v3.593c0 5.893 4.815 10.779 10.779 10.779 5.893 0 10.779-4.815 10.779-10.779v-9.198c4.384-3.952 7.186-9.629 7.186-15.953v-71.859c0-25.151-25.726-28.744-57.488-28.744s-57.487 3.593-57.487 28.744v71.859zm25.151 7.186a10.764 10.764 0 01-10.779-10.779 10.764 10.764 0 0110.779-10.779 10.765 10.765 0 0110.779 10.779 10.764 10.764 0 01-10.779 10.779zm64.673 0a10.764 10.764 0 01-10.779-10.779 10.765 10.765 0 0110.779-10.779 10.764 10.764 0 0110.779 10.779 10.764 10.764 0 01-10.779 10.779zm10.779-43.116l-86.231-.015v-35.914h86.231v35.929z"/>
            </svg>
            <a href="{{ route('home') }}" class="font-bold text-lg md:text-2xl text-white">Extras Catcher</a>
            <div class="md:flex-grow"></div>
            <div class="mt-2 mb-1 md:my-0">
                <a href="{{ route('trips') }}" class="px-2 py-1 md:py-2 hover:bg-primary-600 text-white rounded {{ request()->routeIs('trips') || request()->routeIs('trips.show') ? 'bg-primary-700' : '' }}">Trips</a>
                <a href="{{ route('stops') }}" class="px-2 py-1 md:py-2 hover:bg-primary-600 text-white rounded {{ request()->routeIs('stops') || request()->routeIs('stops.show') ? 'bg-primary-700' : '' }}">Stops</a>
                <a href="{{ route('downloads') }}" class="px-2 py-1 md:py-2 hover:bg-primary-600 text-white rounded {{ request()->routeIs('downloads') ? 'bg-primary-700' : '' }}">Downloads</a>
            </div>
        </div>
        <div class="flex-grow w-full relative" x-data="{ showMap: false }">
{{--            <button class="absolute top-3 md:top-8 right-0 bg-white hover:bg-secondary-700 text-secondary-700 hover:text-white transition-colors p-4 z-10 shadow rounded-l-lg" x-show="!showMap" @click="showMap = true">--}}
{{--                <svg class="w-6 h-6" viewBox="0 0 24 24">--}}
{{--                    <path fill="currentColor" d="M18,15A3,3 0 0,1 21,18A3,3 0 0,1 18,21C16.69,21 15.58,20.17 15.17,19H14V17H15.17C15.58,15.83 16.69,15 18,15M18,17A1,1 0 0,0 17,18A1,1 0 0,0 18,19A1,1 0 0,0 19,18A1,1 0 0,0 18,17M18,8A1.43,1.43 0 0,0 19.43,6.57C19.43,5.78 18.79,5.14 18,5.14C17.21,5.14 16.57,5.78 16.57,6.57A1.43,1.43 0 0,0 18,8M18,2.57A4,4 0 0,1 22,6.57C22,9.56 18,14 18,14C18,14 14,9.56 14,6.57A4,4 0 0,1 18,2.57M8.83,17H10V19H8.83C8.42,20.17 7.31,21 6,21A3,3 0 0,1 3,18C3,16.69 3.83,15.58 5,15.17V14H7V15.17C7.85,15.47 8.53,16.15 8.83,17M6,17A1,1 0 0,0 5,18A1,1 0 0,0 6,19A1,1 0 0,0 7,18A1,1 0 0,0 6,17M6,3A3,3 0 0,1 9,6C9,7.31 8.17,8.42 7,8.83V10H5V8.83C3.83,8.42 3,7.31 3,6A3,3 0 0,1 6,3M6,5A1,1 0 0,0 5,6A1,1 0 0,0 6,7A1,1 0 0,0 7,6A1,1 0 0,0 6,5M11,19V17H13V19H11M7,13H5V11H7V13Z" />--}}
{{--                </svg>--}}
{{--            </button>--}}
{{--            <x-map-view />--}}
            @yield('content')
            @isset($slot)
                {{ $slot }}
            @endisset
        </div>
{{--        <div class="bg-primary-200 p-1 md:p-3 inline-flex items-center justify-between hover:bg-primary-500 hover:text-white transition-colors duration-200 ease-in-out">--}}
{{--            <a href="https://transittracker.ca" class="inline-flex items-center">--}}
{{--                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>--}}
{{--                <b>Return to Transit Tracker </b>--}}
{{--            </a>--}}
{{--            <span class="text-right">A project by <a href="https://github.com/felixinx">@felixinx</a></span>--}}
{{--        </div>--}}
    </div>
@endsection

<script>

</script>
