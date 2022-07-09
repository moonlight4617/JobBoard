<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            求人応募者一覧
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
                            <div class="container px-5 py-4 mx-auto">
                                <div class="flex flex-col">
                                    <div class="flex items-center w-4/5 mx-auto">
                                        <div class="w-1/6 sm:mr-8 mr-4 items-center">
                                            <a href="{{ route('company.user.show', ['user' => $user->id]) }}">
                                                @if (empty($user->pro_image))
                                                    <img class="rounded-full w-20 h-20"
                                                        src="https://via.placeholder.com/100x100?text=No+Image">
                                                @else
                                                    <img class="rounded-full w-20 h-20 object-cover"
                                                        src="{{ asset('storage/users/' . $user->pro_image) }}">
                                                @endif
                                            </a>
                                        </div>
                                        <div class="w-5/6 flex text-left sm:mt-0">
                                            <div class="flex items-center mb-2">
                                                <p class="text-gray-900 title-font font-bold text-3xl">
                                                    <a href="{{ route('company.user.show', ['user' => $user->id]) }}">{{ $user->name }}
                                                    </a>
                                                </p>
                                            </div>
                                            <button
                                                class="ml-auto flex items-center border-2 border-indigo-200 px-2 rounded text-indigo-700 hover:border-indigo-400 "
                                                onClick="location.href='{{ route('company.message.show', ['user' => $user->id]) }}'">メッセージ
                                            </button>
                                        </div>
                                    </div>

                                    {{-- <div class="w-3/5 mx-auto">
                                    </div> --}}
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
