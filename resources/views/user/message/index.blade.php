<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            企業とのメッセージ
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <x-flash-message status="session('status')" />
                    <x-auth-validation-errors class="mb-4" :errors="$errors" />
                    @if ($companies)
                        @foreach ($companies as $company)
                            <div class="container px-5 py-4 mx-auto border-b border-gray-200">
                                <div class="flex flex-col">
                                    <div class="flex items-center w-4/5 mx-auto">
                                        <div class="w-1/6 sm:mr-8 mr-4 items-center">
                                            @if (empty($company->companies->image1))
                                                <img class="rounded-full w-20"
                                                    src="https://via.placeholder.com/100x100?text=No+Image">
                                            @else
                                                <img class="rounded-full w-20 object-cover"
                                                    src="{{ asset('storage/companies/' . $company->companies->image1) }}">
                                            @endif
                                        </div>
                                        <div class="w-5/6 flex text-left sm:mt-0">
                                            <div class="flex items-center mb-2">
                                                <p>
                                                    <a
                                                        href="{{ route('user.message.show', ['company' => $company->companies->id]) }}">
                                                        <span
                                                            class="text-gray-900 title-font font-bold text-3xl">{{ $company->companies->name }}</span>
                                                    </a>とのメッセージ
                                                </p>
                                            </div>
                                            <button
                                                class="ml-auto flex items-center border-2 border-indigo-200 px-2 rounded text-indigo-700 hover:border-indigo-400 "
                                                onClick="location.href='{{ route('user.company.show', ['company' => $company->companies->id]) }}'">企業ページ
                                            </button>
                                        </div>
                                    </div>

                                    <div class="w-3/5 mx-auto">
                                        <div class="p-2 flex flex-col items-start">
                                            {{-- @foreach ($jobs as $job) --}}
                                            @foreach ($company->companies->jobs as $job)
                                                @if ($job->isApplied(Auth::user()))
                                                    <div
                                                        class="inline-block py-1 px-2 mb-2 rounded bg-indigo-50 text-indigo-500 font-medium tracking-widest">
                                                        <a href="{{ route('user.jobs.show', ['job' => $job->id]) }}">
                                                            {{ $job->job_name }}</a>
                                                        <span class="text-black">に応募済み</span>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>

                                        @if ($company->messages->last())
                                            <a
                                                href="{{ route('user.message.show', ['company' => $company->companies->id]) }}">
                                                <p class="text-gray-500">
                                                    {{ $company->messages->last()->body }}</p>
                                                <small
                                                    class="text-gray-500">{{ $company->messages->last()->sent_time }}</small>
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
