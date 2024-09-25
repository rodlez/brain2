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

    <div class="px-12 py-4">
        <span class="text-xl">Entry: {{ excerpt($entry->title, 30) }}</span>
    </div>
    <div class="px-12 pb-12">
        <form wire:submit.prevent="save">
            <label class="text-base text-gray-500 font-semibold mb-2 block">Upload files</label>
            <input wire:model.live="images" multiple
                   type="file"
                   class="w-full text-gray-400 font-semibold text-sm bg-white border file:cursor-pointer cursor-pointer file:border-0 file:py-3 file:px-4 file:mr-4 file:bg-black file:hover:bg-orange-500 file:text-white rounded ease-linear transition-all duration-500" />
            <p class="text-xs text-black font-semibold mt-2">PNG, JPG , and PDF are Allowed.</p>

            <button class="bg-black hover:bg-orange-600 text-white font-bold uppercase text-sm px-6 py-3 my-2 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-500" type="submit">
                <i class="fa-solid fa-file-arrow-up fa-lg px-1"></i> Upload
            </button>

            @error('images')
                <div class="my-4 py-2 text-red-600 font-semibold">{{ $message }}</div>
            @enderror
            @error('images.*')
                <div class="my-4 py-2 text-red-600 font-semibold">{{ $message }}</div>
            @enderror
        </form>
    </div>

    <div class="px-12 pb-12">
        @if (count($images) !== 0)
            <div class="py-0"><span class="text-xl px-2">{{ count($images) }} Files to Upload</span></div>

            <table class="table-fixed w-full bg-white">
                <thead class="text-center text-black bg-gray-200">
                    <th></th>
                    <th class="py-2 max-sm:hidden">Filename</th>
                    <th class="py-2 max-sm:hidden">Size (KB)</th>
                    <th class="py-2 max-sm:hidden">Format</th>
                    <th></th>
                </thead>

                @php($position = 0)
                @foreach ($images as $image)
                    <tr class="bg-white border-b-2 text-center">

                        @switch($image->getMimeType())
                            @case('application/pdf')
                                <td class="py-2"><i class="fa-regular fa-file-pdf fa-2xl"></i></td>
                            @break

                            @case('image/jpeg')
                                <td class="py-2"><img class="rounded-md" src="{{ $image->temporaryURL() }}" width="150"></td>
                            @break

                            @case('image/png')
                                <td class="py-2"><img class="rounded-md" src="{{ $image->temporaryURL() }}" width="150"></td>
                            @break

                            @default
                                <td class="py-2" title="Not a valid Format"><span class="text-red-600 hover:text-red-400"><i class="fa-solid fa-triangle-exclamation fa-2xl"></i></span></td>
                        @endswitch

                        <td class="py-2 max-sm:hidden">{{ $image->getClientOriginalName() }}</td>
                        <td class="py-2 max-sm:hidden">{{ round($image->getSize() / 1000) }}</td>
                        <td class="py-2 max-sm:hidden">{{ $image->getMimeType() }}</td>
                        <td class="py-2">
                            <a wire:click="deleteImage({{ $position }})" class="cursor-pointer" title="Delete File">
                                <span class="hover:text-red-600 ease-linear transition-all duration-500"><i class="fa-solid fa-trash"></i></span>
                            </a>
                        </td>
                    </tr>
                    @php($position++)
                @endforeach
            </table>
        @endif
    </div>


</div>
