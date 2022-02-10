<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            企業詳細
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                  <section class="text-gray-600 body-font relative">
                    <div class="container px-5 py-4 mx-auto">
                      <div class="flex flex-col text-center w-full mb-12">
                        <h1 class="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900">企業詳細</h1>
                      </div>
                      <div class="lg:w-1/2 md:w-2/3 mx-auto">
                        <div class="flex flex-wrap -m-2">
                          <div class="p-2 w-1/2">
                            <div class="relative">
                              企業名:
                              {{ $company->name }}
                            </div>
                          </div>
                          <div class="p-2 w-1/2">
                            <div class="relative">
                              Eメール：
                              {{ $company->email }}
                            </div>
                          </div>
                          <div class="p-2 w-full">
                            <div class="relative">
                              紹介文：
                              {{ $company->intro }}
                            </div>
                          </div>
                          <div class="p-2 w-full flex justify-around mt-4">
                            <button type="button" onclick="location.href='{{ route('admin.companies.index') }}'" class="bg-gray-300 border-0 py-2 px-8 focus:outline-none hover:bg-gray-400 rounded text-lg">戻る</button>
                            <button type="button" onclick="location.href='{{ route('admin.companies.edit', ['company' => $company->id ]) }}'" class="text-white bg-blue-500 border-0 py-2 px-8 focus:outline-none hover:bg-blue-600 rounded text-lg">編集</button>

                            <form id="delete_{{$company->id}}" method="post" action="{{ route('admin.companies.destroy', ['company' => $company->id])}}">
                            @csrf 
                            @method('delete')
                            <button type="button" href=“” data-id="{{ $company->id }}" onclick="deletePost(this)" class="text-white bg-red-500 border-0 py-2 px-8 focus:outline-none hover:bg-red-600 rounded text-lg">削除</button>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                  </section>
                </div>
            </div>
        </div>
    </div>
    <script>
      function deletePost(e) {
        'use strict';
        if (confirm('本当に削除してもいいですか?')) { 
          document.getElementById('delete_' + e.dataset.id).submit();
        }
      } 
    </script>

</x-app-layout>
