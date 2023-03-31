import { Head } from '@inertiajs/react';
import Authenticated from "@/Layouts/AuthenticatedLayout";
import FilerobotImageEditor, { TABS, TOOLS} from 'react-filerobot-image-editor';
import { saveAs } from 'file-saver'

export default function Edit({ auth, id, name, image_url, design_state }) {
    function onSave(design_state, image_base_64, filename, width, height) {
        axios.put('/e-card/' + id, {
            design_state: JSON.stringify(design_state),
            filename: filename,
            image_base_64: image_base_64,
            size: width.toString() + 'x' + height.toString(),
        })
            .then(function (response) {
                saveAs(response.data, filename);
                name = filename;
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
            <div className="w-full sm:max-w-screen-sm bg-white shadow-md overflow-hidden sm:rounded-lg">
                <div className="sm:px-6 lg:px-8">
                    <div className="px-6 py-4">
                        <FilerobotImageEditor
                            defaultSavedImageName={name}
                            loadableDesignState={design_state}
                            source={image_url}
                            onSave={
                            (editedImageObject, designState) => {
                                onSave(designState, editedImageObject.imageBase64, editedImageObject.fullName, editedImageObject.width, editedImageObject.height);

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
                            tabsIds={[TABS.RESIZE, TABS.ADJUST, TABS.ANNOTATE]}
                            defaultTabId={TABS.RESIZE}
                            defaultToolId={TOOLS.RESIZE}
                        />
                    </div>
                </div>
            </div>
        </Authenticated>
    );
}
