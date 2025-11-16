<div x-cloak x-show="showVisualModal" x-transition.opacity.duration.200ms
    x-on:keydown.esc.window="showVisualModal = false" x-on:click.self="showVisualModal = false"
    class="fixed inset-0 z-30 flex items-end justify-center bg-black/20 p-4 pb-8 backdrop-blur-md sm:items-center lg:p-8"
    role="dialog" aria-modal="true" aria-labelledby="defaultModalTitle">
    <!-- Modal Dialog -->
    <div x-show="showVisualModal"
        x-transition:enter="transition ease-out duration-200 delay-100 motion-reduce:transition-opacity"
        x-transition:enter-start="opacity-0 scale-50" x-transition:enter-end="opacity-100 scale-100"
        class="flex max-h-[80svh] overflow-y-auto flex-col gap-4 overflow-hidden rounded-sm border border-neutral-300 bg-white text-neutral-600 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-300">
        <!-- Dialog Header -->
        <div class="flex items-center justify-between border-b border-neutral-300 bg-neutral-50/60 p-4 dark:border-neutral-700 dark:bg-neutral-950/20">
            <h3 id="defaultModalTitle" class="font-semibold tracking-wide text-neutral-900 dark:text-white" x-text="'Flight ' + (scheduleData[0]?.flight_schedule_id || '') + ' - ' + (scheduleData[0]?.model || '') + ' Seats'"></h3>
            <button x-on:click="showVisualModal = false" aria-label="close modal">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true" stroke="currentColor"
                    fill="none" stroke-width="1.4" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <!-- Dialog Body -->
        <div class="px-4 flex flex-col justify-end">
            <div class="grid gap-1" :style="`grid-template-rows: repeat(${scheduleData[0]?.rows || 1}, 1fr); grid-template-columns: repeat(${scheduleData[0]?.columns || 1}, 1fr);`">
                <template x-for="seat in scheduleData" :key="seat.seat_id">
                    <div
                        class="flex items-center justify-center p-2 text-xs font-bold rounded"
                        :style="`grid-row: ${seat.row}; grid-column: ${seat.column};`"
                        :class="{
                            'bg-green-500 text-white': seat.seat_status === 'available',
                            'bg-red-500 text-white': seat.seat_status === 'occupied',
                            'bg-gray-500 text-white': seat.seat_status === 'blocked'
                        }"
                        :title="`ID: ${seat.seat_id}, FID: ${seat.flight_schedule_id}, Ticket: ${seat.ticket_id}, Seat: ${seat.seat_no}, Row: ${seat.row}, Col: ${seat.column}, Class: ${seat.class}, Status: ${seat.seat_status}`"
                        x-text="seat.seat_no + ' (' + seat.seat_id + ')'"></div>
                </template>
            </div>
        </div>
        <!-- Dialog Footer -->
        <div class="flex flex-col-reverse justify-between gap-2 border-t border-neutral-300 bg-neutral-50/60 p-4 dark:border-neutral-700 dark:bg-neutral-950/20 sm:flex-row sm:items-center md:justify-end">
            <button x-on:click="showVisualModal = false"
                class="whitespace-nowrap rounded-sm bg-black border border-black dark:border-white px-4 py-2 text-center text-sm font-medium tracking-wide text-neutral-100 transition hover:opacity-75 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black active:opacity-100 active:outline-offset-0 dark:bg-white dark:text-black dark:focus-visible:outline-white">
                Back
            </button>
        </div>
    </div>
</div>