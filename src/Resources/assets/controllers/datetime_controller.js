import { Controller } from '@hotwired/stimulus';
import {easepick, KbdPlugin, TimePlugin} from '@easepick/bundle';
import easepickStyle from '!!raw-loader!@easepick/bundle/dist/index.css'

export default class extends Controller {
    static values = {
        lang: String
    }
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
            css: easepickStyle,
            lang: this.langValue || 'de-DE',
            readonly: false,
            plugins: plugins,
            calendars: type === 'time' ? 0 : 1,
        });
    }
}
