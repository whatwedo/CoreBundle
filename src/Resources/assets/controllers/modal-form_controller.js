import Dropdown from "stimulus-dropdown"
import {useDispatch} from 'stimulus-use';
import 'regenerator-runtime/runtime'

export default class extends Dropdown {
    static targets = ['modalBody'];
    static values = {
        formUrl: String,
    }

    connect() {
        super.connect()
        useDispatch(this, {debug: true, eventPrefix: false});
    }

    async openModal() {
        super.toggle()
        this.modalBodyTarget.innerHTML = 'Loading ...';
        await fetch(this.formUrlValue)
            .then(response => response.text())
            .then(data => this.setInnerHTML(this.modalBodyTarget, data));
    }

    async submitForm(event) {
        event.preventDefault();
        this.updateForms();
        let form = this.modalBodyTarget.getElementsByTagName("form")[0];
        var formData = new FormData(form);
        try {
            await fetch(this.formUrlValue, {
                method: form.method,
                body: formData
            })
                .then(async response => {
                    if (response.status == 200) {
                        this.dispatch('success', {
                            result: response,
                        });
                        super.toggle(event)
                        this.modalBodyTarget.innerHTML = '';
                    } else if (response.status == 422) {
                        this.dispatch('submitted:validation', {
                            result: response,
                        });
                        this.setInnerHTML(this.modalBodyTarget, await response.text());
                    }
                })
            ;

        } catch (e) {
            this.modalBodyTarget.innerHTML = 'woops!!';
        }
    }

    close(event) {
        const tagName = event.target.tagName.toLowerCase();
        if (tagName === 'input' || tagName === 'select' || tagName === 'textarea') {
            return;
        }
        super.toggle(event);
        this.modalBodyTarget.innerHTML = '';
    }

    updateForms() {
        if (typeof CKEDITOR !== 'undefined') {
            for (const key in CKEDITOR.instances) {
                CKEDITOR.instances[key].updateElement();
            }
        }
    }

    setInnerHTML(elm, html) {
        elm.innerHTML = html;
        Array.from(elm.querySelectorAll("script"))
            .forEach( oldScriptEl => {
                    const newScriptEl = document.createElement("script");
                    Array.from(oldScriptEl.attributes).forEach( attr => {
                        newScriptEl.setAttribute(attr.name, attr.value)
                    });
                    const scriptText = document.createTextNode(oldScriptEl.innerHTML);
                    newScriptEl.appendChild(scriptText);
                    oldScriptEl.parentNode.replaceChild(newScriptEl, oldScriptEl);
                }
            );
    }
}
