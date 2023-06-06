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
                                            <th scope="col" class="px-6 py-4">Actions</th>
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
                                                <td class="whitespace-nowrap px-6 py-4">
                                                    <a href="{{ route('clients.edit', $client->id) }}">
                                                        <x-primary-button>
                                                            {{ __('Edit') }}
                                                        </x-primary-button>
                                                    </a>
                                                    <x-primary-button data-te-toggle="modal"
                                                                      data-te-target="#confirmDeleteModal"
                                                                      data-te-ripple-init>
                                                        {{ __('Delete') }}
                                                    </x-primary-button>

                                                    {{--confirm Delete Modal--}}
                                                    <div
                                                        data-te-modal-init
                                                        class="fixed left-0 top-0 z-[1055] hidden h-full w-full overflow-y-auto overflow-x-hidden outline-none"
                                                        id="confirmDeleteModal"
                                                        tabindex="-1"
                                                        aria-labelledby="confirmDeleteModalTitle"
                                                        aria-modal="true"
                                                        role="dialog">
                                                        <div
                                                            data-te-modal-dialog-ref
                                                            class="pointer-events-none relative flex min-h-[calc(100%-1rem)] w-auto translate-y-[-50px] items-center opacity-0 transition-all duration-300 ease-in-out min-[576px]:mx-auto min-[576px]:mt-7 min-[576px]:min-h-[calc(100%-3.5rem)] min-[576px]:max-w-[500px]">
                                                            <div
                                                                class="pointer-events-auto relative flex w-full flex-col rounded-md border-none bg-white bg-clip-padding text-current shadow-lg outline-none dark:bg-neutral-600">
                                                                <div
                                                                    class="flex flex-shrink-0 items-center justify-between rounded-t-md border-b-2 border-neutral-100 border-opacity-100 p-4 dark:border-opacity-50">
                                                                    <!--Modal title-->
                                                                    <h5
                                                                        class="text-xl font-medium leading-normal text-neutral-800 dark:text-neutral-200"
                                                                        id="exampleModalScrollableLabel">
                                                                        Confirm Delete
                                                                    </h5>
                                                                    <!--Close button-->
                                                                    <button
                                                                        type="button"
                                                                        class="box-content rounded-none border-none hover:no-underline hover:opacity-75 focus:opacity-100 focus:shadow-none focus:outline-none"
                                                                        data-te-modal-dismiss
                                                                        aria-label="Close">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6">
                                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                                                                        </svg>
                                                                    </button>
                                                                </div>

                                                                <!--Modal body-->
                                                                <div class="relative p-4">
                                                                    <p>Are you sure you want delete this client?</p>
                                                                </div>

                                                                <!--Modal footer-->
                                                                <div
                                                                    class="flex flex-shrink-0 flex-wrap items-center justify-end rounded-b-md border-t-2 border-neutral-100 border-opacity-100 p-4 dark:border-opacity-50">
                                                                    <x-primary-button type="button"
                                                                                      data-te-modal-dismiss
                                                                                      data-te-ripple-init>
                                                                        {{ __('Close') }}
                                                                    </x-primary-button>

                                                                    <form method="POST" action="{{ route('clients.destroy', $client->id) }}">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <x-primary-button type="submit" class="ml-4"
                                                                                          data-te-ripple-init>
                                                                            {{ __('Delete') }}
                                                                        </x-primary-button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{--End of confirm Delete Modal--}}

                                                </td>
                                            </tr>
                                        @empty
                                            <tr class="border-b dark:border-neutral-500">
                                                <td class="whitespace-nowrap px-6 py-4 font-medium text-center font-bold"
                                                    colspan="6">No Clients Found.
                                                </td>
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
