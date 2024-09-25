<!-- To use the layout.blade.php in views/components as a Template to render in the slot variable -->
<x-app-layout>
    <div class="container max-w-6xl mx-auto px-6 py-4">
        <!-- Sitemap -->
        <div class="flex flex-row justify-start items-center py-4 px-2 text-slate-400">
            <a href="/dashboard" class="px-2 hover:text-orange-500">Dashboard </a> /
            <a href="/dashboard/sport" class="px-2 hover:text-orange-500">Sport</a> /
            <a href="/dashboard/sport/entry" class="px-2 font-bold hover:text-orange-500">Entries</a> /
            <a href="/dashboard/sport/entry/{{ $entry->id }}" class="px-2 font-bold text-black border-b-2 border-b-orange-500">Info</a>
        </div>

        <div class="bg-white shadow rounded-xl">

            <!-- Header -->
            <div class="flex flex-row justify-between items-center border-b-2 py-2 px-4">
                <div>
                    <h4 class="text-2xl text-zinc-600 leading-6 font-bold">
                        <span style="font-size: 2rem; color: orange; padding-right: 10px;">
                            <i class="fa-solid fa-basketball"></i></span>
                        Informantion
                    </h4>
                </div>
            </div>
            <!-- Status -->
            <div class="pt-6 px-4 sm:mx-12">
                <div class="px-16">
                    <h2 class="text-lg font-semibold py-2">Status</h2>
                </div>
                <div class="flex flex-row justify-start items-center gap-4">
                    <span class="bg-zinc-200 px-3 py-2 rounded-lg">
                        <i class="fa-solid fa-toggle-on"></i>
                    </span>
                    <input name="status" id="status" type="text" value="{{ $entry->status == 0 ? 'Complete' : 'Pending' }}" disabled class="text-md rounded-lg w-28 p-2 {{ $entry->status == 0 ? 'bg-green-400' : 'bg-red-400' }}  border border-gray-300 text-gray-900 dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-orange-500 focus:border-orange-500 cursor-not-allowed">
                </div>
            </div>
            <!-- Title -->
            <div class="py-2 px-4 sm:mx-12">
                <div class="px-16">
                    <h2 class="text-lg font-semibold py-2">Title</h2>
                </div>
                <div class="flex flex-row justify-start items-center gap-4">
                    <span class="bg-zinc-200 px-3 py-2 rounded-lg">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </span>
                    <div value="{{ $entry->title }}" class="w-full p-2 text-md rounded-lg bg-gray-200 border border-gray-300 text-gray-900 dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-orange-500 focus:border-orange-500">
                        {{ $entry->title }}
                    </div>
                </div>
            </div>
            <!-- Date -->
            <div class="py-2 px-4 sm:mx-12">
                <div class="px-16">
                    <h2 class="text-lg font-semibold py-2">Date</h2>
                </div>
                <div class="flex flex-row justify-start items-center gap-4">
                    <span class="bg-zinc-200 px-3 py-2 rounded-lg">
                        <i class="fa-solid fa-calendar-days"></i>
                    </span>
                    <div class="w-full sm:w-1/3 p-2 text-md rounded-lg bg-gray-200 border border-gray-300 text-gray-900 dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-orange-500 focus:border-orange-500 cursor-not-allowed">
                        {{ $entry->date }}
                    </div>
                </div>
            </div>
            <!-- Category -->
            <div class="py-2 px-4 sm:mx-12">
                <div class="px-16">
                    <h2 class="text-lg font-semibold py-2">Category</h2>
                </div>
                <div class="flex flex-row justify-start items-center gap-4">
                    <span class="bg-zinc-200 px-3 py-2 rounded-lg">
                        <i class="fa-solid fa-list"></i>
                    </span>
                    <div class="w-full p-2 text-md rounded-lg bg-gray-200 border border-gray-300 text-gray-900 dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-orange-500 focus:border-orange-500 cursor-not-allowed">
                        {{ $entry->category->name }}
                    </div>
                </div>
            </div>
            <!-- Tags -->
            <div class="py-2 px-4 sm:mx-12">
                <div class="px-16">
                    <h2 class="text-lg font-semibold py-2">Tags</h2>
                </div>
                <div class="flex flex-row justify-start items-center gap-4">
                    <span class="bg-zinc-200 px-3 py-2 rounded-lg">
                        <i class="fa-solid fa-tags"></i>
                    </span>
                    <div class="bg-gray-200 border border-zinc-300 w-full p-2 text-md rounded-lg cursor-not-allowed">
                        @foreach ($tags as $tag)
                            {{ $tag }}
                        @endforeach
                    </div>
                </div>
            </div>
            <!-- Location -->
            <div class="py-2 px-4 sm:mx-12">
                <div class="px-16">
                    <h2 class="text-lg font-semibold py-2">Location</h2>
                </div>
                <div class="flex flex-row justify-start items-center gap-4">
                    <span class="bg-zinc-200 px-3 py-2 rounded-lg">
                        <i class="fa-solid fa-location-dot"></i>
                    </span>
                    <div class="w-full p-2 text-md rounded-lg bg-gray-200 border border-gray-300 text-gray-900 dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-orange-500 focus:border-orange-500 cursor-not-allowed">
                        {{ $entry->location }}
                    </div>
                </div>
            </div>
            <!-- Duration -->
            <div class="py-2 px-4 sm:mx-12">
                <div class="px-16">
                    <h2 class="text-lg font-semibold py-2">Duration</h2>
                </div>
                <div class="flex flex-row justify-start items-end gap-4">
                    <span class="bg-zinc-200 px-3 py-2 rounded-lg">
                        <i class="fa-regular fa-clock"></i>
                    </span>
                    <div class="w-20 p-2 bg-gray-200 border border-gray-300 text-gray-900 text-md rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-orange-500 focus:border-orange-500 cursor-not-allowed">
                        {{ $entry->duration }}
                    </div>
                    <p class="text-sm">minutes</p>
                </div>
            </div>
            <!-- Distance -->
            <div class="py-2 px-4 sm:mx-12">
                <div class="px-16">
                    <h2 class="text-lg font-semibold py-2">Distance</h2>
                </div>
                <div class="flex flex-row justify-start items-end gap-4">
                    <span class="bg-zinc-200 px-3 py-2 rounded-lg">
                        <i class="fa-solid fa-route"></i>
                    </span>
                    <div class="w-20 p-2 bg-gray-200 border border-gray-300 text-gray-900 text-md rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-orange-500 focus:border-orange-500 cursor-not-allowed">
                        {{ $entry->distance }}
                    </div>
                    <p class="text-sm">km</p>
                </div>
            </div>
            <!-- Url -->
            <div class="py-2 px-4 sm:mx-12">
                <div class="px-16">
                    <h2 class="text-lg font-semibold py-2">Url</h2>
                </div>
                <div class="flex flex-row justify-start items-center gap-4">
                    <span class="bg-zinc-200 px-3 py-2 rounded-lg">
                        <i class="fa-solid fa-globe"></i>
                    </span>
                    <div class="w-full p-2 text-md rounded-lg bg-gray-200 border border-gray-300 text-gray-900 dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-orange-500 focus:border-orange-500 cursor-not-allowed">
                        {{ $entry->url === null ? '-' : $entry->url }}
                    </div>
                </div>
            </div>
            <!-- Info -->
            <div class="py-2 px-4 sm:mx-12">
                <div class="px-16">
                    <h2 class="text-lg font-semibold py-2">Info</h2>
                </div>
                <div class="flex flex-row justify-start items-start gap-4">
                    <span class="bg-zinc-200 px-3 py-2 rounded-lg">
                        <i class="fa-solid fa-circle-info"></i>
                    </span>
                    <div class="w-full p-2 text-md rounded-lg bg-gray-200 border border-gray-300 text-gray-900 dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-orange-500 focus:border-orange-500 cursor-not-allowed">
                        {{ $entry->info === null ? '-' : $entry->info }}
                    </div>
                </div>
            </div>
            <!-- Files -->
            <div class="py-2 px-4 sm:mx-12">
                <div class="px-16">
                    <h2 class="text-lg font-semibold py-2">Files ({{ $images->count() }})</h2>
                </div>
                <div class="flex flex-row justify-start items-start gap-4">
                    <span class="bg-zinc-200 px-3 py-2 rounded-lg">
                        <i class="fa-solid fa-file"></i>
                    </span>
                    <!-- Image Table -->
                    <div>
                        @if ($images->count() !== 0)
                            <table class="table-fixed w-full bg-white">
                                <thead class="text-center text-black bg-gray-200">
                                    <th></th>
                                    <th class="py-2 max-xl:hidden">Filename</th>
                                    <th class="py-2 max-sm:hidden">Created</th>
                                    <th class="py-2 max-sm:hidden">Size (KB)</th>
                                    <th class="py-2 max-sm:hidden">Format</th>
                                    <th></th>
                                </thead>

                                @foreach ($images as $image)
                                    <tr class="bg-white border-b-2 text-center">
                                        <td class="py-2">
                                            @if ($image->media_type === 'application/pdf')
                                                <a href="{{ asset('storage/' . $image->path) }}">
                                                    <i class="fa-regular fa-file-pdf fa-2xl"></i>
                                                </a>
                                            @else
                                                {{-- <a href="{{ url($image->path)}}">
                                <img src="{{ url($image->path)}}" alt="{{$image->original_filename}}" width="250">                     
                            </a> --}}
                                                <a href="{{ asset('storage/' . $image->path) }}">
                                                    <img src="{{ asset('storage/' . $image->path) }}" alt="{{ $image->original_filename }}" width="250">
                                                </a>
                                            @endif
                                        </td>
                                        <td class="py-2 max-xl:hidden">{{ shortFilename(getFileName($image->original_filename), 20) }}</td>
                                        <td class="py-2 max-sm:hidden">{{ $image->created_at->format('d-m-Y') }}</td>
                                        <td class="py-2 max-sm:hidden">{{ round($image->size / 1000) }} </td>
                                        <td class="py-2 max-sm:hidden">{{ basename($image->media_type) }}</td>
                                        <td class="py-2">
                                            <div class="flex justify-center items-center gap-2">
                                                <!-- Download Image -->
                                                <a href="{{ route('sportimage.download', [$entry, $image]) }}" title="Download File">
                                                    <span class="text-black hover:text-green-600 transition-all duration-500">
                                                        <i class="fa-lg fa-solid fa-file-arrow-down"></i>
                                                    </span>
                                                </a>
                                                <!-- Delete Image -->
                                                <form action="{{ route('sportimage.destroy', [$entry, $image]) }}" method="POST">
                                                    <!-- Add Token to prevent Cross-Site Request Forgery (CSRF) -->
                                                    @csrf
                                                    <!-- Dirtective to Override the http method -->
                                                    @method('DELETE')
                                                    <button onclick="return confirm('Are you sure you want to delete the image: {{ $image->original_filename }}?')" title="Delete Image">
                                                        <span class="text-black hover:text-red-600 transition-all duration-500"><i class="fa-lg fa-solid fa-trash"></i></span>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>

                                    </tr>
                                @endforeach

                                <tr class="bg-white border-b-2 text-left">
                                    <td class="py-6">
                                        <!-- Upload Image -->
                                        <a href="{{ route('sportimage.index', $entry) }}" class="w-full text-white text-center bg-green-600 hover:bg-green-500 focus:ring-4 focus:ring-violet-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                            <span> Upload File</span>
                                            <span class="px-2"><i class="fa-lg fa-solid fa-file-arrow-up"></i></span>
                                        </a>
                                    </td>
                                </tr>

                            </table>
                        @else
                            <div class="py-2">
                                <!-- Upload Image -->
                                <a href="{{ route('sportimage.index', $entry) }}" class="w-full text-white text-center bg-green-600 hover:bg-green-500 focus:ring-4 focus:ring-violet-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                    <span> Upload File</span>
                                    <span class="px-2"><i class="fa-lg fa-solid fa-file-arrow-up"></i></span>
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Buttons -->
            <div class="flex flex-col justify-start sm:flex-row sm:justify-between p-4 gap-4 border-t-2 mt-8">
                <!-- Edit -->
                <a href="{{ route('sportentry.edit', $entry) }}" class="w-full sm:w-1/3 bg-orange-500 hover:bg-orange-400 text-white text-center font-bold py-2 px-4 rounded-md">
                    <span>Edit</span>
                    <i class="fa-solid fa-pencil px-2"></i>
                </a>
                <!-- Delete -->
                <form action="{{ route('sportentry.destroy', $entry) }}" method="POST" class="w-full sm:w-1/3 bg-red-600 hover:bg-red-500 text-white text-center font-bold py-2 px-4 rounded-md">
                    <!-- Add Token to prevent Cross-Site Request Forgery (CSRF) -->
                    @csrf
                    <!-- Dirtective to Override the http method -->
                    @method('DELETE')
                    <button onclick="return confirm('Are you sure you want to delete the entry: {{ $entry->title }}?')">
                        <span>Delete</span>
                        <i class="fa-solid fa-trash px-2"></i>
                    </button>
                </form>
                <!-- Back -->
                <a href="{{ route('sportentry.index') }}" class="w-full sm:w-1/3 bg-black hover:bg-slate-600 text-white text-center font-bold py-2 px-4 rounded-md">
                    Back
                </a>
            </div>

        </div>

    </div>

</x-app-layout>
