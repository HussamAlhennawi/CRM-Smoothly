<div>
{{--    <form method="POST" action="{{ route('projects.store') }}">--}}
    <form wire:submit.prevent="store">
        @csrf
        <!-- Title -->
        <div>
            <x-input-label for="title" :value="__('Title')" />
            <x-text-input wire:model="title" id="title" class="block mt-1 w-full" type="text" name="title" autofocus/>
            <x-input-error :messages="$errors->get('title')" class="mt-2" />
        </div>

        <!-- Description -->
        <div class="mt-4">
            <x-input-label for="address" :value="__('Description')" />
            <textarea class="block mt-1 mb-4 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                      wire:model="description" id="description" name="description" rows="5"></textarea>
            <x-input-error :messages="$errors->get('description')" class="mt-2" />
        </div>

        <!-- Deadline Date -->
        <div>
            <x-input-label for="deadline_at" :value="__('Deadline Date')" />
            <x-text-input wire:model="deadline_at" id="title" class="block mt-1 w-full" type="date" name="deadline_at"/>
            <x-input-error :messages="$errors->get('deadline_at')" class="mt-2" />
        </div>


        <!-- Client -->
        <div class="mt-4">
            <label for="client" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Client</label>
            <select wire:model="client" id="client" name="client"
                    data-te-select-init
                    data-te-select-placeholder="Select a client">
                <option hidden selected></option>
                @foreach($clients as $client)
                    <option value="{{ $client->id }}">{{ $client->name }}</option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('client')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ml-4">
                {{ __('Store') }}
            </x-primary-button>
        </div>

    </form>
</div>
