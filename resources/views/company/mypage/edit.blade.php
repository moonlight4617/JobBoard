<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            企業情報更新
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <section class="text-gray-600 body-font relative">
                        <div class="container px-5 py-4 mx-auto">
                            <div class="flex flex-col text-center w-full mb-12">
                                <h1 class="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900">企業情報更新</h1>
                            </div>
                            <x-auth-validation-errors class="mb-4" :errors="$errors" />
                            <form method="POST" enctype="multipart/form-data"
                                action="{{ route('company.company.update', ['company' => $company->id]) }}">
                                @csrf
                                @method('put')
                                <div class="lg md:w-2/3 mx-auto">
                                    <div class="p-2">
                                        <div class="relative">
                                            <label for="name" class="leading-7 text-sm text-gray-600">企業名</label>
                                            <input type="text" id="name" name="name" required
                                                class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                                                value="{{ $company->name }}">
                                        </div>
                                    </div>
                                    <div class="p-2">
                                        <div class="relative">
                                            <label for="intro" class="leading-7 text-sm text-gray-600">紹介文</label>
                                            <textarea type="text" id="intro" name="intro" required
                                                class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">{{ $company->intro }}</textarea>
                                        </div>
                                    </div>
                                    <div class="p-2">
                                        <div class="relative">
                                            <label for="tel" class="leading-7 text-sm text-gray-600">電話番号</label>
                                            <input type="text" id="tel" name="tel"
                                                class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                                                value="{{ $company->tel }}">
                                        </div>
                                    </div>
                                    <div class="p-2">
                                        <div class="relative">
                                            <label for="post_code" class="leading-7 text-sm text-gray-600">郵便番号</label>
                                            <input type="text" id="post_code" name="post_code"
                                                class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                                                value="{{ $company->post_code }}">
                                        </div>
                                    </div>
                                    <div class="p-2">
                                        <div class="relative">
                                            <label for="address" class="leading-7 text-sm text-gray-600">住所</label>
                                            <input type="text" id="address" name="address"
                                                class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                                                value="{{ $company->address }}">
                                        </div>
                                    </div>
                                    <div class="p-2">
                                        <div class="relative">
                                            <label for="homepage" class="leading-7 text-sm text-gray-600">ホームページ</label>
                                            <input type="text" id="homepage" name="homepage"
                                                class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                                                value="{{ $company->homepage }}">
                                        </div>
                                    </div>
                                    <div class="p-2 w-full flex justify-around mt-4">
                                        @if (empty($company->image1))
                                            画像１
                                        @else
                                            <img src="{{ asset('storage/companies/' . $company->image1) }}"
                                                class="w-1/4">
                                        @endif
                                        <input type="file" name="imgpath1" accept="image/png,image/jpeg,image/jpg">
                                    </div>
                                    <div class="p-2 w-full flex justify-around mt-4">
                                        @if (empty($company->image2))
                                            画像２
                                        @else
                                            <img src="{{ asset('storage/companies/' . $company->image2) }}"
                                                class="w-1/4">
                                        @endif
                                        <input type="file" name="imgpath2" accept="image/png,image/jpeg,image/jpg">
                                    </div>
                                    <div class="p-2 w-full flex justify-around mt-4">
                                        @if (empty($company->image3))
                                            画像3
                                        @else
                                            <img src="{{ asset('storage/companies/' . $company->image3) }}"
                                                class="w-1/4">
                                        @endif
                                        <input type="file" name="imgpath3" accept="image/png,image/jpeg,image/jpg">
                                    </div>
                                    <div class="p-2 w-full flex justify-around mt-4">
                                        <button type="button"
                                            class="bg-gray-300 border-0 py-2 px-8 focus:outline-none hover:bg-gray-400 rounded text-lg"
                                            onClick="history.back()">戻る</button>
                                        <button type="submit"
                                            class="text-white bg-blue-500 border-0 py-2 px-8 focus:outline-none hover:bg-blue-600 rounded text-lg">更新</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
