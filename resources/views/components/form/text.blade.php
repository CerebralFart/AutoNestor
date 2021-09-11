<div>
    @if($attributes->has('name'))
        <x-form.label
            id="{{$attributes->get('id')}}"
            name="{{$attributes->get('name')}}"
        />
    @endif
    <div class="mt-1">
        <input
            type="{{$attributes->get('type', 'text')}}"
            name="{{$attributes->get('id')}}"
            id="{{$attributes->get('id')}}"
            class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
            value="{{$attributes->get('value', '')}}"
        />
    </div>
</div>
