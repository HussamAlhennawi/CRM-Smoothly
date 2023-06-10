<div>

{{--  Search  --}}
    <div class="mb-3 pe-2 flex justify-end">
        <div class="relative mb-4 flex w-80 flex-wrap items-stretch justify-end">
            <input
                wire:model="search"
                type="search"
                class="relative m-0 -mr-0.5 block w-[1px] min-w-0 flex-auto rounded-l border border-solid border-neutral-300 bg-transparent bg-clip-padding px-3 py-[0.25rem] text-base font-normal leading-[1.6] text-neutral-700 outline-none transition duration-200 ease-in-out"
                placeholder="Search projects by title"
                aria-label="Search"
                aria-describedby="button-addon1" />

            <!--Search button-->
            <button
                class="relative z-[2] flex items-center rounded-r bg-gray-800 px-6 py-2.5 text-xs font-medium uppercase leading-tight text-white shadow-md transition duration-150 ease-in-out hover:bg-primary-700 hover:shadow-lg focus:bg-primary-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-primary-800 active:shadow-lg"
                type="button"
                id="button-addon1"
                data-te-ripple-init
                data-te-ripple-color="light">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 20 20"
                    fill="currentColor"
                    class="h-5 w-5">
                    <path
                        fill-rule="evenodd"
                        d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z"
                        clip-rule="evenodd" />
                </svg>
            </button>
        </div>
    </div>
    {{--  End of Search  --}}
    <table class="min-w-full text-left text-sm font-light">
        <thead class="border-b font-medium dark:border-neutral-500">
        <tr>
            <th scope="col" class="px-6 py-4">#</th>
            <th scope="col" class="px-6 py-4">Title</th>
            <th scope="col" class="px-6 py-4">Status</th>
            <th scope="col" class="px-6 py-4">Client</th>
            <th scope="col" class="px-6 py-4">Deadline</th>
            <th scope="col" class="px-6 py-4">Actions</th>
        </tr>
        </thead>
        <tbody>
        @forelse($projects as $project)
            <tr class="border-b dark:border-neutral-500">
                <td class="whitespace-nowrap px-6 py-4 font-medium">{{ $loop->iteration }}</td>
                <td class="whitespace-nowrap px-6 py-4">{{ $project->title }}</td>
                <td class="whitespace-nowrap px-6 py-4">
                    <span class="border p-1 rounded  text-white text-sm
                        @switch($project->status)
                            @case(1)
                                bg-green-300
                            @break

                            @case(2)
                                bg-yellow-300
                            @break

                            @case(3)
                                bg-rose-500
                            @break

                            @default
                                bg-green-300
                        @endswitch
                    ">
                    {{ array_search ($project->status, \App\Models\Project::STATUS) }}
                    </span>
                </td>
                <td class="whitespace-nowrap px-6 py-4">{{ $project->client->name }}</td>
                <td class="whitespace-nowrap px-6 py-4">{{ $project->deadline_at }}</td>
                <td class="whitespace-nowrap px-6 py-4">
                    <a href="{{ route('projects.edit', $project->id) }}">
                        <x-primary-button>
                            {{ __('Edit') }}
                        </x-primary-button>
                    </a>
                    <x-primary-button data-te-toggle="modal"
                                      data-te-target="#confirmDeleteModal{{$project->id}}"
                                      data-te-ripple-init>
                        {{ __('Delete') }}
                    </x-primary-button>

                    {{--confirm Delete Modal--}}
                    <div
                        data-te-modal-init
                        class="fixed left-0 top-0 z-[1055] hidden h-full w-full overflow-y-auto overflow-x-hidden outline-none"
                        id="confirmDeleteModal{{$project->id}}"
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
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                             stroke-width="1.5" stroke="currentColor" class="h-6 w-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M6 18L18 6M6 6l12 12"/>
                                        </svg>
                                    </button>
                                </div>

                                <!--Modal body-->
                                <div class="relative p-4">
                                    <p>Are you sure you want to delete this project?</p>
                                </div>

                                <!--Modal footer-->
                                <div
                                    class="flex flex-shrink-0 flex-wrap items-center justify-end rounded-b-md border-t-2 border-neutral-100 border-opacity-100 p-4 dark:border-opacity-50">
                                    <x-primary-button type="button"
                                                      data-te-modal-dismiss
                                                      data-te-ripple-init>
                                        {{ __('Close') }}
                                    </x-primary-button>

                                    <form wire:submit.prevent="destroy({{$project->id}})">
                                        @csrf
                                        <x-primary-button type="submit" class="ml-4"
                                                          data-te-modal-dismiss
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
                    colspan="6">No Projects Found.
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>
    <br>
    {{ $projects->links() }}
</div>
