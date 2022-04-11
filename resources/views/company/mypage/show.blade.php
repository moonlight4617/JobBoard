<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            企業情報
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
                                <h1 class="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900">企業情報</h1>
                            </div>
                            <x-auth-validation-errors class="mb-4" :errors="$errors" />
                            <div class="lg md:w-2/3 mx-auto">




                                <!-- Slider main container -->
                                <div class="swiper-container">
                                    <!-- Additional required wrapper -->
                                    <div class="swiper-wrapper">
                                        <!-- Slides -->
                                        <div class="swiper-slide">
                                            @if (empty($company->image1))
                                                <img src="https://via.placeholder.com/1980x1080?text=No+Image">
                                            @else
                                                <img src="{{ asset('storage/companies/' . $company->image1) }}">
                                            @endif
                                        </div>
                                        <div class="swiper-slide">
                                            @if (empty($company->image2))
                                                <img src="https://via.placeholder.com/1980x1080?text=No+Image">
                                            @else
                                                <img src="{{ asset('storage/companies/' . $company->image2) }}">
                                            @endif
                                        </div>
                                        <div class="swiper-slide">
                                            @if (empty($company->image3))
                                                <img src="https://via.placeholder.com/1980x1080?text=No+Image">
                                            @else
                                                <img src="{{ asset('storage/companies/' . $company->image3) }}">
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
                                        企業名：{{ $company->name }}
                                    </div>
                                </div>
                                <div class="p-2">
                                    <div class="relative">
                                        企業詳細：{{ $company->intro }}
                                    </div>
                                </div>
                                <div class="p-2">
                                    <div class="relative">
                                        Eメール：{{ $company->email }}
                                    </div>
                                </div>
                                <div class="p-2">
                                    <div class="relative">
                                        電話番号：{{ $company->tel }}
                                    </div>
                                </div>
                                <div class="p-2">
                                    <div class="relative">
                                        郵便番号：{{ $company->post_code }}
                                    </div>
                                </div>
                                <div class="p-2">
                                    <div class="relative">
                                        住所：{{ $company->address }}
                                    </div>
                                </div>
                                <div class="p-2">
                                    <div class="relative">
                                        ホームページ：{{ $company->homepage }}
                                    </div>
                                </div>
                            </div>
                            <div class="p-2 w-full flex justify-around mt-4">
                                <button type="button"
                                    onclick="location.href='{{ route('company.company.edit', ['company' => $company->id]) }}'"
                                    class="bg-blue-300 border-0 py-2 px-8 focus:outline-none hover:bg-blue-400 rounded text-lg">編集</button>
                                {{-- <button type="button" onclick="location.href='{{ route('company.dashboard') }}'"
                                    class="bg-gray-300 border-0 py-2 px-8 focus:outline-none hover:bg-gray-400 rounded text-lg">戻る</button> --}}
                                <form id="delete_{{ $company->id }}" method="post"
                                    action="{{ route('company.company.destroy', ['company' => $company->id]) }}">
                                    @csrf
                                    @method('delete')
                                    <button type="button" href=“” data-id="{{ $company->id }}"
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
            if (confirm('削除すると元に戻せません。本当に削除してもいいですか?')) {
                document.getElementById('delete_' + e.dataset.id).submit();
            }
        }
    </script>
</x-app-layout>
