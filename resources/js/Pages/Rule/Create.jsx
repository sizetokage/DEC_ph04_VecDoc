// import RuleAdminForm from '@/Components/RuleAdminForm';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head } from '@inertiajs/react';
import { rule } from 'postcss';
import { useState } from 'react';
import { router } from '@inertiajs/react';

export default function Create({ auth, Genres }) {
    const [values, setValues] = useState({
        name: "",
        genre_id: "",
        description: "",
    });

    function RuleChange(e) {
        const key = e.target.id;
        const value = e.target.value;
        setValues((values) => ({
            ...values,
            [key]: value,
        }));
    }
    function RuleSubmit(e) {
        e.preventDefault();
        
        // valuesをalertで表示
        //alert(JSON.stringify(values));
        
        // Inertia.postで値を送信
        router.post("/rule", values);
    }
    
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
                    <form onSubmit={ RuleSubmit }class = "display:table">
                        <div class = "mb-3">
                            <label for="rule_name">規約名</label>
                                <input type="text" id="name" value={values.name} onChange={RuleChange}/>
                        </div>
                        <div class = "mb-3">
                                <label for="genre_id">Genre名</label>
                                <select id="genre_id" value={ values.genre_id} onChange={ RuleChange }>
                                    {Genres.map(genre => (
                                        <option value={genre.id}>{genre.name}</option>
                                    ))}
                                </select>
                            </div>
                            <div class="mb-5">
                                <label for="rule_note">規約内容</label>
                                <br />
                                <textarea id="description" value={values.description} onChange={RuleChange} name="rule_description" rows="4" cols="40"></textarea>
                            </div>
                            <div class="flex">
                                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">作成</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}