// import RuleAdminForm from '@/Components/RuleAdminForm';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head } from '@inertiajs/react';

export default function Create({ auth, Genres }) {
    return (
        <AuthenticatedLayout
            user={auth.user}
            header={<h2 className="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Create a Rule</h2>}
        >
            <Head title="Rule.Create" />

            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            規約一覧
                        </div>
                    {/* <RuleAdminForm create/> */}
                    <form class = "display:table">
                        <div class = "mb-3">
                            <label for="rule_name">規約名</label>
                            <input type="text" id="rule_name" name="rule_name" />
                        </div>
                        <div class = "mb-3">
                                <label for="genre_id">Genre名</label>
                                <select id = "genre_id">
                                    {Genres.map(genre => (
                                        <option><a href={route('dashboard')}>{genre.name}</a></option>
                                    ))}
                                </select>
                            </div>
                            <div class="mb-5">
                                <label for="rule_note">規約内容</label>
                                <br />
                                <textarea id="rule_note" name="rule_note" rows="4" cols="40"></textarea>
                            </div>
                            <div class="flex">
                                <a href={route('rule.create')} class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">ルールの追加</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}