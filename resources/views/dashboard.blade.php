<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>
                <!-- バージョン管理一覧のリンクを追加 -->
                <div class="mb-4">
                    <a href="/show-pdf" class="p-6 text-gray-900 dark:text-gray-100">
                        {{ __('Version管理一覧') }}
                    </a>
                </div>
            </div>
            <form action="/upload" method="POST" enctype="multipart/form-data" style="background-color: grey;">
                @csrf
                <input type="file" name="pdf">
                <button type="submit">Upload</button>
            </form>
        </div>
    </div>
</x-app-layout>