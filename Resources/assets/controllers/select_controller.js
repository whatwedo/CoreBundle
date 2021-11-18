import { Controller } from 'stimulus';
import TomSelect from 'tom-select';
import 'tom-select/dist/css/tom-select.css';

export default class extends Controller {
    connect() {
        new TomSelect(this.element,{
            plugins: [],
            persist: false,
            createOnBlur: true,
            create: true,
            sortField: {
                field: "text",
                direction: "asc"
            }
        });
    }
}
