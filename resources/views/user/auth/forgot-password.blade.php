<x-guest-layout>
    <x-auth-card>
        <x-flash-message status="session('status')" />
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <div class="mb-4 text-sm text-gray-600">
            {{ __('パスワードをお忘れになりましたか？メールアドレスをお知らせいただければ、パスワード再設定用のリンクをメールでお送りしますので、新しいパスワードをお選びください。') }}
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('user.password.email') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-label for="email" :value="__('Eメール')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                    autofocus />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button>
                    {{ __('パスワードリセット用リンクをメール送信') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
