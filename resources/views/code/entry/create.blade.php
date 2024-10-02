<x-app-layout>
    <div class="container max-w-6xl mx-auto">
        <!-- Sitemap -->
        <div class="flex flex-row justify-start items-center py-2 px-2 text-slate-400">
            <a href="/dashboard" class="px-2 hover:text-green-600">Dashboard </a> /
            <a href="/dashboard/code" class="px-2 hover:text-green-600">Code</a> /
            <a href="/dashboard/code/entry" class="px-2 hover:text-green-600">Entries</a> /
            <a href="/dashboard/code/entry/create" class="px-2 font-bold text-black border-b-2 border-b-green-600">New</a>
        </div>
        <livewire:code.entry.entry-create />
    </div>
</x-app-layout>
