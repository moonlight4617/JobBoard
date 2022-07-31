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


                                <div class="p-2">
                                    <div class="relative">
                                        求人名：{{ $job->job_name }}
                                    </div>
                                </div>
                                <div class="p-2">
                                    <div class="relative">
                                        雇用形態：{{ $job->empStatus() }}
                                    </div>
                                </div>
                                <div class="p-2">
                                    <div class="relative">
                                        職種：
                                        @foreach ($job->occupations as $occupation)
                                            {{ $occupation->name }}
                                        @endforeach
                                    </div>
                                </div>
                                <div class="p-2">
                                    <div class="relative">
                                        勤務地：
                                        @foreach ($job->Prefectures as $prefecture)
                                            {{ $prefecture->prefecture }}
                                        @endforeach
                                    </div>
                                </div>
                                <div class="p-2">
                                    <div class="relative">
                                        呼びかけ文：{{ $job->catch }}
                                    </div>
                                </div>
                                <div class="p-2">
                                    <div class="relative">
                                        仕事内容：{!! $job->detail !!}
                                    </div>
                                </div>
                                <div class="p-2">
                                    <div class="relative">
                                        応募条件：{!! $job->conditions !!}
                                    </div>
                                </div>
                                <div class="p-2">
                                    <div class="relative">
                                        勤務時間：{!! $job->duty_hours !!}
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
                                        休日・休暇：{!! $job->holiday !!}
                                    </div>
                                </div>
                                <div class="p-2">
                                    <div class="relative">
                                        福利厚生：{!! $job->benefits !!}
                                    </div>
                                </div>
                                <div class="p-2">
                                    <p for="career" class="leading-7 text-sm text-gray-600">特徴タグ</p>
                                    @foreach ($job->Tags as $tag)
                                        <div class="relative inline-block px-1 py-2">
                                            <label
                                                class="text-white rounded-full bg-teal-500 peer-hover:bg-teal-600 px-2 py-1 peer-checked:bg-teal-600">{{ $tag->tag_name }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="p-4">
                                    <button type="button"
                                        onclick="location.href='{{ route('company.jobs.appliedIndex', ['job' => $job->id]) }}'"
                                        class="border-blue-500 border py-2 px-8 focus:outline-none hover:bg-blue-400 hover:text-white rounded text-lg">応募者一覧</button>
                                </div>
                            </div>

                            <div class="p-2 w-full flex justify-around mt-4">
                                <button type="button"
                                    onclick="location.href='{{ route('company.jobs.edit', ['job' => $job->id]) }}'"
                                    class="bg-blue-300 border-0 py-2 px-8 focus:outline-none hover:bg-blue-400 rounded text-lg">編集</button>
                                @if ($job->rec_status == 0)
                                    <form id="previous_{{ $job->id }}" method="post"
                                        action="{{ route('company.jobs.close', ['job' => $job->id]) }}">
                                        @csrf
                                        @method('post')
                                        <button type="button" href="" data-id="{{ $job->id }}"
                                            onclick="previousPost(this)"
                                            class="bg-red-300 border-0 py-2 px-8 focus:outline-none hover:bg-red-400 rounded text-lg">公開終了</button>
                                    </form>
                                @elseif ($job->rec_status == 1)
                                    <form id="resume_{{ $job->id }}" method="post"
                                        action="{{ route('company.jobs.resume', ['job' => $job->id]) }}">
                                        @csrf
                                        @method('post')
                                        <button type="button" href="" data-id="{{ $job->id }}"
                                            onclick="resumePost(this)"
                                            class="bg-blue-300 border-0 py-2 px-8 focus:outline-none hover:bg-blue-400 rounded text-lg">募集再開</button>
                                    </form>
                                @endif
                                {{-- <button type="button" onClick="location.href='{{ route('company.jobs.index') }}'"
                                    class="bg-gray-300 border-0 py-2 px-8 focus:outline-none hover:bg-gray-400 rounded text-lg">戻る</button> --}}
                                <form id="delete_{{ $job->id }}" method="post"
                                    action="{{ route('company.jobs.destroy', ['job' => $job->id]) }}">
                                    @csrf
                                    @method('delete')
                                    <button type="button" href=“” data-id="{{ $job->id }}"
                                        onclick="deletePost(this)"
                                        class="text-white bg-red-500 border-0 py-2 px-8 focus:outline-none hover:bg-red-600 rounded text-lg">削除</button>
                                </form>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ mix('js/swiper.js') }}"></script>
    <script>
        function deletePost(e) {
            'use strict';
            if (confirm('本当に削除してもいいですか?')) {
                document.getElementById('delete_' + e.dataset.id).submit();
            }
        }

        function previousPost(e) {
            'use strict';
            if (confirm('公開終了しますか？')) {
                document.getElementById('previous_' + e.dataset.id).submit();
            }
        }

        function resumePost(e) {
            'use strict';
            if (confirm('募集再開しますか？')) {
                document.getElementById('resume_' + e.dataset.id).submit();
            }
        }
    </script>
</x-app-layout>
