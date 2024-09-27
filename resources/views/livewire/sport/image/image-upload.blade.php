<div class="bg-white shadow rounded-xl">

    <!-- Header -->
    <div class="flex flex-row justify-between items-start border-b-2 py-4 bg-orange-400 text-white rounded-t-xl">
        <div class="flex">
            <span><i class="px-4 fa-solid fa-basketball fa-xl text-white"></i></span>
            <span class="text-2xl leading-6 font-bold px-2">Upload File</span>
        </div>
    </div>

    {{-- {{ request()->headers->get('referer') }} --}}

    <div class="mx-16 my-2 pt-4 pb-1 border-b-2 border-b-orange-400">
        <span class="text-xl font-semibold">Entry Title - <span class="text-gray-600 text-md font-normal">{{ excerpt($entry->title, 50) }}</span></span>
    </div>

    <div class="mx-16 py-1 text-xs font-semibold">Files in this entry ({{ $entry->images->count() }} of 5)</div>

    @if ($entry->images->count() > 0)
        <div class="mx-16 py-2 flex flex-row justify-start items-center gap-4">
            @foreach ($entry->images as $image)
                @if ($image->media_type === 'application/pdf')
                    <a href="{{ asset('storage/' . $image->path) }}" title="{{ $image->original_filename }}">
                        <i class="fa-regular fa-file-pdf fa-2xl"></i>
                    </a>
                    <!-- Delete Image -->
                    <form action="{{ route('sportimage.destroy', [$entry, $image]) }}" method="POST">
                        <!-- Add Token to prevent Cross-Site Request Forgery (CSRF) -->
                        @csrf
                        <!-- Dirtective to Override the http method -->
                        @method('DELETE')
                        <button onclick="return confirm('Are you sure you want to delete the image: {{ $image->original_filename }}?')" title="Delete Image">
                            <span class="text-red-600 hover:text-black transition-all duration-500"><i class="fa-lg fa-solid fa-trash"></i></span>
                        </button>
                    </form>
                @else
                    <a href="{{ asset('storage/' . $image->path) }}">
                        <img src="{{ asset('storage/' . $image->path) }}" class="w-24 mx-auto rounded-lg" title="{{ $image->original_filename }}">
                    </a>
                    <!-- Delete Image -->
                    <form action="{{ route('sportimage.destroy', [$entry, $image]) }}" method="POST">
                        <!-- Add Token to prevent Cross-Site Request Forgery (CSRF) -->
                        @csrf
                        <!-- Dirtective to Override the http method -->
                        @method('DELETE')
                        <button onclick="return confirm('Are you sure you want to delete the image: {{ $image->original_filename }}?')" title="Delete Image">
                            <span class="text-red-600 hover:text-black transition-all duration-500"><i class="fa-lg fa-solid fa-trash"></i></span>
                        </button>
                    </form>
                @endif
            @endforeach
        </div>
    @endif

    @if ($entry->images->count() >= 5)
        <div class="mx-16 py-4 text-lg text-red-400 font-semibold">You have reached the limit of files for this entry. Delete some to upload new ones.</div>
        <div class="mx-16 py-8">
            <!-- Back -->
            <a href="{{ route('sportentry.show', $entry) }}" class="w-full sm:w-1/3 bg-black hover:bg-slate-600 text-white text-center font-bold py-2 px-4 rounded-md">
                Back
            </a>
        </div>
    @else
        <div class="mx-16 py-4">
            <form wire:submit.prevent="save">
                <label class="text-lg text-gray-500 font-semibold mb-2 block">Upload files</label>
                <input wire:model.live="images" multiple
                       type="file"
                       class="w-full text-gray-400 font-semibold text-sm bg-white border file:cursor-pointer cursor-pointer file:border-0 file:py-3 file:px-4 file:mr-4 file:bg-black file:hover:bg-slate-600 file:text-white rounded ease-linear transition-all duration-500" />
                <p class="text-xs text-black font-semibold mt-2">PNG, JPG , and PDF are Allowed.</p>

                @if (count($images) + $entry->images->count() > 5)
                    <div class="my-4">
                        <span class="text-red-400 font-semibold">You have reached the limit of files ({{ count($images) + $entry->images->count() }}) for this entry. Delete some to upload new ones.</span>
                    </div>
                @else
                    <button class="bg-black hover:bg-slate-600 text-white font-bold uppercase text-sm px-6 py-3 my-4 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-500" type="submit">
                        <i class="fa-solid fa-file-arrow-up fa-lg px-1"></i> Upload
                    </button>
                @endif

                @error('images')
                    <div class="mt-4 mb-0 py-2 text-sm text-red-600 font-semibold">{{ $message }}</div>
                @enderror
                @error('images.*')
                    @if ($message == 'At least one file is not one of the allowed formats: PDF, JPG, JPEG or PNG')
                        <div class="mt-4 mb-0 py-2 text-sm text-red-600 font-semibold"><i class="fa-solid fa-triangle-exclamation fa-2xl pr-2"></i> {{ $message }}</div>
                    @else
                        <div class="mt-4 mb-0 py-2 text-sm text-red-600 font-semibold">{{ $message }}</div>
                    @endif
                @enderror
            </form>
        </div>

        <div class="mx-16 pb-12">
            @if (count($images) !== 0)
                <div class="py-0"><span class="text-xl px-2">Files selected ({{ count($images) }})</span></div>

                <table class="table-fixed w-full bg-gray-200 border-2">
                    <thead class="text-center text-white bg-black text-md">
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
                                    <td class="py-2"><img class="w-24 mx-auto rounded-lg" src="{{ $image->temporaryURL() }}"></td>
                                @break

                                @case('image/png')
                                    <td class="py-2"><img class="w-24 mx-auto rounded-lg" src="{{ $image->temporaryURL() }}"></td>
                                @break

                                @default
                                    <td class="py-2" title="Not a valid Format"><span class="text-red-600 hover:text-red-400"><i class="fa-solid fa-triangle-exclamation fa-2xl"></i></span></td>
                            @endswitch

                            <td class="py-2 max-sm:hidden">{{ $image->getClientOriginalName() }}</td>
                            <td class="py-2 max-sm:hidden">{{ round($image->getSize() / 1000) }}</td>
                            <td class="py-2 max-sm:hidden">{{ $image->getMimeType() }}</td>
                            <td class="py-2">
                                <a wire:click="deleteImage({{ $position }})" class="cursor-pointer" title="Delete File">
                                    <span class="text-red-600 hover:text-black ease-linear transition-all duration-500"><i class="fa-solid fa-trash"></i></span>
                                </a>
                            </td>
                        </tr>
                        @php($position++)
                    @endforeach
                </table>
            @endif
        </div>

    @endif


</div>
