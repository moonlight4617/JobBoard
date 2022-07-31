<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            ユーザーページ
        </h2>
    </x-slot>

    <div class="py-12">
        <x-flash-message status="session('status')" />
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <section class="text-gray-600 body-font relative">
                        <div class="container px-5 py-4 mx-auto">
                            <x-auth-validation-errors class="mb-4" :errors="$errors" />
                            <div class="md:w-4/5 lg:w-3/5 mx-auto mt-4">
                                <div class="flex items-center pb-10 border-gray-200 sm:flex-row flex-col">
                                    <div class="sm:mr-10 inline-flex items-center justify-center">
                                        @if (empty($user->pro_image))
                                            <img class="rounded-full h-40 w-40"
                                                src="https://via.placeholder.com/100x100?text=No+Image">
                                        @else
                                            <img class="rounded-full h-40 w-40 object-cover"
                                                src="/images/{{ $user->pro_image }}">
                                            {{-- src="{{ asset('storage/users/' . $user->pro_image) }}"> --}}
                                        @endif
                                    </div>
                                    <div class="flex-grow sm:text-left text-center mt-6 sm:mt-0">
                                        <div class="flex items-center mb-2">
                                            <p class="text-gray-900 title-font font-bold text-4xl">
                                                {{ $user->name }}
                                            </p>
                                        </div>
                                        <p class="leading-relaxed text-xl">{{ $user->catch }}</p>
                                    </div>
                                </div>

                                <div class="p-2">
                                    <div class="relative">
                                        <div class="my-4">
                                            <span class="font-bold border p-1 border-gray-400 rounded">自己紹介文</span>
                                        </div>
                                        <p class="ml-2">{!! $user->intro !!}</p>
                                    </div>
                                </div>
                                <div class="p-2">
                                    <div class="relative">
                                        <div class="my-4">
                                            <span class="font-bold border p-1 border-gray-400 rounded">経歴</span>
                                        </div>
                                        <p class="ml-2">{!! $user->career !!}</p>
                                    </div>
                                </div>
                                <div class="p-2">
                                    <div class="relative">
                                        <div class="my-4">
                                            <span class="font-bold border p-1 border-gray-400 rounded">資格</span>
                                        </div>
                                        <p class="ml-2">{!! $user->license !!}</p>
                                    </div>
                                </div>
                                <div class="p-2">
                                    <div class="relative">
                                        <div class="my-4">
                                            <span class="font-bold border p-1 border-gray-400 rounded">趣味・特技</span>
                                        </div>
                                        <p class="ml-2">{!! $user->hobby !!}</p>
                                    </div>
                                </div>

                                @if ($tags)
                                    <div class="p-2">
                                        <div class="my-4">
                                            <span class="font-bold border p-1 border-gray-400 rounded">特徴タグ</span>
                                        </div>
                                        @foreach ($tags as $tag)
                                            <div class="relative inline-block px-1 py-2">
                                                <div class="text-white rounded-full bg-teal-500 ease-in px-2 py-1">
                                                    {{ $tag->tag_name }}
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif

                                <div class="p-2">
                                    <div class="my-4">
                                        <span class="font-bold border p-1 border-gray-400 rounded">SNS</span>
                                    </div>
                                    <div class="relative flex ml-2">
                                        @if ($user->twitter)
                                            <a href="https://{{ $user->twitter }}" target="_blank">
                                                <img src="/images/twitter-brands.svg" class="w-8 mx-2" />
                                            </a>
                                        @endif
                                        @if ($user->youtube)
                                            <a href="https://{{ $user->youtube }}" target="_blank">
                                                <img src="/images/youtube-brands.svg" class="w-8 mx-2" />
                                            </a>
                                        @endif
                                        @if ($user->insta)
                                            <a href="https://{{ $user->insta }}" target="_blank">
                                                <img src="/images/instagram-brands.svg" class="w-8 mx-2" />
                                            </a>
                                        @endif
                                        @if ($user->blog)
                                            <a href="https://{{ $user->blog }}" target="_blank">
                                                <img src="/images/blogger-brands.svg" class="w-8 mx-2" alt="ブログ" />
                                            </a>
                                        @endif
                                    </div>
                                </div>

                                <div class="p-2">
                                    <div class="relative">
                                        <div class="my-4">
                                            <span class="font-bold border p-1 border-gray-400 rounded">ポートフォリオ</span>
                                        </div>
                                    </div>
                                </div>
                                {{-- ユーザーアップロード画像 --}}
                                @if ($pictures)
                                    <section class="text-gray-600 body-font">
                                        <div class="container px-5 pb-24 mx-auto">
                                            <div class="flex flex-wrap -m-4">
                                                @foreach ($pictures as $picture)
                                                    <div class="lg:w-1/3 md:w-1/2 p-4 w-full">
                                                        <a class="block relative h-48 rounded overflow-hidden">
                                                            <img alt="userPictures"
                                                                class="object-cover object-center w-full h-full block"
                                                                src="/images/{{ $picture->filename }}">
                                                            {{-- src="{{ asset('storage/users/portfolio/' . $picture->filename) }}"> --}}
                                                        </a>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </section>
                                @endif
                            </div>
                            <div class="p-2 w-full flex justify-around mt-4">
                                <button type="button" onclick="history.back()"
                                    class="bg-gray-300 border-0 py-2 px-8 focus:outline-none hover:bg-gray-400 rounded text-lg">戻る</button>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
