@extends('layouts.app')

@section('content')
<div class="flex items-center h-full mt-0 md:mt-16 bg-secondary-200">
    <div class="mx-auto text-center text-primary-500 hover:text-primary-800 transition-colors duration-500">
        <svg class="w-12 md:w-24 h-12 md:h-24 mx-auto mb-2 md:mb-4" fill="currentColor" viewBox="0 0 24 24">
            <path fill="currentColor" d="M13,2.03C17.73,2.5 21.5,6.25 21.95,11C22.5,16.5 18.5,21.38 13,21.93V19.93C16.64,19.5 19.5,16.61 19.96,12.97C20.5,8.58 17.39,4.59 13,4.05V2.05L13,2.03M11,2.06V4.06C9.57,4.26 8.22,4.84 7.1,5.74L5.67,4.26C7.19,3 9.05,2.25 11,2.06M4.26,5.67L5.69,7.1C4.8,8.23 4.24,9.58 4.05,11H2.05C2.25,9.04 3,7.19 4.26,5.67M2.06,13H4.06C4.24,14.42 4.81,15.77 5.69,16.9L4.27,18.33C3.03,16.81 2.26,14.96 2.06,13M7.1,18.37C8.23,19.25 9.58,19.82 11,20V22C9.04,21.79 7.18,21 5.67,19.74L7.1,18.37M12,16.5L7.5,12H11V8H13V12H16.5L12,16.5Z" />
        </svg>
        <h1 class="text-lg md:text-2xl">Coming soon</h1>
    </div>
{{--    <div class="w-full bg-primary-500 p-3 md:px-8 md:py-3">--}}
{{--        <a href="{{ route('home') }}" class="text-white">Back</a>--}}
{{--    </div>--}}
{{--    <div class="flex-grow w-full flex flex-col p-2 md:p-8">--}}
{{--        <ul>--}}
{{--            @foreach($files as $file)--}}
{{--                <li>--}}
{{--                    <a download="{{ basename($file) }}" href="{{ \Illuminate\Support\Facades\Storage::url($file) }}" title="{{ basename($file) }}" class="underline list-disc">--}}
{{--                        {{ basename($file) }}--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--            @endforeach--}}
{{--        </ul>--}}
{{--    </div>--}}
</div>
@endsection