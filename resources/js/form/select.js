import Alpine from "alpinejs";

Alpine.data('select', () => ({
    names: null,
    nullable: false,
    open: false,
    options: null,
    value: null,

    init() {
        let {options, nullable, value} = this.$root.dataset;
        this.nullable = !!nullable;
        this.names = JSON.parse(options);
        this.options = Object.keys(this.names);
        this.value = value;
    },

    toggle() {
        this.open = !this.open;
    },

    select(value) {
        if (this.nullable && this.value === value) {
            this.value = null
        } else {
            this.value = value;
        }
        this.open = false;
    }
}));
