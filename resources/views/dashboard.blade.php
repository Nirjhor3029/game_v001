<style>
    .paddin-30{
        padding: 30% !important;
    }
</style>

<x-app-layout>
    <x-slot name="header">
        {{-- <h2 class="font-semibold text-xl text-gray-800 leading-tight">

            {{Form::open(['route'=>'startGame2','method'=>'POST','style'=>'display:inline;'])}}
            <button class="btn btn-primary">Start the Game</button>
            {{Form::close()}}
        </h2> --}}
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <x-jet-welcome />
                hello
            </div> --}}
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <div>
                        <svg viewBox="0 0 317 48" fill="none" xmlns="http://www.w3.org/2000/svg" class="block h-12 w-auto">

                            <path d="M11.395 44.428C4.557 40.198 0 32.632 0 24 0 10.745 10.745 0 24 0a23.891 23.891 0 0113.997 4.502c-.2 17.907-11.097 33.245-26.602 39.926z" fill="#6875F5"></path>
                            <path d="M14.134 45.885A23.914 23.914 0 0024 48c13.255 0 24-10.745 24-24 0-3.516-.756-6.856-2.115-9.866-4.659 15.143-16.608 27.092-31.75 31.751z" fill="#6875F5"></path>
                        </svg>


                    </div>

                    <div class="mt-8 text-2xl">
                        Welcome to The Game Platform!, <b>{{ucfirst(\Illuminate\Support\Facades\Auth::guard('web')->user()->name)}}</b>
                    </div>

                    <div class="mt-6 text-gray-500">
                        Laravel Jetstream provides a beautiful, robust starting point for your next Laravel application. Laravel is designed
                        to help you build your application using a development environment that is simple, powerful, and enjoyable. We believe
                        you should love expressing your creativity through programming, so we have spent time carefully crafting the Laravel
                        ecosystem to be a breath of fresh air. We hope you love it.
                    </div>
                </div>

                <div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-2">
                    <div class="p-6 paddin-30">
                        {{Form::open(['route'=>'gm2.startGame2','method'=>'POST','style'=>'display:inline;'])}}
                        <button class="btn btn-primary">Start the Game</button>
                        {{Form::close()}}
                    </div>

                    <div class="p-6 border-t border-gray-200 md:border-t-0 md:border-l">


                        <div class="p-6 border-t border-gray-200">
                            <div class="flex items-center">
                                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-8 h-8 text-gray-400">
                                    <path d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                <div class="ml-4 text-lg text-gray-600 leading-7 font-semibold"><a href="https://tailwindcss.com/">Tailwind</a></div>
                            </div>

                            <div class="ml-12">
                                <div class="mt-2 text-sm text-gray-500">
                                    Laravel Jetstream is built with Tailwind, an amazing utility first CSS framework that doesn't get in your way. You'll be amazed how easily you can build and
                                    maintain
                                    fresh, modern designs with this wonderful framework at your fingertips.
                                </div>
                            </div>
                        </div>

                        <div class="p-6 border-t border-gray-200 ">
                            <div class="flex items-center">
                                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-8 h-8 text-gray-400">
                                    <path d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                </svg>
                                <div class="ml-4 text-lg text-gray-600 leading-7 font-semibold">Authentication</div>
                            </div>

                            <div class="ml-12">
                                <div class="mt-2 text-sm text-gray-500">
                                    Authentication and registration views are included with Laravel Jetstream, as well as support for user email verification and resetting forgotten passwords. So,
                                    you're
                                    free to get started what matters most: building your application.
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
</x-app-layout>



