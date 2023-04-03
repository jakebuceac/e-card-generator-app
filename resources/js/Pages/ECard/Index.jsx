import {Head, Link} from '@inertiajs/react';
import Authenticated from "@/Layouts/AuthenticatedLayout";
import PrimaryButton from "@/Components/PrimaryButton";

export default function ShowNewECards({ auth, e_cards }) {
    const e_card_data = e_cards.data
    const keys = Object.keys(e_card_data);

    return (
        <Authenticated
            auth={auth}
            mainClassName="mt-auto flex justify-center items-center sm:pt-0"
        >

            <Head title="Dashboard" />

            <div className="w-full sm:max-w-screen-lg bg-white shadow-md overflow-hidden sm:rounded-lg">
                <div className="sm:px-6 lg:px-8">
                    <div className="text-center px-6 py-4 ">
                        <div className="py-6 text-center">
                            <h2 className="font-semibold text-xl text-gray-800 leading-tight">Your Recent E-Cards</h2>
                        </div>


                        <div className="grid lg:grid-cols-5 md:grid-cols-3 gap-1 justify-center">
                            {keys.map((key) => (
                                <div className="mt-2 rounded-lg" key={key}>
                                    <Link href={route('e-card.edit.create', [e_card_data[key].id])}>
                                        <img
                                            className="hover:border-indigo-400 border-solid border-2 rounded-lg"
                                            src={e_card_data[key].attributes.thumbnail_url}
                                            alt={e_card_data[key].attributes.name}/>
                                    </Link>

                                    <div className="flex p-2 justify-center">
                                        <PrimaryButton>Delete</PrimaryButton>
                                    </div>
                                </div>
                            ))}
                        </div>
                    </div>
                </div>
            </div>

        </Authenticated>
    );
}
