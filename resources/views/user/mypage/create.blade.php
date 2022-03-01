<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          ユーザー情報登録
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                  <section class="text-gray-600 body-font relative">
                    <div class="container px-5 py-4 mx-auto">
                      <div class="flex flex-col text-center w-full mb-12">
                        <h1 class="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900">ユーザー情報登録</h1>
                      </div>
                      <x-auth-validation-errors class="mb-4" :errors="$errors" />
                      <form method="POST" enctype="multipart/form-data" action="{{ route('user.user.store') }}">
                      @csrf
                      <div class="lg md:w-2/3 mx-auto">
                          <div class="p-2">
                            <div class="relative">
                              <label for="catch" class="leading-7 text-sm text-gray-600">キャッチコピー</label>
                              <input type="text" id="catch" name="catch" required class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out" value="{{ old('catch') }}">
                            </div>
                          </div>
                          <div class="p-2">
                            <div class="relative">
                              <label for="intro" class="leading-7 text-sm text-gray-600">自己紹介文</label>
                              <textarea type="text" id="intro" name="intro" required class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"></textarea>
                            </div>
                          </div>
                          <div class="p-2">
                            <div class="relative">
                              <label for="license" class="leading-7 text-sm text-gray-600">資格</label>
                              <textarea type="text" id="license" name="license" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"></textarea>
                            </div>
                          </div>
                          <div class="p-2">
                            <div class="relative">
                              <label for="career" class="leading-7 text-sm text-gray-600">経歴</label>
                              <textarea type="text" id="career" name="career" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"></textarea>
                            </div>
                          </div>
                          <div class="p-2">
                            <div class="relative">
                              <label for="hobby" class="leading-7 text-sm text-gray-600">趣味・特技</label>
                              <textarea type="text" id="hobby" name="hobby" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"></textarea>
                            </div>
                          </div>
                          <div class="my-4">
                            <p>プロフィール画像　<input type="file" name="pro_image" accept="image/png,image/jpeg,image/jpg"></p>
                          </div>
                          <div class="p-2 w-full flex justify-around mt-4">
                            <button type="button" onclick="location.href='{{ route('user.dashboard') }}'" class="bg-gray-300 border-0 py-2 px-8 focus:outline-none hover:bg-gray-400 rounded text-lg">戻る</button>
                            <button type="submit" class="text-white bg-blue-500 border-0 py-2 px-8 focus:outline-none hover:bg-blue-600 rounded text-lg">登録</button>
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
