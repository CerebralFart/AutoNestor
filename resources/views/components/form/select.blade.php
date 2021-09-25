{{--- TODO field cannot be focussed using the tab key ---}}
@php
    $options = $attributes->get('options', []);
    foreach ($options as $key => $value) {
        $key = is_int($key) ? $value : $key;
        $options[$key] = $value;
    }
@endphp

<div class="flex flex-col gap-2 lg:flex-row lg:items-center">
    <x-form.label
        :id="$attributes->get('id')"
        :name="$attributes->get('name')"
    />
    <div
        class="relative flex-grow"
        x-data="select"
        data-nullable="{{$attributes->has('nullable')}}"
        data-options="{{json_encode($attributes->get('options', []))}}"
        data-value="{{$attributes->get('value', null)}}"
    >
        <input
            name="{{$attributes->get('id')}}"
            x-model="value"
            type="hidden"
        />
        <div
            role="button"
            @click="toggle"
            class="relative w-full select-none bg-white border border-gray-300 rounded-md shadow-sm pl-3 pr-10 py-2 text-left cursor-pointer focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
        >
            <div
                class="block truncate h-5"
                :class="value === null && 'italic'"
                x-text="names[value] ?? 'Niets geselecteerd'"
            ></div>
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
                <li
                    @click="() => select(key)"
                    class="group text-gray-900 cursor-default select-none relative py-2 pl-8 pr-4 cursor-pointer hover:bg-blue-600"
                >
                    <div
                        x-text="names[key]"
                        class="block truncate group-hover:text-white"
                        :class="key === value && 'font-semibold'"
                    ></div>

                    <div
                        class="text-blue-600 absolute inset-y-0 left-0 flex items-center pl-1.5 group-hover:text-white"
                        x-show="key === value"
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
