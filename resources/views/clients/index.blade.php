<x-app-layout>

    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Clients') }}
            </h2>
            <a href="{{ route('clients.create') }}">
                <x-primary-button class="ml-4">
                    {{ __('Add New Client') }}
                </x-primary-button>
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex flex-col">
                        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                                <div class="overflow-hidden">
                                    <table class="min-w-full text-left text-sm font-light">
                                        <thead class="border-b font-medium dark:border-neutral-500">
                                        <tr>
                                            <th scope="col" class="px-6 py-4">#</th>
                                            <th scope="col" class="px-6 py-4">Name</th>
                                            <th scope="col" class="px-6 py-4">Email</th>
                                            <th scope="col" class="px-6 py-4">Mobile</th>
                                            <th scope="col" class="px-6 py-4">Address</th>
                                            <th scope="col" class="px-6 py-4">Created Date</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @forelse($clients as $client)
                                            <tr class="border-b dark:border-neutral-500">
                                                <td class="whitespace-nowrap px-6 py-4 font-medium">{{ $loop->iteration }}</td>
                                                <td class="whitespace-nowrap px-6 py-4">{{ $client->name }}</td>
                                                <td class="whitespace-nowrap px-6 py-4">{{ $client->email }}</td>
                                                <td class="whitespace-nowrap px-6 py-4">{{ $client->mobile }}</td>
                                                <td class="whitespace-nowrap px-6 py-4">{{ $client->address }}</td>
                                                <td class="whitespace-nowrap px-6 py-4">{{ $client->created_at->format('d-M-Y') }}</td>
                                            </tr>
                                        @empty
                                            <tr class="border-b dark:border-neutral-500">
                                                <td class="whitespace-nowrap px-6 py-4 font-medium text-center font-bold" colspan="6">No Clients Found.</td>
                                            </tr>
                                        @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
