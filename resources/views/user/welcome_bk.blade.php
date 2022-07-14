<x-app-layout>
    <x-slot name="header">
        <img src="/images/logo.png" class="w-20 py-0" alt="ロゴ" />
    </x-slot>

    <div class="relative flex items-top justify-center bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">

        @auth('users')
        @else
            <div class="fixed top-0 right-0 px-6 py-4 block">
                @if (Route::has('company.login'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('company.login') }}">
                        {{ __('企業はこちら') }}
                    </a>
                @endif
            </div>
        @endauth

        <div
            class="container bg-no-repeat sm:w-4/5 md:w-4/5 pt-12 sm:pt-24 sm:mt-12 pb-12 bg-[url('/images/topImage-white.png')] bg-contain bg-center">
            <div class="text-center"><small>飲食の求人サイト</small></div>
            <img src="/images/logo.png" class="w-24 sm:w-48 mx-auto" alt="ロゴ" />
            <p class="text-center">JobPairは飲食に特化した求人サイトです。</p>
            <p class="text-center mx-auto w-4/5 md:w-3/5 lg:w-1/2">
                自分で作った料理の写真をアップロードしたり、マイページを充実させることで、企業側に様々な面をアピールすることができます。
            </p>
            <br />
            <div class="flex justify-around mt-4 px-4">

                @auth('users')
                @else
                    <button type="button"
                        class="bg-white border-0 py-2 px-8 focus:outline-none hover:outline-none rounded text-lg"
                        onclick="location.href='{{ route('user.register') }}'">登録</button>
                    <button type="button"
                        class="bg-blue-300 border-0 py-2 px-8 focus:outline-none hover:bg-blue-400 rounded text-lg"
                        onclick="location.href='{{ route('user.login') }}'">ログイン</button>
                @endauth

            </div>
        </div>
    </div>
</x-app-layout>



<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
    <!-- Icon -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        <!-- Page Heading -->
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <img src="/images/logo.png" class="w-20 py-0" alt="ロゴ" />
            </div>
        </header>

        <!-- Page Content -->
        <main>
            <div
                class="relative flex items-top justify-center bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">

                @auth('users')
                    {{-- @if (auth('users')) --}}
                @else
                    <div class="fixed top-0 right-0 px-6 py-4 block">
                        @if (Route::has('company.login'))
                            <a class="underline text-sm text-gray-600 hover:text-gray-900"
                                href="{{ route('company.login') }}">
                                {{ __('企業はこちら') }}
                            </a>
                        @endif
                    </div>
                @endauth
                {{-- @endif --}}


                <div
                    class="container bg-no-repeat sm:w-4/5 md:w-4/5 pt-12 sm:pt-24 sm:mt-12 pb-12 bg-[url('/images/topImage-white.png')] bg-contain bg-center">
                    <div class="text-center"><small>飲食の求人サイト</small></div>
                    <img src="/images/logo.png" class="w-24 sm:w-48 mx-auto" alt="ロゴ" />
                    <p class="text-center">JobPairは飲食に特化した求人サイトです。</p>
                    <p class="text-center mx-auto w-4/5 md:w-3/5 lg:w-1/2">
                        自分で作った料理の写真をアップロードしたり、マイページを充実させることで、企業側に様々な面をアピールすることができます。
                    </p>
                    <br />
                    <div class="flex justify-around mt-4 px-4">

                        @auth('users')
                            {{-- @if (auth('users')) --}}
                        @else
                            <button type="button"
                                class="bg-white border-0 py-2 px-8 focus:outline-none hover:outline-none rounded text-lg"
                                onclick="location.href='{{ route('user.register') }}'">登録</button>
                            <button type="button"
                                class="bg-blue-300 border-0 py-2 px-8 focus:outline-none hover:bg-blue-400 rounded text-lg"
                                onclick="location.href='{{ route('user.login') }}'">ログイン</button>
                            {{-- @endif --}}
                        @endauth
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>

</html>
