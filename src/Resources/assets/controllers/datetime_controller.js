import { Controller } from '@hotwired/stimulus';
import flatpickr from "flatpickr";
import { German } from "flatpickr/dist/l10n/de.js"
require("flatpickr/dist/flatpickr.css");

export default class extends Controller {
    connect() {
        const type = this.element.getAttribute('type');

        flatpickr(this.element, {
            'enableTime': type === 'time' || type === 'datetime-local',
            'noCalendar': type === 'time',
            'locale': German
        });
    }
}
