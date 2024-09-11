<!-- To use the layout.blade.php in views/components as a Template to render in the slot variable -->
<x-app-layout>
    <div class="container max-w-6xl mx-auto px-6 py-4">
        <!-- Sitemap -->
        <div class="flex flex-row justify-start items-center py-4 px-2 text-slate-400">
            <a href="/dashboard" class="px-2 hover:text-orange-500">Dashboard </a> /
            <a href="/dashboard/sport" class="px-2 hover:text-orange-500">Sport</a> /
            <a href="/dashboard/sport/tag" class="px-2 hover:text-orange-500">Tags</a> /
            <a href="/dashboard/sport/tag/create" class="px-2 font-bold text-black border-b-2 border-b-orange-500">New</a>
        </div>
        <livewire:sport.tag.tag-create />
    </div>

</x-app-layout>
