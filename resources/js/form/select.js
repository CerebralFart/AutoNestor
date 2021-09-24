import Alpine from "alpinejs";

Alpine.data('select', () => ({
    names: null,
    open: false,
    options: null,
    value: null,

    init() {
        let {options, value} = this.$root.dataset;
        this.names = JSON.parse(options);
        this.options = Object.keys(this.names);
        this.value = value;
    },

    toggle() {
        this.open = !this.open;
    },

    select(value) {
        this.value = value;
        this.open = false;
    }
}));
