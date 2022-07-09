<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            プロフィール
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <section class="text-gray-600 body-font relative">
                        <div class="container px-5 py-4 mx-auto">
                            <div class="flex flex-col text-center w-full mb-12">
                                <h1 class="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900">プロフィール</h1>
                            </div>
                            <x-auth-validation-errors class="mb-4" :errors="$errors" />
                            <form method="POST" enctype="multipart/form-data"
                                action="{{ route('user.user.update', ['user' => $user->id]) }}" id="profile">
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

                                    {{-- タグ選択 --}}
                                    @if ($tags)
                                        <div class="p-2">
                                            <p for="career" class="leading-7 text-sm text-gray-600">特徴タグ</p>
                                            @foreach ($tags as $tag)
                                                <div class="relative inline-block px-1 py-2">
                                                    @if ($userTags && $userTags->contains($tag))
                                                        <input checked="checked" type="checkbox"
                                                            id="checkbox{{ $tag->id }}"
                                                            name="tag[{{ $tag->id }}]" value="{{ $tag->id }}"
                                                            class="opacity-0 absolute w-full h-full left-0 peer cursor-pointer">
                                                        <label for="checkbox1"
                                                            class="text-white rounded-full bg-teal-500  cursor-pointer ease-in peer-hover:bg-teal-600 px-2 py-1 peer-checked:bg-teal-600">{{ $tag->tag_name }}
                                                        </label>
                                                    @else
                                                        <input type="checkbox" id="checkbox{{ $tag->id }}"
                                                            name="tag[{{ $tag->id }}]"
                                                            value="{{ $tag->id }}"
                                                            class="opacity-0 absolute w-full h-full left-0 peer cursor-pointer">
                                                        <label for="checkbox1"
                                                            class="text-white rounded-full bg-teal-500  cursor-pointer ease-in peer-hover:bg-teal-600 px-2 py-1 peer-checked:bg-teal-600">{{ $tag->tag_name }}
                                                        </label>
                                                    @endif

                                                </div>
                                            @endforeach
                                        </div>
                                    @endif


                                    <div class="p-2">
                                        <p class="leading-7 text-sm text-gray-600">SNS</p>
                                        <div class="flex items-center">
                                            <div class="mx-4">
                                                <!-- Modal toggle -->
                                                <a data-modal-toggle="twitterModal">
                                                    <img src="/images/twitter-brands.svg" class="w-8" />
                                                </a>
                                                <!-- Main modal -->
                                                <div id="twitterModal" tabindex="-1" aria-hidden="true"
                                                    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full">
                                                    <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
                                                        <!-- Modal content -->
                                                        <div
                                                            class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                                            <!-- Modal header -->
                                                            <div
                                                                class="flex justify-end items-start pt-4 pr-4 rounded-t">
                                                                <button type="button"
                                                                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                                                    data-modal-toggle="twitterModal">
                                                                    <svg class="w-5 h-5" fill="currentColor"
                                                                        viewBox="0 0 20 20"
                                                                        xmlns="http://www.w3.org/2000/svg">
                                                                        <path fill-rule="evenodd"
                                                                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                                            clip-rule="evenodd"></path>
                                                                    </svg>
                                                                </button>
                                                            </div>
                                                            <!-- Modal body -->
                                                            <div class="p-6 space-y-6">
                                                                <p>twitter</p>
                                                                @if ($user->twitter)
                                                                    <input name="twitter" id="twitter" type="text"
                                                                        class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                                                                        value="{{ $user->twitter }}" />
                                                                @else
                                                                    <input name="twitter" id="twitter" type="text"
                                                                        class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out" />
                                                                @endif
                                                                <label for="twitter"
                                                                    class="leading-7 text-sm text-gray-600">URLを入力してください</label>
                                                            </div>
                                                            <!-- Modal footer -->
                                                            <div
                                                                class="flex justify-end items-center pb-6 pr-6 space-x-2 rounded-b">
                                                                <button data-modal-toggle="twitterModal" type="button"
                                                                    class="text-white bg-gray-500 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 p-2.5 text-center">入力</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="ml-2 mr-4">
                                                <!-- Modal toggle -->
                                                <a data-modal-toggle="youtubeModal">
                                                    <img src="/images/youtube-brands.svg" class="w-8" />
                                                </a>
                                                <!-- Main modal -->
                                                <div id="youtubeModal" tabindex="-1" aria-hidden="true"
                                                    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full">
                                                    <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
                                                        <!-- Modal content -->
                                                        <div
                                                            class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                                            <!-- Modal header -->
                                                            <div
                                                                class="flex justify-end items-start pt-4 pr-4 rounded-t">
                                                                <button type="button"
                                                                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                                                    data-modal-toggle="youtubeModal">
                                                                    <svg class="w-5 h-5" fill="currentColor"
                                                                        viewBox="0 0 20 20"
                                                                        xmlns="http://www.w3.org/2000/svg">
                                                                        <path fill-rule="evenodd"
                                                                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                                            clip-rule="evenodd"></path>
                                                                    </svg>
                                                                </button>
                                                            </div>
                                                            <!-- Modal body -->
                                                            <div class="p-6 space-y-6">
                                                                <p>youtube</p>
                                                                <label for="youtube"
                                                                    class="leading-7 text-sm text-gray-600">URLを入力してください</label>
                                                                @if ($user->youtube)
                                                                    <input name="youtube" id="youtube" type="text"
                                                                        class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                                                                        value="{{ $user->youtube }}" />
                                                                @else
                                                                    <input name="youtube" id="youtube" type="text"
                                                                        class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out" />
                                                                @endif
                                                            </div>
                                                            <!-- Modal footer -->
                                                            <div
                                                                class="flex justify-end items-center pb-6 pr-6 space-x-2 rounded-b">
                                                                <button data-modal-toggle="youtubeModal" type="button"
                                                                    class="text-white bg-gray-500 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 p-2.5 text-center">入力</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="ml-2 mr-4">
                                                <!-- Modal toggle -->
                                                <a data-modal-toggle="instaModal">
                                                    <img src="/images/instagram-brands.svg" class="w-8" />
                                                </a>
                                                <!-- Main modal -->
                                                <div id="instaModal" tabindex="-1" aria-hidden="true"
                                                    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full">
                                                    <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
                                                        <!-- Modal content -->
                                                        <div
                                                            class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                                            <!-- Modal header -->
                                                            <div
                                                                class="flex justify-end items-start pt-4 pr-4 rounded-t">
                                                                <button type="button"
                                                                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                                                    data-modal-toggle="instaModal">
                                                                    <svg class="w-5 h-5" fill="currentColor"
                                                                        viewBox="0 0 20 20"
                                                                        xmlns="http://www.w3.org/2000/svg">
                                                                        <path fill-rule="evenodd"
                                                                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                                            clip-rule="evenodd"></path>
                                                                    </svg>
                                                                </button>
                                                            </div>
                                                            <!-- Modal body -->
                                                            <div class="p-6 space-y-6">
                                                                <p>instagram</p>
                                                                <label for="insta"
                                                                    class="leading-7 text-sm text-gray-600">URLを入力してください</label>
                                                                @if ($user->insta)
                                                                    <input name="insta" id="insta" type="text"
                                                                        class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                                                                        value="{{ $user->insta }}" />
                                                                @else
                                                                    <input name="insta" id="insta" type="text"
                                                                        class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out" />
                                                                @endif
                                                            </div>
                                                            <!-- Modal footer -->
                                                            <div
                                                                class="flex justify-end items-center pb-6 pr-6 space-x-2 rounded-b">
                                                                <button data-modal-toggle="instaModal" type="button"
                                                                    class="text-white bg-gray-500 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 p-2.5 text-center">入力</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="ml-2 mr-4">
                                                <!-- Modal toggle -->
                                                <a data-modal-toggle="defaultModal">
                                                    <img src="/images/blogger-brands.svg" class="w-8"
                                                        alt="ブログ" />
                                                </a>
                                                <!-- Main modal -->
                                                <div id="defaultModal" tabindex="-1" aria-hidden="true"
                                                    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full">
                                                    <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
                                                        <!-- Modal content -->
                                                        <div
                                                            class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                                            <!-- Modal header -->
                                                            <div
                                                                class="flex justify-end items-start pt-4 pr-4 rounded-t">
                                                                <button type="button"
                                                                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                                                    data-modal-toggle="defaultModal">
                                                                    <svg class="w-5 h-5" fill="currentColor"
                                                                        viewBox="0 0 20 20"
                                                                        xmlns="http://www.w3.org/2000/svg">
                                                                        <path fill-rule="evenodd"
                                                                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                                            clip-rule="evenodd"></path>
                                                                    </svg>
                                                                </button>
                                                            </div>
                                                            <!-- Modal body -->
                                                            <div class="p-6 space-y-6">
                                                                <p>ブログ</p>
                                                                <label for="blog"
                                                                    class="leading-7 text-sm text-gray-600">URLを入力してください</label>
                                                                @if ($user->blog)
                                                                    <input name="blog" id="blog" type="text"
                                                                        class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                                                                        value="{{ $user->blog }}" />
                                                                @else
                                                                    <input name="blog" id="blog" type="text"
                                                                        class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out" />
                                                                @endif
                                                            </div>
                                                            <!-- Modal footer -->
                                                            <div
                                                                class="flex justify-end items-center pb-6 pr-6 space-x-2 rounded-b">
                                                                <button data-modal-toggle="defaultModal" type="button"
                                                                    class="text-white bg-gray-500 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 p-2.5 text-center">入力</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
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
                                                                <div class="lg:w-1/3 md:w-1/2 p-4 w-full image-box"
                                                                    id="picture-{{ $picture->id }}">
                                                                    <a
                                                                        class="block relative h-48 rounded overflow-hidden">
                                                                        <img alt="userPictures"
                                                                            class="object-cover object-center w-full h-full block"
                                                                            src="{{ asset('storage/users/portfolio/' . $picture->filename) }}">
                                                                    </a>
                                                                    <span class="material-icons deletePicture delete"
                                                                        data-picture-id="{{ $picture->id }}">
                                                                        highlight_off
                                                                    </span>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </section>
                                            @endif
                                            <p>画像を追加する　<input type="file" name="portfolio[]"
                                                    accept="image/png,image/jpeg,image/jpg" class="addPic"
                                                    multiple></p>
                                            <small>* 1度に複数枚選択可能です</small>

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
    <script src="https://unpkg.com/flowbite@1.4.5/dist/flowbite.js"></script>

</x-app-layout>
