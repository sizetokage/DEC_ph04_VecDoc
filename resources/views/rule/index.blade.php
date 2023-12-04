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
                    {{ __("規約一覧") }}
                </div>
            </div>
            <table class = "bg-white text-center w-full border-collaple">
                <thead>
                    <tr>
                        <th  class="py-4 px-6 bg-gray-lightest dark:bg-gray-darkest font-bold uppercase text-lg text-gray-dark dark:text-gray-200 border-b border-grey-light dark:border-grey-dark">ルール名</th>
                        <th  class="py-4 px-6 bg-gray-lightest dark:bg-gray-darkest font-bold uppercase text-lg text-gray-dark dark:text-gray-200 border-b border-grey-light dark:border-grey-dark">最終更新日</th>
                        <th  class="py-4 px-6 bg-gray-lightest dark:bg-gray-darkest font-bold uppercase text-lg text-gray-dark dark:text-gray-200 border-b border-grey-light dark:border-grey-dark">カテゴリー</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        {{ ddd($Rules) }}
                        <td>育休</td>
                        <td>2019-10-31</td>
                        <td>休暇</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>