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

    <!-- Help -->
    @if ($show % 2 != 0)
        <div class="text-white py-4 m-4 bg-zinc-400 rounded-lg">
            <h2 class="text-md px-4 ">Enter the name in the textbox.</h2>
            <p class="px-4">To batch creation add more categories using (Add +) button.</p>
        </div>
    @endif


    <form wire:submit="save">
        <!-- Add Token to prevent Cross-Site Request Forgery (CSRF) -->
        @csrf
        <!-- Title -->
        <div class="pt-6 px-4">
            <h2 class="text-lg font-semibold py-2">Title <span class="text-red-400">*</span></h2>
            <div class="flex flex-row justify-start items-center gap-1">
                <span class="bg-zinc-200 px-3 py-2 rounded-lg">
                    <i class="fa-solid fa-pen-to-square"></i>
                </span>
                <input wire:model="title" name="title" id="title" type="text" value="{{ old('title') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-lg w-2/3 pl-4 p-2  dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-orange-500 focus:border-orange-500">
            </div>
        </div>
        <div class="pl-6 pb-0 pt-2 text-red-400 italic">
            @error('title')
                {{ $message }}
            @enderror
        </div>
        <!-- Category -->
        <div class="py-0 px-4">
            <h2 class="text-lg font-semibold py-2">Category <span class="text-red-400">*</span></h2>
            <div class="flex flex-row justify-start items-center gap-1">
                <span class="bg-zinc-200 px-3 py-2 rounded-lg">
                    <i class="fa-solid fa-list"></i>
                </span>
                <select wire:model="category_id" name="category_id" id="category_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-lg w-2/3 pl-4 p-2  dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-orange-500 focus:border-orange-500">
                    <?php foreach ($categories as $category) : ?>
                    <option value="{{ $category->id }}"
                            @if (old('category_id') == $category->id) selected @endif>{{ $category->name }}</option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="pl-6 pb-0 pt-2 text-red-400 italic">
            @error('category_id')
                {{ $message }}
            @enderror
        </div>
        <!-- Location -->
        <div class="py-0 px-4">
            <h2 class="text-lg font-semibold py-2">Location <span class="text-red-400">*</span></h2>
            <div class="flex flex-row justify-start items-center gap-1">
                <span class="bg-zinc-200 px-3 py-2 rounded-lg">
                    <i class="fa-solid fa-location-dot"></i>
                </span>
                <input wire:model="location" name="location" id="location" type="text" value="{{ old('location') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-lg w-2/3 pl-4 p-2  dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-orange-500 focus:border-orange-500">
            </div>
        </div>
        <div class="pl-6 pb-0 pt-2 text-red-400 italic">
            @error('location')
                {{ $message }}
            @enderror
        </div>
        <!-- Duration -->
        <div class="py-0 px-4">
            <h2 class="text-lg font-semibold py-2">Duration <span class="text-red-400">*</span></h2>
            <div class="flex flex-row justify-start items-center gap-1">
                <span class="bg-zinc-200 px-3 py-2 rounded-lg">
                    <i class="fa-regular fa-clock"></i>
                </span>
                <input wire:model="duration" name="duration" id="duration" type="number" step="5" value="{{ old('duration') }}" class="inline-flex w-20 bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-orange-500 focus:border-orange-500">
                <p class="text-md pl-4 pt-4">minutes</p>
            </div>
        </div>
        <div class="pl-6 pb-0 pt-2 text-red-400 italic">
            @error('duration')
                {{ $message }}
            @enderror
        </div>
        <!-- Distance -->
        <div class="py-0 px-4">
            <h2 class="text-lg font-semibold py-2">Distance</h2>
            <div class="flex flex-row justify-start items-center gap-1">
                <span class="bg-zinc-200 px-3 py-2 rounded-lg">
                    <i class="fa-solid fa-route"></i>
                </span>
                <input wire:model="distance" name="distance" id="distance" type="number" step="0.1" value="{{ old('distance') }}" class="inline-flex w-20 bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-orange-500 focus:border-orange-500">
                <p class="text-md pl-4 pt-4">km</p>
            </div>
        </div>
        <div class="pl-6 pb-0 pt-2 text-red-400 italic">
            @error('distance')
                {{ $message }}
            @enderror
        </div>
        <!-- Info -->
        <div class="py-0 px-4">
            <h2 class="text-lg font-semibold py-2">Info</h2>
            <textarea rows="8" cols="20"wire:model="info" name="info" id="info" type="text" class="appearance-none block w-full bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-orange-500 focus:border-orange-500">{{ old('info') }}</textarea>
        </div>
        <!-- Errors -->
        <div class="pl-6 pb-0 pt-2 text-red-400 italic">
            @error('info')
                {{ $message }}
            @enderror
        </div>








        <!-- Buttons -->
        <div class="flex flex-col justify-start sm:flex-row sm:justify-between p-4 gap-4 border-t-2">
            <button type="submit">Save</button>


            <!-- Back -->
            <a href="{{ route('sportcategory.index') }}" class="order-3 sm:order-3 w-full sm:w-1/3 bg-black hover:bg-slate-600 text-white text-center font-bold py-2 px-4 rounded-md">
                Back
            </a>
        </div>

    </form>
</div>
