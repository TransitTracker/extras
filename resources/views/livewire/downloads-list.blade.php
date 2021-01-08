@section('title', 'Downloads')

<div class="h-full bg-secondary-100 p-3 md:p-8 grid grid-cols-2 gap-2 md:gap-8 auto-rows-min">
    <h1 class="text-lg md:text-2xl font-bold col-span-2">Downloads</h1>
    <div class="bg-white shadow-lg rounded-lg row-span-2 p-2 md:p-4">
        <h2 class="md:text-lg font-medium mb-2">Keep in mind</h2>
        <div class="space-y-2">
            <div class="flex items-center gap-x-2">
                <div class="flex-none w-10 h-10 bg-red-500 text-white rounded-full leading-10">
                    <svg class="h-6 m-2" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M12 2C17.5 2 22 6.5 22 12S17.5 22 12 22 2 17.5 2 12 6.5 2 12 2M12 4C10.1 4 8.4 4.6 7.1 5.7L18.3 16.9C19.3 15.5 20 13.8 20 12C20 7.6 16.4 4 12 4M16.9 18.3L5.7 7.1C4.6 8.4 4 10.1 4 12C4 16.4 7.6 20 12 20C13.9 20 15.6 19.4 16.9 18.3Z" />
                    </svg>
                </div>
                <p>Trips may not be open to the public</p>
            </div>
            <div class="flex items-center gap-x-2">
                <div class="flex-none w-10 h-10 bg-secondary-500 rounded-full leading-10">
                    <svg class="h-6 m-2" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M12,20A8,8 0 0,0 20,12A8,8 0 0,0 12,4A8,8 0 0,0 4,12A8,8 0 0,0 12,20M12,2A10,10 0 0,1 22,12A10,10 0 0,1 12,22C6.47,22 2,17.5 2,12A10,10 0 0,1 12,2M12.5,7V12.25L17,14.92L16.25,16.15L11,13V7H12.5Z" />
                    </svg>
                </div>
                <p>The times at stops are the latest predictions generated by the STM server</p>
            </div>
            <div class="flex items-center gap-x-2">
                <div class="flex-none w-10 h-10 bg-secondary-500 rounded-full leading-10">
                    <svg class="h-6 m-2" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M19 3H18V1H16V3H8V1H6V3H5C3.89 3 3 3.89 3 5V19C3 20.1 3.89 21 5 21H19C20.1 21 21 20.1 21 19V5C21 3.89 20.1 3 19 3M19 19H5V8H19V19M12 17V15H8V12H12V10L16 13.5L12 17Z" />
                    </svg>
                </div>
                <p>The first ZIP file is available the day after the first day of the board period. After a week, all trips should be included</p>
            </div>
            <div class="flex items-center gap-x-2">
                <div class="flex-none w-10 h-10 bg-secondary-500 rounded-full leading-10">
                    <svg class="h-6 m-2" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M11.89,10.34L10.55,11.04C10.41,10.74 10.24,10.53 10.03,10.41C9.82,10.29 9.62,10.23 9.45,10.23C8.55,10.23 8.11,10.82 8.11,12C8.11,12.54 8.22,12.97 8.45,13.29C8.67,13.61 9,13.77 9.45,13.77C10.03,13.77 10.44,13.5 10.68,12.91L11.91,13.54C11.65,14.03 11.29,14.41 10.82,14.69C10.36,14.97 9.85,15.11 9.29,15.11C8.39,15.11 7.67,14.84 7.12,14.29C6.58,13.74 6.3,13 6.3,12C6.3,11.05 6.58,10.3 7.13,9.74C7.69,9.18 8.39,8.9 9.23,8.9C10.47,8.89 11.36,9.38 11.89,10.34M17.66,10.34L16.34,11.04C16.2,10.74 16,10.53 15.81,10.41C15.6,10.29 15.4,10.23 15.21,10.23C14.32,10.23 13.87,10.82 13.87,12C13.87,12.54 14,12.97 14.21,13.29C14.44,13.61 14.77,13.77 15.21,13.77C15.8,13.77 16.21,13.5 16.45,12.91L17.7,13.54C17.42,14.03 17.05,14.41 16.59,14.69C16.12,14.97 15.62,15.11 15.07,15.11C14.17,15.11 13.44,14.84 12.9,14.29C12.36,13.74 12.09,13 12.09,12C12.09,11.05 12.37,10.3 12.92,9.74C13.47,9.18 14.17,8.9 15,8.9C16.26,8.89 17.14,9.38 17.66,10.34M12,3.5A8.5,8.5 0 0,1 20.5,12A8.5,8.5 0 0,1 12,20.5A8.5,8.5 0 0,1 3.5,12A8.5,8.5 0 0,1 12,3.5M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10,10 0 0,0 12,2Z" />
                    </svg>
                </div>
                <p>Data is released under the same license as the STM, <a href="http://creativecommons.org/licenses/by/4.0/" class="underline">Creative Commons Attribution 4.0</a></p>
            </div>
        </div>

        <h2 class="md:text-lg font-medium mt-4 mb-2">How it works</h2>
        <p>Throughout the day, Extras Catcher will pick up any trips with route ending in E or I. Then, these trips will be matched to existing stops in the database.</p>

        <h2 class="md:text-lg font-medium mt-4 mb-2">Route types</h2>
        <ul class="space-y-2">
            <li>
                <span class="p-1 bg-stm-green rounded text-white">Ecole</span> trips are special trips running to or from a school.
            </li>
            <li>
                <span class="p-1 bg-stm-yellow rounded">Industriel</span> trips are special trips running to or from a specific enterprise or an industrial neighbourhood.
            </li>
            <li>
                <span class="p-1 bg-stm-blue rounded text-white">Regular</span> trips are from the original GTFS set and have not been modified.
            </li>
        </ul>

        <h2 class="md:text-lg font-medium mt-4 mb-2">Route types</h2>
        <p>The current board period is <span class="bg-gray-100 p-1">{{ $period->period }}</span> and is valid from <span class="bg-gray-100 p-1">{{ $period->start_date }}</span> to <span class="bg-gray-100 p-1">{{ $period->end_date }}</span>.</p>
    </div>
    <a download="gtfs_stm_extended.zip" href="{{ \Illuminate\Support\Facades\Storage::url('latest/gtfs_stm_extended.zip') }}"
       title="gtfs_stm_extended.zip" class="bg-secondary-500 hover:bg-secondary-700 hover:text-white transition-colors p-2 md:p-4 rounded-lg shadow-lg flex flex-col items-center justify-center gap-y-2 md:text-lg">
        Latest ZIP
        <svg class="w-6 md:w-10 h-6 md:h-10 float-right" fill="currentColor" viewBox="0 0 24 24">
            <path fill="currentColor"
                  d="M20,6A2,2 0 0,1 22,8V18A2,2 0 0,1 20,20H4C2.89,20 2,19.1 2,18V6C2,4.89 2.89,4 4,4H10L12,6H20M19.25,13H16V9H14V13H10.75L15,17.25"></path>
        </svg>
    </a>
    <div class="bg-white shadow-lg rounded-lg flex-1 overflow-auto">
        <h2 class="md:text-lg font-medium my-2 px-4">Archives</h2>
        <ul class="divide-y" x-data="{selectedDirectory: '' }">
            @foreach($directories as $directory)
                <li class="transition-colors duration-200 ease-in-out" x-bind:style="selectedDirectory === '{{ $directory }}' ? 'bg-secondary-200' : 'hover:bg-secondary-300'">
                    <div class="p-4 group" @click="selectedDirectory = (selectedDirectory === '{{ $directory }}' ? '' : '{{ $directory }}')">
                        {{ basename($directory) }}
                        <svg class="ml-2 w-6 h-6 float-right transition-opacity duration-200 ease-in-out transform transition-transform"
                             x-bind:style="{'-rotate-90': selectedDirectory === '{{ $directory }}', 'rotate-90': selectedDirectory !== '{{ $directory }}'}"
                             fill="currentColor" viewBox="0 0 24 24">
                            <path fill="currentColor"
                                  d="M8.59,16.58L13.17,12L8.59,7.41L10,6L16,12L10,18L8.59,16.58Z"></path>
                        </svg>
                    </div>
                    <div class="flex-1" x-show="selectedDirectory === '{{ $directory }}'" >
                        <ul>
                            @foreach(\Illuminate\Support\Facades\Storage::files($directory) as $file)
                                <li class="p-4 border-b last:border-b-0 hover:bg-secondary-200 transition-colors duration-200 ease-in-out">
                                    <a download="{{ basename($file) }}" href="{{ \Illuminate\Support\Facades\Storage::url($file) }}"
                                       title="{{ basename($file) }}">
                                        {{ basename($file) }}
                                        <svg class="ml-2 w-6 h-6 float-right" fill="currentColor" viewBox="0 0 24 24">
                                            <path fill="currentColor"
                                                  d="@if(strpos($file, '.zip') !== false) M20,6A2,2 0 0,1 22,8V18A2,2 0 0,1 20,20H4C2.89,20 2,19.1 2,18V6C2,4.89 2.89,4 4,4H10L12,6H20M19.25,13H16V9H14V13H10.75L15,17.25 @else M5,20H19V18H5M19,9H15V3H9V9H5L12,16L19,9Z @endif"></path>
                                        </svg>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
</div>