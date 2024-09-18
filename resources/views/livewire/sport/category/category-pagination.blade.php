<div class="bg-white shadow rounded-xl">

    <!-- Header -->
    <div class="flex flex-row justify-between items-center border-b-2 border-zinc-200 py-4 px-4">
        <div>
            <h4 class="text-2xl text-zinc-600 leading-6 font-bold">
                <span style="font-size: 2rem; color: orange; padding-right: 10px;">
                    <i class="fa-solid fa-basketball"></i></span>
                Categories
            </h4>
        </div>
        <div>
            <a href="{{ route('sportcategory.create') }}" class="text-white bg-orange-500 hover:bg-orange-600 focus:ring-0 focus:ring-black font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">New</a>
        </div>
    </div>

    <!-- Search and Pagination -->
    <div class="flex flex-col justify-start sm:flex-row sm:justify-between  gap-6 py-6 px-4">
        <!-- Search -->
        <div class="relative">
            <div class="absolute top-2.5 bottom-0 left-4 text-slate-700">
                <i class="fa-solid fa-magnifying-glass"></i>
            </div>
            <input type="search" class="rounded-xl pl-10 placeholder-zinc-400 focus:outline-none focus:ring-0 focus:border-orange-500 border-2 border-zinc-200" placeholder="Search by name" style="width: 250px;" wire:model.live="search">
        </div>
        <!-- Pagination -->
        <div>
            Pagination
            <select wire:model.live="perPage" class="focus:outline-none focus:ring-0 focus:border-orange-500 border-2 border-zinc-200 rounded-lg">
                <option class="bg-zinc-200 text-black" value="10">10</option>
                <option value="25">25</option>
                <option class="bg-zinc-200 text-black" value="50">50</option>
                <option value="100">100</option>
            </select>
        </div>
    </div>
    <!-- Founded Entries -->
    @if ($found !== 0)
        <div class="flex flex-row justify-start items-center rounded-lg mx-4 p-4 bg-zinc-100">
            <p class="text-green-600 text-md font-bold italic">{{ $found > 0 ? 'Found ' . $found . ' categories with name (' . $search . ')' : '' }}</p>
        </div>
    @endif

    <!-- Bulk Actions -->
    @if (count($selections) > 0)
        <div class="flex flex-row justify-start items-center sm:flex-row sm:justify-end gap-6 py-2 px-4">
            Bulk Actions
            <button type="button" class="w-1/3 sm:w-24 bg-red-600 text-white p-2 hover:bg-red-300 rounded-lg"
                    wire:click="bulkDelete"
                    wire:confirm="Are you sure you want to delete this categories?">
                Delete
            </button>
        </div>
    @endif

    <!-- Table -->
    <div class="flex flex-col pt-4 pb-8 px-4">
        <div class="overflow-x-auto">
            <div class="min-w-full inline-block align-middle">

                <div class="overflow-hidden">
                    <table class="min-w-full">
                        <thead>
                            <tr class="bg-black text-left text-sm leading-6 font-bold text-white uppercase">
                                <th></th>
                                <th scope="col" class="p-4 hover:cursor-pointer hover:text-orange-500 {{ $column == 'id' ? 'bg-yellow-300 text-black' : '' }}" wire:click="sorting('id')">id {!! $sortLink !!}</th>
                                <th scope="col" class="p-4 hover:cursor-pointer hover:text-orange-500 {{ $column == 'name' ? 'bg-yellow-300 text-black' : '' }}" wire:click="sorting('name')">name {!! $sortLink !!}</th>
                                <th scope="col" class="p-4 hover:cursor-pointer hover:text-orange-500 {{ $column == 'created_at' ? 'bg-yellow-300 text-black' : '' }}" wire:click="sorting('created_at')">created {!! $sortLink !!}</th>
                                <th scope="col" class="p-4 hover:cursor-pointer hover:text-orange-500 {{ $column == 'updated_at' ? 'bg-yellow-300 text-black' : '' }}" wire:click="sorting('updated_at')">updated {!! $sortLink !!}</th>
                                <th scope="col" class="p-4 uppercase"> actions </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-zinc-200">
                            @if ($categories->count())
                                @foreach ($categories as $category)
                                    <tr class="even:bg-zinc-200 odd:bg-white transition-all duration-500 hover:bg-yellow-100">
                                        <td class="p-4 whitespace-nowrap text-sm leading-6 font-medium text-gray-900"><input wire:model.live="selections" type="checkbox" class="text-green-600 outline-none focus:ring-0 checked:bg-green-500" value={{ $category->id }}></td>
                                        <td class="p-4 whitespace-nowrap text-sm leading-6 font-medium text-gray-900">{{ $category->id }}</td>
                                        <td class="p-4 whitespace-nowrap text-sm leading-6 font-medium text-gray-900">{{ $category->name }}</td>
                                        <td class="p-4 whitespace-nowrap text-sm leading-6 font-medium text-gray-900">{{ date('d-m-Y', strtotime($category->created_at)) }}</td>
                                        <td class="p-4 whitespace-nowrap text-sm leading-6 font-medium text-gray-900">{{ date('d-m-Y', strtotime($category->updated_at)) }}</td>
                                        <td class="p-4">
                                            <div class="flex items-center gap-1">
                                                <!-- Show -->
                                                <a href="{{ route('sportcategory.show', $category) }}">
                                                    <button class="p-2 rounded-full  group transition-all duration-500  flex item-center">
                                                        <span style="font-size: 1rem; color: rgb(32, 131, 7);"><i class="fa-solid fa-eye"></i></span>
                                                    </button>
                                                </a>
                                                <!-- Edit -->
                                                <a href="{{ route('sportcategory.edit', $category) }}">
                                                    <button class="p-2  rounded-full  group transition-all duration-500  flex item-center">
                                                        <span style="font-size: 1rem; color: rgb(20, 19, 20);"><i class="fa-solid fa-pen-to-square"></i></span>
                                                    </button>
                                                </a>
                                                <!-- Delete -->
                                                <form action="{{ route('sportcategory.destroy', $category) }}" method="POST">
                                                    <!-- Add Token to prevent Cross-Site Request Forgery (CSRF) -->
                                                    @csrf
                                                    <!-- Dirtective to Override the http method -->
                                                    @method('DELETE')
                                                    <button class="p-2 rounded-full  group transition-all duration-500  flex item-center" onclick="return confirm('Are you sure you want to delete the category: {{ $category->name }}?')">
                                                        <span style="font-size: 1rem; color: rgb(209, 29, 5);"><i class="fa-solid fa-trash"></i></span>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr class="bg-slate-200">
                                    <td colspan="6" class="py-8 px-4 whitespace-nowrap text-xl leading-6 font-medium text-red-600 ">No categories found</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>

                </div>


            </div>
        </div>
    </div>

    <div class="border-2 border-zinc-100"></div>

    <!-- Pagination Links -->
    <div class="py-8 px-4">
        {{ $categories->links() }}
    </div>

</div>
