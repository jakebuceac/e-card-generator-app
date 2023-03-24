import { Head } from '@inertiajs/react';
import Authenticated from "@/Layouts/AuthenticatedLayout";

export default function ShowNewECards({ auth, image_urls }) {
    const keys = Object.keys(image_urls);

    return (
        <Authenticated
            auth={auth}
            mainClassName="mt-auto flex justify-center items-center sm:pt-0"
        >

            <Head title="Generate E-Card" />

            <div className="py-12">
                <div className="sm:px-6 lg:px-8">
                    <div className="bg-white overflow-hidden shadow-sm rounded text-center px-6 py-4 ">
                        <div className="py-6 text-center">
                            <h2 className="font-semibold text-xl text-gray-800 leading-tight">Completed Personalised E-Cards</h2>
                        </div>

                        <div className="grid lg:grid-cols-3 md:grid-cols-2 gap-2 justify-center mt-2.5">
                            {keys.map((key) => (
                                <div>
                                    <img
                                        src={image_urls[key]['url']}
                                        alt="image"/>
                                </div>
                            ))}
                        </div>
                    </div>
                </div>
            </div>

        </Authenticated>
    );
}
