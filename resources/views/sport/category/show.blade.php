<!-- To use the layout.blade.php in views/components as a Template to render in the slot variable -->
<x-app-layout>
    <div class="container max-w-6xl mx-auto px-6 py-4">
        <!-- Sitemap -->
        <div class="flex flex-row justify-start items-center py-4 px-2 text-slate-400">
            <a href="/dashboard" class="px-2 hover:text-orange-500">Dashboard </a> /
            <a href="/dashboard/sport" class="px-2 hover:text-orange-500">Sport</a> /
            <a href="/dashboard/sport/category" class="px-2 hover:text-orange-500 text-slate-400">Category</a> /
            <a href="/dashboard/sport/category/{{ $category->id }}" class="px-2 font-bold text-black border-b-2 border-b-orange-500">Info</a>
        </div>

        <div class="bg-white shadow rounded-xl">

            <!-- Header -->
            <div class="flex flex-row justify-between items-center border-b-2 py-4 px-4">
                <div>
                    <h4 class="text-2xl text-zinc-600 leading-6 font-bold">
                        <span style="font-size: 2rem; color: orange; padding-right: 10px;">
                            <i class="fa-solid fa-basketball"></i></span>
                        Category Info
                    </h4>
                </div>
            </div>

            <!-- Info -->
            <div class="py-6 px-4">
                <h2 class="text-lg font-semibold py-2">Category Name</h2>
                <input type="text" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-lg w-2/3 pl-4 p-2  dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-orange-500 dark:focus:border-orange-500" value="{{ $category->name }}" disabled>
            </div>

            <!-- Buttons -->
            <div class="flex flex-col justify-start sm:flex-row sm:justify-between p-4 gap-4 border-t-2">
                <!-- Edit -->
                <a href="{{ route('sportcategory.edit', $category) }}" class="w-full sm:w-1/3 bg-orange-500 hover:bg-orange-400 text-white text-center font-bold py-2 px-4 rounded-md">
                    <span>Edit</span>
                    <i class="fa-solid fa-pencil px-2"></i>
                </a>
                <!-- Delete -->
                <form action="{{ route('sportcategory.destroy', $category) }}" method="POST" class="w-full sm:w-1/3 bg-red-600 hover:bg-red-500 text-white text-center font-bold py-2 px-4 rounded-md">
                    <!-- Add Token to prevent Cross-Site Request Forgery (CSRF) -->
                    @csrf
                    <!-- Dirtective to Override the http method -->
                    @method('DELETE')
                    <button onclick="return confirm('Are you sure you want to delete the category: {{ $category->name }}?')">
                        <span>Delete</span>
                        <i class="fa-solid fa-trash px-2"></i>
                    </button>
                </form>
                <!-- Back -->
                <a href="{{ route('sportcategory.index') }}" class="w-full sm:w-1/3 bg-black hover:bg-slate-600 text-white text-center font-bold py-2 px-4 rounded-md">
                    Back
                </a>

            </div>

        </div>

    </div>

</x-app-layout>
