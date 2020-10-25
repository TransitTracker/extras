@extends('layouts.app')

@section('content')
    <div class="flex flex-col md:flex-row h-full bg-secondary-200">
        <a href="https://github.com/transittracker/extras" class="block absolute bottom-3 md:bottom-8 left-3 md:left-8">
            <svg fill="currentColor" class="w-12 h-12" viewBox="0 0 24 24">
                <path fill="currentColor"
                      d="M12,2A10,10 0 0,0 2,12C2,16.42 4.87,20.17 8.84,21.5C9.34,21.58 9.5,21.27 9.5,21C9.5,20.77 9.5,20.14 9.5,19.31C6.73,19.91 6.14,17.97 6.14,17.97C5.68,16.81 5.03,16.5 5.03,16.5C4.12,15.88 5.1,15.9 5.1,15.9C6.1,15.97 6.63,16.93 6.63,16.93C7.5,18.45 8.97,18 9.54,17.76C9.63,17.11 9.89,16.67 10.17,16.42C7.95,16.17 5.62,15.31 5.62,11.5C5.62,10.39 6,9.5 6.65,8.79C6.55,8.54 6.2,7.5 6.75,6.15C6.75,6.15 7.59,5.88 9.5,7.17C10.29,6.95 11.15,6.84 12,6.84C12.85,6.84 13.71,6.95 14.5,7.17C16.41,5.88 17.25,6.15 17.25,6.15C17.8,7.5 17.45,8.54 17.35,8.79C18,9.5 18.38,10.39 18.38,11.5C18.38,15.32 16.04,16.16 13.81,16.41C14.17,16.72 14.5,17.33 14.5,18.26C14.5,19.6 14.5,20.68 14.5,21C14.5,21.27 14.66,21.59 15.17,21.5C19.14,20.16 22,16.42 22,12A10,10 0 0,0 12,2Z"/>
            </svg>
        </a>
        <a href="https://transittracker.ca/?pk_campaign=extras"
           class="block absolute bottom-3 md:bottom-8 left-16 md:left-24">
            <svg class="w-12 h-12 py-1" viewBox="0 0 295.012 403.722">
                <path fill="#2374ab" stroke="#2374ab" stroke-width="3.75"
                      d="M293.137 147.506c0-80.34-65.291-145.631-145.631-145.631S1.875 67.166 1.875 147.506c0 84.709 87.864 198.786 126.942 245.631 9.708 11.651 27.427 11.651 37.136 0 39.32-46.845 127.184-160.922 127.184-245.631z"/>
                <path fill="#fff"
                      d="M84.348 183.032c0 6.948 3.079 13.185 7.895 17.527v10.105a11.826 11.826 0 0011.842 11.842 11.826 11.826 0 0011.842-11.842v-3.947h63.158v3.947c0 6.474 5.289 11.842 11.842 11.842 6.474 0 11.842-5.289 11.842-11.842v-10.105c4.816-4.342 7.895-10.579 7.895-17.527v-78.947c0-27.632-28.263-31.579-63.158-31.579-34.895 0-63.158 3.947-63.158 31.579zm27.632 7.895a11.826 11.826 0 01-11.842-11.842 11.826 11.826 0 0111.842-11.842 11.826 11.826 0 0111.842 11.842c0 6.553-5.29 11.842-11.842 11.842zm71.052 0a11.826 11.826 0 01-11.842-11.842c0-6.553 5.29-11.842 11.842-11.842a11.826 11.826 0 0111.842 11.842 11.826 11.826 0 01-11.842 11.842zm11.842-47.368h-94.736v-39.474h94.736z"/>
            </svg>
        </a>
        <div class="flex-1 p-3 md:p-8 mt-20 md:mt-16 flex flex-col justify-center">
            <h1 class="text-3xl md:text-6xl font-bold text-center md:text-left">
                Welcome to Extras&nbsp;Catcher
            </h1>
            <h2 class="text-xl md:text-3xl font-bold text-center md:text-left mt-2 hidden md:block">
                A collaborative platform to create a complete static GTFS set of the STM network, including school and
                industrial trips. View all
                <a href="https://github.com/transittracker/extras" class="underline">contributors</a>.
            </h2>
            <div class="rounded bg-red-200 shadow p-2 md:p-3 mt-4 text-sm md:text-base">
                <b class="flex items-center">
                    <svg class="w-4 md:w-6 h-4 md:h-6 mr-1 md:mr-2" fill="currentColor" viewBox="0 0 24 24">
                        <path fill="currentColor"
                              d="M13 14H11V9H13M13 18H11V16H13M1 21H23L12 2L1 21Z"/>
                    </svg>
                    For information only.
                </b>
                Never use the information presented here for transportation purpose. Don't try to board a bus with a
                trip listed here without proper authorization.
            </div>
        </div>
        <div class="flex-1 md:mt-16 flex justify-center items-start md:items-center">
            <div class="bg-primary-500 overflow-hidden text-white shadow-lg rounded-lg">
                <a class="flex items-center justify-between p-3 md:p-8 border-b border-white hover:bg-primary-600 transition-colors duration-200 ease-in-out"
                   href="{{ route('trips') }}">
                    <h2 class="text-xl md:text-3xl font-bold">Trips</h2>
                    <svg fill="currentColor" class="ml-12 w-6 md:w-12 h-6 md:h-12" viewBox="0 0 24 24">
                        <path fill="currentColor"
                              d="M4,11V13H16L10.5,18.5L11.92,19.92L19.84,12L11.92,4.08L10.5,5.5L16,11H4Z"/>
                    </svg>
                </a>
                <a class="flex items-center justify-between p-3 md:p-8 border-b border-white hover:bg-primary-600 transition-colors duration-200 ease-in-out"
                   href="{{ route('stops') }}">
                    <h2 class="text-xl md:text-3xl font-bold">Stops</h2>
                    <svg fill="currentColor" class="ml-12 w-6 md:w-12 h-6 md:h-12" viewBox="0 0 24 24">
                        <path fill="currentColor"
                              d="M4,11V13H16L10.5,18.5L11.92,19.92L19.84,12L11.92,4.08L10.5,5.5L16,11H4Z"/>
                    </svg>
                </a>
                <a class="flex items-center justify-between p-3 md:p-8 hover:bg-primary-600 transition-colors duration-200 ease-in-out"
                   href="{{ route('downloads') }}">
                    <h2 class="text-xl md:text-3xl font-bold">Downloads</h2>
                    <svg fill="currentColor" class="ml-12 w-6 md:w-12 h-6 md:h-12" viewBox="0 0 24 24">
                        <path fill="currentColor"
                              d="M4,11V13H16L10.5,18.5L11.92,19.92L19.84,12L11.92,4.08L10.5,5.5L16,11H4Z"/>
                    </svg>
                </a>
            </div>
        </div>
    </div>
@endsection