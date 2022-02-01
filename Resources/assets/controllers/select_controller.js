import { Controller } from '@hotwired/stimulus';
import TomSelect from 'tom-select';
import 'tom-select/dist/css/tom-select.css';


export default class extends Controller {
    static values = {
        url: String,
        required: Boolean
    }
    connect() {
        const urlValue = this.urlValue;
        const settings = {
            plugins: [],
            persist: false,
        };
        if (this.requiredValue === false) {
            settings.allowEmptyOption = true;
            settings.plugins.push('clear_button');
            settings.placeholder = '---';
        }
        if (urlValue !== '') {
            settings.sortField = {
                field: "text",
                direction: "asc"
            };
            settings.valueField = 'id';
            settings.searchField = 'label';
            settings.labelField = 'label';
            settings.load = function (query, callback) {
                const url = urlValue + '?q=' + encodeURIComponent(query);
                fetch(url)
                    .then(response => response.json())
                    .then(json => {
                        callback(json.items);
                    }).catch(()=>{
                    callback();
                });
            }
        }
        new TomSelect(this.element, settings);
    }
}
