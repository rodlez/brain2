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
            <div class="flex flex-row justify-between items-center border-b-2 py-4 px-4">
                <div>
                    <h4 class="text-2xl text-zinc-600 leading-6 font-bold">
                        <span style="font-size: 2rem; color: orange; padding-right: 10px;">
                            <i class="fa-solid fa-basketball"></i></span>
                        Informantion
                    </h4>
                </div>
            </div>


            <!-- Title -->
            <div class="pt-6 px-4">
                <h2 class="text-lg font-semibold py-2">Title <span class="text-red-400">*</span></h2>
                <div class="flex flex-row justify-start items-center gap-1">
                    <span class="bg-zinc-200 px-3 py-2 rounded-lg">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </span>
                    <input name="title" id="title" type="text" value="{{ $entry->title }}" disabled class="bg-gray-200 border border-gray-300 text-gray-900 text-md rounded-lg w-2/3 pl-4 p-2  dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-orange-500 focus:border-orange-500 cursor-not-allowed">
                </div>
            </div>
            <!-- Date -->
            <div class="py-0 px-4">
                <h2 class="text-lg font-semibold py-2">Date <span class="text-red-400">*</span></h2>
                <div class="flex flex-row justify-start items-center gap-1">
                    <span class="bg-zinc-200 px-3 py-2 rounded-lg">
                        <i class="fa-solid fa-calendar-days"></i>
                    </span>
                    <input name="date" id="date" type="date" min="2024-01-01" value="{{ $entry->date }}" disabled class="bg-gray-200 border border-gray-300 text-gray-900 text-md rounded-lg w-2/3 pl-4 p-2  dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-orange-500 focus:border-orange-500 cursor-not-allowed">
                </div>
            </div>
            <!-- Category -->
            <div class="py-0 px-4">
                <h2 class="text-lg font-semibold py-2">Category <span class="text-red-400">*</span></h2>
                <div class="flex flex-row justify-start items-center gap-1">
                    <span class="bg-zinc-200 px-3 py-2 rounded-lg">
                        <i class="fa-solid fa-list"></i>
                    </span>
                    <input name="category" id="category" type="text" value="{{ $entry->category->name }}" disabled class="bg-gray-200 border border-gray-300 text-gray-900 text-md rounded-lg w-2/3 pl-4 p-2  dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-orange-500 focus:border-orange-500 cursor-not-allowed">
                </div>
            </div>
            <!-- Tags -->
            <div class="py-0 px-4">
                <h2 class="text-lg font-semibold py-2">Tags <span class="text-red-400">*</span></h2>
                <div class="flex flex-row justify-start items-center gap-1">
                    <span class="bg-zinc-200 px-3 py-2 rounded-lg">
                        <i class="fa-solid fa-tags"></i>
                    </span>
                    <div class="bg-gray-200 border w-100 p-2 rounded-lg cursor-not-allowed">
                        @foreach ($tags as $tag)
                            {{ $tag }}
                        @endforeach
                    </div>
                </div>
            </div>
            <!-- Location -->
            <div class="py-0 px-4">
                <h2 class="text-lg font-semibold py-2">Location <span class="text-red-400">*</span></h2>
                <div class="flex flex-row justify-start items-center gap-1">
                    <span class="bg-zinc-200 px-3 py-2 rounded-lg">
                        <i class="fa-solid fa-location-dot"></i>
                    </span>
                    <input name="location" id="location" type="text" value="{{ $entry->location }}" disabled class="bg-gray-200 border border-gray-300 text-gray-900 text-md rounded-lg w-2/3 pl-4 p-2  dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-orange-500 focus:border-orange-500 cursor-not-allowed">
                </div>
            </div>
            <!-- Duration -->
            <div class="py-0 px-4">
                <h2 class="text-lg font-semibold py-2">Duration <span class="text-red-400">*</span></h2>
                <div class="flex flex-row justify-start items-center gap-1">
                    <span class="bg-zinc-200 px-3 py-2 rounded-lg">
                        <i class="fa-regular fa-clock"></i>
                    </span>
                    <input name="duration" id="duration" type="number" value="{{ $entry->duration }}" disabled class="inline-flex w-20 bg-gray-200 border border-gray-300 text-gray-900 text-md rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-orange-500 focus:border-orange-500 cursor-not-allowed">
                    <p class="text-md pl-4 pt-4">minutes</p>
                </div>
            </div>
            <!-- Distance -->
            <div class="py-0 px-4">
                <h2 class="text-lg font-semibold py-2">Distance</h2>
                <div class="flex flex-row justify-start items-center gap-1">
                    <span class="bg-zinc-200 px-3 py-2 rounded-lg">
                        <i class="fa-solid fa-route"></i>
                    </span>
                    <input name="distance" id="distance" type="text" value="{{ $entry->distance === null ? '---' : $entry->distance }}" disabled class="inline-flex w-20 bg-gray-200 border border-gray-300 text-gray-900 text-md rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-orange-500 focus:border-orange-500 cursor-not-allowed">
                    <p class="text-md pl-4 pt-4">km</p>
                </div>
            </div>
            @if ($entry->info !== null)
                <!-- Info -->
                <div class="py-0 px-4">
                    <h2 class="text-lg font-semibold py-2">Info</h2>
                    <textarea rows="8" cols="20"wire:model="info" name="info" id="info" type="text" class="appearance-none block w-full bg-gray-200 border border-gray-300 text-gray-900 text-md rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-orange-500 focus:border-orange-500 cursor-not-allowed">{{ $entry->info }}</textarea>
                </div>
            @endif

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
