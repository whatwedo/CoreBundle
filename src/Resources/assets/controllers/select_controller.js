import { Controller } from '@hotwired/stimulus';
import TomSelect from 'tom-select';
import 'tom-select/dist/css/tom-select.css';


export default class extends Controller {
    static values = {
        url: String,
        required: Boolean
    }

    _url = null;
    tomSelect = null;

    setUrlValue(value) {
        this._url = value;
        this.tomSelect.destroy();
        this.innerConnect();
    }

    connect() {
        this._url = this.urlValue;
        this.innerConnect();
    }

    innerConnect() {
        const settings = {
            maxOptions: 10000,
            preload: true
        };
        if (this.requiredValue === false) {
            settings.allowEmptyOption = true;
        }
        if (this._url !== '') {
            settings.sortField = {
                field: "text",
                direction: "asc"
            };
            settings.valueField = 'id';
            settings.searchField = 'label';
            settings.labelField = 'label';
            const that = this;
            settings.load = function (query, callback) {
                const url = that._url + (that._url.includes('?') ? '&' : '?') + 'q=' + encodeURIComponent(query);
                fetch(url)
                    .then(response => response.json())
                    .then(json => {
                        callback(json.items);
                    }).catch(()=>{
                    callback();
                });
            }
        }
        this.tomSelect = new TomSelect(this.element, settings);
    }
}
