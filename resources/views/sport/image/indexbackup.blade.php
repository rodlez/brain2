<!-- To use the layout.blade.php in views/components as a Template to render in the slot variable -->
<x-app-layout>
    <div class="container max-w-6xl mx-auto px-6 py-4">
        <!-- Sitemap -->
        <div class="flex flex-row justify-start items-center py-4 px-2 text-slate-400">
            <a href="/dashboard" class="px-2 hover:text-orange-500">Dashboard </a> /
            <a href="/dashboard/sport" class="px-2 hover:text-orange-500">Sport</a> /
            <a href="/dashboard/sport/entry/{{ $entry->id }}" class="px-2 font-bold hover:text-orange-500">Entry</a> /
            <a href="/dashboard/sport/entry/{{ $entry->id }}/image" class="px-2 font-bold text-black border-b-2 border-b-orange-500">Upload</a>
        </div>

        <div class="bg-white shadow rounded-xl">

            <!-- Header -->
            <div class="flex flex-row justify-between items-center border-b-2 py-2 px-4">
                <div>
                    <h4 class="text-2xl text-zinc-600 leading-6 font-bold">
                        <span style="font-size: 2rem; color: orange; padding-right: 10px;">
                            <i class="fa-solid fa-basketball"></i></span>
                        Upload File
                    </h4>
                </div>
            </div>

            <div class="flex flex-col justify-start items-start gap-4">
                <div class="px-12 py-4">
                    <span class="text-xl">Entry: {{ excerpt($entry->title, 30) }}</span>
                </div>
                <div class="px-12 pb-12">
                    <form action="{{ route('sportimage.store', $entry) }}" method="POST" enctype="multipart/form-data">
                        <!-- Add Token to prevent Cross-Site Request Forgery (CSRF) -->
                        @csrf

                        <div>
                            <input type="file" name="images[]" multiple>
                        </div>
                        <div>
                            <button type="submit">Submit</button>
                        </div>
                        @error('images')
                            <div class="text-orange-600">{{ $message }}</div>
                        @enderror
                        @error('images.*')
                            <div class="text-red-600">{{ $message }}</div>
                        @enderror
                    </form>
                </div>
            </div>

        </div>

</x-app-layout>
