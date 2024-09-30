<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot> --}}


    {{--  <!-- LOGIN -->
            <div class="bg-red-400 mx-6">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        {{ __("You're logged in!") }}
                    </div>
                </div>
            </div> --}}


    <div class="w-11/12 mx-auto flex flex-col shadow-lg">
        <!-- NOTIFICATIONS -->
        <div>
            <div class="flex flex-col bg-lime-600 text-white px-4 py-4 rounded-t-xl">
                <span class="text-xl px-2">Notifications</span>
                <span class="text-sm p-4 mt-2 bg-white text-black rounded-xl">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Officiis similique vel ipsam nam pariatur excepturi cumque voluptate? Ducimus illo adipisci obcaecati unde, fugiat deserunt veniam quidem odio, repellendus impedit fugit. Consequatur libero dolores, dignissimos quas unde ipsa corrupti possimus consequuntur ducimus vitae aspernatur nulla aliquam dolorum aperiam, accusamus, quos inventore.</span>
            </div>
        </div>
        <!-- MAIN MENU -->
        <div class="flex flex-col sm:flex-row sm:flex-wrap sm:justify-center sm:px-4 bg-zinc-100 gap-4">

            <div class="flex justify-center items-center bg-orange-400 w-4/5 mx-auto sm:w-1/4 lg:w-1/5 h-44 my-4 sm:mx-0 rounded-xl text-white">
                <a href="{{ route('sport.main') }}">
                    <div class="text-center">
                        <i class="fa-solid fa-basketball fa-4x"></i>
                    </div>
                    <div class="text-center py-2">
                        <span class="text-4xl">Sport</span>
                    </div>
                </a>
            </div>

            <div class="flex justify-center items-center bg-green-600 w-4/5 mx-auto sm:w-1/4 lg:w-1/5 h-44 my-4 sm:mx-0 rounded-xl text-white">
                <a href="{{ route('code.main') }}">
                    <div class="text-center">
                        <i class="fa-solid fa-laptop-code fa-4x"></i>
                    </div>
                    <div class="text-center py-2">
                        <span class="text-4xl">Coding</span>
                    </div>
                </a>
            </div>

            <div class="flex justify-center items-center bg-blue-400 w-4/5 mx-auto sm:w-1/4 lg:w-1/5 h-44 my-4 sm:mx-0 rounded-xl text-white">
                <a href="{{ route('sport.main') }}">
                    <div class="text-center">
                        <i class="fa-solid fa-calendar-days fa-4x"></i>
                    </div>
                    <div class="text-center py-2">
                        <span class="text-4xl">Agenda</span>
                    </div>
                </a>
            </div>

            <div class="flex justify-center items-center bg-yellow-400 w-4/5 mx-auto sm:w-1/4 lg:w-1/5 h-44 my-4 sm:mx-0 rounded-xl text-white">
                <a href="{{ route('sport.main') }}">
                    <div class="text-center">
                        <i class="fa-solid fa-cubes-stacked fa-4x"></i>
                    </div>
                    <div class="text-center py-2">
                        <span class="text-4xl">Stock</span>
                    </div>
                </a>
            </div>

            <div class="flex justify-center items-center bg-violet-600 w-4/5 mx-auto sm:w-1/4 lg:w-1/5 h-44 my-4 sm:mx-0 rounded-xl text-white">
                <a href="{{ route('sport.main') }}">
                    <div class="text-center">
                        <i class="fa-solid fa-masks-theater fa-4x"></i>
                    </div>
                    <div class="text-center py-2">
                        <span class="text-4xl">Kultur</span>
                    </div>
                </a>
            </div>

            <div class="flex justify-center items-center bg-black w-4/5 mx-auto sm:w-1/4 lg:w-1/5 h-44 my-4 sm:mx-0 rounded-xl text-white">
                <a href="{{ route('sport.main') }}">
                    <div class="text-center">
                        <i class="fa-solid fa-utensils fa-4x"></i>
                    </div>
                    <div class="text-center py-2">
                        <span class="text-4xl">Cook</span>
                    </div>
                </a>
            </div>

        </div>

        <!-- Footer -->
        <div>
            <div class="flex flex-col sm:flex-row sm:justify-end items-center bg-black text-white px-4 py-1 rounded-b-xl">
                <span class="text-md font-semibold">Brain <sup>2</sup></span>
                <i class="fa-solid fa-brain fa-2x px-4 py-2 text-pink-300"></i>
            </div>

        </div>

    </div>


    {{-- <!-- SPORT -->
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
    </div> --}}



</x-app-layout>
