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
                        <ul>
                            @foreach ($companies as $company)
                                <li>
                                    <a
                                        href="{{ route('user.message.show', ['company' => $company->companies->id]) }}">
                                        {{ $company->companies->name }}とのメッセージ一覧
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
