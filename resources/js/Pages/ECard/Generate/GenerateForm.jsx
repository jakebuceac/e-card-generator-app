import InputError from '@/Components/InputError';
import InputLabel from '@/Components/InputLabel';
import PrimaryButton from '@/Components/PrimaryButton';
import TextInput from '@/Components/TextInput';
import { Head, useForm } from '@inertiajs/react';
import Authenticated from "@/Layouts/AuthenticatedLayout";
import SelectInput from "@/Components/SelectInput";

export default function GenerateForm({ auth, image_sizes, occasions }) {
    const { data, setData, post, processing, errors } = useForm({
        recipient_name: '',
        image_size: '',
        occasion: '',
        personal_message: '',
    });

    function removeEmptyFields(data) {
        Object.keys(data).forEach(key => {
            if (data[key] === '' || data[key] == null) {
                delete data[key];
            }
        });
    }

    const handleOnChange = (event) => {
        setData(event.target.name, event.target.type === 'checkbox' ? event.target.checked : event.target.value);
    };

    const submit = (e) => {
        e.preventDefault();

        removeEmptyFields(data)

        post(route('e-card.generation.store'));
    };

    return (
        <Authenticated
            auth={auth}
            mainClassName="mt-auto flex sm:justify-center items-center sm:pt-0"
        >
            <div className="m-auto w-full sm:max-w-lg px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                <header className="bg-white">
                    <div className="max-w-7xl mx-auto py-6 text-center">
                        <h2 className="font-semibold text-xl text-gray-800 leading-tight">Generate E-Card</h2>
                    </div>

                    <div className="mx-auto text-center pb-6">
                        <p className="text-sm text-gray-600">Please input the following details to help us make your "unique" e-card!</p>
                    </div>
                </header>

                <Head title="Generate E-Card" />

                <form onSubmit={submit}>
                    <div>
                        <InputLabel htmlFor="recipient_name" value="Recipient Name*" />

                        <TextInput
                            id="recipient_name"
                            name="recipient_name"
                            value={data.recipient_name}
                            className="mt-1 block w-full"
                            autoComplete="recipient_name"
                            isFocused={true}
                            onChange={handleOnChange}
                            required
                        />

                        <InputError message={errors.recipient_name} className="mt-2" />
                    </div>

                    <div className="mt-4">
                        <InputLabel htmlFor="image_size" value="Image Size*" />

                        <SelectInput
                            id="image_size"
                            name="image_size"
                            value={data.image_size}
                            options={image_sizes}
                            className="mt-1 block w-full"
                            onChange={handleOnChange}
                            isFocused={true}
                            required
                        />

                        <InputError message={errors.image_size} className="mt-2" />
                    </div>

                    <div className="mt-4">
                        <InputLabel htmlFor="occasion" value="Occasion*" />

                        <SelectInput
                            id="occasion"
                            name="occasion"
                            value={data.occasion}
                            options={occasions}
                            onChange={handleOnChange}
                            className="mt-1 block w-full"
                            isFocused={true}
                            required
                        />

                        <InputError message={errors.occasion} className="mt-2" />
                    </div>

                    <div className="mt-4">
                        <InputLabel htmlFor="personal_message" value="Personal Message" />

                        <TextInput
                            id="personal_message"
                            name="personal_message"
                            value={data.personal_message}
                            className="mt-1 block w-full"
                            autoComplete="personal_message"
                            isFocused={true}
                            onChange={handleOnChange}
                        />

                        <InputError message={errors.personal_message} className="mt-2" />
                    </div>


                    <div className="flex items-center justify-end mt-4">
                        <PrimaryButton className="ml-4" disabled={processing}>
                            Create
                        </PrimaryButton>
                    </div>
                </form>
            </div>

        </Authenticated>
    );
}
