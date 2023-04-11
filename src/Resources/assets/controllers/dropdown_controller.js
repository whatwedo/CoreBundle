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

    toggle (event) {
        event.stopPropagation();

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

    layoutCalculate () {
        const dropdownDiv = this.menuTarget;

        // Reset
        dropdownDiv.style.position = '';
        dropdownDiv.style.top = '';
        dropdownDiv.style.left = '';

        // Calculate
        const {top, left} = dropdownDiv.getBoundingClientRect();

        // Set fixed position
        dropdownDiv.style.position = 'fixed';
        dropdownDiv.style.top = top + 'px';
        dropdownDiv.style.left = left + 'px';
    }
}
