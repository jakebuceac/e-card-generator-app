import {Head, router} from '@inertiajs/react';
import Authenticated from "@/Layouts/AuthenticatedLayout";
import FilerobotImageEditor, { TABS, TOOLS} from 'react-filerobot-image-editor';
import TextInput from "@/Components/TextInput";

export default function Edit({ auth, id, image_url, design_state }) {
    console.log(design_state);
    const handleOnChange = (event) => {
        setData(event.target.name, event.target.type === 'checkbox' ? event.target.checked : event.target.value);
    };

    return (
        <Authenticated
            auth={auth}
            mainClassName="mt-auto flex justify-center items-center sm:pt-0"
        >
            <Head title="Editing E-Card" />
            <div className="w-full sm:max-w-screen-lg bg-white shadow-md overflow-hidden sm:rounded-lg">
                <div className="sm:px-6 lg:px-8">
                    <div className="text-center px-6 py-4">
                        <div className="py-6">
                            <TextInput
                                id="name"
                                name="name"
                                className="mt-1 block w-full text-center"
                                autoComplete="name"
                                isFocused={true}
                                onChange={handleOnChange}
                                required
                            />
                        </div>
                        <FilerobotImageEditor
                            loadableDesignState={design_state}
                            source={image_url}
                            onSave={
                            (editedImageObject, designState) => {
                                router.put('/e-card/' + id, {
                                    design_state: designState,
                            })}}
                            annotationsCommon={{
                                fill: '#000000'
                            }}
                            Text={{
                                text: 'Text',
                                align: 'center',
                                fontFamily: 'Lobster',
                                fonts: [
                                    'Arial',
                                    'Tahoma',
                                    'Sans-serif',
                                    'Lobster'
                                ],
                        }}
                            Rotate={{ angle: 90, componentType: 'slider' }}
                            tabsIds={[TABS.RESIZE, TABS.ADJUST, TABS.ANNOTATE]} // or {['Adjust', 'Annotate', 'Watermark']}
                            defaultTabId={TABS.RESIZE} // or 'Annotate'
                            defaultToolId={TOOLS.RESIZE} // or 'Text'
                        />
                    </div>
                </div>
            </div>
        </Authenticated>
    );
}
