import { Head } from '@inertiajs/react';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import GuestLayout from '@/Layouts/GuestLayout';
import PrimaryButton from "@/Components/PrimaryButton";

export default function Welcome(props) {
    return (
        <>
            <Head title="Welcome" />

            {props.auth.user ? (
                <AuthenticatedLayout
                    auth={props.auth}
                    mainClassName="mt-auto flex sm:justify-center items-center sm:pt-0"
                >
                    <div className="m-auto w-full sm:max-w-lg px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                        <header className="bg-white">
                            <div className="max-w-7xl mx-auto py-6 text-center">
                                <h2 className="font-semibold text-xl text-gray-800 leading-tight">Welcome</h2>
                            </div>
                        </header>

                        <div className="mx-auto text-center space-y-6">
                            <p className="text-sm text-gray-600">Require a personalised E-Card Quickly?</p>

                            <PrimaryButton className="py-4 px-14">
                                Generate E-Card
                            </PrimaryButton>
                        </div>
                    </div>
                </AuthenticatedLayout>
            ) : (
                <GuestLayout
                    header={<h2 className="font-semibold text-xl text-gray-800 leading-tight">Welcome</h2>}
                >

                    <div className="mx-auto text-center space-y-6">
                        <p className="text-sm text-gray-600">Require a personalised E-Card Quickly?</p>

                        <PrimaryButton className="py-4 px-14">
                            Generate E-Card
                        </PrimaryButton>
                    </div>

                </GuestLayout>
            )}
        </>
    );
}
