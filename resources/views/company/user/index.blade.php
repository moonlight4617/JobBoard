<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            求職者一覧
        </h2>
    </x-slot>


    <div class="flex">
        {{-- サイドバー --}}
        <aside class="w-64 hidden sm:inline-block" aria-label="Sidebar">
            <div class="overflow-y-auto py-4 px-3 bg-gray-50 rounded dark:bg-gray-800">
                <form method="GET" action="{{ route('company.user.search') }}">
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


        <div class="py-12">
            <x-flash-message status="session('status')" />
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <x-auth-validation-errors class="mb-4" :errors="$errors" />
                        <section class="text-gray-600 body-font">
                            @if ($users)
                                @foreach ($users as $user)
                                    <div class="container px-5 py-24 mx-auto">
                                        <div
                                            class="flex items-center lg:w-3/5 mx-auto pb-10 border-gray-200 sm:flex-row flex-col">
                                            <div
                                                class="sm:mr-10 inline-flex items-center justify-center h-40 w-40
                                            ">
                                                @if (empty($user->pro_image))
                                                    <img class="rounded-full h-40 w-40"
                                                        src="https://via.placeholder.com/100x100?text=No+Image">
                                                @else
                                                    <img class="rounded-full h-40 w-40 object-cover"
                                                        src="{{ asset('storage/users/' . $user->pro_image) }}">
                                                @endif
                                            </div>
                                            <div class="flex-grow sm:text-left text-center mt-6 sm:mt-0">
                                                <div class="flex items-center mb-2">
                                                    <p class="text-gray-900 title-font font-bold text-3xl">
                                                        {{ $user->name }}
                                                    </p>

                                                    {{-- フォローボタン --}}
                                                    @auth('companies')
                                                        @if (!$user->isFollowedBy(Auth::user()))
                                                            <span class="material-icons follow ml-4"
                                                                data-user-id="{{ $user->id }}"
                                                                id="follow-{{ $user->id }}">favorite_border</span>
                                                        @else
                                                            <span class="material-icons follow ml-4"
                                                                data-user-id="{{ $user->id }}"
                                                                id="follow-{{ $user->id }}">favorite</span>
                                                        @endif
                                                    @endauth
                                                </div>

                                                <p class="leading-relaxed text-lg">{{ $user->catch }}</p>
                                                <hr />
                                                <p class="leading-relaxed text-base my-4">自己紹介：{{ $user->intro }}</p>
                                                <p class="leading-relaxed text-base my-4">経歴：{{ $user->career }}</p>
                                                <p class="leading-relaxed text-base my-4">資格：{{ $user->license }}</p>
                                            </div>
                                        </div>
                                        <div
                                            class="flex flex-wrap -m-4 items-center lg:w-3/5 md:w-4/5 mx-auto border-b pb-10 mb-10 border-gray-200">
                                            @for ($i = 0; $i < 3; $i++)
                                                @if ($user->userPictures->get($i) != null)
                                                    <div class="p-8 md:w-1/3 sm:w-1/2 mx-auto">
                                                        <div class="h-full flex flex-col items-center text-center">
                                                            <img alt="portfolio"
                                                                class="flex-shrink-0 rounded-lg w-full object-contain object-center mb-4"
                                                                src="{{ asset('storage/users/portfolio/' . $user->userPictures->get($i)->filename) }}">
                                                        </div>
                                                    </div>
                                                @endif
                                            @endfor
                                        </div>
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
