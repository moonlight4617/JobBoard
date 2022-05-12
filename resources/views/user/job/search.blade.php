<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            求人一覧
        </h2>
    </x-slot>


    <div class="flex">
        {{-- サイドバー --}}
        <aside class="w-64 hidden sm:inline-block" aria-label="Sidebar">
            <div class="overflow-y-auto py-4 px-3 bg-gray-50 rounded dark:bg-gray-800">
                <form method="GET" action="{{ route('user.jobs.query') }}">
                    @csrf
                    <ul class="space-y-2">
                        <li>
                            <button type="button"
                                class="flex items-center p-2 w-full text-base font-normal text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700"
                                aria-controls="dropdown-example" data-collapse-toggle="dropdown-example">
                                <svg class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"
                                    fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M10 2a4 4 0 00-4 4v1H5a1 1 0 00-.994.89l-1 9A1 1 0 004 18h12a1 1 0 00.994-1.11l-1-9A1 1 0 0015 7h-1V6a4 4 0 00-4-4zm2 5V6a2 2 0 10-4 0v1h4zm-6 3a1 1 0 112 0 1 1 0 01-2 0zm7-1a1 1 0 100 2 1 1 0 000-2z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                <span class="flex-1 ml-3 text-left whitespace-nowrap" sidebar-toggle-item>勤務地</span>
                                <svg sidebar-toggle-item class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </button>
                            <ul id="dropdown-example" class="hidden py-2 space-y-2">
                                @if ($prefectures)
                                    @foreach ($prefectures as $prefecture)
                                        <li class="flex items-center p-2 pl-11 w-full ">
                                            @if (!$requestPrefs == null && in_array($prefecture->id, $requestPrefs))
                                                <input checked type="checkbox" value="{{ $prefecture->id }}"
                                                    name="prefectures[]" class="mr-2">
                                            @else
                                                <input type="checkbox" value="{{ $prefecture->id }}"
                                                    name="prefectures[]" class="mr-2">
                                            @endif
                                            <label
                                                class="text-base font-normal text-gray-900 rounded-lg hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">{{ $prefecture->prefecture }}
                                            </label>
                                        </li>
                                    @endforeach
                                @endif
                            </ul>
                        </li>
                        <li>
                            <button type="button"
                                class="flex items-center p-2 w-full text-base font-normal text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700"
                                aria-controls="dropdown-occupation" data-collapse-toggle="dropdown-occupation">
                                <svg class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                                    fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z">
                                    </path>
                                </svg>
                                <span class="flex-1 ml-3 text-left whitespace-nowrap" sidebar-toggle-item>職種</span>
                                <svg sidebar-toggle-item class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </button>
                            <ul id="dropdown-occupation" class="hidden py-2 space-y-2">
                                @if ($occupations)
                                    @foreach ($occupations as $occupation)
                                        <li class="flex items-center p-2 pl-11 w-full ">
                                            @if ($requestOccupations && in_array($occupation->id, $requestOccupations))
                                                <input checked type="checkbox" value="{{ $occupation->id }}"
                                                    name="occupations[]" class="mr-2">
                                            @else
                                                <input type="checkbox" value="{{ $occupation->id }}"
                                                    name="occupations[]" class="mr-2">
                                            @endif
                                            <label
                                                class="text-base font-normal text-gray-900 rounded-lg hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">{{ $occupation->name }}</label>
                                        </li>
                                    @endforeach
                                @endif
                            </ul>
                        </li>
                        <li>
                            <button type="button"
                                class="flex items-center p-2 w-full text-base font-normal text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700"
                                aria-controls="dropdown-salary" data-collapse-toggle="dropdown-salary">
                                <svg class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                                    fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M8.707 7.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l2-2a1 1 0 00-1.414-1.414L11 7.586V3a1 1 0 10-2 0v4.586l-.293-.293z">
                                    </path>
                                    <path
                                        d="M3 5a2 2 0 012-2h1a1 1 0 010 2H5v7h2l1 2h4l1-2h2V5h-1a1 1 0 110-2h1a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2V5z">
                                    </path>
                                </svg>
                                <span class="flex-1 ml-3 text-left whitespace-nowrap">給与</span>
                                <svg sidebar-toggle-item class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </button>
                            <ul id="dropdown-salary" class="hidden py-2 space-y-2">
                                <li class="items-center pl-8">
                                    <label
                                        class="text-base font-normal text-gray-900 hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">下限年収
                                        <small>(万円)</small></label>
                                    @if ($requestLowSalary)
                                        <input type="number" id="low_salary" name="low_salary"
                                            class="leading-7 text-sm text-gray-600" value="{{ $requestLowSalary }}">
                                    @else
                                        <input type="number" id="low_salary" name="low_salary"
                                            class="leading-7 text-sm text-gray-600">
                                    @endif
                                </li>
                                <li class="items-center pl-8">
                                    <label
                                        class="text-base font-normal text-gray-900 hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">上限年収
                                        <small>(万円)</small></label>
                                    @if ($requestHighSalary)
                                        <input type="number" id="high_salary" name="high_salary"
                                            class="leading-7 text-sm text-gray-600" value="{{ $requestHighSalary }}">
                                    @else
                                        <input type="number" id="high_salary" name="high_salary"
                                            class="leading-7 text-sm text-gray-600">
                                    @endif
                                </li>
                            </ul>

                        </li>
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
                                            @if ($requestTags && in_array($tag->id, $requestTags))
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
                        <li>
                            @if ($requestSearch)
                                <input type="text" id="search" name="search"
                                    class="w-48 bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 mr-2 leading-8 transition-colors duration-200 ease-in-out"
                                    placeholder="キーワード検索" value="{{ $requestSearch }}">
                            @else
                                <input type="text" id="search" name="search"
                                    class="w-48 bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 mr-2 leading-8 transition-colors duration-200 ease-in-out"
                                    placeholder="キーワード検索">
                            @endif
                        </li>
                    </ul>
                    <button
                        class="flex mt-6 mx-auto text-white bg-gray-500 border-0 py-2 px-6 focus:outline-none hover:bg-gray-600 rounded">検索</button>
                </form>
            </div>
        </aside>


        <section class="text-gray-600 body-font mx-auto">
            <x-flash-message status="session('status')" />
            <div class="container px-5 py-24 mx-auto">
                <div class="flex flex-wrap -m-4">
                    <x-auth-validation-errors class="mb-4" :errors="$errors" />
                    @if ($jobs)
                        @foreach ($jobs as $job)
                            <div class="p-4 md:w-1/3">
                                <div
                                    class="h-full border-2 border-gray-200 border-opacity-60 rounded-lg overflow-hidden">
                                    @if (empty($job->image1))
                                        <img src="https://via.placeholder.com/1980x1080?text=No+Image">
                                    @else
                                        <img src="{{ asset('storage/jobs/' . $job->image1) }}">
                                    @endif
                                    <div class="p-6">
                                        <h1 class="title-font text-lg font-medium text-gray-900 mb-3">
                                            {{ $job->job_name }}
                                        </h1>
                                        <p class="leading-relaxed mb-3">{{ $job->detail }}</p>
                                        <div class="flex items-center flex-wrap ">
                                            <a class="text-indigo-500 inline-flex items-center md:mb-2 lg:mb-0"
                                                href="{{ route('user.jobs.show', ['job' => $job->id]) }}">詳細を見る
                                                <svg class="w-4 h-4 ml-2" viewBox="0 0 24 24" stroke="currentColor"
                                                    stroke-width="2" fill="none" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path d="M5 12h14"></path>
                                                    <path d="M12 5l7 7-7 7"></path>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        {{ $jobs->links() }}
                    @endif
                </div>
            </div>
        </section>

    </div>
    <script src="https://unpkg.com/flowbite@1.4.5/dist/flowbite.js"></script>

</x-app-layout>
