<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            SPORT
        </h2>
    </x-slot>
    <div class="py-12 bg-red-400">
        <div class="flex flex-row max-w-7xl mx-auto sm:px-6 lg:px-8 bg-slate-500 justify-start items-center gap-4">
            <div class="bg-green-400">Entries</div>
            <div><a href="sport/category">Categories</a></div>
            <div><a href="{{ route('sportcategory.index') }}">Categories</a></div>
            <div>Tags</div>
        </div>

    </div>
</x-app-layout>
