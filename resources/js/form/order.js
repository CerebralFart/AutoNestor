import Alpine from "alpinejs";

Alpine.data("order", () => ({
    //TODO track state to input component
    dragging: null,
    nodes: {},
    order: [],

    get sorted() {
        return this.order.map(k => this.nodes[k]);
    },

    init() {
        const data = JSON.parse(this.$root.dataset.items);

        for (const node of data) {
            const key = node.id;
            if (key in this.nodes)
                throw new Error(`All elements in an x-data="order" input should have a unique key, but multiple entries exist for [${key}]`);

            this.nodes[key] = node;
            this.order.push(key);
        }
    },

    startDrag(node) {
        this.dragging = node.id;
    },
    dragOver(evt) {
        evt.preventDefault();
    },
    stopDrag(node) {
        this.moveTo(this.dragging, this.order.indexOf(node.id));
        this.dragging = null;
    },

    moveUp(node) {
        const idx = this.order.indexOf(node.id);
        if (idx < 0) return;
        this.moveTo(node.id, idx - 1);
    },
    moveDown(node) {
        const idx = this.order.indexOf(node.id);
        if (idx >= this.nodes.length) return;
        this.moveTo(node.id, idx + 1);
    },

    moveTo(subject, idx) {
        this.order = this.order
            .filter(id => id !== subject);
        this.order.splice(idx, 0, subject);
    },
}));
