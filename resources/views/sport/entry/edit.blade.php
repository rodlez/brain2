<x-app-layout>
    <div class="container max-w-6xl mx-auto px-6 py-4">
        <!-- Sitemap -->
        <div class="flex flex-row justify-start items-center py-4 px-2 text-slate-400">
            <a href="/dashboard" class="px-2 hover:text-orange-500">Dashboard </a> /
            <a href="/dashboard/sport" class="px-2 hover:text-orange-500">Sport</a> /
            <a href="/dashboard/sport/entry" class="px-2 hover:text-orange-500">Entries</a> /
            <a href="/dashboard/sport/entry/edit/{{ $entry->id }}" class="px-2 font-bold text-black border-b-2 border-b-orange-500">Edit</a>
        </div>
        <livewire:sport.entry.entry-edit :entry="$entry" />
    </div>

</x-app-layout>
