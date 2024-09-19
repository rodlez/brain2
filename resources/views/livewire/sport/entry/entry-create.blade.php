<div class="bg-white shadow rounded-xl">

    <!-- Header -->
    <div class="flex flex-row justify-between items-center border-b-2 py-4 px-4">
        <div>
            <h4 class="text-2xl text-zinc-600 leading-6 font-bold">
                <span style="font-size: 2rem; color: orange; padding-right: 10px;">
                    <i class="fa-solid fa-basketball"></i></span>
                New Entry
            </h4>
        </div>
        <div>
            <button wire:click="help">
                <span style="font-size: 1.5rem; color: black;">
                    <i class="fa-regular fa-circle-question"></i>
                </span>
            </button>

        </div>
    </div>

    <form wire:submit="save">
        <!-- Add Token to prevent Cross-Site Request Forgery (CSRF) -->
        @csrf
        <!-- Status -->
        <div class="flex flex-row justify-start items-end py-6 px-4 sm:px-16 gap-4 bg-orange-300">
            <div class="pl-16">
                <h2 class="text-black text-lg font-semibold py-2">Pending</h2>
            </div>
            <div>
                <label class="inline-flex items-center cursor-pointer">
                    <input wire:model="status" name="status" id="status" type="checkbox" value="{{ old('status') }}" class="sr-only peer">
                    <div class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-white dark:peer-focus:ring-gray-600 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-green-600"></div>
                </label>
            </div>
        </div>
        <!-- Title -->
        <div class="py-0 px-4 sm:mx-12">
            <div class="px-16">
                <h2 class="text-lg font-semibold py-2">Title <span class="text-red-400">*</span></h2>
            </div>
            <div class="flex flex-row justify-start items-center gap-4">
                <span class="bg-zinc-200 px-3 py-2 rounded-lg">
                    <i class="fa-solid fa-pen-to-square"></i>
                </span>
                <input wire:model="title" name="title" id="title" type="text" value="{{ old('title') }}" class="w-full pl-4 p-2 text-md rounded-lg bg-gray-50 border border-gray-300 text-gray-900 dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-orange-500 focus:border-orange-500">
            </div>
        </div>
        <div class="py-2 px-20 sm:mx-12 text-red-600 font-semibold">
            @error('title')
                {{ $message }}
            @enderror
        </div>
        <!-- Date -->
        <div class="py-0 px-4 sm:mx-12">
            <div class="px-16">
                <h2 class="text-lg font-semibold py-2">Date <span class="text-red-400">*</span></h2>
            </div>
            <div class="flex flex-row justify-start items-center gap-4">
                <span class="bg-zinc-200 px-3 py-2 rounded-lg">
                    <i class="fa-solid fa-calendar-days"></i>
                </span>
                <input wire:model="date" name="date" id="date" type="date" {{-- min="2024-01-01" --}} value="{{ old('date') }}" class="w-full sm:w-1/3 pl-4 p-2 text-md rounded-lg bg-gray-50 border border-gray-300 text-gray-900 dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-orange-500 focus:border-orange-500">
            </div>
        </div>
        <div class="py-2 px-20 sm:mx-12 text-red-600 font-semibold">
            @error('date')
                {{ $message }}
            @enderror
        </div>
        <!-- Category -->
        <div class="py-0 px-4 sm:mx-12">
            <div class="px-16">
                <h2 class="text-lg font-semibold py-2">Category <span class="text-red-400">*</span></h2>
            </div>
            <div class="flex flex-row justify-start items-center gap-4">
                <span class="bg-zinc-200 px-3 py-2 rounded-lg">
                    <i class="fa-solid fa-list"></i>
                </span>
                <select wire:model="category_id" name="category_id" id="category_id" class="w-full pl-4 p-2 text-md rounded-lg bg-gray-50 border border-gray-300 text-gray-900 dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-orange-500 focus:border-orange-500">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" class="text-orange-500"
                                @if (old('category_id') == $category->id) selected @endif>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="py-2 px-20 sm:mx-12 text-red-600 font-semibold">
            @error('category_id')
                {{ $message }}
            @enderror
        </div>
        <!-- Help -->
        @if ($show % 2 != 0)
            <div class="text-white py-4 m-4 bg-zinc-400 rounded-lg">
                <p class="px-4">Use Ctrl + select to select multiple tags</p>
            </div>
        @endif
        <!-- Tags -->
        <div class="py-0 px-4 sm:mx-12">
            <div class="px-16">
                <h2 class="text-lg font-semibold py-2">Tags <span class="text-red-400">*</span></h2>
            </div>
            <div class="flex flex-row justify-start items-start gap-4">
                <span class="bg-zinc-200 px-3 py-2 rounded-lg">
                    <i class="fa-solid fa-tags"></i>
                </span>
                <select wire:model.live="selectedTags" name="selectedTags" id="selectedTags" multiple class="w-full pl-4 p-2 text-md rounded-lg bg-gray-50 border border-gray-300 text-gray-900  dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-orange-500 focus:border-orange-500">
                    @foreach ($tags as $tag)
                        <option value="{{ $tag->id }}"
                                @if (old('selectedTags') == $tag->id) selected @endif>{{ $tag->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="py-2 px-20 sm:mx-12 text-red-600 font-semibold">
            @error('selectedTags')
                {{ $message }}
            @enderror
        </div>
        <!-- Location -->
        <div class="py-0 px-4 sm:mx-12">
            <div class="px-16">
                <h2 class="text-lg font-semibold py-2">Location <span class="text-red-400">*</span></h2>
            </div>
            <div class="flex flex-row justify-start items-center gap-4">
                <span class="bg-zinc-200 px-3 py-2 rounded-lg">
                    <i class="fa-solid fa-location-dot"></i>
                </span>
                <input wire:model="location" name="location" id="location" type="text" value="{{ old('location') }}" class="w-full pl-4 p-2 bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-orange-500 focus:border-orange-500">
            </div>
        </div>
        <div class="py-2 px-20 sm:mx-12 text-red-600 font-semibold">
            @error('location')
                {{ $message }}
            @enderror
        </div>
        <!-- Duration -->
        <div class="py-0 px-4 sm:mx-12">
            <div class="px-16">
                <h2 class="text-lg font-semibold py-2">Duration <span class="text-red-400">*</span></h2>
            </div>
            <div class="flex flex-row justify-start items-end gap-4">
                <span class="bg-zinc-200 px-3 py-2 rounded-lg">
                    <i class="fa-regular fa-clock"></i>
                </span>
                <input wire:model="duration" name="duration" id="duration" type="number" step="1" value="{{ old('duration') }}" class="inline-flex w-20 bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-orange-500 focus:border-orange-500">
                <p class="text-sm">minutes</p>
            </div>
        </div>
        <div class="py-2 px-20 sm:mx-12 text-red-600 font-semibold">
            @error('duration')
                {{ $message }}
            @enderror
        </div>
        <!-- Distance -->
        <div class="py-0 px-4 sm:mx-12">
            <div class="px-16">
                <h2 class="text-lg font-semibold py-2">Distance</h2>
            </div>
            <div class="flex flex-row justify-start items-end gap-4">
                <span class="bg-zinc-200 px-3 py-2 rounded-lg">
                    <i class="fa-solid fa-route"></i>
                </span>
                <input wire:model="distance" name="distance" id="distance" type="number" step="0.1" value="{{ old('distance') }}" class="inline-flex w-20 bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-orange-500 focus:border-orange-500">
                <p class="text-sm">km</p>
            </div>
        </div>
        <div class="py-2 px-20 sm:mx-12 text-red-600 font-semibold">
            @error('distance')
                {{ $message }}
            @enderror
        </div>
        <!-- Url -->
        <div class="py-0 px-4 sm:mx-12">
            <div class="px-16">
                <h2 class="text-lg font-semibold py-2">Url</h2>
            </div>
            <div class="flex flex-row justify-start items-center gap-4">
                <span class="bg-zinc-200 px-3 py-2 rounded-lg">
                    <i class="fa-solid fa-globe"></i>
                </span>
                <input wire:model="url" name="url" id="url" type="text" value="{{ old('url') }}" class="w-full pl-4 p-2 bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-orange-500 focus:border-orange-500">
            </div>
        </div>
        <div class="py-2 px-20 sm:mx-12 text-sm text-red-600 font-semibold">
            @error('url')
                {{ $message }}
            @enderror
        </div>
        <!-- Info -->
        <div class="py-0 px-4 sm:mx-12">
            <div class="px-16">
                <h2 class="text-lg font-semibold py-2">Info</h2>
            </div>
            <div class="flex flex-row justify-start items-start gap-4">
                <span class="bg-zinc-200 px-3 py-2 rounded-lg">
                    <i class="fa-solid fa-circle-info"></i>
                </span>
                <textarea rows="8" cols="20" wire:model="info" name="info" id="info" type="text" class="appearance-none block w-full bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-orange-500 focus:border-orange-500">{{ old('info') }}</textarea>
            </div>
        </div>
        <!-- Errors -->
        <div class="py-2 px-20 sm:mx-12 text-red-600 font-semibold">
            @error('info')
                {{ $message }}
            @enderror
        </div>

        <!-- Buttons -->
        <div class="flex flex-col justify-start sm:flex-row sm:justify-between mt-6 p-4 gap-4 border-t-2">
            <!-- Save -->
            <button type="submit" class="order-3 sm:order-3 w-full sm:w-1/3 bg-orange-500 hover:bg-orange-400 text-white text-center font-bold py-2 px-4 rounded-md">
                <span>Save</span>
                <i class="fa-regular fa-share-from-square px-2"></i>
            </button>
            <!-- Back -->
            <a href="{{ route('sportentry.index') }}" class="order-3 sm:order-3 w-full sm:w-1/3 bg-black hover:bg-slate-800 text-white text-center font-bold py-2 px-4 rounded-md">
                Back
            </a>
        </div>

    </form>
</div>
