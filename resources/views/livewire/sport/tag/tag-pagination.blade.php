<div class="bg-white shadow rounded-xl">

    <!-- Header -->
    <div class="flex flex-row justify-between items-center border-b-2 border-zinc-200 py-4 px-4">
        <div>
            <h4 class="text-2xl text-zinc-600 leading-6 font-bold">
                <span style="font-size: 2rem; color: orange; padding-right: 10px;">
                    <i class="fa-solid fa-basketball"></i></span>
                <span>Tags ({{ $search != '' ? $found : $total }})</span>
            </h4>
        </div>
        <div>
            <a href="{{ route('sporttag.create') }}" class="text-white bg-orange-500 hover:bg-orange-600 focus:ring-0 focus:ring-black font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">New</a>
        </div>
    </div>

    <!-- Search -->
    <div class="flex flex-col justify-between sm:flex-row items-center p-4 w-100 sm:w-100 gap-2 sm:gap-4">
        <!-- Search -->
        <div class="relative w-full">
            <div class="absolute top-2.5 bottom-0 left-6 text-slate-700">
                <i class="fa-solid fa-magnifying-glass"></i>
            </div>
            <input type="search" class="w-full rounded-lg pl-14 placeholder-zinc-400 focus:outline-none focus:ring-0 focus:border-orange-500 border-2 border-zinc-200" placeholder="Search by tag name" wire:model.live="search">
        </div>
        <!-- Pagination -->
        <div class="flex flex-row items-center w-full sm:w-28 pt-4 sm:pt-0 w-100">
            <select wire:model.live="perPage" class="w-full focus:outline-none focus:ring-0 focus:border-orange-500 border-2 border-zinc-200 rounded-lg">
                <option class="bg-zinc-200 text-black" value="10">10</option>
                <option value="25">25</option>
                <option class="bg-zinc-200 text-black" value="50">50</option>
                <option value="100">100</option>
            </select>
        </div>
    </div>

    <!-- Bulk Actions -->
    @if (count($selections) > 0)
        <div class="flex flex-row justify-start items-end sm:flex-row sm:justify-start gap-6 py-0 px-6">
            <span class="text-sm font-semibold">Tags Selected</span>
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

                    @if ($tags->count())
                        <table class="min-w-full  border-black border">
                            <thead>
                                <tr class="bg-black text-left text-md leading-6 font-bold text-white capitalize">
                                    <th></th>
                                    <th scope="col" class="p-4 hover:cursor-pointer hover:text-yellow-400 {{ $column == 'id' ? 'text-yellow-400' : '' }}" wire:click="sorting('id')">id {!! $sortLink !!}</th>
                                    <th scope="col" class="p-4 hover:cursor-pointer hover:text-yellow-400 {{ $column == 'name' ? 'text-yellow-400' : '' }}" wire:click="sorting('name')">name {!! $sortLink !!}</th>
                                    <th scope="col" class="p-4 hover:cursor-pointer hover:text-yellow-400 {{ $column == 'created_at' ? 'text-yellow-400' : '' }}" wire:click="sorting('created_at')">created {!! $sortLink !!}</th>
                                    <th scope="col" class="p-4 hover:cursor-pointer hover:text-yellow-400 {{ $column == 'updated_at' ? 'text-yellow-400' : '' }}" wire:click="sorting('updated_at')">updated {!! $sortLink !!}</th>
                                    <th scope="col" class="p-4 text-center"> actions </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-zinc-200">

                                @foreach ($tags as $tag)
                                    <tr class="even:bg-zinc-200 odd:bg-white transition-all duration-1000 hover:bg-yellow-400">
                                        <td class="p-4 whitespace-nowrap text-md text-center leading-6 font-medium text-gray-900"><input wire:model.live="selections" type="checkbox" class="text-green-600 outline-none focus:ring-0 checked:bg-green-500" value={{ $tag->id }}></td>
                                        <td class="p-4 whitespace-nowrap text-md leading-6 font-medium text-gray-900">{{ $tag->id }}</td>
                                        <td class="p-4 whitespace-nowrap text-md leading-6 font-medium text-gray-900">{{ $tag->name }}</td>
                                        <td class="p-4 whitespace-nowrap text-md leading-6 font-medium text-gray-900">{{ date('d-m-Y', strtotime($tag->created_at)) }}</td>
                                        <td class="p-4 whitespace-nowrap text-md leading-6 font-medium text-gray-900">{{ date('d-m-Y', strtotime($tag->updated_at)) }}</td>
                                        <td class="p-4">
                                            <div class="flex justify-center items-center gap-4">
                                                <!-- Entries for this Tag -->
                                                <a href="{{ route('sporttag.entries', $tag) }}" title="See Entries for this Tag">
                                                    <span class="text-orange-600 hover:text-black transition-all duration-500"><i class="fa-lg fa-solid fa-basketball"></i></span>
                                                </a>
                                                <!-- Show -->
                                                <a href="{{ route('sporttag.show', $tag) }}" title="See this Tag">
                                                    <span class="text-green-600 hover:text-black transition-all duration-500"><i class="fa-lg fa-solid fa-circle-info"></i></span>
                                                </a>
                                                <!-- Edit -->
                                                <a href="{{ route('sporttag.edit', $tag) }}" title="Edit this Tag">
                                                    <span class="text-blue-600 hover:text-black transition-all duration-500"><i class="fa-lg fa-solid fa-pen-to-square"></i></span>
                                                </a>
                                                <!-- Delete -->
                                                <form action="{{ route('sporttag.destroy', $tag) }}" method="POST">
                                                    <!-- Add Token to prevent Cross-Site Request Forgery (CSRF) -->
                                                    @csrf
                                                    <!-- Dirtective to Override the http method -->
                                                    @method('DELETE')
                                                    <button onclick="return confirm('Are you sure you want to delete the tag: {{ $tag->name }}?')" title="Delete this Tag">
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
                            <span class="text-lg text-red-600 px-4">No tags found</span>
                        </div>
                    @endif

                </div>

            </div>
        </div>
    </div>

    <div class="border-2 border-zinc-100"></div>

    <!-- Pagination Links -->
    <div class="py-8 px-4">
        {{ $tags->links() }}
    </div>

</div>
