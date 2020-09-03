<div>
    <div class="flex-1 bg-gray-100 p-3 md:p-8">
        <div class="w-full h-full rounded-lg shadow-lg bg-white">
            <div class="p-3 md:px-6 md:py-3 md:flex justify-between border-b border-gray-200">
                <input type="search" class="bg-white rounded border border-gray-300 p-1 md:p-3 text-xs md:text-sm text-gray-700 leading-5 mb-2 sm:mb-0" placeholder="Search by trip..." wire:model="searchTrip">
                <input type="search" class="bg-white rounded border border-gray-300 p-1 md:p-3 text-xs md:text-sm text-gray-700 leading-5" placeholder="Search by route..." wire:model="searchRoute">
            </div>
            <div class="text-sm md:text-base">
                @forelse($trips as $trip)
                    <div class="flex items-center cursor-pointer hover:bg-teal-300 p-2 md:px-6 md:py-3 transition-colors duration-200 ease-in-out {{ !$selectedTrip ? '' : ($selectedTrip->id === $trip->id ? 'bg-teal-200' : '') }}" wire:click="selectTrip({{ $trip->id }})" wire:key="{{ $trip->id }}">
                        <p class="hover:text-gray-900 mr-2">{{ $trip->trip_id }}</p>
                        @if(strpos($trip->route_id, 'E') !== false)
                            <span class="px-1 md:px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                          {{ $trip->route_id }}
                        </span>
                        @else
                            <span class="px-1 md:px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                          {{ $trip->route_id }}
                        </span>
                        @endif
                        <p class="flex-grow text-right text-sm text-gray-900">{{ \Carbon\Carbon::parse($trip->start_time)->diffForHumans() }}</p>
                    </div>
                @empty
                    <div class="px-6 py-3">No trips are matching your search</div>
                @endforelse
            </div>
            {{ $trips->links() }}
        </div>
    </div>
    <div class="flex-1 p-3 md:p-8">
        @if(count($trips) > 0 || $selectedTrip)
        <div class="md:flex items-center mb-4">
            <h1 class="md:text-2xl flex-grow">Trip {{ $selectedTrip->trip_id }}</h1>
            <div class="text-sm md:text-base">
                <b>First sight:</b> {{ $selectedTrip->created_at }}<br>
                <b>Last sight:</b> {{ $selectedTrip->updated_at }}
            </div>
        </div>
        <div class="overflow-auto">
            <table class="rounded border-b border-gray-200 text-xs md:text-base">
                <thead class="bg-gray-800 text-white">
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
                        <td>
                            @if($stop['lat'] !== 0 && $stop['lon'] !== 0)
                                <a class="underline text-secondary-700" href="https://www.openstreetmap.org/?mlat={{ $stop['lat'] }}&mlon={{ $stop['lon'] }}" target="_blank">
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
        </div>
        @else
            <div>There is no trips yet!</div>
        @endif
    </div>
</div>