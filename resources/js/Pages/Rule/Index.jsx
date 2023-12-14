import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head } from '@inertiajs/react';
//import { router } from '@inertiajs/react';


function handleSearchSubmit(e) {
    e.preventDefault();
    const keyword = e.target.elements.keyword.value;
    window.location.href = route("rule.search", { keyword : keyword });
}

export default function Index({ auth, Rules }) {

    return (
        <AuthenticatedLayout
            user={auth.user}
            header={<h2 className="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Rule</h2>}
        >
            <Head title="Rule.Index" />

            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div className="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div className="p-6 text-gray-900 dark:text-gray-100">
                            規約一覧
                        </div>
                    </div>
                    {auth.user.role == 2 && (
                        <div class="flex justify-end">
                            <a href={route('rule.create')} class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">ルールの追加</a>
                        </div>
                    )}

                    <form className="mb-6" onSubmit={handleSearchSubmit}>
                        <div className="flex flex-col mb-4">
                            <label htmlFor="keyword" className="block text-sm font-medium text-gray-700">
                                Keyword
                            </label>
                            <input
                                id="keyword"
                                className="block mt-1 w-full"
                                type="text"
                                name="keyword"
                                autoFocus
                            />
                        </div>
                        <div className="flex items-center justify-end mt-4">
                            <button type="submit" className="ml-3 bg-blue-500 text-white px-4 py-2 rounded">
                                Search
                            </button>
                        </div>
                    </form>

                    <table class="bg-white text-center w-full border-collaple">
                        <thead>
                            <tr>
                                <th class="py-4 px-6 bg-gray-lightest dark:bg-gray-darkest font-bold uppercase text-lg text-gray-dark dark:text-gray-200 border-b border-grey-light dark:border-grey-dark">ルール名</th>
                                <th class="py-4 px-6 bg-gray-lightest dark:bg-gray-darkest font-bold uppercase text-lg text-gray-dark dark:text-gray-200 border-b border-grey-light dark:border-grey-dark">カテゴリ</th>
                                <th class="py-4 px-6 bg-gray-lightest dark:bg-gray-darkest font-bold uppercase text-lg text-gray-dark dark:text-gray-200 border-b border-grey-light dark:border-grey-dark">最終更新日</th>
                            </tr>
                        </thead>
                        <tbody>
                            {Rules.map(rule => (
                                <tr>
                                    <td><a href={route('rule.show', rule.id)}>{rule.name}</a></td>
                                    <td>{rule.genre_name}</td>
                                    <td>{new Date(rule.updated_at).toLocaleString('ja-JP', { year: 'numeric', month: '2-digit', day: '2-digit', hour: '2-digit', minute: '2-digit' })}</td>
                                </tr>
                            ))}
                        </tbody>
                    </table>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}