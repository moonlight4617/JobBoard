<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            ユーザー情報登録
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <section class="text-gray-600 body-font relative">
                        <div class="container px-5 py-4 mx-auto">
                            <div class="flex flex-col text-center w-full mb-12">
                                <h1 class="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900">ユーザー情報登録</h1>
                            </div>
                            <x-auth-validation-errors class="mb-4" :errors="$errors" />
                            <form method="POST" enctype="multipart/form-data"
                                action="{{ route('admin.users.store') }}">
                                @csrf
                                <div class="lg md:w-2/3 mx-auto">
                                    <div class="p-2">
                                        <div class="relative">
                                            <label for="name" class="leading-7 text-sm text-gray-600">ユーザー名</label>
                                            <input type="text" id="name" name="name" required
                                                class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                                                value="{{ old('name') }}">
                                        </div>
                                    </div>
                                    <div class="p-2">
                                        <div class="relative">
                                            <label for="email" class="leading-7 text-sm text-gray-600">Eメール</label>
                                            <input type="email" id="email" name="email" required
                                                class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                                                value="{{ old('email') }}">
                                        </div>
                                    </div>
                                    <div class="p-2">
                                        <div class="relative">
                                            <label for="password" class="leading-7 text-sm text-gray-600">パスワード</label>
                                            <input type="password" id="password" name="password" required
                                                class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                                                value="{{ old('password') }}">
                                        </div>
                                    </div>
                                    <div class="p-2">
                                        <div class="relative">
                                            <label for="password_confirmation"
                                                class="leading-7 text-sm text-gray-600">パスワード確認</label>
                                            <input type="password" id="password_confirmation"
                                                name="password_confirmation" required
                                                class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                                                value="{{ old('password_confirmation') }}">
                                        </div>
                                    </div>
                                    <div class="p-2">
                                        <div class="relative">
                                            <label for="catch" class="leading-7 text-sm text-gray-600">キャッチコピー</label>
                                            <input type="text" id="catch" name="catch" required
                                                class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                                                value="{{ old('catch') }}">
                                        </div>
                                    </div>
                                    <div class="p-2">
                                        <div class="relative">
                                            <label for="intro" class="leading-7 text-sm text-gray-600">自己紹介文</label>
                                            <textarea type="text" id="intro" name="intro" required
                                                class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"></textarea>
                                        </div>
                                    </div>
                                    <div class="p-2">
                                        <div class="relative">
                                            <label for="license" class="leading-7 text-sm text-gray-600">資格</label>
                                            <textarea type="text" id="license" name="license"
                                                class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"></textarea>
                                        </div>
                                    </div>
                                    <div class="p-2">
                                        <div class="relative">
                                            <label for="career" class="leading-7 text-sm text-gray-600">経歴</label>
                                            <textarea type="text" id="career" name="career"
                                                class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"></textarea>
                                        </div>
                                    </div>
                                    <div class="p-2">
                                        <div class="relative">
                                            <label for="hobby" class="leading-7 text-sm text-gray-600">趣味・特技</label>
                                            <textarea type="text" id="hobby" name="hobby"
                                                class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"></textarea>
                                        </div>
                                    </div>

                                    {{-- タグ選択 --}}
                                    <div class="p-2">
                                        <p for="career" class="leading-7 text-sm text-gray-600">特徴タグ</p>
                                        @foreach ($tags as $tag)
                                            <div class="relative inline-block px-1 py-2">
                                                <input type="checkbox" id="checkbox{{ $tag->id }}"
                                                    name="tags[{{ $tag->id }}]" value="{{ $tag->id }}"
                                                    class="opacity-0 absolute w-full h-full left-0 peer cursor-pointer">
                                                <label for="checkbox1"
                                                    class="text-white rounded-full bg-teal-500  cursor-pointer ease-in peer-hover:bg-teal-600 px-2 py-1 peer-checked:bg-teal-600">{{ $tag->tag_name }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>

                                    <div class="p-2 ">
                                        <p class="leading-7 text-sm text-gray-600">プロフィール画像</p>
                                        <input type="file" name="pro_image" accept="image/png,image/jpeg,image/jpg">
                                    </div>
                                    <div class="p-2 ">
                                        <p class="leading-7 text-sm text-gray-600">ポートフォリオ画像を登録</p><input type="file"
                                            name="portfolio1" accept="image/png,image/jpeg,image/jpg">
                                    </div>

                                    <div class="p-2 w-full flex justify-around mt-4">
                                        <button type="submit"
                                            class="text-white bg-blue-500 border-0 py-2 px-8 focus:outline-none hover:bg-blue-600 rounded text-lg">登録</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
