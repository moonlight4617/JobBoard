<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            求人詳細
        </h2>
    </x-slot>

    <div class="py-12">
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
                            <div class="p-2">
                              <div class="relative">
                                求人名：{{ $job->job_name}}
                              </div>
                            </div>
                            <div class="p-2">
                              <div class="relative">
                                仕事内容：{{ $job->detail}}
                              </div>
                            </div>
                            <div class="p-2">
                              <div class="relative">
                                応募条件：{{ $job->conditions}}
                              </div>
                            </div>
                            <div class="p-2">
                              <div class="relative">
                                勤務時間：{{ $job->duty_hours}}
                              </div>
                            </div>
                            <div class="p-2">
                              <div class="relative">
                                下限給与：{{ $job->low_salary}}
                              </div>
                            </div>
                            <div class="p-2">
                              <div class="relative">
                                上限給与：{{ $job->high_salary}}
                              </div>
                            </div>
                            <div class="p-2">
                              <div class="relative">
                                休日・休暇：{{ $job->holiday}}
                              </div>
                            </div>
                            <div class="p-2">
                              <div class="relative">
                              福利厚生：{{ $job->benefits}}
                              </div>
                            </div>
                          </div>
                          <div class="p-2 w-full flex justify-around mt-4">
                          <button type="button" onclick="location.href='{{ route('company.jobs.edit', ['job' => $job->id ]) }}'" class="bg-blue-300 border-0 py-2 px-8 focus:outline-none hover:bg-blue-400 rounded text-lg">編集</button>
                          <button type="button" onclick="location.href='{{ route('company.jobs.index') }}'" class="bg-gray-300 border-0 py-2 px-8 focus:outline-none hover:bg-gray-400 rounded text-lg">戻る</button>
                          <button type="button" class="text-white bg-red-500 border-0 py-2 px-8 focus:outline-none hover:bg-red-600 rounded text-lg">削除</button>
                        </div>
                    </div>
                  </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
