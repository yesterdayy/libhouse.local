import {Controller} from "stimulus";
import Cropper      from 'cropperjs';

export default class extends Controller {

    /**
     * @type {string[]}
     */

    static targets = [
        "source",
        "upload"
    ];

    /**
     *
     */
    connect() {
        let image = this.data.get('image');
        if (image) {
            this.element.querySelector('.picture-preview').src = image;
        } else {
            this.element.querySelector('.picture-preview').classList.add('none');
            this.element.querySelector('.picture-remove').classList.add('none');
        }

    }

    /**
     * Event for uploading image
     *
     * @param event
     */
    upload(event) {

        if (!event.target.files[0]) {
            return;
        }

        let blob = new Blob([event.target.files[0]], {type: event.target.files[0].type});

        const formData = new FormData();

        formData.append('file', blob);
        formData.append('storage', this.data.get('storage'));

        let element = this.element;
        axios.post(platform.prefix('/systems/avatar'), formData)
            .then((response) => {
                let image = response.data.url;
                element.querySelector('.picture-preview').src = image;
                element.querySelector('.picture-preview').classList.remove('none');
                element.querySelector('.picture-remove').classList.remove('none');
                element.querySelector('.picture-path').value = image;
                $(element.querySelector('.modal')).modal('hide');
            });
    }

    /**
     *
     */
    clear() {
        this.element.querySelector('.picture-path').value = '';
        this.element.querySelector('.picture-preview').src = '';
        this.element.querySelector('.picture-preview').classList.add('none');
        this.element.querySelector('.picture-remove').classList.add('none');
    }

    imageToBlob(url) {
        return new Promise(function(resolve, reject) {
            try {
                var xhr = new XMLHttpRequest();
                xhr.open("GET", url);
                xhr.responseType = "blob";
                xhr.onerror = function() {reject("Network error.")};
                xhr.onload = function() {
                    if (xhr.status === 200) {resolve(xhr.response)}
                    else {reject("Loading error:" + xhr.statusText)}
                };
                xhr.send();
            }
            catch(err) {reject(err.message)}
        });
    }
}