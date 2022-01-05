import Dropdown from "stimulus-dropdown"
import {useDispatch} from 'stimulus-use';

export default class extends Dropdown {
    static targets = ['modalBody'];
    static values = {
        formUrl: String,
    }

    connect() {
        console.log('modal-form');
        super.connect()
        useDispatch(this, {debug: true, eventPrefix: false});
    }

    async openModal() {
        super.toggle()
        this.modalBodyTarget.innerHTML = 'Loading...';
        await fetch(this.formUrlValue)
            .then(response => response.text())
            .then(data => this.modalBodyTarget.innerHTML = data);
    }

    async submitForm(event) {
        event.preventDefault();

        console.log('submitForm');


        let form = this.modalBodyTarget.getElementsByTagName("form")[0];
        var formData = new FormData(form);
        try {
            await fetch(this.formUrlValue, {
                method: form.method,
                body: formData
            })
                .then(response => {
                    if (response.status == 200) {
                        this.dispatch('success', {
                            result: response,
                        });
                        super.toggle(event)

                        console.log('close');
                        this.modalBodyTarget.innerHTML = '';

                    } else if (response.status == 422) {
                        this.dispatch('submitted:validation', {
                            result: response,
                        });
                        this.modalBodyTarget.innerHTML = response.text()
                    }
                });

        } catch (e) {
            this.modalBodyTarget.innerHTML = 'woops!!';
        }
    }

    close(event) {
        super.toggle(event);
        this.modalBodyTarget.innerHTML = '';
    }
}
