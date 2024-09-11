<x-app-layout>
    <div class="container max-w-6xl mx-auto px-6 py-4">
        <!-- Sitemap -->
        <div class="flex flex-row justify-start items-center py-4 px-2 text-slate-400">
            <a href="/dashboard" class="px-2 hover:text-orange-500">Dashboard </a> /
            <a href="/dashboard/sport" class="px-2 font-bold text-black border-b-2 border-b-orange-500">Sport</a>
        </div>

        <div class="bg-white shadow rounded-xl">
            <div class="flex flex-col max-w-7xl mx-auto py-12 justify-center items-center gap-4 sm:flex-row sm:px-6 lg:px-8">

                <div class="flex flex-col justify-center items-center w-40 h-40 border-4 border-black rounded-lg gap-10 bg-green-600 text-white hover:bg-yellow-200 hover:text-black hover:border-black">
                    <span class="text-xl">Entries</span>
                    <i class="fa-solid fa-dumbbell fa-2xl"></i>
                </div>
                <a href="{{ route('sportcategory.index') }}">
                    <div class="flex flex-col justify-center items-center w-40 h-40 border-4 border-black rounded-lg gap-10 bg-blue-600 text-white hover:bg-yellow-200 hover:text-black hover:border-black">
                        <span>Categories</span>
                        <i class="fa-solid fa-list fa-2xl"></i>
                    </div>
                </a>
                <a href="{{ route('sporttag.index') }}">
                    <div class="flex flex-col justify-center items-center w-40 h-40 border-4 border-black rounded-lg gap-10 bg-orange-500 text-white hover:bg-yellow-200 hover:text-black hover:border-black">
                        <span>Tags</span>
                        <i class="fa-solid fa-tags fa-2xl"></i>
                    </div>
                </a>
            </div>
        </div>
</x-app-layout>
