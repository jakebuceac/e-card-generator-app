import {Head, Link} from '@inertiajs/react';
import Authenticated from "@/Layouts/AuthenticatedLayout";

export default function ShowNewECards({ auth, images }) {
    const keys = Object.keys(images);

    return (
        <Authenticated
            auth={auth}
            mainClassName="mt-auto flex justify-center items-center sm:pt-0"
        >

            <Head title="Completed Personalised E-Cards" />

            <div className="w-full sm:max-w-screen-lg bg-white shadow-md overflow-hidden sm:rounded-lg">
                <div className="sm:px-6 lg:px-8">
                    <div className="text-center px-6 py-4 ">
                        <div className="py-6 text-center">
                            <h2 className="font-semibold text-xl text-gray-800 leading-tight">Completed Personalised E-Cards</h2>
                        </div>

                        <div className="grid lg:grid-cols-3 md:grid-cols-2 gap-1 justify-center mt-2.5">
                            {keys.map((key) => (
                                <div className="hover:border-indigo-400 border-solid border-2 rounded-lg" key={key}>
                                    <Link href={route('e-card.store')} method="post" data={{
                                        name: images[key]['name'],
                                        image_size: images[key]['size'],
                                        occasion: images[key]['occasion'],
                                        header: images[key]['header'],
                                        message: images[key]['message'],
                                        font_colour: images[key]['font_colour'],
                                    }}>
                                        <img
                                            className="rounded-lg"
                                            src={images[key]['thumbnail_url']}
                                            alt="image"/>
                                    </Link>
                                </div>
                            ))}
                        </div>
                    </div>
                </div>
            </div>

        </Authenticated>
    );
}
