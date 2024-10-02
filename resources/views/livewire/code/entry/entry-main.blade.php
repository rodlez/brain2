<div class="bg-white shadow rounded-xl mx-4">

    <!-- Header -->
    <div class="flex flex-row justify-between items-center py-4 bg-green-600 rounded-t-lg">
        <div>
            <i class="fa-lg sm:fa-2x fa-solid fa-laptop-code pl-4 text-white"></i>
            <span class="text-lg text-white px-4">Entries <span class="text-md">({{ $search != '' ? $found : $total }})</span></span>
        </div>
        <div class="px-4">
            <a href="{{ route('codeentry.create') }}" class="text-white text-sm sm:text-md rounded-lg py-2 px-4 bg-black hover:bg-slate-600 transition duration-1000 ease-in-out" title="Create New Entry">New</a>
        </div>
    </div>

    <!-- Filters -->
    <div class="flex flex-row justify-between items-center py-2 mx-4 mt-2 border-green-600 border-b-2 w-100 sm:w-100">
        <div>
            <i class="fa-solid fa-filter text-green-600 pl-4"></i>
            <span class="px-2 text-lg text-zinc-800">Filters
                <span class="text-sm font-semibold text-orange-400">
                    {{ $tipo != 0 ? '(Type)' : '' }}
                    {{ $cat != 0 ? '(Category)' : '' }}
                    {{ !in_array('0', $this->selectedTags) && count($this->selectedTags) != 0 ? '(Tags)' : '' }}
                </span>
            </span>
        </div>
        <div>
            @if ($showFilter % 2 != 0)
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

    @if ($showFilter % 2 != 0)
        <div class="bg-green-600 mx-4 rounded-lg py-4 mt-4 w-100">
            <!-- Type -->
            <div class="flex flex-col justify-start items-start sm:flex-row sm:justify-start sm:items-center gap-2 px-4 py-4">
                <div class="text-white text-lg w-100 sm:w-1/3">
                    <span><i class="fa-xl fa-solid fa-sitemap"></i></span>
                    <span class="pl-2">Type (<span class="font-semibold text-sm">{{ count($types) }}</span>)</span>
                </div>
                <div class="w-full pl-2">
                    <select wire:model.live="tipo"
                            class="rounded-lg w-full sm:w-1/2">
                        <option value="0">All</option>
                        @foreach ($types as $type)
                            <option value="{{ $type['name'] }}">{{ $type['name'] }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <!-- Category -->
            <div class="flex flex-col justify-start items-start sm:flex-row sm:justify-start sm:items-center gap-2 px-4 py-4">
                <div class="text-white text-lg w-100 sm:w-1/3">
                    <span><i class="fa-xl fa-solid fa-list"></i></span>
                    <span class="pl-2">Category (<span class="font-semibold text-sm">{{ count($categories) }}</span>)</span>
                </div>
                <div class="w-full pl-2">
                    <select wire:model.live="cat"
                            class="rounded-lg w-full sm:w-1/2">
                        <option value="0">All</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category['name'] }}">{{ $category['name'] }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <!-- Tags -->
            <div class="flex flex-col justify-start items-start sm:flex-row sm:justify-start sm:items-center gap-2 px-4 py-4">
                <div class="text-white text-lg w-100 sm:w-1/3">
                    <span><i class="fa-xl fa-solid fa-tags"></i></span>
                    <span class="pl-2">Tags (<span class="font-semibold text-sm">{{ count($tags) }}</span>)</span>
                </div>
                <div class="w-full pl-2">
                    <select wire:model.live="selectedTags" name="selectedTags" id="selectedTags" multiple
                            class="rounded-lg w-full sm:w-1/2" size="6">
                        <option value="0">All</option>
                        @foreach ($tags as $tag)
                            <option value="{{ $tag['id'] }}">{{ $tag['name'] }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <!-- Reset Filters -->
            <div class="flex flex-row justify-start items-center sm:flex-row sm:justify-start sm:items-center gap-2 px-4 py-2">
                <button type="button" class="w-full bg-black text-white p-2 hover:bg-slate-700 rounded-lg" wire:click="clearFilters">
                    <span> Reset Filters </span>
                    <span class="px-2"><i class="fa-solid fa-delete-left"></i></span>
                </button>
            </div>

        </div>
    @endif

    <!-- Search -->
    <div class="flex flex-col items-start sm:justify-between sm:flex-row px-4 py-4 w-100 gap-2">
        <!-- Search -->
        <div class="relative w-full">
            <div class="absolute top-2.5 bottom-0 left-4 text-slate-700">
                <i class="fa-solid fa-magnifying-glass"></i>
            </div>
            <input type="search" class="w-full rounded-lg pl-10 placeholder-zinc-400 focus:outline-none focus:ring-0 focus:border-green-600 border-2 border-zinc-200" placeholder="Search by title" wire:model.live="search">
        </div>
        <!-- Pagination -->
        <div class="relative w-32">
            <div class="absolute top-2.5 bottom-0 left-4 text-slate-700">
                <i class="fa-solid fa-book-open"></i>
            </div>
            <select wire:model.live="perPage" class="w-full rounded-lg text-end focus:outline-none focus:ring-0 focus:border-green-500 border-2 border-zinc-200 ">
                <option value="10">10</option>
                <option value="25">25</option>
                <option value="50">50</option>
                <option value="100">100</option>
            </select>
        </div>
    </div>

    <!-- Criteria -->
    @if ($search != '' || $tipo > 0 || $cat > 0 || (!in_array('0', $this->selectedTags) && count($this->selectedTags) != 0))
        <div class="flex flex-row justify-between items-center rounded-lg mx-4 p-2 bg-zinc-100">
            <div>
                <p class="text-orange-600 text-md font-bold">
                    <span class="text-lg text-black font-semibold">Criteria: </span>
                    <span class="text-green-600">{{ $search != '' ? 'Search (' . $search . ')' : '' }}</span>
                    {{ $tipo > 0 ? 'Type (' . $tipo . ')' : '' }}
                    {{ $cat > 0 ? 'Category (' . $cat . ')' : '' }}
                    {{ !in_array('0', $this->selectedTags) && count($this->selectedTags) != 0 ? 'Tags (' . implode(',', $tagNames) . ')' : '' }}
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
                        <table class="table-fixed min-w-full border-l border-r border-b border-black">
                            <thead class="h-16">
                                <tr class="bg-black text-white text-left text-sm font-normal uppercase">
                                    {{-- <th class="p-2"><input wire:model.live="selectAll" type="checkbox" class="text-green-600 outline-none focus:ring-0 checked:bg-green-500"></th> --}}
                                    <th></th>
                                    <th wire:click="sorting('id')" scope="col" class="p-2 hover:cursor-pointer {{ $column == 'id' ? 'bg-yellow-400 text-black' : '' }}">id {!! $sortLink !!}</th>
                                    <th wire:click="sorting('title')" scope="col" class="p-2 hover:cursor-pointer {{ $column == 'title' ? 'bg-yellow-400 text-black' : '' }}">title {!! $sortLink !!}</th>
                                    <th wire:click="sorting('type_name')" scope="col" class="p-2 hover:cursor-pointer {{ $column == 'type_name' ? 'bg-yellow-400 text-black' : '' }}">type <span class="text-xs">{{ '(' . $differentTypes . ')' }}</span> {!! $sortLink !!}</th>
                                    <th wire:click="sorting('category_name')" scope="col" class="p-2 hover:cursor-pointer {{ $column == 'category_name' ? 'bg-yellow-400 text-black' : '' }}">category <span class="text-xs">{{ '(' . $differentCategories . ')' }}</span> {!! $sortLink !!}</th>
                                    <th wire:click="sorting('created')" scope="col" class="p-2 hover:cursor-pointer {{ $column == 'created' ? 'bg-yellow-400 text-black' : '' }}">created {!! $sortLink !!}</th>
                                    <th scope="col" class="p-2 text-center">Tags</th>
                                    {{-- <th scope="col" class="p-2 text-center">Files</th> --}}
                                    <th scope="col" class="p-2 text-center">actions</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($entries as $entry)
                                    <tr class="text-sm even:bg-zinc-200 odd:bg-white transition-all duration-1000 hover:bg-yellow-400">
                                        <td class="p-2 text-center border-r border-r-black"><input wire:model.live="selections" type="checkbox" class="text-green-600 outline-none focus:ring-0 checked:bg-green-500" value={{ $entry->id }}></td>
                                        <td class="p-2 text-center">{{ $entry->id }}</td>

                                        <td class="p-2 border-l border-l-black whitespace-nowrap text-sm text-black cursor-pointer" title="{{ $entry->title }}">
                                            <a href="{{ route('codeentry.show', $entry) }}" title="See this entry">
                                                {{-- {{ excerpt($entry->title, 20) }} --}}
                                                {{ $entry->title }}
                                            </a>
                                        </td>

                                        <td class="p-2 border-l border-l-black whitespace-nowrap text-sm text-black">{{ $entry->type_name }}</td>
                                        <td class="p-2 border-l border-l-black whitespace-nowrap text-sm text-black">{{ $entry->category_name }}</td>
                                        <td class="p-2 border-l border-l-black whitespace-nowrap text-sm text-black">{{ date('d-m-Y', strtotime($entry->created)) }}</td>
                                        <td class="p-2 border-l border-l-black whitespace-nowrap text-sm text-black">
                                            @foreach ($entry->tags as $tag)
                                                {{ $tag->name }} <br>
                                            @endforeach
                                        </td>
                                        {{-- <td class="p-2 border-l border-l-black whitespace-nowrap text-sm   text-black">
                                            <div class="flex flex-col items-center gap-2">
                                                @foreach ($entry->images as $image)
                                                    @if ($image->media_type === 'application/pdf')
                                                        <a href="{{ asset('storage/' . $image->path) }}" title="{{ $image->original_filename }}">
                                                            <i class="fa-regular fa-file-pdf fa-xl"></i>
                                                        </a>
                                                    @else
                                                        <a href="{{ asset('storage/' . $image->path) }}" title="{{ $image->original_filename }}">
                                                            <i class="fa-regular fa-image fa-xl"></i>
                                                        </a>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </td> --}}
                                        <td class="p-2 border-l border-l-black">
                                            <div class="flex items-center gap-2">
                                                <!-- Show -->
                                                <a href="{{ route('codeentry.show', $entry) }}" title="See this entry">
                                                    <span class="text-orange-400 hover:text-black transition-all duration-500"><i class="fa-lg fa-solid fa-circle-info"></i></span>
                                                </a>
                                                <!-- Upload File -->
                                                {{-- <a href="{{ route('codeimage.index', $entry) }}" title="Upload File">
                                                    <span class="text-green-600 hover:text-black transition-all duration-500"><i class="fa-lg fa-solid fa-file-arrow-up"></i></span>
                                                </a> --}}
                                                <!-- Edit -->
                                                <a href="{{ route('codeentry.edit', $entry) }}" title="Edit this entry">
                                                    <span class="text-blue-600 hover:text-black transition-all duration-500"><i class="fa-lg fa-solid fa-pen-to-square"></i></span>
                                                </a>
                                                <!-- Delete -->
                                                <form action="{{ route('codeentry.destroy', $entry) }}" method="POST">
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
                        <div class="bg-zinc-200 py-6 rounded-lg border-double border-2 border-red-600">
                            <span class="text-md text-red-600 px-4">No Entries found
                                {{-- <a wire:click.prevent="clearSearch" title="Reset">
                                <i class="fa-lg fa-solid fa-circle-xmark px-2"></i>
                            </a> --}}
                            </span>
                        </div>
                    @endif
                    </tbody>
                    </table>

                </div>


            </div>
        </div>
    </div>


    <!-- Pagination Links -->
    <div class="py-8 px-4">
        {{ $entries->links() }}
    </div>

    <!-- Footer -->
    <div class="py-4 flex flex-row justify-end items-center px-4 bg-green-600 rounded-b-lg">
        <a href="{{ route('code.main') }}">
            <i class="fa-lg fa-solid fa-backward-step text-white hover:text-black transition duration-1000 ease-in-out" title="Go Back"></i>
        </a>
    </div>

</div>
