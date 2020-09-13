<div>
    <div class="flex-1 bg-gray-100 p-3 md:p-8">
        <div class="w-full h-full rounded-lg shadow-lg bg-white">
            <div class="p-3 md:px-6 md:py-3 md:flex justify-between border-b border-gray-200">
                <div class="flex items-center bg-white border border-gray-200 rounded p-1 md:p-3 text-xs md:text-sm text-gray-700 leading-5 w-full md:w-1/4">
                    <svg viewBox="0 0 20 20" fill="currentColor" class="search w-6 h-6 mr-1 md:mr-3">
                        <path fill-rule="evenodd"
                              d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                              clip-rule="evenodd"></path>
                    </svg>
                    <input type="search" class="w-full h-full text-gray-700" placeholder="Search by id..."
                           wire:model="searchId">
                </div>
                <div class="flex items-center bg-white border border-gray-200 rounded p-1 md:p-3 text-xs md:text-sm text-gray-700 leading-5 w-full md:w-1/4">
                    <svg viewBox="0 0 20 20" fill="currentColor" class="search w-6 h-6 mr-1 md:mr-3">
                        <path fill-rule="evenodd"
                              d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                              clip-rule="evenodd"></path>
                    </svg>
                    <input type="search" class="w-full h-full text-gray-700" placeholder="Search by name..."
                           wire:model="searchName">
                </div>
            </div>
            <div class="text-sm md:text-base">
                @forelse($stops as $stop)
                    <div class="flex items-center cursor-pointer hover:bg-teal-300 p-2 md:px-6 md:py-3 transition-colors duration-200 ease-in-out {{ !$selectedStop ? '' : ($selectedStop->stop_id === $stop->stop_id ? 'bg-teal-200' : '') }}"
                         wire:click="selectStop({{ $stop->stop_id }})" wire:key="{{ $stop->stop_id }}">
                        <p class="hover:text-gray-900 mr-2">{{ $stop->stop_code }}</p>
                        <p class="flex-grow text-right text-sm text-gray-900">{{ $stop->stop_name }}</p>
                    </div>
                @empty
                    <div class="px-6 py-3">No stops are matching your search</div>
                @endforelse
            </div>
            {{ $stops->links() }}
        </div>
    </div>
    <div class="flex-1 p-3 md:p-8">
        @if(count($stops) > 0 || $selectedStop)
            <h1 class="text-xl md:text-xl2 mb-2">
                <b>{{ $selectedStop->stop_id }}</b> {{ $selectedStop->stop_name }}
            </h1>

            @if($selectedStop->stop_lat && $selectedStop->stop_lon)
                <div class="w-full mb-4">
                    <iframe class="rounded shadow" width="100%" height="300" frameborder="0" scrolling="no"
                            marginheight="0" marginwidth="0"
                            src="https://maps.google.com/maps?width=100%25&amp;height=300&amp;hl=en&amp;q={{$selectedStop->stop_lat}},{{$selectedStop->stop_lon}}&amp;t=&amp;z=17&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe>
                </div>
            @endif

            <div class="rounded shadow">
                @if($selectedStop->stop_name === 'TBD')
                    <div class="p-1 md:p-3 bg-yellow-200 flex">
                        <b class="flex-grow inline-flex">
                            <svg class="w-6 h-6 mr-1 md:mr-2" fill="currentColor" viewBox="0 0 20 20"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                      d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z"
                                      clip-rule="evenodd"></path>
                            </svg>
                            No data
                        </b>
                        <p class="inline-flex">
                            <svg class="w-6 h-6 mr-1 md:mr-2" fill="currentColor" viewBox="0 0 20 20"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                            </svg>
                            Make a suggestion
                        </p>
                    </div>
                @else
                    <div class="p-1 md:p-3 bg-green-200 flex">
                        <b class="flex-grow inline-flex">
                            <svg class="w-6 h-6 mr-1 md:mr-2" fill="currentColor" viewBox="0 0 20 20"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                      d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z"
                                      clip-rule="evenodd"></path>
                            </svg>
                            Can it be improved?
                        </b>
                        <p class="inline-flex">
                            <svg class="w-6 h-6 mr-1 md:mr-2" fill="currentColor" viewBox="0 0 20 20"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                            </svg>
                            Make a suggestion
                        </p>
                    </div>
                @endif
                @if(count($selectedStop->suggestions) > 0)
                    <div class="p-1 md:p-3 bg-gray-100 text-sm">
                        <b>Here is some suggestions:</b>
                        <ul>
                            @foreach($selectedStop->suggestions as $suggestion)
                                <li>{{ $suggestion->payload['stop_name'] }}
                                    at {{ $suggestion->payload['stop_location'] }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="p-1 md:p-3">
                    @if($formSuccess)
                        <div class="flex flex-col items-center">
                            <svg class="w-10 h-10 text-green-500" fill="currentColor" viewBox="0 0 20 20"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                      d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                      clip-rule="evenodd"></path>
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

                            <button type="submit"
                                    class="bg-secondary-500 rounded p-2 hover:bg-secondary-700 hover:text-white">Submit
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        @else
            <div>There is no stops yet!</div>
        @endif
    </div>
</div>