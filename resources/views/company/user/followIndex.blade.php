<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            フォローしている求職者
        </h2>
    </x-slot>

    <div class="py-12">
        <x-flash-message status="session('status')" />
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <x-auth-validation-errors class="mb-4" :errors="$errors" />
                    <section class="text-gray-600 body-font">
                        @if ($users)
                            @foreach ($users as $user)
                                <div class="container px-5 py-24 mx-auto">
                                    <div
                                        class="flex items-center lg:w-3/5 mx-auto pb-10 border-gray-200 sm:flex-row flex-col">
                                        <div
                                            class="sm:mr-10 inline-flex items-center justify-center h-40 w-40
                                            ">
                                            @if (empty($user->users->pro_image))
                                                <img class="rounded-full h-40 w-40"
                                                    src="https://via.placeholder.com/100x100?text=No+Image">
                                            @else
                                                <img class="rounded-full h-40 w-40 object-cover"
                                                    src="{{ asset('storage/users/' . $user->users->pro_image) }}">
                                            @endif
                                        </div>
                                        <div class="flex-grow sm:text-left text-center mt-6 sm:mt-0">
                                            <p class="text-gray-900 title-font mb-2 font-bold text-3xl">
                                                {{ $user->users->name }}

                                                {{-- フォローボタン --}}
                                                @auth('companies')
                                                    @if (!$user->users->isFollowedBy(Auth::user()))
                                                        <span class="material-icons follow align-bottom ml-4"
                                                            data-user-id="{{ $user->users->id }}"
                                                            id=follow-{{ $user->users->id }}>favorite_border</span>
                                                    @else
                                                        <span class="material-icons follow align-bottom ml-4"
                                                            data-user-id="{{ $user->users->id }}"
                                                            id=follow-{{ $user->users->id }}>favorite</span>
                                                    @endif
                                                @endauth

                                            </p>
                                            <p class="leading-relaxed text-lg">{{ $user->users->catch }}</p>
                                            <hr />
                                            <p class="leading-relaxed text-base my-4">自己紹介：{{ $user->users->intro }}
                                            </p>
                                            <p class="leading-relaxed text-base my-4">経歴：{{ $user->users->career }}
                                            </p>
                                            <p class="leading-relaxed text-base my-4">資格：{{ $user->users->license }}
                                            </p>
                                        </div>
                                    </div>
                                    <div
                                        class="flex flex-wrap -m-4 items-center lg:w-3/5 md:w-4/5 mx-auto border-b pb-10 mb-10 border-gray-200">
                                        @for ($i = 0; $i < 3; $i++)
                                            @if ($user->users->userPictures->get($i) != null)
                                                <div class="p-8 md:w-1/3 sm:w-1/2 mx-auto">
                                                    <div class="h-full flex flex-col items-center text-center">
                                                        <img alt="portfolio"
                                                            class="flex-shrink-0 rounded-lg w-full object-contain object-center mb-4"
                                                            src="{{ asset('storage/users/portfolio/' . $user->users->userPictures->get($i)->filename) }}">
                                                    </div>
                                                </div>
                                            @endif
                                        @endfor
                                    </div>
                                </div>
                            @endforeach
                            {{-- {{ $users->links() }} --}}
                        @endif
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
