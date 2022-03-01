import {Controller} from "@hotwired/stimulus";

export default class extends Controller {
    connect() {
        document
            .querySelectorAll('[data-modal-toggle="'+this.element.getAttribute('id')+'"]')
            .forEach((element, i) => {
                element.onclick = () => {
                    this.toggle();
                };
            })
        ;
    }

    toggle(show = null) {
        if (show === true) {
            this.element.classList.remove('hidden');
        } else if (show === false) {
            this.element.classList.add('hidden');
        } else {
            if (this.element.classList.contains('hidden')) {
                this.element.classList.remove('hidden');
            } else {
                this.element.classList.add('hidden');
            }
        }
    }
}
