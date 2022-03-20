<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            プロフィール更新
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <section class="text-gray-600 body-font relative">
                        <div class="container px-5 py-4 mx-auto">
                            <div class="flex flex-col text-center w-full mb-12">
                                <h1 class="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900">プロフィール更新</h1>
                            </div>
                            <x-auth-validation-errors class="mb-4" :errors="$errors" />
                            <form method="POST" enctype="multipart/form-data"
                                action="{{ route('user.user.update', ['user' => $user->id]) }}">
                                @csrf
                                @method('put')
                                <div class="lg md:w-2/3 mx-auto">
                                    <div class="p-2 w-full flex justify-around mt-4">
                                        @if (empty($user->pro_image))
                                            プロフィール画像
                                        @else
                                            <img src="{{ asset('storage/users/' . $user->pro_image) }}"
                                                class="w-1/4">
                                        @endif
                                        <input type="file" name="pro_image" accept="image/png,image/jpeg,image/jpg">
                                    </div>

                                    <div class="p-2">
                                        <div class="relative">
                                            <label for="catch" class="leading-7 text-sm text-gray-600">キャッチコピー</label>
                                            <input type="text" id="catch" name="catch"
                                                class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                                                value="{{ $user->catch }}">
                                        </div>
                                    </div>
                                    <div class="p-2">
                                        <div class="relative">
                                            <label for="intro" class="leading-7 text-sm text-gray-600">自己紹介文</label>
                                            <textarea type="text" id="intro" name="intro"
                                                class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">{{ $user->intro }}</textarea>
                                        </div>
                                    </div>
                                    <div class="p-2">
                                        <div class="relative">
                                            <label for="license" class="leading-7 text-sm text-gray-600">資格</label>
                                            <textarea type="text" id="license" name="license"
                                                class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">{{ $user->license }}</textarea>
                                        </div>
                                    </div>
                                    <div class="p-2">
                                        <div class="relative">
                                            <label for="career" class="leading-7 text-sm text-gray-600">経歴</label>
                                            <textarea type="text" id="career" name="career"
                                                class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">{{ $user->career }}</textarea>
                                        </div>
                                    </div>
                                    <div class="p-2">
                                        <div class="relative">
                                            <label for="hobby" class="leading-7 text-sm text-gray-600">趣味・特技</label>
                                            <textarea type="text" id="hobby" name="hobby"
                                                class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">{{ $user->hobby }}</textarea>
                                        </div>
                                    </div>


                                    <div class="p-2">
                                        <div class="relative">
                                            <p>ポートフォリオ</p>

                                            {{-- ユーザーアップロード画像 --}}
                                            @if ($pictures)
                                                <section class="text-gray-600 body-font">
                                                    <div class="container px-5 pb-8 mx-auto">
                                                        <div class="flex flex-wrap -m-4">
                                                            @foreach ($pictures as $picture)
                                                                <div class="lg:w-1/3 md:w-1/2 p-4 w-full">
                                                                    <a
                                                                        class="block relative h-48 rounded overflow-hidden">
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
                                            <p>画像を追加する　<input type="file" name="portfolio1"
                                                    accept="image/png,image/jpeg,image/jpg"></p>
                                        </div>
                                    </div>


                                    <div class="p-2 w-full flex justify-around mt-4">
                                        <button type="button"
                                            onclick="location.href='{{ route('user.user.show', ['user' => $user->id]) }}'"
                                            class="bg-gray-300 border-0 py-2 px-8 focus:outline-none hover:bg-gray-400 rounded text-lg">戻る</button>
                                        <button type="submit"
                                            class="text-white bg-blue-500 border-0 py-2 px-8 focus:outline-none hover:bg-blue-600 rounded text-lg">更新</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>

    <script>
        'use strict'
        const images = document.querySelectorAll('.image')

        images.forEach(image => {
            image.addEventListener('click', function(e) {
                const imageName = e.target.dataset.id.substr(0, 6)
                const imageId = e.target.dataset.id.replace(imageName + '_', '')
                const imageFile = e.target.dataset.file
                const imagePath = e.target.dataset.path
                const modal = e.target.dataset.modal
                document.getElementById(imageName + '_thumbnail').src = imagePath + '/' + imageFile
                document.getElementById(imageName + '_hidden').value = imageId
                MicroModal.close(modal);
            }, )
        })
    </script>

</x-app-layout>
