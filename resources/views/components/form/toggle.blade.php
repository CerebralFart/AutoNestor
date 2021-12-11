<div
    class="my-2 flex flex-col gap-2 sm:flex-row sm:justify-between"
    x-data="toggle"
    data-active="{{$attributes->get('value') ? 'yes' : 'no'}}"
>
    <x-form.label
        :id="$attributes->get('id')"
        :name="$attributes->get('name')"
    />
    <button
        type="button"
        @click="toggle"
        class="relative inline-flex flex-shrink-0 h-6 w-11 border-2 border-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200"
        :class="active ? 'bg-green-300' : 'bg-gray-200'"
    >
        <span
            class="pointer-events-none inline-block h-5 w-5 rounded-full bg-white shadow transform ring-0 transition ease-in-out duration-200"
            :class="active ? 'translate-x-0' : 'translate-x-5'"
        ></span>
    </button>
    <input
        type="hidden"
        name="{{$attributes->get('id')}}"
        :value="active ? 'yes' : 'no'"
    />
</div>
