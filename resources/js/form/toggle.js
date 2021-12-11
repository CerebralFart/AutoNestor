import Alpine from "alpinejs";

Alpine.data("toggle", () => ({
    active: false,

    init() {
        this.active = this.$root.dataset.active === "yes";
    },

    toggle() {
        this.active = !this.active;
    },
}));
