import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import {Head, Link} from '@inertiajs/react';
import PrimaryButton from "@/Components/PrimaryButton";

export default function Dashboard(props) {
    return (
        <AuthenticatedLayout
            auth={props.auth}
            mainClassName="mt-auto"
        >
            <Head title="Dashboard" />

            <div className="py-12">
                <div className="max-w-5xl mx-auto sm:px-6 lg:px-8">
                    <div className="bg-white overflow-hidden shadow-sm sm:rounded-lg py-4">
                        <div className="py-6 text-center">
                            <h2 className="font-semibold text-xl text-gray-800 leading-tight">Your Recent E-Cards</h2>
                        </div>
                        <div className="text-center">
                            <p className="text-sm text-gray-600 mb-20">Seems you don't have any E-Cards!</p>

                            <Link href={route('e-card.generation.create')}>
                                <PrimaryButton className="mt-20 py-4 px-14">
                                    Generate E-Card
                                </PrimaryButton>
                            </Link>
                        </div>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
