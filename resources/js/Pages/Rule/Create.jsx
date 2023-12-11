import InputLabel from '@/Components/InputLabel';
import PrimaryButton from '@/Components/PrimaryButton';
import TextInput from '@/Components/TextInput';
import Dropdown from '@/Components/Dropdown';
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
                    </div>
                    <form>
                        <InputLabel
                            value="rule_name" />
                        <TextInput />

                        <Dropdown content={Genres}></Dropdown>

                        <PrimaryButton type="submit">送信</PrimaryButton>
                    </form>

                    

                </div>
            </div>
        </AuthenticatedLayout>
    );
}