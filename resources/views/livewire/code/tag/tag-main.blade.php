<div class="bg-white shadow rounded-xl mx-4">

    <!-- Header -->
    <div class="flex flex-row justify-between items-center py-4 bg-green-600 rounded-t-lg">
        <div>
            <i class="fa-lg sm:fa-2x fa-solid fa-laptop-code pl-4 text-white"></i>
            <span class="text-lg text-white px-4">Tags <span class="text-sm">({{ $search != '' ? $found : $total }})</span></span>
        </div>
        <div class="px-4">
            <a href="{{ route('codetag.create') }}" class="text-white text-sm sm:text-md rounded-lg py-2 px-4 bg-black hover:bg-slate-600 transition duration-1000 ease-in-out" title="Create New Tag">New</a>
        </div>
    </div>

    <!-- Search -->
    <div class="flex flex-col sm:flex-row justify-between items-start px-4 py-4 gap-4">
        <!-- Search -->
        <div class="relative w-full">
            <div class="absolute top-2.5 bottom-0 left-4 text-slate-700">
                <i class="fa-solid fa-magnifying-glass"></i>
            </div>
            <input wire:model.live="search" type="search" class="w-full rounded-lg pl-10 placeholder-zinc-400 focus:outline-none focus:ring-0 focus:border-green-500 border-2 border-zinc-200" placeholder="Search by name">
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

    <!-- Bulk Actions -->
    @if (count($selections) > 0)
        <div class="px-4">
            <div class="flex flex-row justify-start items-end gap-4 py-2 px-4 mb-2 rounded-lg bg-zinc-200">
                <span class="text-sm font-semibold">Bulk Actions</span>
                <a wire:click.prevent="bulkClear" class="cursor-pointer" title="Unselect All">
                    <span><i class="fa-solid fa-circle-xmark text-green-600 hover:text-green-500"></i></span>
                </a>
                <a wire:click.prevent="bulkDelete" wire:confirm="Are you sure you want to delete this items?" class="cursor-pointer text-red-600 hover:text-red-500" title="Delete">
                    <span><i class="fa-solid fa-trash"></i></span>
                    <span class="px-1">({{ count($selections) }})</span>
                </a>
            </div>
        </div>
    @endif

    <!-- Table -->
    <div class="px-4 pb-8 border-b-2 border-b-green-600">
        <div class="overflow-x-auto">

            @if ($tags->count())
                <table class="min-w-full">
                    <thead>
                        <tr class="bg-black text-white text-left text-sm font-normal uppercase">
                            <th></th>
                            <th wire:click="sorting('id')" scope="col" class="p-2 hover:cursor-pointer hover:text-yellow-400 {{ $column == 'id' ? 'text-yellow-400' : '' }}">id {!! $sortLink !!}</th>
                            <th wire:click="sorting('name')" scope="col" class="p-2 hover:cursor-pointer hover:text-yellow-400 {{ $column == 'name' ? 'text-yellow-400' : '' }}">name {!! $sortLink !!}</th>
                            <th wire:click="sorting('created_at')" scope="col" class="p-2 hover:cursor-pointer hover:text-yellow-400 {{ $column == 'created_at' ? 'text-yellow-400' : '' }}">created {!! $sortLink !!}</th>
                            <th wire:click="sorting('updated_at')" scope="col" class="p-2 hover:cursor-pointer hover:text-yellow-400 {{ $column == 'updated_at' ? 'text-yellow-400' : '' }}">updated {!! $sortLink !!}</th>
                            <th scope="col" class="p-2 text-center"> actions </th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($tags as $tag)
                            <tr class="even:bg-zinc-200 odd:bg-white transition-all duration-1000 hover:bg-yellow-400">
                                <td class="p-2 whitespace-nowrap text-md text-center leading-6 font-medium text-gray-900"><input wire:model.live="selections" type="checkbox" class="text-green-600 outline-none focus:ring-0 checked:bg-green-500" value={{ $tag->id }}></td>
                                <td class="p-2 whitespace-nowrap text-md leading-6 font-medium text-gray-900">{{ $tag->id }}</td>
                                <td class="p-2 whitespace-nowrap text-md leading-6 font-medium text-gray-900">{{ $tag->name }}</td>
                                <td class="p-2 whitespace-nowrap text-md leading-6 font-medium text-gray-900">{{ date('d-m-Y', strtotime($tag->created_at)) }}</td>
                                <td class="p-2 whitespace-nowrap text-md leading-6 font-medium text-gray-900">{{ date('d-m-Y', strtotime($tag->updated_at)) }}</td>
                                <td class="p-2">
                                    <div class="flex justify-center items-center gap-4">
                                        <!-- Entries for this tag -->
                                        {{-- <a href="{{ route('codetag.entries', $tag) }}" title="See Entries for this tag">
                                                    <span class="text-orange-600 hover:text-black transition-all duration-500"><i class="fa-lg fa-solid fa-basketball"></i></span>
                                                </a> --}}
                                        <!-- Show -->
                                        <a href="{{ route('codetag.show', $tag) }}" title="Show">
                                            <span class="text-green-600 hover:text-black transition-all duration-500"><i class="fa-solid fa-circle-info"></i></span>
                                        </a>
                                        <!-- Edit -->
                                        <a href="{{ route('codetag.edit', $tag) }}" title="Edit">
                                            <span class="text-blue-600 hover:text-black transition-all duration-500"><i class="fa-solid fa-pen-to-square"></i></span>
                                        </a>
                                        <!-- Delete -->
                                        <form action="{{ route('codetag.destroy', $tag) }}" method="POST">
                                            <!-- Add Token to prevent Cross-Site Request Forgery (CSRF) -->
                                            @csrf
                                            <!-- Dirtective to Override the http method -->
                                            @method('DELETE')
                                            <button onclick="return confirm('Are you sure you want to delete the tag: {{ $tag->name }}?')" title="Delete">
                                                <span class="text-red-600 hover:text-black transition-all duration-500"><i class="fa-solid fa-trash"></i></span>
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
                    <span class="text-md text-red-600 px-4">No Tags found
                        <a wire:click.prevent="clearSearch" title="Reset">
                            <i class="fa-lg fa-solid fa-circle-xmark px-2"></i>
                        </a>

                    </span>
                </div>
            @endif

        </div>

    </div>

    <!-- Pagination Links -->
    <div class="py-8 px-4">
        {{ $tags->links() }}
    </div>

    <!-- Footer -->
    <div class="py-4 flex flex-row justify-end items-center px-4 bg-green-600 rounded-b-lg">
        <a href="{{ route('code.main') }}">
            <i class="fa-lg fa-solid fa-backward-step text-white hover:text-black transition duration-1000 ease-in-out" title="Go Back"></i>
        </a>
    </div>

</div>
