@section('title', 'Trips')

<div class="flex flex-col md:flex-row h-full">
    <div class="flex-1 md:shadow-lg bg-white mt-20 md:mt-0 h-half md:h-full">
        <div class="p-3 md:flex justify-between border-b border-gray-200 bg-white sticky top-20 md:top-16 md:h-16">
            <div class="flex justify-between gap-2 w-full">
                <input aria-label="Search by trip" wire:model="searchTrip" type="text"
                       class="appearance-none rounded px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 text-sm w-full"
                       placeholder="Search by trip id...">
                <input aria-label="Search by route" wire:model="searchRoute" type="text"
                       class="appearance-none rounded px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 text-sm w-full"
                       placeholder="Search by route...">
            </div>
        </div>
        <ul class="text-sm md:text-base max-h-40-screen md:max-h-(screen-32) overflow-auto">
            @forelse($trips as $trip)
                <li class="flex items-center cursor-pointer hover:bg-secondary-300 p-2 md:p-3 transition-colors duration-200 ease-in-out {{ !$selectedTrip ? '' : ($selectedTrip->trip_id === $trip->trip_id ? 'bg-secondary-200' : '') }}"
                    wire:click="selectTrip({{ $trip->trip_id }})" wire:key="{{ $trip->trip_id }}">
                    <p class="hover:text-gray-900 mr-2">{{ $trip->trip_id }}</p>
                    <span class="px-1 md:px-2 inline-flex text-xs leading-5 font-semibold rounded-full @if((bool) strpos($trip->route_id, 'E')) bg-stm-green text-white @else bg-stm-yellow text-black @endif">
                      {{ $trip->route_id }}
                    </span>
                    <p class="flex-grow text-right text-sm text-gray-900">{{ \Carbon\Carbon::parse($trip->note_en)->diffForHumans() }}</p>
                </li>
            @empty
                <div class="px-6 py-3">No trips are matching your search</div>
            @endforelse
            {{ $trips->links('livewire.custom-pagination') }}
        </ul>
    </div>
    <div class="flex-1 p-3 md:p-8 bg-secondary-100 h-half md:h-(screen-16) overflow-x-auto">
        @if($selectedTrip)
            <div class="text-sm md:text-base" x-data="{ showAll: false }">
                <div class="md:flex items-center mb-4">
                    <h1 class="text-xl md:text-2xl flex-grow">Trip {{ $selectedTrip->trip_id }}
                        on {{ $selectedTrip->route_id }}</h1>
                </div>
                <ul>
                    <li class="flex mb-2">
                        <svg fill="currentColor" class="w-4 md:w-6 h-4 md:h-6 mr-2" viewBox="0 0 24 24">
                            <path fill="currentColor"
                                  d="M19,19H5V8H19M16,1V3H8V1H6V3H5C3.89,3 3,3.89 3,5V19A2,2 0 0,0 5,21H19A2,2 0 0,0 21,19V5C21,3.89 20.1,3 19,3H18V1M17,12H12V17H17V12Z"/>
                        </svg>
                        First seen: {{ $selectedTrip->created_at }}
                    </li>
                    <li class="flex mb-2">
                        <svg viewBox="0 0 24 24" fill="currentColor" class="w-4 md:w-6 h-4 md:h-6 mr-2">
                            <path fill="currentColor"
                                  d="M18,11V12.5C21.19,12.5 23.09,16.05 21.33,18.71L20.24,17.62C21.06,15.96 19.85,14 18,14V15.5L15.75,13.25L18,11M18,22V20.5C14.81,20.5 12.91,16.95 14.67,14.29L15.76,15.38C14.94,17.04 16.15,19 18,19V17.5L20.25,19.75L18,22M19,3H18V1H16V3H8V1H6V3H5A2,2 0 0,0 3,5V19A2,2 0 0,0 5,21H14C13.36,20.45 12.86,19.77 12.5,19H5V8H19V10.59C19.71,10.7 20.39,10.94 21,11.31V5A2,2 0 0,0 19,3Z"/>
                        </svg>
                        Last seen: {{ $selectedTrip->updated_at }}
                    </li>
                    <li class="flex mb-2">
                        <svg viewBox="0 0 24 24" fill="currentColor" class="w-4 md:w-6 h-4 md:h-6 mr-2">
                            <path fill="currentColor"
                                  d="M9,10H7V12H9V10M13,10H11V12H13V10M17,10H15V12H17V10M19,3H18V1H16V3H8V1H6V3H5C3.89,3 3,3.9 3,5V19A2,2 0 0,0 5,21H19A2,2 0 0,0 21,19V5A2,2 0 0,0 19,3M19,19H5V8H19V19Z"/>
                        </svg>
                        Seen on: {{ $selectedTrip->sight->monday ? 'Monday' : '' }}
                        {{ $selectedTrip->sight->tuesday ? 'Tuesday' : '' }}
                        {{ $selectedTrip->sight->wednesday ? 'Wednesday' : '' }}
                        {{ $selectedTrip->sight->thursday ? 'Thursday' : '' }}
                        {{ $selectedTrip->sight->friday ? 'Friday' : '' }}
                        {{ $selectedTrip->sight->saturday ? 'Saturday' : '' }}
                        {{ $selectedTrip->sight->sunday ? 'Sunday' : '' }}
                    </li>
                    <li class="flex mb-2">
                        <svg viewBox="0 0 24 24" fill="currentColor" class="w-4 md:w-6 h-4 md:h-6 mr-2">
                            <path fill="currentColor"
                                  d="M16.5,4V8.25L19.36,9.94L18.61,11.16L15,9V4H16.5M16,13C17.36,13 18.54,12.5 19.5,11.53C20.5,10.56 21,9.39 21,8C21,6.64 20.5,5.46 19.5,4.5C18.54,3.5 17.36,3 16,3C14.61,3 13.44,3.5 12.47,4.5C11.5,5.46 11,6.64 11,8C11,9.39 11.5,10.56 12.47,11.53C13.44,12.5 14.61,13 16,13M13.5,19C13.94,19 14.3,18.84 14.58,18.54C14.86,18.24 15,17.89 15,17.5C15,17.08 14.86,16.73 14.58,16.43C14.3,16.13 13.94,16 13.5,16C13.06,16 12.7,16.13 12.42,16.43C12.14,16.73 12,17.08 12,17.5C12,17.89 12.14,18.24 12.42,18.54C12.7,18.84 13.06,19 13.5,19M3,13H11.11C9.7,11.64 9,10 9,8H3V13M4.5,19C4.94,19 5.3,18.84 5.58,18.54C5.86,18.24 6,17.89 6,17.5C6,17.08 5.86,16.73 5.58,16.43C5.3,16.13 4.94,16 4.5,16C4.06,16 3.7,16.13 3.42,16.43C3.14,16.73 3,17.08 3,17.5C3,17.89 3.14,18.24 3.42,18.54C3.7,18.84 4.06,19 4.5,19M16,1C17.92,1 19.58,1.67 20.95,3.05C22.33,4.42 23,6.08 23,8C23,9.77 22.44,11.29 21.28,12.59C20.13,13.88 18.7,14.66 17,14.91V18C17,18.84 16.67,19.58 16,20.2V22C16,22.27 15.89,22.5 15.7,22.71C15.5,22.91 15.28,23 15,23H14C13.73,23 13.5,22.91 13.29,22.71C13.09,22.5 13,22.27 13,22V21H5V22C5,22.27 4.91,22.5 4.71,22.71C4.5,22.91 4.27,23 4,23H3C2.72,23 2.5,22.91 2.3,22.71C2.11,22.5 2,22.27 2,22V20.2C1.33,19.58 1,18.84 1,18V8C1,6.42 1.67,5.35 3.05,4.8C4.42,4.26 6.41,4 9,4C9.13,4 9.33,4 9.61,4C9.89,4 10.09,4.03 10.22,4.03C11.63,2 13.55,1 16,1Z"/>
                        </svg>
                        Start time: {{ $selectedTrip->note_en }}
                    </li>
                    <li class="flex mb-2">
                        <svg viewBox="0 0 24 24" fill="currentColor" class="w-4 md:w-6 h-4 md:h-6 mr-2">
                            <path fill="currentColor"
                                  d="M11,12H3.5L6,9.5L3.5,7H11V3L12,2L13,3V7H18L20.5,9.5L18,12H13V20A2,2 0 0,1 15,22H9A2,2 0 0,1 11,20V12Z"/>
                        </svg>
                        Headsign: {{ $selectedTrip->trip_headsign }}
                    </li>
                </ul>

                <div class="rounded shadow my-4" x-data="{open:false}">
                    @if($selectedTrip->trip_headsign === 'TBD')
                        <div class="p-1 md:p-3 bg-yellow-200 flex cursor-pointer" @click="open = !open">
                            <b class="flex-grow inline-flex">
                                <svg class="w-6 h-6 mr-1 md:mr-2" fill="currentColor" viewBox="0 0 24 24">
                                    <path fill="currentColor"
                                          d="M10,19H13V22H10V19M12,2C17.35,2.22 19.68,7.62 16.5,11.67C15.67,12.67 14.33,13.33 13.67,14.17C13,15 13,16 13,17H10C10,15.33 10,13.92 10.67,12.92C11.33,11.92 12.67,11.33 13.5,10.67C15.92,8.43 15.32,5.26 12,5A3,3 0 0,0 9,8H6A6,6 0 0,1 12,2Z"/>
                                </svg>
                                No data
                            </b>
                            <p class="inline-flex">
                                <svg class="w-6 h-6 mr-1 md:mr-2" fill="currentColor" viewBox="0 0 24 24">
                                    <path fill="currentColor"
                                          d="M20.71,7.04C21.1,6.65 21.1,6 20.71,5.63L18.37,3.29C18,2.9 17.35,2.9 16.96,3.29L15.12,5.12L18.87,8.87M3,17.25V21H6.75L17.81,9.93L14.06,6.18L3,17.25Z"/>
                                </svg>
                                Make a suggestion
                            </p>
                        </div>
                    @else
                        <div class="p-1 md:p-3 bg-green-200 flex cursor-pointer" @click="open = !open">
                            <b class="flex-grow inline-flex">
                                <svg class="w-4 md:w-6 h-4 md:h-6 mr-1 md:mr-2" fill="currentColor" viewBox="0 0 24 24">
                                    <path fill="currentColor"
                                          d="M4,2H20A2,2 0 0,1 22,4V16A2,2 0 0,1 20,18H13.9L10.2,21.71C10,21.9 9.75,22 9.5,22V22H9A1,1 0 0,1 8,21V18H4A2,2 0 0,1 2,16V4C2,2.89 2.9,2 4,2M12.19,5.5C11.3,5.5 10.59,5.68 10.05,6.04C9.5,6.4 9.22,7 9.27,7.69H11.24C11.24,7.41 11.34,7.2 11.5,7.06C11.7,6.92 11.92,6.85 12.19,6.85C12.5,6.85 12.77,6.93 12.95,7.11C13.13,7.28 13.22,7.5 13.22,7.8C13.22,8.08 13.14,8.33 13,8.54C12.83,8.76 12.62,8.94 12.36,9.08C11.84,9.4 11.5,9.68 11.29,9.92C11.1,10.16 11,10.5 11,11H13C13,10.72 13.05,10.5 13.14,10.32C13.23,10.15 13.4,10 13.66,9.85C14.12,9.64 14.5,9.36 14.79,9C15.08,8.63 15.23,8.24 15.23,7.8C15.23,7.1 14.96,6.54 14.42,6.12C13.88,5.71 13.13,5.5 12.19,5.5M11,12V14H13V12H11Z"/>
                                </svg>
                                Incorrect?
                            </b>
                            <p class="inline-flex">
                                <svg class="w-4 md:w-6 h-4 md:h-6 mr-1 md:mr-2" fill="currentColor" viewBox="0 0 24 24">
                                    <path fill="currentColor"
                                          d="M20.71,7.04C21.1,6.65 21.1,6 20.71,5.63L18.37,3.29C18,2.9 17.35,2.9 16.96,3.29L15.12,5.12L18.87,8.87M3,17.25V21H6.75L17.81,9.93L14.06,6.18L3,17.25Z"/>
                                </svg>
                                Make a suggestion
                            </p>
                        </div>
                    @endif
                    @if(count($selectedTrip->suggestions) > 0)
                        <div class="p-1 md:p-3 bg-white text-sm" x-bind:style="open ? '' : 'display:none'">
                            <b>Previous suggestions:</b>
                            <ul>
                                @foreach($selectedTrip->suggestions as $suggestion)
                                    <li>{{ $suggestion->payload['trip_headsign'] }}
                                        - {{ $suggestion->payload['trip_notes'] }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="p-1 md:p-3 bg-white" x-bind:style="open ? '' : 'display:none'">
                        @if($formSuccess)
                            <div class="flex flex-col items-center">
                                <svg class="w-10 h-10 text-green-500" fill="currentColor" viewBox="0 0 24 24">
                                    <path fill="currentColor"
                                          d="M21,7L9,19L3.5,13.5L4.91,12.09L9,16.17L19.59,5.59L21,7Z"/>
                                </svg>
                                Thanks for your suggestion!
                            </div>
                        @else
                            <form wire:submit.prevent="formSubmit" class="text-sm">
                                <input aria-label="Trip headsign (special destination or origin)"
                                       wire:model="formHeadsign" type="text" required
                                       class="appearance-none rounded px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 w-full mb-2"
                                       placeholder="Trip headsign (special destination or origin)">
                                @error('formHeadsign') <p class="text-red-600 mb-2 text-sm">{{ $message }}</p> @enderror
                                <input aria-label="Notes (e.g. source)" wire:model="formNotes" type="text" required
                                       class="appearance-none rounded px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 w-full mb-2"
                                       placeholder="Notes (e.g. source)">
                                @error('formNotes') <p class="text-red-600 mb-2 text-sm">{{ $message }}</p> @enderror
                                <input aria-label="Your username" wire:model="formUsername" type="text"
                                       class="appearance-none rounded px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 w-full mb-2"
                                       placeholder="Your username">
                                @error('formUsername') <p class="text-red-600 mb-2 text-sm">{{ $message }}</p> @enderror

                                <div class="flex items-center justify-between">
                                    <button type="submit"
                                            class="bg-secondary-500 rounded p-2 hover:bg-secondary-700 hover:text-white mr-4">
                                        Submit
                                    </button>
                                    <p class="text-sm text-gray-700 italic">If the username field is filled, you will be
                                        credited on <a href="https://github.com/transittracker/extras#Contributors"
                                                       class="text-primary-600">this page</a>.</p>
                                </div>
                            </form>
                        @endif
                    </div>
                </div>

                <table class="rounded border-b border-gray-200 text-xs md:text-base w-full bg-white">
                    <thead class="bg-gray-500 text-white" @click="showAll = !showAll">
                    <tr>
                        <th class="text-left p-1 md:p-2" x-show="showAll">Stop sequence</th>
                        <th class="text-left p-1 md:p-2">Arrival time</th>
                        <th class="text-left p-1 md:p-2" x-show="showAll">Departure time</th>
                        <th class="text-left p-1 md:p-2">
                            Stop name <span class="hidden md:block">& ID</span>
                        </th>
                        <th class="text-left p-1 md:p-2" x-show="showAll">Schedule relationship</th>
                    </tr>
                    </thead>
                    <tbody class="text-gray-700">
                    @foreach($selectedTrip->stop_times as $stopTime)
                        <tr wire:key="{{ $stopTime->stop_id }}">
                            <th scope="row" x-show="showAll">{{ $stopTime->stop_sequence }}</th>
                            <td>{{ $stopTime->arrival_time }}</td>
                            <td x-show="showAll">{{ $stopTime->departure_time }}</td>
                            <td class="inline-flex truncate">
                                @if($stopTime->stop->is_fake)
                                    <svg class="w-4 md:w-5 h-4 md:h-5 text-red-700" fill="currentColor"
                                         viewBox="0 0 24 24">
                                        <path fill="currentColor" d="M13 14H11V9H13M13 18H11V16H13M1 21H23L12 2L1 21Z"/>
                                    </svg>
                                @endif
                                <a href="{{ route('stops.show', $stopTime->stop_id) }}" class="underline">
                                    <span class="hidden md:block mr-1">{{ $stopTime->stop_id }}</span>
                                    {{ $stopTime->stop->stop_name }}
                                </a>
                            </td>
                            <td x-show="showAll">{{ $stopTime->schedule_relationship }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <ul class="mt-3">
                    <li class="flex items-center">
                        <input type="checkbox" class="mr-2" x-model="showAll">
                        Show all columns
                    </li>
                    <li class="flex">
                        <svg class="w-4 md:w-5 h-4 md:h-5 text-red-700 mr-2" fill="currentColor" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M13 14H11V9H13M13 18H11V16H13M1 21H23L12 2L1 21Z"/>
                        </svg>
                        Indicates a fake stop
                    </li>
                </ul>
            </div>
        @else
            <div class="md:sticky md:top-32 h-full md:h-auto flex md:block items-center">
                <div class="text-center mx-auto">
                    <svg class="w-12 md:w-24 h-12 md:h-24 text-primary-500 mx-auto mb-2 md:mb-4" fill="currentColor"
                         viewBox="0 0 24 24">
                        <path fill="currentColor"
                              d="M10.76,8.69A0.76,0.76 0 0,0 10,9.45V20.9C10,21.32 10.34,21.66 10.76,21.66C10.95,21.66 11.11,21.6 11.24,21.5L13.15,19.95L14.81,23.57C14.94,23.84 15.21,24 15.5,24C15.61,24 15.72,24 15.83,23.92L18.59,22.64C18.97,22.46 19.15,22 18.95,21.63L17.28,18L19.69,17.55C19.85,17.5 20,17.43 20.12,17.29C20.39,16.97 20.35,16.5 20,16.21L11.26,8.86L11.25,8.87C11.12,8.76 10.95,8.69 10.76,8.69M15,10V8H20V10H15M13.83,4.76L16.66,1.93L18.07,3.34L15.24,6.17L13.83,4.76M10,0H12V5H10V0M3.93,14.66L6.76,11.83L8.17,13.24L5.34,16.07L3.93,14.66M3.93,3.34L5.34,1.93L8.17,4.76L6.76,6.17L3.93,3.34M7,10H2V8H7V10"/>
                    </svg>
                    <h1 class="text-primary-500 text-lg md:text-2xl">Select a trip to get started</h1>
                </div>
            </div>
            {{--            <div class="md:mt-24 text-center">--}}
            {{--                <svg class="w-12 md:w-24 h-12 md:h-24 text-primary-500 mx-auto mb-2 md:mb-4" fill="currentColor" viewBox="0 0 24 24">--}}
            {{--                    <path fill="currentColor" d="M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10,10 0 0,0 12,2M16.2,16.2L11,13V7H12.5V12.2L17,14.9L16.2,16.2Z" />--}}
            {{--                </svg>--}}
            {{--                <h1 class="text-primary-500 text-lg md:text-2xl">Come back later</h1>--}}
            {{--                <p>So far, no trips have been recorded for this board period</p>--}}
            {{--            </div>--}}
        @endif
    </div>
</div>