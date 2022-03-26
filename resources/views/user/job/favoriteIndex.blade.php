<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            お気に入り求人一覧
        </h2>
    </x-slot>

    <section class="text-gray-600 body-font">
        <x-flash-message status="session('status')" />
        <div class="container px-5 py-24 mx-auto">
            <div class="flex flex-wrap -m-4">
                <x-auth-validation-errors class="mb-4" :errors="$errors" />
                @if ($jobs)
                    @foreach ($jobs as $job)
                        {{-- {{ get_class($job) }}
                        {{ method_exists($job, 'jobs') }} --}}
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
    </section>

</x-app-layout>
