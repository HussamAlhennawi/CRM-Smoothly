@props([
    'title' => config('app.name', 'CRM-Smoothly'),
    'message' => 'Successful',
    'backgroundColor' => 'bg-green-200'
    ])

<div
    class="fixed flex items-center right-5 bottom-5
        {{ $backgroundColor }} pointer-events-auto mx-auto mb-4 hidden w-72 max-w-full rounded-lg bg-primary-100 bg-clip-padding text-sm text-primary-700 shadow-lg shadow-black/5 data-[te-toast-show]:block data-[te-toast-hide]:hidden"
    id="static-example" role="alert" aria-live="assertive" aria-atomic="true" data-te-autohide="false"
    data-te-toast-init
    data-te-toast-show>
    <div
        class="flex items-center justify-between rounded-t-lg border-b-2 border-primary-200 bg-primary-100 bg-clip-padding px-4 pb-2 pt-2.5 text-primary-700">
        <p class="flex items-center font-bold text-primary-700 uppercase">
            {{ $title }}
        </p>
        <div class="flex items-center">
            <button
                type="button"
                class="ml-2 box-content rounded-none border-none opacity-80 hover:no-underline hover:opacity-75 focus:opacity-100 focus:shadow-none focus:outline-none"
                data-te-toast-dismiss
                aria-label="Close">
        <span
            class="w-[1em] focus:opacity-100 disabled:pointer-events-none disabled:select-none disabled:opacity-25 [&.disabled]:pointer-events-none [&.disabled]:select-none [&.disabled]:opacity-25">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </span>
            </button>
        </div>
    </div>
    <div
        class="break-words rounded-b-lg bg-primary-100 px-4 py-4 text-primary-700 font-bold">
        {{ $message }}
    </div>
</div>
