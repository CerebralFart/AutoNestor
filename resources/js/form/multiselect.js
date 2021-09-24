import Alpine from "alpinejs";

Alpine.data('multiselect', () => ({
    names: null,
    open: false,
    options: null,
    selected: [],

    init() {
        let {options, values} = this.$root.dataset;
        this.names = JSON.parse(options);
        this.selected = JSON.parse(values).map(v => v.toString());
        this.options = Object.keys(this.names);
    },

    toggleDropdown() {
        this.open = !this.open;
    },

    toggleOption(value) {
        if (this.selected.indexOf(value) === -1) {
            this.selected = [...this.selected, value].sort();
        } else {
            this.selected = this.selected.filter(v => v !== value);
        }
    }
}));
