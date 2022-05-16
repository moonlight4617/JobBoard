<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            お気に入り求人一覧
        </h2>
    </x-slot>

    {{-- <section class="text-gray-600 body-font">
        <x-flash-message status="session('status')" />
        <div class="container px-5 py-24 mx-auto">
            <div class="flex flex-wrap -m-4">
                <x-auth-validation-errors class="mb-4" :errors="$errors" />
                @if ($jobs)
                    @foreach ($jobs as $job)
                        <div class="p-4 md:w-1/3">
                            <div class="h-full border-2 border-gray-200 border-opacity-60 rounded-lg overflow-hidden">
                                @if (empty($job->jobs->image1))
                                    <img src="https://via.placeholder.com/1980x1080?text=No+Image">
                                @else
                                    <img src="{{ asset('storage/jobs/' . $job->jobs->image1) }}">
                                @endif
                                <div class="p-6">
                                    <h1 class="title-font text-lg font-medium text-gray-900 mb-3">
                                        {{ $job->jobs->job_name }}
                                    </h1>
                                    <p class="leading-relaxed mb-3">{{ $job->jobs->detail }}</p>
                                    <div class="flex items-center flex-wrap ">
                                        <a class="text-indigo-500 inline-flex items-center md:mb-2 lg:mb-0"
                                            href="{{ route('user.jobs.show', ['job' => $job->jobs_id]) }}">詳細を見る
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
    </section> --}}


    <section class="text-gray-600 body-font">
        @if ($jobs)
            @foreach ($jobs as $job)
                <div class="container mx-auto flex px-5 py-24 items-center justify-center flex-col">
                    <div class="mx-auto md:w-3/6 w-5/6 mb-4">
                        <a href="{{ route('user.jobs.show', ['job' => $job->id]) }}">
                            @if (empty($job->image1))
                                <img class="object-cover object-center rounded"
                                    src="https://via.placeholder.com/1980x1080?text=No+Image" alt="No Image">
                            @else
                                <img class="object-cover object-center rounded"
                                    src="{{ asset('storage/jobs/' . $job->image1) }}" alt="job-image">
                            @endif
                        </a>
                    </div>
                    <div class="text-center lg:w-2/3 w-full">
                        <div class="items-center flex justify-center mb-2">
                            <a href="{{ route('user.jobs.show', ['job' => $job->id]) }}">
                                <p class="leading-relaxed font-bold text-xl">
                                    {{ $job->job_name }} </p>
                            </a>

                            @auth('users')
                                @if (!$job->isLikedBy(Auth::user()))
                                    <span class="material-icons favorite mb-1 ml-4 cursor-pointer"
                                        data-job-id="{{ $job->id }}">favorite_border</span>
                                @else
                                    <span class="material-icons favorite mb-1 ml-4 cursor-pointer"
                                        data-job-id="{{ $job->id }}">favorite</span>
                                @endif
                            @endauth
                        </div>
                        <p class="text-3xl mb-4 text-gray-900">{{ $job->catch }}</p>
                        <p class="mb-2 leading-relaxed">{{ $job->empStatus() }}</p>
                        @if ($job->low_salary || $job->high_salary)
                            <p class="mb-2 leading-relaxed">
                                {{ $job->low_salary }}〜{{ $job->high_salary }}万円</p>
                        @endif
                        @if ($job->Prefectures)
                            @foreach ($job->Prefectures as $prefecture)
                                <span class="mb-2 mx-2 leading-relaxed">{{ $prefecture->prefecture }}</span>
                            @endforeach
                        @endif
                        <p class="mb-2 leading-relaxed">{{ $job->detail }}</p>
                        @if ($job->tags)
                            @foreach ($job->tags as $tag)
                                <div class="relative inline-block px-1 py-2">
                                    <label for="checkbox1"
                                        class="text-white rounded-full bg-teal-500 px-2 py-1">{{ $tag->tag_name }}
                                    </label>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
                <hr>
            @endforeach
        @endif
    </section>

</x-app-layout>
