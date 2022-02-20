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
                          @if(empty($job->image1))
                            <img src="{{asset('images/noimage.png')}}">
                            @else
                            <img src="{{asset('storage/public/jobs/' . $job->image1)}}">
                          @endif
                          @if(empty($job->image2))
                            <img src="{{asset('images/noimage.png')}}">
                            @else
                            <img src="{{asset('storage/public/jobs/' . $job->image2)}}">
                          @endif
                          @if(empty($job->image3))
                            <img src="{{asset('images/noimage.png')}}">
                            @else
                            <img src="{{asset('storage/public/jobs/' . $job->image3)}}">
                          @endif

<div id="carouselExampleIndicators" class="carousel slide relative" data-bs-ride="carousel">
  <div class="carousel-indicators absolute right-0 bottom-0 left-0 flex justify-center p-0 mb-4">
    <button
      type="button"
      data-bs-target="#carouselExampleIndicators"
      data-bs-slide-to="0"
      class="active"
      aria-current="true"
      aria-label="Slide 1"
    ></button>
    <button
      type="button"
      data-bs-target="#carouselExampleIndicators"
      data-bs-slide-to="1"
      aria-label="Slide 2"
    ></button>
    <button
      type="button"
      data-bs-target="#carouselExampleIndicators"
      data-bs-slide-to="2"
      aria-label="Slide 3"
    ></button>
  </div>
  <div class="carousel-inner relative w-full overflow-hidden">
    <div class="carousel-item active float-left w-full">
      <img
        src="https://mdbcdn.b-cdn.net/img/new/slides/041.webp"
        class="block w-full"
        alt="Wild Landscape"
      />
    </div>
    <div class="carousel-item float-left w-full">
      <img
        src="https://mdbcdn.b-cdn.net/img/new/slides/042.webp"
        class="block w-full"
        alt="Camera"
      />
    </div>
    <div class="carousel-item float-left w-full">
      <img
        src="https://mdbcdn.b-cdn.net/img/new/slides/043.webp"
        class="block w-full"
        alt="Exotic Fruits"
      />
    </div>
  </div>
  <button
    class="carousel-control-prev absolute top-0 bottom-0 flex items-center justify-center p-0 text-center border-0 hover:outline-none hover:no-underline focus:outline-none focus:no-underline left-0"
    type="button"
    data-bs-target="#carouselExampleIndicators"
    data-bs-slide="prev"
  >
    <span class="carousel-control-prev-icon inline-block bg-no-repeat" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button
    class="carousel-control-next absolute top-0 bottom-0 flex items-center justify-center p-0 text-center border-0 hover:outline-none hover:no-underline focus:outline-none focus:no-underline right-0"
    type="button"
    data-bs-target="#carouselExampleIndicators"
    data-bs-slide="next"
  >
    <span class="carousel-control-next-icon inline-block bg-no-repeat" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>


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
                          <form id="delete_{{$job->id}}" method="post" action="{{ route('company.jobs.destroy', ['job' => $job->id])}}">
                            @csrf 
                            @method('delete')
                          <button type="button" href=“” data-id="{{ $job->id }}" onclick="deletePost(this)" class="text-white bg-red-500 border-0 py-2 px-8 focus:outline-none hover:bg-red-600 rounded text-lg">削除</button>
                          </form>
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
