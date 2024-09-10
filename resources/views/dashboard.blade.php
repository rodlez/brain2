<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <!-- LOGIN -->
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
        <!-- SPORT -->
        <div class="max-w-7xl my-8 mx-auto sm:px-6 lg:px-8">
            <div class="flex flex-col justify-center items-center bg-red-400 sm:flex-row sm:justify-end sm:bg-blue-400 gap-4 text-gray-900 dark:text-gray-100 rounded-lg">

                <div class="flex-col w-2/3 mx-auto sm:w-1/2 p-8 rounded-lg border-2 border-orange-500 bg-black hover:bg-slate-400">
                    <a href="{{ route('sport.main') }}">
                        <div class="text-center">
                            <span style="font-size: 3rem; color: orange;">
                                <i class="fa-solid fa-basketball"></i>
                            </span>
                        </div>
                        <div class="text-center">
                            <h4 class="text-3xl text-white leading-6 font-semibold">
                                Sport
                            </h4>
                        </div>
                    </a>
                </div>

                <div class="flex-col  w-2/3 mx-auto sm:w-1/2 p-8 rounded-lg border-2 border-orange-500 bg-black hover:bg-slate-400">
                    <a href="{{ route('sport.main') }}">
                        <div class="text-center">
                            <span style="font-size: 3rem; color: orange;">
                                <i class="fa-solid fa-basketball"></i>
                            </span>
                        </div>
                        <div class="text-center">
                            <h4 class="text-3xl text-white leading-6 font-semibold">
                                Sport
                            </h4>
                        </div>
                    </a>
                </div>

                <div class="flex-col  w-2/3 mx-auto sm:w-1/2 p-8 rounded-lg border-2 border-orange-500 bg-black hover:bg-slate-400">
                    <a href="{{ route('sport.main') }}">
                        <div class="text-center">
                            <span style="font-size: 3rem; color: orange;">
                                <i class="fa-solid fa-basketball"></i>
                            </span>
                        </div>
                        <div class="text-center">
                            <h4 class="text-3xl text-white leading-6 font-semibold">
                                Sport
                            </h4>
                        </div>
                    </a>
                </div>

                <div class="flex-col  w-2/3 mx-auto sm:w-1/2 p-8 rounded-lg border-2 border-orange-500 bg-black hover:bg-slate-400">
                    <a href="{{ route('sport.main') }}">
                        <div class="text-center">
                            <span style="font-size: 3rem; color: orange;">
                                <i class="fa-solid fa-basketball"></i>
                            </span>
                        </div>
                        <div class="text-center">
                            <h4 class="text-3xl text-white leading-6 font-semibold">
                                Sport
                            </h4>
                        </div>
                    </a>
                </div>

            </div>
        </div>

    </div>


    </div>
</x-app-layout>
