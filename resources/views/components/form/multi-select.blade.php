{{-- TODO field cannot be focussed using the tab key --}}
{{-- TODO this only works with associative arrays currently --}}
<div>
    <x-form.label
        :id="$attributes->get('id')"
        :name="$attributes->get('name')"
    />

    <div
        class="mt-1 relative"
        x-data="multiselect"
        data-options="{{json_encode($attributes->get('options', []))}}"
        data-values="{{json_encode($attributes->get('values', []))}}"
    >
        <template x-for="value in selected">
            <input
                x-model="value"
                name="{{$attributes->get('id')}}[]"
                type="hidden"
            />
        </template>
        <template x-if="selected.length === 0">
            <input
                name="{{$attributes->get('id')}}"
                value=""
                type="hidden"
            />
        </template>

        <div
            role="button"
            @click="toggleDropdown"
            class="relative w-full select-none bg-white border border-gray-300 rounded-md shadow-sm pl-3 pr-10 py-2 text-left cursor-pointer focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
        >
            <div
                class="block truncate h-5"
                x-show="selected.length > 0"
                x-text="selected.map(k => names[k] ?? null).join(', ')"
            ></div>
            <div
                class="block truncate h-5 italic"
                x-show="selected.length === 0"
            >
                Niets geselecteerd
            </div>
            <div class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none">
                <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd"/>
                </svg>
            </div>
        </div>

        <ul
            x-show="open"
            class="absolute z-10 mt-1 w-full select-none bg-white shadow-lg max-h-60 rounded-md py-1 text-base ring-1 ring-black ring-opacity-5 overflow-auto focus:outline-none sm:text-sm"
            x-transition:leave="transition ease-in duration-100"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
        >
            <template x-for="key in options">
                <li class="group text-gray-900 cursor-default select-none relative py-2 pl-8 pr-4 cursor-pointer hover:bg-blue-600" @click="()=>toggleOption(key)">
                    <div
                        x-text="names[key]"
                        class="block truncate group-hover:text-white"
                        :class="selected.indexOf(key) > -1 && 'font-bold'"
                    ></div>

                    <div
                        x-show="selected.indexOf(key) > -1"
                        class="text-blue-600 absolute inset-y-0 left-0 flex items-center pl-1.5 group-hover:text-white"
                    >
                        <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                </li>
            </template>
        </ul>
    </div>
</div>
