<!-- To use the layout.blade.php in views/components as a Template to render in the slot variable -->
<x-app-layout>

    <div class="container max-w-6xl mx-auto">
        <!-- Sitemap -->
        <div class="flex flex-row justify-start items-center py-2 px-2 text-slate-400">
            <a href="/dashboard" class="px-2 hover:text-green-600">Dashboard </a> /
            <a href="/dashboard/code" class="px-2 hover:text-green-600">Code</a> /
            <a href="/dashboard/code/test" class="px-2 font-bold text-black border-b-2 border-b-green-600">Test</a>
        </div>


        1 quill
        <div class="bg-red-500">
            {{-- <livewire:quill /> --}}
            @livewire('quill', [
                'value' => 'Hello <strong>Buddy!</strong>'
            ])
        </div>

        2 quill
        <div class="bg-green-500">
            {{-- <livewire:quill /> --}}
            @livewire('quill', [
                'value' => 'Mire <strong>usted</strong>'
            ])
        </div>


        

    </div>


</x-app-layout>
