import {Controller} from "@hotwired/stimulus";

export default class extends Controller {
    connect() {
        super.connect()
    }

    toggle (event) {
        let dropdownButton = this.element.querySelector("button");
        let dropdownDiv = this.element.querySelector('[data-whatwedo--core-bundle--dropdown-target="menu"]');

        if (dropdownDiv && dropdownDiv.classList.contains('hidden')) {
            // Hide all other dropdowns
            document
                .querySelectorAll('.whatwedo_table-actions[data-action^="whatwedo--core-bundle--dropdown#toggle"]')
                .forEach((element) => {
                    let eventDropdownDiv = element.parentNode.querySelector('[data-whatwedo--core-bundle--dropdown-target="menu"]');

                    if (element !== dropdownButton && eventDropdownDiv && !eventDropdownDiv.classList.contains("hidden"))
                        eventDropdownDiv.classList.add("hidden");
                })

            // Show currently focussed dropdown
            dropdownDiv.classList.remove('hidden');
        } else {
            dropdownDiv.classList.add('hidden');
        }
    }

    close (event) {
        super.toggle(event)
    }
}
