<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            応募済み求人一覧
        </h2>
    </x-slot>

    <section class="text-gray-600 body-font">
        <x-flash-message status="session('status')" />
        <x-auth-validation-errors class="mb-4" :errors="$errors" />
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
                                    <span
                                        class="material-icons favoriteId{{ $job->id }} favorite mb-1 ml-4 cursor-pointer"
                                        data-job-id="{{ $job->id }}">favorite_border</span>
                                @else
                                    <span
                                        class="material-icons favoriteId{{ $job->id }} favorite mb-1 ml-4 cursor-pointer"
                                        data-job-id="{{ $job->id }}">favorite</span>
                                @endif
                                <span class="material-icons ml-2 mb-1 cursor-pointer"
                                    onClick="location.href='{{ route('user.message.show', ['company' => $job->companies->id]) }}'">
                                    mail_outline
                                </span>
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
                        <p class="mb-2 leading-relaxed">{!! $job->detail !!}</p>
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
            {{ $jobs->links() }}
        @endif
    </section>

</x-app-layout>
