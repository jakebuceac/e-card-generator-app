import {Head} from '@inertiajs/react';
import Authenticated from "@/Layouts/AuthenticatedLayout";
import FilerobotImageEditor, { TABS, TOOLS} from 'react-filerobot-image-editor';
import { saveAs } from 'file-saver'

export default function Edit({ auth, id, name, image_url, design_state }) {
    function onSave(design_state, image_base_64, filename, width, height) {
        axios.put('/e-card/' + id, {
            design_state: JSON.stringify(design_state),
            filename: image_base_64,
            image_base_64: filename,
            size: width.toString() + 'x' + height.toString(),
        })
            .then(function (response) {
                console.log(response.data);
                saveAs(response.data, filename);
            })
            .catch(function (error) {
                console.log(error);
            });
    }

    return (
        <Authenticated
            auth={auth}
            mainClassName="mt-auto flex justify-center items-center sm:pt-0"
        >
            <Head title="Editing E-Card" />
            <div className="w-full sm:max-w-screen-lg bg-white shadow-md overflow-hidden sm:rounded-lg">
                <div className="sm:px-6 lg:px-8">
                    <div className="text-center px-6 py-4">
                        <header className="bg-white">
                            <div className="max-w-7xl mx-auto py-6 text-center">
                                <h2 className="font-semibold text-xl text-gray-800 leading-tight">{name}</h2>
                            </div>
                        </header>
                        <FilerobotImageEditor
                            loadableDesignState={design_state}
                            source={image_url}
                            onSave={
                            (editedImageObject, designState) => {
                                onSave(designState, editedImageObject.fullName, editedImageObject.imageBase64, editedImageObject.width, editedImageObject.height);

                                console.log('finished');
                            }}
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
