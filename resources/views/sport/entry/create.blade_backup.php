<!-- To use the layout.blade.php in views/components as a Template to render in the slot variable -->
<x-app-layout>
    <div class="container max-w-6xl mx-auto px-6 py-4">
        <!-- Sitemap -->
        <div class="flex flex-row justify-start items-center py-4 px-2 text-slate-400">
            <a href="/dashboard" class="px-2 hover:text-orange-500">Dashboard </a> /
            <a href="/dashboard/sport" class="px-2 hover:text-orange-500">Sport</a> /
            <a href="/dashboard/sport/entry" class="px-2 hover:text-orange-500 text-slate-400">Entries</a> /
            <a href="/dashboard/sport/entry/create" class="px-2 font-bold text-black border-b-2 border-b-orange-500">New</a>
        </div>

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
            </div>

            <form action="{{ route('sportentry.store') }}" method="POST">
                <!-- Add Token to prevent Cross-Site Request Forgery (CSRF) -->
                @csrf
                <!-- Title -->
                <div class="pt-6 px-4">
                    <h2 class="text-lg font-semibold py-2">Title <span class="text-red-400">*</span></h2>
                    <div class="flex flex-row justify-start items-center gap-1">
                        <span class="bg-zinc-200 px-3 py-2 rounded-lg">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </span>
                        <input name="title" id="title" type="text" value="{{ old('title') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-lg w-2/3 pl-4 p-2  dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-orange-500 focus:border-orange-500">
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
                        <select class="bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-lg w-2/3 pl-4 p-2  dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-orange-500 focus:border-orange-500" name="category_id" id="category_id">
                            <?php foreach ($categories as $category) : ?>
                                <option value="{{ $category->id }}"
                                    @if (old('category_id')==$category->id) selected @endif>{{ $category->name }}</option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="pl-6 pb-0 pt-2 text-red-400 italic">
                    @error('category_id')
                    {{ $message }}
                    @enderror
                </div>

                <select class="form-control" name="cat[]" multiple="">
                    <option value="php">PHP</option>
                    <option value="react">React</option>
                    <option value="jquery">JQuery</option>
                    <option value="javascript">Javascript</option>
                    <option value="angular">Angular</option>
                    <option value="vue">Vue</option>
                </select>

                <select class="js-select2 form-control" id="prodmulti" name="prodmulti[]" style="width: 100%;" data-placeholder="Choose many.." multiple>
                    <option value="php">PHP</option>
                    <option value="react">React</option>
                    <option value="jquery">JQuery</option>
                    <option value="javascript">Javascript</option>
                    <option value="angular">Angular</option>
                    <option value="vue">Vue</option>
                </select>


                <!-- Date -->
                <div class="py-0 px-4">
                    <h2 class="text-lg font-semibold py-2">Date <span class="text-red-400">*</span></h2>
                    <div class="flex flex-row justify-start items-center gap-1">
                        <span class="bg-zinc-200 px-3 py-2 rounded-lg">
                            <i class="fa-solid fa-calendar-days"></i>
                        </span>
                        <input name="date" id="date" type="date" value="{{ old('date') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-lg w-2/3 pl-4 p-2  dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-orange-500 focus:border-orange-500">
                    </div>
                </div>
                <div class="pl-6 pb-0 pt-2 text-red-400 italic">
                    @error('date')
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
                        <input name="location" id="location" type="text" value="{{ old('location') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-lg w-2/3 pl-4 p-2  dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-orange-500 focus:border-orange-500">
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
                        <input name="duration" id="duration" type="number" step="5" value="{{ old('duration') }}" class="inline-flex w-20 bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-orange-500 focus:border-orange-500">
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
                        <input name="distance" id="distance" type="number" step="0.1" value="{{ old('distance') }}" class="inline-flex w-20 bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-orange-500 focus:border-orange-500">
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
                    <textarea rows="8" cols="20" name="info" id="info" type="text" class="appearance-none block w-full bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-orange-500 focus:border-orange-500">{{ old('info') }}</textarea>
                </div>
                <!-- Errors -->
                <div class="pl-6 pb-0 pt-2 text-red-400 italic">
                    @error('info')
                    {{ $message }}
                    @enderror
                </div>















                <!-- Buttons -->
                <div class="flex flex-col justify-start sm:flex-row sm:justify-between p-4 gap-4 border-t-2">
                    <button class="w-full sm:w-1/3 bg-orange-500 hover:bg-orange-400 text-white font-bold py-2 px-4 rounded-md">
                        <span>Save</span>
                        <i class="fa-regular fa-share-from-square px-2"></i>
                    </button>

                    <!-- Back -->
                    <a href="{{ route('sportentry.index') }}" class="w-full sm:w-1/3 bg-black hover:bg-slate-600 text-white text-center font-bold py-2 px-4 rounded-md">
                        Back
                    </a>

                </div>

        </div>
        </form>
    </div>


</x-app-layout>