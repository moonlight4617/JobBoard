<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            求職者一覧
        </h2>
    </x-slot>


    <div class="flex">
        {{-- サイドバー --}}
        <aside class="py-12 ml-4 w-64 hidden lg:inline-block" aria-label="Sidebar">
            <div class="overflow-y-auto py-4 px-3 bg-gray-50 rounded dark:bg-gray-800">
                <form method="GET" action="{{ route('company.user.index.search') }}">
                    @csrf
                    <ul class="space-y-2">
                        <li>
                            <button type="button"
                                class="flex items-center p-2 w-full text-base font-normal text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700"
                                aria-controls="dropdown-tag" data-collapse-toggle="dropdown-tag">
                                <svg class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                                    fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                <span class="flex-1 ml-3 text-left whitespace-nowrap">特長タグ</span>
                                <svg sidebar-toggle-item class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </button>
                            <ul id="dropdown-tag" class="hidden py-2 space-y-2">
                                @if ($tags)
                                    @foreach ($tags as $tag)
                                        <li class="flex items-center p-2 pl-11 w-full">
                                            @if (isset($requestTags) && $requestTags && in_array($tag->id, $requestTags))
                                                <input checked type="checkbox" value="{{ $tag->id }}" name="tags[]"
                                                    class="mr-2">
                                            @else
                                                <input type="checkbox" value="{{ $tag->id }}" name="tags[]"
                                                    class="mr-2">
                                            @endif
                                            <label
                                                class="text-base font-normal text-gray-900 rounded-lg hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">{{ $tag->tag_name }}
                                            </label>
                                        </li>
                                    @endforeach
                                @endif
                            </ul>
                        </li>
                    </ul>
                    <button type="submit"
                        class="flex mt-6 mx-auto text-white bg-gray-500 border-0 py-2 px-6 focus:outline-none hover:bg-gray-600 rounded">検索</button>
                </form>
            </div>
        </aside>


        <div class="py-12 w-full">
            <x-flash-message status="session('status')" />
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <x-auth-validation-errors class="mb-4" :errors="$errors" />
                        <section class="text-gray-600 body-font">
                            @if ($users)
                                @foreach ($users as $user)
                                    <div class="container px-5 py-24 mx-auto border-b border-gray-200">
                                        <div
                                            class="flex sm:items-center md:w-4/5 mx-auto sm:pb-10 sm:flex-row flex-col">
                                            <div class="sm:w-1/3 sm:mr-10 inline-flex items-center justify-center">
                                                @if (empty($user->pro_image))
                                                    <img class="rounded-full h-40 w-40"
                                                        src="https://via.placeholder.com/100x100?text=No+Image">
                                                @else
                                                    <img class="rounded-full h-40 w-40 object-cover"
                                                        src="{{ asset('storage/users/' . $user->pro_image) }}">
                                                @endif
                                            </div>
                                            <div class="sm:w-2/3 sm:text-left text-center mt-6 sm:mt-0">
                                                <div class="flex items-center mb-2">
                                                    <p class="text-gray-900 title-font font-bold text-3xl">
                                                        {{ $user->name }}
                                                    </p>


                                                    {{-- フォローボタン --}}
                                                    @auth('companies')
                                                        @if (!$user->isFollowedBy(Auth::user()))
                                                            <span class="material-icons follow ml-4 cursor-pointer"
                                                                data-user-id="{{ $user->id }}"
                                                                id="follow-{{ $user->id }}">favorite_border</span>
                                                        @else
                                                            <span class="material-icons follow ml-4 cursor-pointer"
                                                                data-user-id="{{ $user->id }}"
                                                                id="follow-{{ $user->id }}">favorite</span>
                                                        @endif
                                                    @endauth
                                                </div>
                                                <p class="leading-relaxed text-lg text-left">{{ $user->catch }}</p>
                                                <hr />

                                            </div>
                                        </div>
                                        <div class="md:w-4/5 mx-auto">
                                            @if ($user->intro)
                                                <div class="my-4">
                                                    <span
                                                        class="font-bold border p-1 border-gray-400 rounded">自己紹介</span>
                                                </div>
                                                <p class="ml-2">{{ $user->intro }}</p>
                                            @endif
                                            @if ($user->career)
                                                <div class="my-4">
                                                    <span class="font-bold border p-1 border-gray-400 rounded">経歴</span>
                                                </div>
                                                <p class="ml-2">{{ $user->career }}</p>
                                            @endif
                                            @if ($user->license)
                                                <div class="my-4">
                                                    <span class="font-bold border p-1 border-gray-400 rounded">資格</span>
                                                </div>
                                                <p class="ml-2">{{ $user->license }}</p>
                                            @endif
                                            @if ($user->Tags->first())
                                                <div class="my-4">
                                                    <span
                                                        class="font-bold border p-1 border-gray-400 rounded">特徴タグ</span>
                                                </div>
                                                @foreach ($user->Tags as $tag)
                                                    <div class="relative inline-block px-1 py-2">
                                                        <div
                                                            class="text-white rounded-full bg-teal-500 ease-in px-2 py-1">
                                                            {{ $tag->tag_name }}
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                                        @if ($user->userPictures->first())
                                            <div class="my-4 md:w-4/5 mx-auto">
                                                <span
                                                    class="font-bold border p-1 border-gray-400 rounded">ポートフォリオ</span>
                                                <div class="flex flex-wrap -m-4 items-center mx-auto pb-10 mb-10 mt-2">
                                                    @for ($i = 0; $i < 3; $i++)
                                                        @if ($user->userPictures->get($i) != null)
                                                            <div class="p-4 sm:p-4 sm:w-1/3 mx-auto">
                                                                <div
                                                                    class="h-full flex flex-col items-center text-center">
                                                                    <img alt="portfolio"
                                                                        class="flex-shrink-0 rounded-lg w-full object-contain object-center mb-4"
                                                                        src="{{ asset('storage/users/portfolio/' . $user->userPictures->get($i)->filename) }}">
                                                                </div>
                                                            </div>
                                                        @endif
                                                    @endfor
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                @endforeach
                                {{ $users->links() }}
                            @endif
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://unpkg.com/flowbite@1.4.5/dist/flowbite.js"></script>
</x-app-layout>
