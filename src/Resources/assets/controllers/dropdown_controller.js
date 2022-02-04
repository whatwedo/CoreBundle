import Dropdown from "stimulus-dropdown"

export default class extends Dropdown {
    connect() {
        super.connect()
    }

    toggle (event) {
        super.toggle()
    }

    close (event) {
        super.toggle(event)
    }
}
