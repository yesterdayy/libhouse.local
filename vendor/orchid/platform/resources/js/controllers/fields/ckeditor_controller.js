import { Controller } from 'stimulus';
// Core
import CKEditor from '@ckeditor/ckeditor5-build-classic/build/ckeditor';

// A theme is also required
// import 'tinymce/themes/modern';
// import 'tinymce/themes/inlite'

// Plugins

export default class extends Controller {
    /**
     *
     */
    connect() {
        const selector = '#' + this.element.querySelector('.ckeditor').id;
        const input = this.element.querySelector('input');

        CKEditor
        .create(this.element.querySelector(selector))
        .then( editor => {

        } )
        .catch( error => {

        });
    }

    /**
     *
     * @param blobInfo
     * @param success
     */
    upload(blobInfo, success) {
        const data = new FormData();
        data.append('file', blobInfo.blob());

        axios
            .post(platform.prefix('/systems/files'), data)
            .then((response) => {
                success(response.data.url);
            })
            .catch((error) => {
                console.warn(error);
            });
    }

    disconnect() {
        tinymce.remove(`#${this.element.querySelector('.tinymce').id}`);
    }
}
