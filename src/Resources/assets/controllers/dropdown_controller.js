import {Controller} from "@hotwired/stimulus";
import { useClickOutside } from 'stimulus-use'

export default class extends Controller {
    static targets = ['menu']

    connect() {
        super.connect();
        useClickOutside(this);
    }

    clickOutside (event) {
        this.close();
    }

    toggle () {
        const dropdownDiv = this.menuTarget;
        if (this.hasMenuTarget && dropdownDiv.classList.contains('hidden')) {
            dropdownDiv.classList.remove('hidden');
        } else {
            dropdownDiv.classList.add('hidden');
        }
    }

    close () {
        const dropdownDiv = this.menuTarget;
        if (this.hasMenuTarget && !dropdownDiv.classList.contains('hidden')) {
            dropdownDiv.classList.add('hidden');
        }
    }
}
