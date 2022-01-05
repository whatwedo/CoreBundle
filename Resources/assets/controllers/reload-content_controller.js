import { Controller } from '@hotwired/stimulus';
import { useDispatch } from 'stimulus-use'

export default class extends Controller {
    static targets = ['content'];
    static values = {
        url: String,
    }

    connect() {
        console.log('reload-content');
        useDispatch(this)
    }

    async refreshContent(event) {
        console.log('refreshContentex');
        const target = this.hasContentTarget ? this.contentTarget : this.element;

        target.style.opacity = .5;

        let url = this.urlValue;

        if (event.currentTarget.dataset && event.currentTarget.dataset.reloadContentUrlParam) {
            url = event.currentTarget.dataset.reloadContentUrlParam;
        }

        const response = await fetch(url);
        target.innerHTML = await response.text();
        target.style.opacity = 1;
    }
}
