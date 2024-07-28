<div x-data="{ open: true, search: '' }">
    <div class="mb-5">
        <label for="description" class="block mb-2 text-sm font-medium ">Description</label>
        <input type="text" id="description" name="description" x-model="search" autocomplete="off"
            @input.debounce="open = true; $wire.updateSearch($event.target.value); "
            class="shadow-sm bg-gray-50 border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
            required />
    </div>

    <div x-show = 'open'>
        @foreach ($descriptions as $description)
            <div class="items-center justify-between px-4 py-3 mb-2 text-gray-500 bg-white rounded-lg cursor-pointer"
                @click="open = false; search = '{{ $description->description }}'">
                {{-- {{dd($description)}} --}}
                <p class="cursor-pointer">{{ $description->description }}</p>
            </div>
        @endforeach
    </div>

</div>
