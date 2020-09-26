@extends('layouts.base')

@section('body')
    <div class="flex flex-col h-screen">
        <div class="w-full h-20 md:h-16 bg-primary-500 fixed p-2 md:p-3 text-center md:text-left md:flex md:items-center md:justify-between">
            <h1 class="font-bold text-lg md:text-2xl text-white">Extras Catcher</h1>
            <div class="mt-2 mb-1 md:my-0">
                <a href="{{ route('home') }}" class="px-2 py-1 md:py-2 hover:bg-primary-600 text-white rounded {{ request()->routeIs('home') ? 'bg-primary-700' : '' }}">Trips</a>
                <a href="{{ route('stops') }}" class="px-2 py-1 md:py-2 hover:bg-primary-600 text-white rounded {{ request()->routeIs('stops') ? 'bg-primary-700' : '' }}">Stops</a>
                <a href="{{ route('download') }}" class="px-2 py-1 md:py-2 hover:bg-primary-600 text-white rounded {{ request()->routeIs('download') ? 'bg-primary-700' : '' }}">Download</a>
            </div>
        </div>
        @yield('content')
{{--        <div class="bg-primary-200 p-1 md:p-3 inline-flex items-center justify-between hover:bg-primary-500 hover:text-white transition-colors duration-200 ease-in-out">--}}
{{--            <a href="https://transittracker.ca" class="inline-flex items-center">--}}
{{--                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>--}}
{{--                <b>Return to Transit Tracker </b>--}}
{{--            </a>--}}
{{--            <span class="text-right">A project by <a href="https://github.com/felixinx">@felixinx</a></span>--}}
{{--        </div>--}}
    </div>
@endsection
