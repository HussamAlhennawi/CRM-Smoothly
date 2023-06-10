<x-app-layout>

    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Projects') }}
            </h2>
            <a href="{{ route('projects.create') }}">
                <x-primary-button class="ml-4">
                    {{ __('Add New Project') }}
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
                                    @livewire('project.index-table')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if (session()->has('project-added'))
        <x-toaster title="Success"
                   message="Project Added !!!"
                   backgroundColor="bg-green-200" />
    @endif

    @if (session()->has('project-updated'))
        <x-toaster title="Success"
                   message="Project Updated !!!"
                   backgroundColor="bg-green-200" />
    @endif


</x-app-layout>
