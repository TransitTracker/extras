@section('title', 'Stops')

<div class="flex flex-col md:flex-row h-full">
    <div class="flex-1 md:shadow-lg bg-white mt-20 md:mt-0 h-half md:h-full">
        <div class="p-3 md:flex justify-between border-b border-gray-200 bg-white sticky top-20 md:top-16 md:h-16">
            <div class="flex justify-between gap-2 w-full">
                <input aria-label="Search by id" wire:model="searchId" type="text"
                       class="appearance-none rounded px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 text-sm w-full"
                       placeholder="Search by id...">
                <input aria-label="Search by name" wire:model="searchName" type="text"
                       class="appearance-none rounded px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 text-sm w-full"
                       placeholder="Search by name...">
            </div>
        </div>
        <ul class="text-sm md:text-base max-h-40-screen md:max-h-(screen-32) overflow-auto">
            @forelse($stops as $stop)
                <li class="flex items-center cursor-pointer hover:bg-secondary-300 p-2 md:p-3 transition-colors duration-200 ease-in-out {{ !$selectedStop ? '' : ($selectedStop->stop_id === $stop->stop_id ? 'bg-secondary-200' : '') }}"
                    wire:click="selectStop({{ $stop->stop_id }})" wire:key="{{ $stop->stop_id }}">
                    <p class="hover:text-gray-900 mr-2">{{ $stop->stop_id }}</p>
                    <p class="flex-grow text-right text-sm text-gray-900">{{ $stop->stop_name }}</p>
                </li>
            @empty
                <div class="px-6 py-3">No stops are matching your search</div>
            @endforelse
            {{ $stops->links('livewire.custom-pagination') }}
        </ul>
    </div>
    <div class="flex-1 p-3 md:p-8 bg-secondary-100 h-half md:h-(screen-16) overflow-x-auto"">
        @if($selectedStop)
            <div class="text-sm md:text-base">
                <div class="md:flex items-center mb-4">
                    <h1 class="text-xl md:text-2xl flex-grow">Stop <b>{{ $selectedStop->stop_id }}</b> {{ $selectedStop->stop_name }}</h1>
                </div>
                @if($selectedStop->stop_lat && $selectedStop->stop_lon)
                    <div class="w-full mb-2">
                        <iframe class="rounded shadow" width="100%" height="300" frameborder="0" scrolling="no"
                                marginheight="0" marginwidth="0"
                                src="https://maps.google.com/maps?width=100%25&amp;height=300&amp;hl=en&amp;q={{$selectedStop->stop_lat}},{{$selectedStop->stop_lon}}&amp;t=&amp;z=17&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe>
                    </div>
                @endif

                <div class="rounded shadow my-4" x-data="{open:false}">
                    @if($selectedStop->stop_name === 'TBD')
                        <div class="p-1 md:p-3 bg-yellow-200 flex cursor-pointer" @click="open = !open">
                            <b class="flex-grow inline-flex">
                                <svg class="w-6 h-6 mr-1 md:mr-2" fill="currentColor" viewBox="0 0 24 24">
                                    <path fill="currentColor" d="M10,19H13V22H10V19M12,2C17.35,2.22 19.68,7.62 16.5,11.67C15.67,12.67 14.33,13.33 13.67,14.17C13,15 13,16 13,17H10C10,15.33 10,13.92 10.67,12.92C11.33,11.92 12.67,11.33 13.5,10.67C15.92,8.43 15.32,5.26 12,5A3,3 0 0,0 9,8H6A6,6 0 0,1 12,2Z" />
                                </svg>
                                No data
                            </b>
                            <p class="inline-flex">
                                <svg class="w-6 h-6 mr-1 md:mr-2" fill="currentColor" viewBox="0 0 24 24">
                                    <path fill="currentColor" d="M20.71,7.04C21.1,6.65 21.1,6 20.71,5.63L18.37,3.29C18,2.9 17.35,2.9 16.96,3.29L15.12,5.12L18.87,8.87M3,17.25V21H6.75L17.81,9.93L14.06,6.18L3,17.25Z" />
                                </svg>
                                Make a suggestion
                            </p>
                        </div>
                    @else
                        <div class="p-1 md:p-3 bg-green-200 flex cursor-pointer" @click="open = !open">
                            <b class="flex-grow inline-flex">
                                <svg class="w-6 h-6 mr-1 md:mr-2" fill="currentColor" viewBox="0 0 24 24">
                                    <path fill="currentColor" d="M4,2H20A2,2 0 0,1 22,4V16A2,2 0 0,1 20,18H13.9L10.2,21.71C10,21.9 9.75,22 9.5,22V22H9A1,1 0 0,1 8,21V18H4A2,2 0 0,1 2,16V4C2,2.89 2.9,2 4,2M12.19,5.5C11.3,5.5 10.59,5.68 10.05,6.04C9.5,6.4 9.22,7 9.27,7.69H11.24C11.24,7.41 11.34,7.2 11.5,7.06C11.7,6.92 11.92,6.85 12.19,6.85C12.5,6.85 12.77,6.93 12.95,7.11C13.13,7.28 13.22,7.5 13.22,7.8C13.22,8.08 13.14,8.33 13,8.54C12.83,8.76 12.62,8.94 12.36,9.08C11.84,9.4 11.5,9.68 11.29,9.92C11.1,10.16 11,10.5 11,11H13C13,10.72 13.05,10.5 13.14,10.32C13.23,10.15 13.4,10 13.66,9.85C14.12,9.64 14.5,9.36 14.79,9C15.08,8.63 15.23,8.24 15.23,7.8C15.23,7.1 14.96,6.54 14.42,6.12C13.88,5.71 13.13,5.5 12.19,5.5M11,12V14H13V12H11Z" />
                                </svg>
                                Incorrect?
                            </b>
                            <p class="inline-flex">
                                <svg class="w-6 h-6 mr-1 md:mr-2" fill="currentColor" viewBox="0 0 24 24">
                                    <path fill="currentColor" d="M20.71,7.04C21.1,6.65 21.1,6 20.71,5.63L18.37,3.29C18,2.9 17.35,2.9 16.96,3.29L15.12,5.12L18.87,8.87M3,17.25V21H6.75L17.81,9.93L14.06,6.18L3,17.25Z" />
                                </svg>
                                Make a suggestion
                            </p>
                        </div>
                    @endif
                    @if(count($selectedStop->suggestions) > 0)
                        <div class="p-1 md:p-3 bg-white text-sm" x-bind:style="open ? '' : 'display:none'">
                            <b>Previous suggestions:</b>
                            <ul>
                                @foreach($selectedStop->suggestions as $suggestion)
                                    <li>{{ $suggestion->payload['stop_name'] }}
                                        at {{ $suggestion->payload['stop_location'] }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="p-1 md:p-3 bg-white" x-bind:style="open ? '' : 'display:none'">
                        @if($formSuccess)
                            <div class="flex flex-col items-center">
                                <svg class="w-10 h-10 text-green-500" fill="currentColor" viewBox="0 0 24 24">
                                    <path fill="currentColor" d="M21,7L9,19L3.5,13.5L4.91,12.09L9,16.17L19.59,5.59L21,7Z" />
                                </svg>
                                Thanks for your suggestion!
                            </div>
                        @else
                            <form wire:submit.prevent="formSubmit" class="text-sm">
                                <input aria-label="Stop name" wire:model="formName" type="text" required
                                       class="appearance-none rounded px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 w-full mb-2"
                                       placeholder="Name">
                                @error('formName') <p class="text-red-600 mb-2 text-sm">{{ $message }}</p> @enderror
                                <input aria-label="Stop location" wire:model="formLocation" type="text" required
                                       class="appearance-none rounded px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 w-full mb-2"
                                       placeholder="Location (street corner, address or coordinates)">
                                @error('formLocation') <p class="text-red-600 mb-2 text-sm">{{ $message }}</p> @enderror
                                <input aria-label="Real stop" wire:model="formRealStop" type="text"
                                       class="appearance-none rounded px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 w-full mb-2"
                                       placeholder="Real stop (if any)">
                                @error('formRealStop') <p class="text-red-600 mb-2 text-sm">{{ $message }}</p> @enderror
                                <input aria-label="Your username" wire:model="formUsername" type="text"
                                       class="appearance-none rounded px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 w-full mb-2"
                                       placeholder="Your username">
                                @error('formUsername') <p class="text-red-600 mb-2 text-sm">{{ $message }}</p> @enderror

                                <div class="flex items-center justify-between">
                                    <button type="submit" class="bg-secondary-500 rounded p-2 hover:bg-secondary-700 hover:text-white mr-4">
                                        Submit
                                    </button>
                                    <p class="text-sm text-gray-700 italic">If the username field is filled, you will be credited on <a href="https://github.com/transittracker/extras#Contributors" class="text-primary-600">this page</a>.</p>
                                </div>
                            </form>
                        @endif
                    </div>
                </div>
                <table class="rounded border-b border-gray-200 text-xs md:text-base w-full bg-white">
                    <thead class="bg-gray-500 text-white">
                    <tr>
                        <th class="text-left p-1 md:p-2">Trip ID</th>
                        <th class="text-left p-1 md:p-2">Route</th>
                        <th class="text-left p-1 md:p-2">Headsign</th>
                    </tr>
                    </thead>
                    <tbody class="text-gray-700">
                    @foreach($selectedStop->trips() as $trip)
                        <tr wire:key="{{ $trip->trip_id }}">
                            <th scope="row">
                                <a href="{{ route('trips.show', $trip->trip_id) }}" class="underline">{{ $trip->trip_id }}</a>
                            </th>
                            <td>{{ $trip->route_id }}</td>
                            <td>{{ $trip->trip_headsign }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="md:sticky md:top-32 h-full md:h-auto flex md:block items-center">
                <div class="text-center mx-auto">
                    <svg class="w-12 md:w-24 h-12 md:h-24 text-primary-500 mx-auto mb-2 md:mb-4" fill="currentColor" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M10.76,8.69A0.76,0.76 0 0,0 10,9.45V20.9C10,21.32 10.34,21.66 10.76,21.66C10.95,21.66 11.11,21.6 11.24,21.5L13.15,19.95L14.81,23.57C14.94,23.84 15.21,24 15.5,24C15.61,24 15.72,24 15.83,23.92L18.59,22.64C18.97,22.46 19.15,22 18.95,21.63L17.28,18L19.69,17.55C19.85,17.5 20,17.43 20.12,17.29C20.39,16.97 20.35,16.5 20,16.21L11.26,8.86L11.25,8.87C11.12,8.76 10.95,8.69 10.76,8.69M15,10V8H20V10H15M13.83,4.76L16.66,1.93L18.07,3.34L15.24,6.17L13.83,4.76M10,0H12V5H10V0M3.93,14.66L6.76,11.83L8.17,13.24L5.34,16.07L3.93,14.66M3.93,3.34L5.34,1.93L8.17,4.76L6.76,6.17L3.93,3.34M7,10H2V8H7V10" />
                    </svg>
                    <h1 class="text-primary-500 text-lg md:text-2xl">Select a stop to get started</h1>
                </div>
            </div>
        @endif
    </div>
</div>