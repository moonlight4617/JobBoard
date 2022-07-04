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
