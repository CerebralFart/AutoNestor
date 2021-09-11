<div>
    @if($attributes->has('name'))
        <x-form.label
            id="{{$attributes->get('id')}}"
            name="{{$attributes->get('name')}}"
        />
    @endif
    <div class="mt-1">
        <textarea
            id="{{$attributes->get('id')}}"
            name="{{$attributes->get('id')}}"
            class="shadow-sm block w-full focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border border-gray-300 rounded-md"
        ></textarea>
    </div>
</div>
