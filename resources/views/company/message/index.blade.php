<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            ユーザーとのメッセージ
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <x-flash-message status="session('status')" />
                    <x-auth-validation-errors class="mb-4" :errors="$errors" />
                    @if ($users)
                        @foreach ($users as $user)
                            <div class="container px-5 py-4 mx-auto border-b border-gray-200">
                                <div class="flex flex-col">
                                    <div class="flex items-center sm:w-4/5 mx-auto">
                                        <div class="w-1/6 sm:mr-8 mr-4 items-center">
                                            @if (empty($user->users->pro_image))
                                                <img class="rounded-full w-20"
                                                    src="https://via.placeholder.com/100x100?text=No+Image">
                                            @else
                                                <img class="rounded-full w-20 h-20 object-cover"
                                                    src="/images/{{ $user->users->pro_image }}">
                                                {{-- src="{{ asset('storage/users/' . $user->pro_image) }}"> --}}
                                            @endif
                                        </div>
                                        <div class="w-5/6 flex text-left sm:mt-0">
                                            <div class="flex items-center mb-2">
                                                <p>
                                                    <a
                                                        href="{{ route('company.message.show', ['user' => $user->users->id]) }}">
                                                        <span
                                                            class="text-gray-900 title-font font-bold text-3xl">{{ $user->users->name }}</span>
                                                    </a>とのメッセージ
                                                </p>
                                            </div>
                                            <button
                                                class="ml-auto flex items-center border-2 border-indigo-200 px-2 rounded text-indigo-700 hover:border-indigo-400 "
                                                onClick="location.href='{{ route('company.user.show', ['user' => $user->users->id]) }}'">プロフィール
                                            </button>
                                        </div>
                                    </div>

                                    <div class="sm:w-3/5 mx-auto">
                                        <div class="p-2 flex flex-col items-start">
                                            @foreach ($jobs as $job)
                                                @if ($job->isApplied($user))
                                                    <div
                                                        class="inline-block py-1 px-2 mb-2 rounded bg-indigo-50 text-indigo-500 font-medium tracking-widest">
                                                        <a href="{{ route('company.jobs.show', ['job' => $job->id]) }}">
                                                            {{ $job->job_name }}</a>
                                                        <span class="text-black">に応募済み</span>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>

                                        @if ($user->messages->last())
                                            <a href="{{ route('company.message.show', ['user' => $user->users->id]) }}">
                                                <p class="text-gray-500">{!! $user->messages->last()->body !!}</p>
                                                <small
                                                    class="text-gray-500">{{ date('Y-m-d H:i', strtotime($user->messages->last()->sent_time)) }}</small>
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        {{ $users->links() }}
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
