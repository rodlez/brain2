<div class="bg-white shadow rounded-xl">

    <!-- Header -->
    <div class="flex flex-row justify-between items-center border-b-2 border-zinc-200 py-4 px-4">
        <div>
            <h4 class="text-2xl text-zinc-600 leading-6 font-bold">
                <span style="font-size: 2rem; color: orange; padding-right: 10px;">
                    <i class="fa-solid fa-basketball"></i></span>
                Entries for Tag - {{ $tagName }}
            </h4>
        </div>
        <div>
            <a href="{{ route('sportentry.create') }}" class="text-white bg-orange-500 hover:bg-orange-600 focus:ring-0 focus:ring-black font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">New</a>
        </div>
    </div>

    <!-- Filters -->
    <div class="flex flex-row justify-between items-center py-2 mx-4 border-orange-400 border-b-2 w-100 sm:w-100">
        <div>
            <span class="px-2 text-xl text-zinc-800">Filters
                <span class="text-sm font-semibold text-orange-400">
                    {{ $pending != 2 ? '(Status)' : '' }}
                    {{ $initialDateTo != $dateTo || $initialDateFrom != $dateFrom ? '(Date)' : '' }}
                    {{ $cat != 0 ? '(Category)' : '' }}
                    {{ $initialDurationTo != $durationTo || $durationFrom != 0 ? '(Duration)' : '' }}
                    {{ $initialDistanceTo != $distanceTo || $distanceFrom != 0 ? '(Distance)' : '' }}
                </span>
            </span>
        </div>
        <div>
            @if ($showFilter % 2 == 0)
                <a wire:click="activateFilter" class="cursor-pointer" title="Close Filters">
                    <i class="fa-solid fa-minus"></i>
                </a>
            @else
                <a wire:click="activateFilter" class="cursor-pointer" title="Open Filters">
                    <i class="fa-solid fa-plus"></i>
                </a>
            @endif
        </div>
    </div>

    @if ($showFilter % 2 == 0)
        <div class="bg-orange-200 mx-4 rounded-lg py-4 mt-4">
            <!-- Status -->
            <div class="flex flex-col justify-start items-start sm:flex-row sm:justify-start sm:items-center gap-4 px-4 py-2">
                <div>
                    <span><i class="fa-solid fa-circle-check"></i></span>
                    <span class="pl-2">Status</span>
                </div>
                <div class="sm:pl-20">
                    <select wire:model.live="pending"
                            class="rounded-lg">
                        <option value="2">All</option>
                        <option value="0">0 - Complete</option>
                        <option value="1">1 - Pending</option>
                    </select>
                </div>
            </div>
            <!-- Date -->
            <div class="flex flex-col justify-start items-start sm:flex-row sm:justify-start sm:items-center gap-4 px-4 py-2">
                <div>
                    <span><i class="fa-solid fa-calendar-days"></i></span>
                    <span class="pl-2 sm:pr-20">Date</span>
                </div>
                <div class="sm:pl-4"><input type="date" class="rounded-lg" placeholder="From" style="width: 150px;" wire:model.live="dateFrom"></div>
                <div><input type="date" class="rounded-lg" placeholder="To" style="width: 150px;" wire:model.live="dateTo"></div>
            </div>
            <!-- Category -->
            <div class="flex flex-col justify-start items-start sm:flex-row sm:justify-start sm:items-center gap-4 px-4 py-2">
                <div>
                    <span><i class="fa-solid fa-list"></i></span>
                    <span class="sm:pl-4">Category (<span class="font-semibold text-sm">{{ count($categories) }}</span>)</span>
                </div>
                <div class="sm:pl-7">
                    <select wire:model.live="cat"
                            class="rounded-lg">
                        <option value="0">All</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category['name'] }}">{{ $category['name'] }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <!-- Duration -->
            <div class="flex flex-col justify-start items-start sm:flex-row sm:justify-start sm:items-center gap-4 px-4 py-2">
                <div>
                    <span><i class="fa-regular fa-clock"></i></span>
                    <span class="sm:pl-2 sm:pr-2">Duration (<span class="font-semibold text-sm">mins</span>)</span>
                </div>
                <div class="sm:pl-3">
                    <input type="number" class="rounded-lg" placeholder="From" style="width: 80px;" wire:model.live="durationFrom">
                    <input type="number" class="rounded-lg" placeholder="To" style="width: 80px;" wire:model.live="durationTo">
                </div>
            </div>
            <!-- Distance -->
            <div class="flex flex-col justify-start items-start sm:flex-row sm:justify-start sm:items-center gap-4 px-4 py-2">
                <div>
                    <span>
                        <i class="fa-solid fa-route"></i></span>
                    <span class="pr-2 sm:pl-2 sm:pr-4">Distance (<span class="font-semibold text-sm">km</span>)</span>
                </div>
                <div class="sm:pl-3.5">
                    <input type="number" class="rounded-lg" placeholder="From" style="width: 80px;" wire:model.live="distanceFrom">
                    <input type="number" class="rounded-lg" placeholder="To" style="width: 80px;" wire:model.live="distanceTo">
                </div>
            </div>
            <!-- Reset Filters -->
            <div class="flex flex-row justify-start items-center sm:flex-row sm:justify-start sm:items-center gap-4 px-4 py-2">
                <button type="button" class="w-full bg-black text-white p-2 hover:bg-slate-700 rounded-lg" wire:click="clearFilters">
                    <span> Reset Filters </span>
                    <span class="px-2"><i class="fa-solid fa-delete-left"></i></span>
                </button>
            </div>

        </div>
    @endif

    <!-- Search -->
    <div class="flex flex-row justify-between items-center py-2 mx-4 my-4 border-green-600 border-b-2 w-100 sm:w-100">
        <div>
            <span class="px-2 text-xl text-zinc-800">Search
                <span class="text-sm font-semibold text-green-600">
                    {{ $search != '' ? '(' . $search . ')' : '' }}
                </span>
            </span>
        </div>
        <div>
            @if ($showSearch % 2 == 0)
                <a wire:click="activateSearch" class="cursor-pointer" title="Close Search">
                    <i class="fa-solid fa-minus"></i>
                </a>
            @else
                <a wire:click="activateSearch" class="cursor-pointer" title="Open Search">
                    <i class="fa-solid fa-plus"></i>
                </a>
            @endif
        </div>
    </div>

    @if ($showSearch % 2 == 0)
        <div class="flex flex-col justify-between sm:flex-row items-center p-4 w-100 sm:w-100 gap-2 sm:gap-4">
            <!-- Search -->
            <div class="relative w-full">
                <div class="absolute top-2.5 bottom-0 left-6 text-slate-700">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </div>
                <input type="search" class="w-full rounded-lg pl-14 placeholder-zinc-400 focus:outline-none focus:ring-0 focus:border-green-600 border-2 border-zinc-200" placeholder="Search by title" wire:model.live="search">
            </div>
        </div>
    @endif

    <!-- Entries -->
    <div class="flex flex-row justify-between items-center py-2 mx-4 my-4 border-yellow-600 border-b-2 w-100 sm:w-100">
        <div>
            <span class="px-2 text-xl text-zinc-800">Entries found ({{ $search != '' ? $found : $total }})</span>
        </div>
        <div>
            <select wire:model.live="perPage" class="focus:outline-none focus:ring-0 focus:border-orange-500 border-2 border-zinc-200 rounded-lg">
                <option class="bg-zinc-200 text-black" value="10">10</option>
                <option value="25">25</option>
                <option class="bg-zinc-200 text-black" value="50">50</option>
                <option value="100">100</option>
            </select>
        </div>
    </div>

    <!-- Criteria -->
    @if ($search != '' || $pending != 2 || $initialDateTo != $dateTo || $initialDateFrom != $dateFrom || $cat > 0 || $initialDurationTo != $durationTo || $durationFrom != 0 || $initialDistanceTo != $distanceTo || $distanceFrom != 0)
        <div class="flex flex-row justify-between items-center rounded-lg mx-4 p-4 bg-zinc-100">
            <div>
                <p class="text-green-600 text-md font-bold">
                    {{ $search != '' ? 'Search (' . $search . ')' : '' }}
                    {{ $pending != 2 ? 'Status (' . $pending . ')' : '' }}
                    {{ $initialDateTo != $dateTo || $initialDateFrom != $dateFrom ? 'Dates (' . date('d-m-Y', strtotime($dateFrom)) . ' - ' . date('d-m-Y', strtotime($dateTo)) . ')' : '' }}
                    {{ $cat > 0 ? 'Category (' . $cat . ')' : '' }}
                    {{ $initialDurationTo != $durationTo || $durationFrom != 0 ? 'Duration (' . $durationFrom . ' - ' . $durationTo . ')' : '' }}
                    {{ $initialDistanceTo != $distanceTo || $distanceFrom != 0 ? 'Distance (' . $distanceFrom . ' - ' . $distanceTo . ')' : '' }}
                </p>
            </div>
            <div>
                <a wire:click.prevent="resetAll" title="Reset All" class="cursor-pointer">
                    <span class="text-red-600"><i class="fa-solid fa-x"></i></span>
                </a>
            </div>
        </div>
    @endif

    <!-- Bulk Actions -->
    @if (count($selections) > 0)
        <div class="flex flex-row justify-start items-end sm:flex-row sm:justify-start gap-6 py-0 px-6">
            <span class="text-sm font-semibold">Entries Selected</span>
            <a wire:click.prevent="bulkClear" class="cursor-pointer" title="Unselect All">
                <span><i class="fa-solid fa-arrow-rotate-left text-green-600"></i></span>
            </a>
            <a wire:click.prevent="bulkDelete" wire:confirm="Are you sure you want to delete this entries?" class="cursor-pointer text-red-600" title="Delete">
                <span><i class="fa-solid fa-trash"></i></span>
                <span class="px-1">({{ count($selections) }})</span>
            </a>
        </div>
    @endif

    <!-- Table -->
    <div class="flex flex-col pt-4 pb-8 px-4">
        <div class="overflow-x-auto">
            <div class="min-w-full inline-block align-middle">

                <div class="overflow-hidden">

                    @if ($entries->count())
                        <table class="min-w-full">
                            <thead>
                                <tr class="bg-black text-left text-md leading-6 font-bold text-white capitalize">
                                    {{-- <th class="p-4"><input wire:model.live="selectAll" type="checkbox" class="text-green-600 outline-none focus:ring-0 checked:bg-green-500"></th> --}}
                                    <th></th>
                                    <th scope="col" class="p-4 hover:cursor-pointer hover:text-yellow-400 {{ $column == 'id' ? 'text-yellow-400' : '' }}" wire:click="sorting('id')">id {!! $sortLink !!}</th>
                                    <th scope="col" class="p-4 hover:cursor-pointer hover:text-yellow-400 {{ $column == 'title' ? 'text-yellow-400' : '' }}" wire:click="sorting('title')">title {!! $sortLink !!}</th>
                                    <th scope="col" class="p-4 hover:cursor-pointer hover:text-yellow-400 {{ $column == 'category_name' ? 'text-yellow-400' : '' }}" wire:click="sorting('category_name')">category {{-- {{ '(' . $differentCategories . ')' }} --}} {!! $sortLink !!}</th>
                                    <th scope="col" class="p-4 hover:cursor-pointer hover:text-yellow-400 {{ $column == 'status' ? 'text-yellow-400' : '' }}" wire:click="sorting('status')">status {!! $sortLink !!}</th>
                                    <th scope="col" class="p-4 hover:cursor-pointer hover:text-yellow-400 {{ $column == 'location' ? 'text-yellow-400' : '' }}" wire:click="sorting('location')">location {{-- {{ '(' . $differentLocations . ')' }} --}} {!! $sortLink !!}</th>
                                    <th scope="col" class="p-4 hover:cursor-pointer hover:text-yellow-400 {{ $column == 'duration' ? 'text-yellow-400' : '' }}" wire:click="sorting('duration')">duration {{ '(' . $totalDuration . ')' }} {!! $sortLink !!}</th>
                                    <th scope="col" class="p-4 hover:cursor-pointer hover:text-yellow-400 {{ $column == 'distance' ? 'text-yellow-400' : '' }}" wire:click="sorting('distance')">distance {{ '(' . $totalDistance . ')' }} {!! $sortLink !!}</th>
                                    <th scope="col" class="p-4 hover:cursor-pointer hover:text-yellow-400 {{ $column == 'date' ? 'text-yellow-400' : '' }}" wire:click="sorting('date')">date {{-- {{ '(' . $differentDates . ')' }} --}} {!! $sortLink !!}</th>
                                    <th scope="col" class="p-4 text-center"> actions </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-zinc-200">

                                @foreach ($entries as $entry)
                                    <tr class="even:bg-zinc-200 odd:bg-white transition-all duration-1000 hover:bg-yellow-400">
                                        <td class="p-4 whitespace-nowrap text-md text-center leading-6 font-medium text-gray-900"><input wire:model.live="selections" type="checkbox" class="text-green-600 outline-none focus:ring-0 checked:bg-green-500" value={{ $entry->id }}></td>
                                        <td class="p-4 whitespace-nowrap text-md leading-6 font-medium text-gray-900">{{ $entry->id }}</td>
                                        <td class="p-4 whitespace-nowrap text-md leading-6 font-medium text-gray-900">{{ excerpt($entry->title, 20) }}</td>
                                        <td class="p-4 whitespace-nowrap text-md leading-6 font-medium text-gray-900">{{ $entry->category->name }}</td>
                                        <td class="p-4 whitespace-nowrap text-md leading-6 font-medium text-gray-900">{{ $entry->status }}</td>
                                        <td class="p-4 whitespace-nowrap text-md leading-6 font-medium text-gray-900">{{ $entry->location }}</td>
                                        <td class="p-4 whitespace-nowrap text-md leading-6 font-medium text-gray-900">{{ $entry->duration }}</td>
                                        <td class="p-4 whitespace-nowrap text-md leading-6 font-medium text-gray-900">{{ $entry->distance }}</td>
                                        <td class="p-4 whitespace-nowrap text-md leading-6 font-medium text-gray-900">{{ date('d-m-Y', strtotime($entry->date)) }}</td>
                                        <td class="p-4">
                                            <div class="flex items-center gap-4">
                                                <!-- Show -->
                                                <a href="{{ route('sportentry.show', $entry) }}" title="See this entry">
                                                    <span class="text-green-600 hover:text-black transition-all duration-500"><i class="fa-lg fa-solid fa-circle-info"></i></span>
                                                </a>
                                                <!-- Edit -->
                                                <a href="{{ route('sportentry.edit', $entry) }}" title="Edit this category">
                                                    <span class="text-blue-600 hover:text-black transition-all duration-500"><i class="fa-lg fa-solid fa-pen-to-square"></i></span>
                                                </a>
                                                <!-- Delete -->
                                                <form action="{{ route('sportentry.destroy', $entry) }}" method="POST">
                                                    <!-- Add Token to prevent Cross-Site Request Forgery (CSRF) -->
                                                    @csrf
                                                    <!-- Dirtective to Override the http method -->
                                                    @method('DELETE')
                                                    <button onclick="return confirm('Are you sure you want to delete the entry: {{ $entry->title }}?')" title="Delete this entry">
                                                        <span class="text-red-600 hover:text-black transition-all duration-500"><i class="fa-lg fa-solid fa-trash"></i></span>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <div>
                            <span class="text-lg text-red-600 px-4">No Entries found</span>
                        </div>
                    @endif


                </div>


            </div>
        </div>
    </div>

    <div class="border-2 border-zinc-100"></div>

    <!-- Pagination Links -->
    <div class="py-8 px-4">
        {{ $entries->links() }}
    </div>

</div>
