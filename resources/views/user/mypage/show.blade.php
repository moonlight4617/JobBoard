<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            ユーザー情報
        </h2>
    </x-slot>

    <div class="py-12">
        <x-flash-message status="session('status')" />
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <section class="text-gray-600 body-font relative">
                        <div class="container px-5 py-4 mx-auto">
                            <div class="flex flex-col text-center w-full mb-12">
                                <h1 class="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900">ユーザー情報</h1>
                            </div>
                            <x-auth-validation-errors class="mb-4" :errors="$errors" />
                            <div class="lg md:w-2/3 mx-auto">

                                @if (empty($user->pro_image))
                                    <img src="https://via.placeholder.com/1980x1080?text=No+Image">
                                @else
                                    <img src="{{ asset('storage/users/' . $user->pro_image) }}">
                                @endif

                                <div class="p-2">
                                    <div class="relative">
                                        ユーザー名：{{ $user->name }}
                                    </div>
                                </div>
                                <div class="p-2">
                                    <div class="relative">
                                        キャッチコピー：{{ $user->catch }}
                                    </div>
                                </div>
                                <div class="p-2">
                                    <div class="relative">
                                        紹介文：{{ $user->intro }}
                                    </div>
                                </div>
                                <div class="p-2">
                                    <div class="relative">
                                        Eメール：{{ $user->email }}
                                    </div>
                                </div>
                                <div class="p-2">
                                    <div class="relative">
                                        資格：{{ $user->license }}
                                    </div>
                                </div>
                                <div class="p-2">
                                    <div class="relative">
                                        経歴：{{ $user->career }}
                                    </div>
                                </div>
                                <div class="p-2">
                                    <div class="relative">
                                        趣味・特技：{{ $user->hobby }}
                                    </div>
                                </div>

                                @if ($tags)
                                    <div class="p-2">
                                        <p class="leading-7 text-sm text-gray-600">特徴タグ</p>
                                        @foreach ($tags as $tag)
                                            <div class="relative inline-block px-1 py-2">
                                                <label for="checkbox1"
                                                    class="text-white rounded-full bg-teal-500  cursor-pointer ease-in px-2 py-1">{{ $tag->tag_name }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif

                                <div class="p-2">
                                    <div class="relative">
                                        <p>ポートフォリオ</p>
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
                                                                src="{{ asset('storage/users/portfolio/' . $picture->filename) }}">
                                                        </a>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </section>
                                @endif
                            </div>
                            <div class="p-2 w-full flex justify-around mt-4">
                                <button type="button"
                                    onclick="location.href='{{ route('user.user.edit', ['user' => $user->id]) }}'"
                                    class="bg-blue-300 border-0 py-2 px-8 focus:outline-none hover:bg-blue-400 rounded text-lg">編集</button>
                                {{-- <button type="button" onclick="location.href='{{ route('user.dashboard') }}'"
                                    class="bg-gray-300 border-0 py-2 px-8 focus:outline-none hover:bg-gray-400 rounded text-lg">戻る</button> --}}
                                <form id="delete_{{ $user->id }}" method="post"
                                    action="{{ route('user.user.destroy', ['user' => $user->id]) }}">
                                    @csrf
                                    @method('delete')
                                    <button type="button" href=“” data-id="{{ $user->id }}"
                                        onclick="deletePost(this)"
                                        class="text-white bg-red-500 border-0 py-2 px-8 focus:outline-none hover:bg-red-600 rounded text-lg">削除</button>
                                </form>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>

    {{-- <script src="{{ mix('js/swiper.js') }}"></script> --}}
    <script>
        function deletePost(e) {
            'use strict';
            if (confirm('本当に削除してもいいですか?')) {
                document.getElementById('delete_' + e.dataset.id).submit();
            }
        }
    </script>
</x-app-layout>
