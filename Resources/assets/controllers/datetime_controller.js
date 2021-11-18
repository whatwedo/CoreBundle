import { Controller } from 'stimulus';
import flatpickr from "flatpickr";
require("flatpickr/dist/flatpickr.css");

export default class extends Controller {
    connect() {
        const type = this.element.getAttribute('type');

        flatpickr(this.element, {
            enableTime: type === 'time' || type === 'datetime-local',
            noCalendar: type === 'time',
        });
    }
}
