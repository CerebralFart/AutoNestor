// TODO add animations when opening / closing
window.addEventListener('load', () => {
    document.querySelectorAll("[data-input-type='select']").forEach(select => {
        const button = select.querySelector("[role='button']")
        const text = button.querySelector("div:first-child");
        const value = select.querySelector('input');
        const list = select.querySelector("ul");
        const items = select.querySelectorAll("li");

        button.addEventListener('click', () => list.classList.toggle("hidden"));
        items.forEach(item => item.addEventListener("click", () => {
            value.value = item.dataset.value;
            text.innerText = item.dataset.value;
            items.forEach(innerItem => {
                innerItem.querySelector("div:first-child").classList.toggle("font-semibold", innerItem === item)
                innerItem.querySelector("div:last-child").classList.toggle("hidden", innerItem !== item);
            })
            list.classList.add("hidden");
        }))
    })
})
