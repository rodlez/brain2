<div class="bg-white shadow rounded-xl">

    <!-- Header -->
    <div class="flex flex-row justify-between items-center border-b-2 py-4 px-4">
        <div>
            <h4 class="text-2xl text-zinc-600 leading-6 font-bold">
                <span style="font-size: 2rem; color: orange; padding-right: 10px;">
                    <i class="fa-solid fa-basketball"></i></span>
                New tag
            </h4>
        </div>
        <div>
            <button wire:click="help">
                <span style="font-size: 1.5rem; color: black;">
                    <i class="fa-regular fa-circle-question"></i>
                </span>
            </button>

        </div>
    </div>

    <!-- Help -->
    @if ($show % 2 != 0)
        <div class="text-white py-4 m-4 bg-zinc-400 rounded-lg">
            <h2 class="text-md px-4 ">Enter the name in the textbox.</h2>
            <p class="px-4">To batch creation add more tags using (Add +) button.</p>
        </div>
    @endif

    <!--tag Form -->
    <div class="py-6 px-4">
        @foreach ($inputs as $key => $value)
            <div>
                <input wire:model="inputs.{{ $key }}.name" type="text" id="inputs.{{ $key }}.name" class="bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-lg focus:ring-orange-500 focus:border-orange-500 w-2/3 pl-4 p-2  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-orange-500 dark:focus:border-orange-500" placeholder="enter tag name">
                <button wire:click="remove({{ $key }})" class="align-middle mx-2 px-2">
                    <span style="font-size: 1.2rem; color: rgba(204, 13, 13, 0.849);"><i class="fa-solid fa-trash"></i></span>
                </button>
            </div>
            <div class="p-2 text-red-400 italic">
                @error('inputs.' . $key . '.name')
                    {{ $message }}
                @enderror
            </div>
        @endforeach
    </div>

    <!-- Buttons -->
    <div class="flex flex-col justify-start sm:flex-row sm:justify-between p-4 gap-4 border-t-2">
        <!-- Save -->
        @if (count($inputs) == 0)
            <button wire:click="save" class="order-2 cursor-not-allowed w-full sm:w-1/3 bg-orange-500 hover:bg-orange-400 text-white font-bold py-2 px-4 rounded-md" disabled>
                <span>Save</span>
                <i class="fa-regular fa-share-from-square px-2"></i>
            </button>
        @else
            <button wire:click="save" class="order-2 sm:order-1 w-full sm:w-1/3 bg-orange-500 hover:bg-orange-400 text-white font-bold py-2 px-4 rounded-md">
                <span>Save</span>
                <i class="fa-regular fa-share-from-square px-2"></i>
            </button>
        @endif
        <!-- Add -->
        <button wire:click="add" class="order-1 sm:order-2 w-full sm:w-1/3 bg-green-700 hover:bg-green-600 text-white font-bold py-2 px-4 rounded-md">
            <span>Add</span>
            <i class="fa-solid fa-plus px-2"></i>
        </button>
        <!-- Back -->
        <a href="{{ route('sporttag.index') }}" class="order-3 sm:order-3 w-full sm:w-1/3 bg-black hover:bg-slate-600 text-white text-center font-bold py-2 px-4 rounded-md">
            Back
        </a>
    </div>

</div>
