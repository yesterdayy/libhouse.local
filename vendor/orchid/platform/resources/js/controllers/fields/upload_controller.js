import {Controller} from "stimulus";
import Dropzone from 'dropzone';
import Sortable from 'sortablejs';

export default class extends Controller {

    /**
     *
     * @type {string[]}
     */
    static targets = [
        "search",
        "name",
        "original",
        "alt",
        "description",
        "url",
    ];

    /**
     *
     * @param props
     */
    constructor(props) {
        super(props);
        this.attachments = {};
        this.mediaList = {};
    }

    /**
     *
     * @returns {string}
     */
    get dropname() {
        return '#' + this.data.get('id');
    }

    /**
     *
     * @returns {string|{id: *}}
     */
    get activeAttachment() {
        return {
            'id': this.activeAchivmentId,
            'name': this[this.getAttachmentTargetKey('name')].value || '',
            'alt': this[this.getAttachmentTargetKey('alt')].value || '',
            'description': this[this.getAttachmentTargetKey('description')].value || '',
            'original_name': this[this.getAttachmentTargetKey('original')].value || '',
        };
    }

    /**
     *
     * @param data
     */
    set activeAttachment(data) {
        this.activeAchivmentId = data.id;

        this[this.getAttachmentTargetKey('name')].value = data.name || '';
        this[this.getAttachmentTargetKey('original')].value = data.original_name || '';
        this[this.getAttachmentTargetKey('alt')].value = data.alt || '';
        this[this.getAttachmentTargetKey('description')].value = data.description || '';

        this.data.set('url', data.url);

    }

    /**
     *
     */
    openLink() {
        event.preventDefault();
        window.open(this.data.get('url'));
    }

    /**
     *
     */
    connect() {
        this.initDropZone();
        this.initSortable();
    }

    /**
     *
     */
    save() {
        const attach = this.activeAttachment;
        $(`${this.dropname} .modal`).modal('toggle');

        const name = attach.name + attach.id;

        if (this.attachments.hasOwnProperty(name)) {
            this.attachments[name].name = attach.name;
            this.attachments[name].alt = attach.alt;
            this.attachments[name].description = attach.description;
            this.attachments[name].original_name = attach.original_name;
        }

        axios
            .put(platform.prefix(`/systems/files/post/${attach.id}`), attach)
            .then();
    }

    /**
     *
     * @param dataKey
     * @returns {string}
     */
    getAttachmentTargetKey(dataKey) {
        return `${dataKey}Target`
    }

    /**
     *
     * @param data
     */
    loadInfo(data) {
        const name = data.name + data.id;

        if (!this.attachments.hasOwnProperty(name)) {
            this.attachments[name] = data;
        }
        this.activeAttachment = data
    }

    /**
     *
     */
    resortElement() {
        const items = {};
        $('.file-sort').each((index, value) => {
            const id = $(value).attr('data-file-id');
            items[id] = index;
        });

        axios
            .post(platform.prefix('/systems/files/sort'), {
                files: items,
            })
            .then();
    }

    /**
     *
     */
    initSortable() {
        new Sortable(document.querySelector(this.dropname + ' .sortable-dropzone'), {
            animation: 150,
            onChange: this.resortElement,
        });
    }

    /**
     *
     * @param dropname
     * @param name
     * @param file
     */
    addSortDataAtributes(dropname, name, file) {
        $(`${dropname} .dz-complete:last-child`)
            .attr('data-file-id', file.id)
            .addClass('file-sort');
        $(
            `<input type='hidden' class='files-${file.id}' name='${name}[]' value='${file.id}'  />`
        ).appendTo(dropname);

        this.resortElement();
    }

    /**
     *
     */
    initDropZone() {
        const self = this;
        const data = this.data.get('data') && JSON.parse(this.data.get('data'));
        const storage = this.data.get('storage');
        const name = this.data.get('name');
        const loadInfo = this.loadInfo.bind(this);
        const dropname = this.dropname;
        const groups = this.data.get('groups');

        this.dropZone = new Dropzone(dropname, {
            url: platform.prefix('/systems/files'),
            method: 'post',
            uploadMultiple: this.data.get('multiple'),
            parallelUploads: this.data.get('parallel-uploads'),
            maxFilesize: this.data.get('max-file-size'),
            maxFiles: this.data.get('max-files'),
            acceptedFiles: this.data.get('accepted-files'),
            resizeQuality: this.data.get('resize-quality'),
            resizeWidth: this.data.get('resize-width'),
            resizeHeight: this.data.get('resize-height'),
            paramName: 'files',

            previewsContainer: `${dropname} .visual-dropzone`,
            addRemoveLinks: false,
            dictFileTooBig: 'File is big',
            autoDiscover: false,

            init() {
                this.on('addedfile', (e) => {

                    const removeButton = Dropzone.createElement('<a href="javascript:;" class="btn-remove">&times;</a>');
                    const editButton = Dropzone.createElement('<a href="javascript:;" class="btn-edit"><i class="icon-note" aria-hidden="true"></i></a>');

                    removeButton.addEventListener('click', (event) => {
                        event.preventDefault();
                        event.stopPropagation();
                        this.removeFile(e);
                    });

                    editButton.addEventListener('click', () => {
                        loadInfo(e.data);
                        $(`${dropname} .attachment.modal`).modal('show');
                    });

                    e.previewElement.appendChild(removeButton);
                    e.previewElement.appendChild(editButton);


                    if(e.data !== undefined) {
                        self.addSortDataAtributes(dropname, name, e.data);
                    }
                });

                this.on('completemultiple', () => {
                    //  $(`${dropname}.sortable-dropzone`).sortable('enable');
                });

                const images = data;

                if (images) {
                    Object.values(images).forEach((item) => {

                        const file = {
                            id: item.id,
                            name: item.original_name,
                            size: item.size,
                            type: item.mime,
                            status: Dropzone.ADDED,
                            url: `${item.url}`,
                            data: item,
                        };

                        this.emit('addedfile', file);
                        this.emit('thumbnail', file, file.url);
                        this.emit('complete', file);
                        this.files.push(file);


                        self.addSortDataAtributes(dropname, name, item);
                    });
                }

                $(`${dropname} .dz-progress`).remove();

                this.on('sending', (file, xhr, formData) => {
                    formData.append('_token', $('meta[name=\'csrf_token\']').attr('content'));
                    formData.append('storage', storage);
                    formData.append('group', groups);
                });

                this.on('removedfile', file => {
                    $(`${dropname} .files-${file.data.id}`).remove();
                    axios
                        .delete(platform.prefix(`/systems/files/${file.data.id}`), {
                            storage: $('#post-attachment-dropzone').data('storage'),
                        })
                        .then();
                });
            },
            error(file, response) {

                if ($.type(response) === 'string') {
                    return response; // dropzone sends it's own error messages in string
                }
                return response.message;
            },

            success(file, response) {

                if(!Array.isArray(response)) {
                    response = [response];
                }

                response.forEach((item) => {
                    if(file.name === item.original_name){
                        file.data = item;
                        return false;
                    }
                });

                self.addSortDataAtributes(dropname, name, file.data);
            },
        });
    }

    /**
     *
     */
    openMedia() {
        $(`${this.dropname} .media-loader`).show();
        $(`${this.dropname} .media-results`).hide();

        this.loadMedia();
    }

    /**
     *
     */
    loadMedia() {
        axios
            .post(platform.prefix('/systems/media'), {
                filter: {
                    disk: this.data.get('storage'),
                    original_name: this.searchTarget.value,
                },
            })
            .then((response)=>{
                this.mediaList = response.data;
                $(`${this.dropname} .media.modal`).modal('show');
                this.renderMedia();
            });
    }

    /**
     *
     */
    renderMedia() {
        let html = '';

        /** todo: */
        this.mediaList.forEach((element,key) => {
            html += '<div class="col-4 col-sm-3 col-md-2 mb-4">\n' +
                '    <div data-action="click->fields--upload#addFile" data-key="'+key+'">\n' +
                '        <img src="'+element.url+'"\n' +
                '             alt="sample"\n' +
                '             class="rounded mw-100"\n' +
                '             style="height: 50px;width: 100%;object-fit: cover;">\n' +
                '        <p class="text-ellipsis small text-muted mt-1 mb-0" title="'+element.original_name+'">'+element.original_name+'</p>\n' +
                '    </div>\n' +
                '</div>';
        });

        $(`${this.dropname} .media-results`).html(html);
        $(`${this.dropname} .media-loader`).hide();
        $(`${this.dropname} .media-results`).show();
    }

    /**
     *
     */
    addFile(event){
        const key = event.currentTarget.dataset.key;
        const file = this.mediaList[key];

        this.addedExistFile(file);
    }

    /**
     *
     * @param attachment
     */
    addedExistFile(attachment){

        /** todo: Дублируется дважды */
        const file = {
            id: attachment.id,
            name: attachment.original_name,
            size: attachment.size,
            type: attachment.mime,
            status: Dropzone.ADDED,
            url: `${attachment.url}`,
            data: attachment,
        };

        this.dropZone.emit('addedfile', file);
        this.dropZone.emit('thumbnail', file, file.url);
        this.dropZone.emit('complete', file);
        this.dropZone.files.push(file);
    }
}
