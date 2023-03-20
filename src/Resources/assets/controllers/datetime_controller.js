import { Controller } from '@hotwired/stimulus';
import {easepick, KbdPlugin, TimePlugin} from '@easepick/bundle';

export default class extends Controller {
    connect() {
        if (this.element.tagName !== 'INPUT') {
            return;
        }
        const type = this.element.getAttribute('type');
        const enableTime = type === 'time' || type === 'datetime-local';
        let plugins = [KbdPlugin];

        if(enableTime) {
            plugins.push(TimePlugin);
        }

        const picker = new easepick.create({
            element: this.element,
            css: [
                'https://cdn.jsdelivr.net/npm/@easepick/bundle@1.2.1/dist/index.css',
            ],
            lang: 'de-DE',
            readonly: false,
            plugins: plugins,
            calendars: type === 'time' ? 0 : 1,
        });
    }
}
