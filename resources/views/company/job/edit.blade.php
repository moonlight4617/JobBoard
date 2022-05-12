<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            求人更新
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <section class="text-gray-600 body-font relative">
                        <div class="container px-5 py-4 mx-auto">
                            <div class="flex flex-col text-center w-full mb-12">
                                <h1 class="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900">求人更新</h1>
                            </div>
                            <x-auth-validation-errors class="mb-4" :errors="$errors" />
                            <form method="POST" enctype="multipart/form-data"
                                action="{{ route('company.jobs.update', ['job' => $job->id]) }}">
                                @csrf
                                @method('put')
                                <div class="lg md:w-2/3 mx-auto">
                                    <div class="p-2">
                                        <div class="relative">
                                            <label for="job_name" class="leading-7 text-sm text-gray-600">求人名</label>
                                            <small>　*必須</small>
                                            <input type="text" id="job_name" name="job_name" required
                                                class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                                                value="{{ $job->job_name }}">
                                        </div>
                                    </div>
                                    <div class="p-2">
                                        <div class="relative">
                                            <label for="catch" class="leading-7 text-sm text-gray-600">呼びかけ文</label>
                                            <small>　*必須</small>
                                            <input type="text" id="catch" name="catch" required
                                                class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                                                value="{{ $job->catch }}">
                                        </div>
                                    </div>

                                    <div class="p-2">
                                        <div class="relative">
                                            <label for="detail" class="leading-7 text-sm text-gray-600">仕事内容</label>
                                            <small>　*必須</small>
                                            <textarea type="text" id="detail" name="detail" required
                                                class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">{{ $job->detail }}</textarea>
                                        </div>
                                    </div>
                                    <div class="p-2">
                                        <div class="relative">
                                            <label for="conditions" class="leading-7 text-sm text-gray-600">応募条件</label>
                                            <textarea type="text" id="conditions" name="conditions"
                                                class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                                                value="{{ $job->conditions }}"></textarea>
                                        </div>
                                    </div>
                                    <div class="p-2">
                                        <div class="relative">
                                            <label for="emp_status" class="leading-7 text-sm text-gray-600">雇用形態</label>
                                            <small>　*必須</small>
                                            <select type="number" id="emp_status" name="emp_status"
                                                class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                                @foreach ($emp_statuses as $key => $value)
                                                    @if ($job->empStatus() == $value)
                                                        <option selected value={{ $key }}>{{ $value }}
                                                        </option>
                                                    @else
                                                        <option value={{ $key }}>{{ $value }}
                                                        </option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="p-2">
                                        <div class="relative">
                                            <label for="occupation" class="leading-7 text-sm text-gray-600">職種</label>
                                            <br />
                                            <div class="m-2">
                                                @foreach ($occupations as $occupation)
                                                    @if ($jobOccus->contains($occupation->id))
                                                        <input checked type="checkbox" id="occupation"
                                                            name="occupation[]" value={{ $occupation->id }}
                                                            class="bg-gray-100 bg-opacity-50 border-gray-300" />
                                                    @else
                                                        <input type="checkbox" id="occupation" name="occupation[]"
                                                            value={{ $occupation->id }}
                                                            class="bg-gray-100 bg-opacity-50 border-gray-300" />
                                                    @endif
                                                    <label for="prefecture"
                                                        class="leading-7 text-sm text-gray-600 mr-3">{{ $occupation->name }}</label>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    <div class="p-2">
                                        <div class="relative">
                                            <label for="prefecture" class="leading-7 text-sm text-gray-600">勤務地</label>
                                            <br />
                                            @foreach ($prefectures as $prefecture)
                                                @if ($jobPrefs->contains($prefecture->id))
                                                    <input checked type="checkbox" id="prefecture" name="prefecture[]"
                                                        value={{ $prefecture->id }}
                                                        class="bg-gray-100 bg-opacity-50 border-gray-300 ml-3">
                                                @else
                                                    <input type="checkbox" id="prefecture" name="prefecture[]"
                                                        value={{ $prefecture->id }}
                                                        class="bg-gray-100 bg-opacity-50 border-gray-300 ml-3">
                                                @endif
                                                <label for="prefecture"
                                                    class="leading-7 text-sm text-gray-600">{{ $prefecture->prefecture }}</label>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="p-2">
                                        <div class="relative">
                                            <label for="duty_hours" class="leading-7 text-sm text-gray-600">勤務時間</label>
                                            <textarea type="text" id="duty_hours" name="duty_hours"
                                                class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                                                value="{{ $job->duty_hours }}"></textarea>
                                        </div>
                                    </div>
                                    <div class="p-2">
                                        <div class="relative">
                                            <label for="low_salary" class="leading-7 text-sm text-gray-600">下限給与</label>
                                            <input type="number" id="low_salary" name="low_salary"
                                                class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                                                value="{{ $job->low_salary }}">
                                        </div>
                                    </div>
                                    <div class="p-2">
                                        <div class="relative">
                                            <label for="high_salary"
                                                class="leading-7 text-sm text-gray-600">上限給与</label>
                                            <input type="number" id="high_salary" name="high_salary"
                                                class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                                                value="{{ $job->high_salary }}">
                                        </div>
                                    </div>
                                    <div class="p-2">
                                        <div class="relative">
                                            <label for="holiday" class="leading-7 text-sm text-gray-600">休日・休暇</label>
                                            <textarea type="text" id="holiday" name="holiday"
                                                class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                                                value="{{ $job->holiday }}"></textarea>
                                        </div>
                                    </div>
                                    <div class="p-2">
                                        <div class="relative">
                                            <label for="benefits" class="leading-7 text-sm text-gray-600">福利厚生</label>
                                            <textarea type="text" id="benefits" name="benefits"
                                                class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                                                value="{{ $job->benefits }}"></textarea>
                                        </div>
                                    </div>

                                    {{-- タグ選択 --}}
                                    @if ($tags)
                                        <div class="p-2">
                                            <p for="career" class="leading-7 text-sm text-gray-600">特徴タグ</p>
                                            @foreach ($tags as $tag)
                                                <div class="relative inline-block px-1 py-2">
                                                    @if ($jobTags && $jobTags->contains($tag))
                                                        <input checked="checked" type="checkbox"
                                                            id="checkbox{{ $tag->id }}"
                                                            name="tag[{{ $tag->id }}]"
                                                            value="{{ $tag->id }}"
                                                            class="opacity-0 absolute w-full h-full left-0 peer cursor-pointer">
                                                        <label for="checkbox1"
                                                            class="text-white rounded-full bg-teal-500  cursor-pointer ease-in peer-hover:bg-teal-600 px-2 py-1 peer-checked:bg-teal-600">{{ $tag->tag_name }}
                                                        </label>
                                                    @else
                                                        <input type="checkbox" id="checkbox{{ $tag->id }}"
                                                            name="tag[{{ $tag->id }}]"
                                                            value="{{ $tag->id }}"
                                                            class="opacity-0 absolute w-full h-full left-0 peer cursor-pointer">
                                                        <label for="checkbox1"
                                                            class="text-white rounded-full bg-teal-500  cursor-pointer ease-in peer-hover:bg-teal-600 px-2 py-1 peer-checked:bg-teal-600">{{ $tag->tag_name }}
                                                        </label>
                                                    @endif
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif

                                    <div class="pt-4">
                                        <div class="relative">
                                            <p class="leading-7 text-sm text-gray-600">求人画像</p>
                                            <div class="w-full flex justify-around mt-4">
                                                @if (empty($job->image1))
                                                    画像１
                                                @else
                                                    <img src="{{ asset('storage/jobs/' . $job->image1) }}"
                                                        class="w-1/4">
                                                @endif
                                                <input type="file" name="imgpath1"
                                                    accept="image/png,image/jpeg,image/jpg">
                                            </div>
                                            <div class="w-full flex justify-around mt-4">
                                                @if (empty($job->image2))
                                                    画像２
                                                @else
                                                    <img src="{{ asset('storage/jobs/' . $job->image2) }}"
                                                        class="w-1/4">
                                                @endif
                                                <input type="file" name="imgpath2"
                                                    accept="image/png,image/jpeg,image/jpg">
                                            </div>
                                            <div class="w-full flex justify-around mt-4">
                                                @if (empty($job->image3))
                                                    画像3
                                                @else
                                                    <img src="{{ asset('storage/jobs/' . $job->image3) }}"
                                                        class="w-1/4">
                                                @endif
                                                <input type="file" name="imgpath3"
                                                    accept="image/png,image/jpeg,image/jpg">
                                            </div>
                                            <div class="p-2 w-full flex justify-around mt-4">
                                                <button type="button"
                                                    onclick="location.href='{{ route('company.jobs.show', ['job' => $job->id]) }}'"
                                                    class="bg-gray-300 border-0 py-2 px-8 focus:outline-none hover:bg-gray-400 rounded text-lg">戻る</button>
                                                <button type="submit"
                                                    class="text-white bg-blue-500 border-0 py-2 px-8 focus:outline-none hover:bg-blue-600 rounded text-lg">更新</button>
                                            </div>
                                        </div>
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
