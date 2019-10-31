import { Controller } from 'stimulus';

export default class extends Controller {


    /**
     * Connect Form
     */
    connect() {

        /**
         * Added focus button for Mac OS firefox/safari
         */
        document.querySelectorAll('button[type=submit]').forEach((button) => {
            button.addEventListener('click', (event) => {
                event.target.focus();
            });
        });
    }


    /**
     *
     */
    submitByForm(event) {
        const formId = this.data.get('id');
        const formElem = document.getElementById(formId);
        formElem.submit();

        event.preventDefault();
        return false;
    }

    /**
     *
     */
    submit(event) {
        if (!this.validateForm(event)) {
            event.preventDefault();
            return false;
        }

        this.animateButton();
        event.preventDefault();

        const formAction = this.element.getAttribute('action');
        const activeElementAction = document.activeElement.getAttribute('formaction');
        const action = activeElementAction || formAction;

        setTimeout(() => {
            const form = new FormData(event.target);

            axios.post(action, form, {
                headers: {
                    'X-Requested-With': null,
                    Accept: 'text/html,application/xhtml+xml,application/xml',
                },
            })
                .then((response) => {
                    const url = response.request.responseURL;
                    window.Turbolinks.controller.cache.put(
                        url,
                        Turbolinks.Snapshot.wrap(response.data),
                    );
                    window.Turbolinks.visit(url, { action: 'restore' });
                })
                .catch((error) => {
                    if (error.response) {
                        window.history.pushState({ html: error.response.data }, '', error.request.responseURL);
                        document.documentElement.innerHTML = error.response.data;
                    } else {
                        // eslint-disable-next-line no-console
                        console.error(`Malformed error ${error}`);
                    }
                });
        });

        return false;
    }

    /**
     *
     */
    animateButton() {
        const button = this.data.get('button-animate');
        const text = this.data.get('button-text');

        if (button) {
            const buttonElement = document.querySelector(button);
            buttonElement.disabled = true;
            buttonElement.innerHTML = '<span class="spinner-border spinner-border-sm mb-1" role="status" aria-hidden="true"></span>'
                + `<span class="pl-1">${text || ''}</span>`;
        }
    }

    /**
     *
     * @returns {*}
     */
    validateForm(event) {

        const message = this.data.get('validation');

        if (!event.target.checkValidity()) {
            window.platform.alert(message);

            return false;
        }

        return true;
    }
}
