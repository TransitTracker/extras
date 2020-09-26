<div class="flex flex-col md:flex-row h-full">
    <div class="flex-1 md:shadow-lg bg-white mt-20 md:mt-0 h-half md:h-full">
        <div class="p-3 md:flex justify-between border-b border-gray-200 bg-white sticky top-20 md:top-16">
            <div class="flex justify-between gap-2">
                <input aria-label="Search by trip" wire:model="searchTrip" type="text"
                       class="appearance-none rounded px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 text-sm w-full mr-2"
                       placeholder="Search by trip id...">
                <input aria-label="Search by route" wire:model="searchRoute" type="text"
                       class="appearance-none rounded px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 text-sm w-full mr-2"
                       placeholder="Search by route...">
            </div>
        </div>
        <ul class="text-sm md:text-base md:mt-16 max-h-40-screen md:max-h-full overflow-auto">
            @forelse($trips as $trip)
                <li class="flex items-center cursor-pointer hover:bg-secondary-300 p-2 md:p-3 transition-colors duration-200 ease-in-out {{ !$selectedTrip ? '' : ($selectedTrip->id === $trip->id ? 'bg-secondary-200' : '') }}"
                     wire:click="selectTrip({{ $trip->id }})" wire:key="{{ $trip->id }}">
                    <p class="hover:text-gray-900 mr-2">{{ $trip->trip_id }}</p>
                    @if(strpos($trip->route_id, 'E') !== false)
                        <span class="px-1 md:px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-200 text-blue-800">
                          {{ $trip->route_id }}
                        </span>
                    @else
                        <span class="px-1 md:px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-200 text-gray-800">
                          {{ $trip->route_id }}
                        </span>
                    @endif
                    <p class="flex-grow text-right text-sm text-gray-900">{{ \Carbon\Carbon::parse($trip->start_time)->diffForHumans() }}</p>
                </li>
            @empty
                <div class="px-6 py-3">No trips are matching your search</div>
            @endforelse
            {{ $trips->links('livewire.custom-pagination') }}
        </ul>
    </div>
    <div class="flex-1 p-3 md:p-8 bg-gray-200 h-half md:h-full">
        @if($selectedTrip)
            <div class="md:sticky md:top-24 text-sm md:text-base">
                <div class="md:flex items-center mb-4">
                    <h1 class="text-xl md:text-2xl flex-grow">Trip {{ $selectedTrip->trip_id }} on {{ $selectedTrip->route_id }}</h1>
                </div>
                <ul class="mb-4">
                    <li class="flex">
                        <svg viewBox="0 0 20 20" fill="currentColor" class="clock w-4 md:w-6 h-4 md:h-6 mr-2">
                            <path fill-rule="evenodd"
                                  d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                                  clip-rule="evenodd"></path>
                        </svg>
                        First seen {{ $selectedTrip->created_at }}
                    </li>
                    <li class="flex">
                        <svg viewBox="0 0 20 20" fill="currentColor" class="clock w-4 md:w-6 h-4 md:h-6 mr-2">
                            <path fill-rule="evenodd"
                                  d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                                  clip-rule="evenodd"></path>
                        </svg>
                        Last seen {{ $selectedTrip->updated_at }}
                    </li>
                    <li class="flex">
                        <svg viewBox="0 0 20 20" fill="currentColor" class="clock w-4 md:w-6 h-4 md:h-6 mr-2">
                            <path fill-rule="evenodd"
                                  d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                                  clip-rule="evenodd"></path>
                        </svg>
                        Start at {{ $selectedTrip->start_time }}
                    </li>
                    <li class="flex">
                        <svg class="w-4 md:w-6 h-4 md:h-6 mr-2" fill="currentColor" viewBox="0 0 20 20"
                             xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                  d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                  clip-rule="evenodd"></path>
                        </svg>
                        Seen on {{ $selectedTrip->sight->monday ? 'Monday' : '' }}
                        {{ $selectedTrip->sight->tuesday ? 'Tuesday' : '' }}
                        {{ $selectedTrip->sight->wednesday ? 'Wednesday' : '' }}
                        {{ $selectedTrip->sight->thursday ? 'Thursday' : '' }}
                        {{ $selectedTrip->sight->friday ? 'Friday' : '' }}
                        {{ $selectedTrip->sight->saturday ? 'Saturday' : '' }}
                        {{ $selectedTrip->sight->sunday ? 'Sunday' : '' }}
                    </li>
                </ul>
                <table class="rounded border-b border-gray-200 text-xs md:text-base w-full bg-gray-100">
                    <thead class="bg-gray-500 text-white">
                    <tr>
                        <th class="text-left p-1 md:p-2">Stop sequence</th>
                        <th class="text-left p-1 md:p-2">Arrival time</th>
                        <th class="text-left p-1 md:p-2">Departure time</th>
                        <th class="text-left p-1 md:p-2">Stop ID</th>
                        <th class="text-left p-1 md:p-2">Schedule relationship</th>
                    </tr>
                    </thead>
                    <tbody class="text-gray-700">
                    @foreach($selectedTrip->stop_time_updates as $stop)
                        <tr wire:key="{{ $stop['stop_id'] }}">
                            <th scope="row">{{ $stop['stop_sequence'] }}</th>
                            <td class="timestamp">{{ $stop['arrival_time'] }}</td>
                            <td class="timestamp">{{ $stop['departure_time'] }}</td>
                            <td class="inline-flex">
                                @if(key_exists('is_fake', $stop) && $stop['is_fake'])
                                    <svg viewBox="0 0 20 20" fill="currentColor"
                                         class="exclamation w-4 md:w-6 h-4 md:h-6 text-red-700">
                                        <path fill-rule="evenodd"
                                              d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                                              clip-rule="evenodd"></path>
                                    </svg>
                                @endif
                                @if($stop['lat'] !== 0 && $stop['lon'] !== 0)
                                    <a class="underline text-secondary-700"
                                       href="https://www.openstreetmap.org/?mlat={{ $stop['lat'] }}&mlon={{ $stop['lon'] }}"
                                       target="_blank">
                                        {{ $stop['stop_id'] }}
                                    </a>
                                @else
                                    {{ $stop['stop_id'] }}
                                @endif
                            </td>
                            <td>{{ $stop['schedule_relationship'] }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <ul class="mt-3">
                    <li class="inline-flex">
                        <svg viewBox="0 0 20 20" fill="currentColor" class="exclamation w-4 md:w-6 h-4 md:h-6 text-red-700 mr-2">
                            <path fill-rule="evenodd"
                                  d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                                  clip-rule="evenodd"></path>
                        </svg>
                        Indicates a fake stop
                    </li>
                </ul>
            </div>
        @else
            <div>There is no trips yet!</div>
        @endif
    </div>
</div>