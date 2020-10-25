<div class="h-full bg-secondary-100 p-3 md:p-8 flex flex-col">
    <div class="flex items-center justify-between" x-data="{ urlView: false }">
        <h1 class="mt-20 md:mt-16 text-lg md:text-2xl text-bold">Downloads</h1>
        <a download="gtfs_stm_extended.zip" href="{{ \Illuminate\Support\Facades\Storage::url('latest/gtfs_stm_extended.zip') }}"
           title="gtfs_stm_extended.zip" class="mt-20 md:mt-16 bg-secondary-500 p-2 rounded">
            Latest ZIP
            <svg class="ml-2 w-6 h-6 float-right" fill="currentColor" viewBox="0 0 24 24">
                <path fill="currentColor"
                      d="M20,6A2,2 0 0,1 22,8V18A2,2 0 0,1 20,20H4C2.89,20 2,19.1 2,18V6C2,4.89 2.89,4 4,4H10L12,6H20M19.25,13H16V9H14V13H10.75L15,17.25"></path>
            </svg>
        </a>
    </div>
    <div class="mt-4 w-full flex-grow flex gap-4 h-half">
        <ul class="bg-white shadow-lg rounded-lg flex-1 overflow-auto">
            @foreach($directories as $directory)
                <li class="group p-4 hover:bg-secondary-300 transition-colors duration-200 ease-in-out border-b last:border-b-0 @if($selectedDirectory === $directory) bg-secondary-200 @endif"
                    wire:click="setSelectedDirectory('{{ $directory }}')">
                    {{ basename($directory) }}
                    <svg class="ml-2 w-6 h-6 float-right transition-opacity duration-200 ease-in-out  @if($selectedDirectory !== $directory) opacity-0 group-hover:opacity-100 @endif"
                         fill="currentColor" viewBox="0 0 24 24">
                        <path fill="currentColor"
                              d="M8.59,16.58L13.17,12L8.59,7.41L10,6L16,12L10,18L8.59,16.58Z"></path>
                    </svg>
                </li>
            @endforeach
        </ul>
        <div class="flex-1">
            <ul>
                @foreach($files as $file)
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
    </div>
    <div class="mt-8">
        <a rel="license" href="http://creativecommons.org/licenses/by/4.0/"><img alt="Creative Commons License"
                                                                                 style="border-width:0"
                                                                                 src="https://i.creativecommons.org/l/by/4.0/88x31.png"
                                                                                 class="mb-1"/></a>This work is licensed
        under a <a rel="license" href="http://creativecommons.org/licenses/by/4.0/">Creative Commons Attribution 4.0
            International License</a>.
    </div>
</div>