<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            登録求人一覧
        </h2>
    </x-slot>

    <div class="py-12">
        <x-flash-message status="session('status')" />
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <x-auth-validation-errors class="mb-4" :errors="$errors" />
                    <section class="text-gray-600 body-font">
                        @if ($jobs)
                            @foreach ($jobs as $job)
                                <div class="container mx-auto flex px-5 py-24 items-center justify-center flex-col">
                                    @if (empty($job->image1))
                                        <img class="lg:w-2/6 md:w-3/6 w-5/6 mb-10 object-cover object-center rounded"
                                            src="https://via.placeholder.com/1980x1080?text=No+Image" alt="No Image">
                                    @else
                                        <img class="lg:w-2/6 md:w-3/6 w-5/6 mb-10 object-cover object-center rounded"
                                            src="{{ asset('storage/jobs/' . $job->image1) }}" alt="job-image">
                                    @endif
                                    <div class="text-center lg:w-2/3 w-full">
                                        <h1 class="title-font sm:text-4xl text-3xl mb-4 font-medium text-gray-900">
                                            Microdosing
                                            synth tattooed vexillologist</h1>
                                        <p class="mb-2 leading-relaxed">{{ $job->job_name }}</p>
                                        <p class="mb-2 leading-relaxed">
                                            給与：{{ $job->low_salary }}〜{{ $job->high_salary }}万円</p>
                                        <p class="mb-2 leading-relaxed"> 仕事内容：{{ $job->detail }}
                                        </p>

                                        @if ($job->tags)
                                            {{-- <div class="p-2"> --}}
                                            @foreach ($job->tags as $tag)
                                                <div class="relative inline-block px-1 py-2">
                                                    <label for="checkbox1"
                                                        class="text-white rounded-full bg-teal-500 px-2 py-1">{{ $tag->tag_name }}
                                                    </label>
                                                </div>
                                            @endforeach
                                            {{-- </div> --}}
                                        @endif



                                        <div class="flex justify-center mt-4">
                                            <button type="button"
                                                onclick="location.href='{{ route('company.jobs.show', ['job' => $job->id]) }}'"
                                                class="inline-flex text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded text-lg">詳細</button>
                                        </div>

                                    </div>
                                </div>
                                <hr>
                            @endforeach
                        @endif
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
