<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            求人詳細
        </h2>
    </x-slot>

    <div class="py-12">
        <x-flash-message status="session('status')" />
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <section class="text-gray-600 body-font relative">
                        <div class="container px-5 py-4 mx-auto">
                            <div class="flex flex-col text-center w-full mb-12">
                                <h1 class="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900">求人詳細</h1>
                            </div>
                            <x-auth-validation-errors class="mb-4" :errors="$errors" />
                            <div class="lg md:w-2/3 mx-auto">

                                <!-- Slider main container -->
                                <div class="swiper-container">
                                    <!-- Additional required wrapper -->
                                    <div class="swiper-wrapper">
                                        <!-- Slides -->
                                        <div class="swiper-slide">
                                            @if (empty($job->image1))
                                                <img src="https://via.placeholder.com/1980x1080?text=No+Image">
                                            @else
                                                <img src="{{ asset('storage/jobs/' . $job->image1) }}">
                                            @endif
                                        </div>
                                        <div class="swiper-slide">
                                            @if (empty($job->image2))
                                                <img src="https://via.placeholder.com/1980x1080?text=No+Image">
                                            @else
                                                <img src="{{ asset('storage/jobs/' . $job->image2) }}">
                                            @endif
                                        </div>
                                        <div class="swiper-slide">
                                            @if (empty($job->image3))
                                                <img src="https://via.placeholder.com/1980x1080?text=No+Image">
                                            @else
                                                <img src="{{ asset('storage/jobs/' . $job->image3) }}">
                                            @endif
                                        </div>
                                    </div>
                                    <!-- If we need pagination -->
                                    <div class="swiper-pagination"></div>

                                    <!-- If we need navigation buttons -->
                                    <div class="swiper-button-prev"></div>
                                    <div class="swiper-button-next"></div>

                                    <!-- If we need scrollbar -->
                                    <div class="swiper-scrollbar"></div>
                                </div>


                                <div class="pl-2 pr-2 pt-2 pb-1">
                                    <div class="relative">
                                        <span class="align-bottom">
                                            求人名：{{ $job->job_name }}</span>
                                        @auth('users')
                                            @if (!$job->isLikedBy(Auth::user()))
                                                <span class="material-icons favorite align-bottom ml-4"
                                                    data-job-id="{{ $job->id }}">favorite_border</span>
                                            @else
                                                <span class="material-icons favorite align-bottom ml-4"
                                                    data-job-id="{{ $job->id }}">favorite</span>
                                            @endif
                                        @endauth
                                    </div>
                                </div>
                                <div class="p-2">
                                    <div class="relative">
                                        仕事内容：{{ $job->detail }}
                                    </div>
                                </div>
                                <div class="p-2">
                                    <div class="relative">
                                        応募条件：{{ $job->conditions }}
                                    </div>
                                </div>
                                <div class="p-2">
                                    <div class="relative">
                                        勤務時間：{{ $job->duty_hours }}
                                    </div>
                                </div>
                                <div class="p-2">
                                    <div class="relative">
                                        下限給与：{{ $job->low_salary }}
                                    </div>
                                </div>
                                <div class="p-2">
                                    <div class="relative">
                                        上限給与：{{ $job->high_salary }}
                                    </div>
                                </div>
                                <div class="p-2">
                                    <div class="relative">
                                        休日・休暇：{{ $job->holiday }}
                                    </div>
                                </div>
                                <div class="p-2">
                                    <div class="relative">
                                        福利厚生：{{ $job->benefits }}
                                    </div>
                                </div>
                                <div class="p-2">
                                    <div class="relative">
                                        企業名：<a
                                            href="{{ route('user.company.show', ['company' => $job->companies->id]) }}">{{ $job->companies->name }}</a>
                                    </div>
                                </div>

                            </div>
                            <div class="p-2 w-full flex justify-around mt-4">
                                {{-- まだ応募してなければ --}}
                                @if (!$job->isApplied(Auth::user()))
                                    <button type="button"
                                        onclick="location.href='{{ route('user.jobs.application', ['job' => $job->id]) }}'"
                                        class="bg-blue-300 border-0 py-2 px-8 focus:outline-none hover:bg-blue-400 rounded text-lg">応募する</button>
                                @else
                                    {{-- もう応募してれば --}}
                                    <button type="button" disabled
                                        class="bg-gray-300 border-0 py-2 px-8 focus:outline-none rounded text-lg">応募済み</button>
                                @endif
                                <button type="button"
                                    class="bg-gray-300 border-0 py-2 px-8 focus:outline-none hover:bg-gray-400 rounded text-lg"
                                    onClick="history.back()">戻る</button>

                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ mix('js/swiper.js') }}"></script>
</x-app-layout>
