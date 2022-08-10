<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            タグ一覧
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-flash-message status="session('status')" />
            <x-auth-validation-errors class="mb-4" :errors="$errors" />
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="md:p-6 bg-white border-b border-gray-200">
                    <section class="text-gray-600 body-font">
                        @if ($userTags || $jobTags)
                            <form id="delete" method="post" action="{{ route('admin.tags.destroy') }}">
                                @csrf
                                @method('delete')
                                <div class="p-2">
                                    <div class="font-bold">ユーザータグ
                                    </div>
                                    @foreach ($userTags as $tag)
                                        <div class="relative inline-block px-1 py-2">
                                            <div class="flex items-center">
                                                <input type="checkbox" name="tags[]" value="{{ $tag->id }}"
                                                    class="mr-1 ">
                                                <div class="text-white rounded-full bg-teal-500 ease-in px-2 py-1">
                                                    {{ $tag->tag_name }}
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    <div class="mt-4">
                                        <span class="font-bold">求人タグ</span>
                                    </div>
                                    @foreach ($jobTags as $tag)
                                        <div class="relative inline-block px-1 py-2">
                                            <div class="flex items-center">
                                                <input type="checkbox" name="tags[]" value="{{ $tag->id }}"
                                                    class="mr-1 ">
                                                <div class="text-white rounded-full bg-teal-500 ease-in px-2 py-1">
                                                    {{ $tag->tag_name }}
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="text-center my-4">
                                    <button type="button"
                                        class="text-white bg-red-400 border-0 py-2 px-8 focus:outline-none hover:bg-red-600 rounded text-lg"
                                        onclick="deleteTag(this)">削除</button>
                                </div>
                            </form>
                        @endif
                        <hr>
                        <form method="POST" enctype="multipart/form-data" action="{{ route('admin.tags.store') }}">
                            @csrf
                            @method('post')

                            <h3 class="m-4 ml-0 font-bold">新規登録</h3>
                            <label for="tags" class="leading-7 text-sm text-gray-600">タグ種別</label>
                            <select class="form-select rounded border-gray-400 mb-2" id="tags" name="subject">
                                <option value="none">選択してください</option>
                                <option value="0">ユーザー</option>
                                <option value="1">求人</option>
                            </select>
                            <br>
                            <span class="leading-7 text-sm text-gray-600 mr-4">タグ名</span>
                            <input type="text"
                                class="w-3/5 bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                                value="{{ old('name') }}" name="tag_name">
                            <button type="submit"
                                class="text-white bg-blue-500 border-0 py-2 px-8 focus:outline-none hover:bg-blue-600 rounded text-lg">新規登録</button>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>

    <script>
        function deleteTag(e) {
            'use strict';
            if (confirm('本当に削除してもいいですか?')) {
                document.getElementById('delete').submit();
            }
        }
    </script>

</x-app-layout>
