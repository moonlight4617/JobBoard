<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            企業一覧
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-flash-message status="session('status')" />
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="md:p-6 bg-white border-b border-gray-200">
                    <section class="text-gray-600 body-font">
                        <div class="container md:px-5 py-4 mx-auto">
                            <div class="w-full mx-auto overflow-auto">
                                <form method="POST" enctype="multipart/form-data"
                                    action="{{ route('admin.companies.query') }}">
                                    @csrf
                                    @method('get')
                                    <label for="name" class="leading-7 text-sm text-gray-600">企業名</label>
                                    <input id="name" name="name"
                                        class="bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                    <label for="email" class="ml-4 leading-7 text-sm text-gray-600">Eメール</label>
                                    <input id="email" name="email"
                                        class="bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                    <button type="submit"
                                        class="text-white bg-blue-500 border-0 py-2 px-8 ml-4 focus:outline-none hover:bg-blue-600 rounded text-lg">検索</button>
                                </form>
                                <table class="table-auto w-full text-left whitespace-no-wrap mt-4">
                                    <thead>
                                        <tr>
                                            <th
                                                class="md:px-4 px-2 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl">
                                                企業名</th>
                                            <th
                                                class="md:px-4 px-2 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                                Eメール</th>
                                            <th
                                                class="md:px-4 px-2 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                                作成日</th>
                                            <th
                                                class="md:px-4 px-2 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                                更新日</th>
                                            <th
                                                class="md:px-4 px-2 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($companies as $company)
                                            <tr>
                                                <td class="md:px-4 px-2 py-3">{{ $company->name }}</td>
                                                <td class="md:px-4 px-2 py-3">{{ $company->email }}</td>
                                                <td class="md:px-4 px-2 py-3">{{ $company->created_at }}</td>
                                                <td class="md:px-4 px-2 py-3">{{ $company->updated_at }}</td>
                                                <td class="md:px-4 px-2 py-3">
                                                    <button type="button"
                                                        onclick="location.href='{{ route('admin.companies.show', ['company' => $company->id]) }}'"
                                                        class="bg-blue-300 border-0 py-2 px-8 focus:outline-none hover:bg-blue-400 rounded">詳細</button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{ $companies->links() }}
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
