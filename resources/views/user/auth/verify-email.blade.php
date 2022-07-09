<x-guest-layout>
    <x-auth-card>
        <x-flash-message status="session('status')" />
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <div class="mb-4 text-sm text-gray-600">
            登録ありがとうございます。<br>確認用のメールを送信致しました。記載されているリンクをクリックして、メールアドレスの確認をお願いします。<br>もし、メールが届かなかった場合は再度お送りします。
        </div>

        @if (session('status') == 'verification-link-sent')
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ __('登録時に入力された電子メールアドレスに新しい認証リンクが送信されました。') }}
            </div>
        @endif

        <div class="mt-4 flex items-center justify-between">
            <form method="POST" action="{{ route('user.verification.send') }}">
                @csrf

                <div>
                    <x-button>
                        {{ __('認証メール再送信') }}
                    </x-button>
                </div>
            </form>

            <form method="POST" action="{{ route('user.logout') }}">
                @csrf

                <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900">
                    {{ __('ログアウト') }}
                </button>
            </form>
        </div>
    </x-auth-card>
</x-guest-layout>
