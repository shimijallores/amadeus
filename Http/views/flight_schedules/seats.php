<div x-cloak x-show="showSeatsModal" x-transition.opacity.duration.200ms
    x-on:keydown.esc.window="showSeatsModal = false" x-on:click.self="showSeatsModal = false"
    class="fixed inset-0 z-30 flex items-end justify-center bg-black/20 p-4 pb-8 backdrop-blur-md sm:items-center lg:p-8"
    role="dialog" aria-modal="true" aria-labelledby="defaultModalTitle">
    <!-- Modal Dialog -->
    <div x-show="showSeatsModal"
        x-transition:enter="transition ease-out duration-200 delay-100 motion-reduce:transition-opacity"
        x-transition:enter-start="opacity-0 scale-50" x-transition:enter-end="opacity-100 scale-100"
        class="flex max-h-[80svh] overflow-y-auto flex-col gap-4 overflow-hidden rounded-sm border border-neutral-300 bg-white text-neutral-600 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-300">
        <!-- Dialog Header -->
        <div class="flex items-center justify-between border-b border-neutral-300 bg-neutral-50/60 p-4 dark:border-neutral-700 dark:bg-neutral-950/20">
            <h3 id="defaultModalTitle" class="font-semibold tracking-wide text-neutral-900 dark:text-white">Flight seats</h3>
            <button x-on:click="showSeatsModal = false" aria-label="close modal">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true" stroke="currentColor"
                    fill="none" stroke-width="1.4" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <!-- Dialog Body -->
        <div class="px-4 flex flex-col justify-end">
            <button @click="showVisualModal = true"
                class="whitespace-nowrap self-end rounded-sm bg-black border border-black dark:border-white px-4 py-2 text-center text-sm font-medium tracking-wide text-neutral-100 transition hover:opacity-75 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black active:opacity-100 active:outline-offset-0 dark:bg-white dark:text-black dark:focus-visible:outline-white">
                Visualize
            </button>
            <table id="flightSchedulesTable" class="w-full max-h-50 overflow-y-auto font-medium text-left text-sm text-black dark:text-black">
                <thead class="border-b border-neutral-300 bg-neutral-50 text-sm text-black dark:border-neutral-700 dark:bg-neutral-900 dark:text-white">
                    <tr>
                        <th scope="col" class="p-4">ID</th>
                        <th scope="col" class="p-4">FID</th>
                        <th scope="col" class="p-4">TICKET</th>
                        <th scope="col" class="p-4">SEAT NO</th>
                        <th scope="col" class="p-4">Row</th>
                        <th scope="col" class="p-4">Column</th>
                        <th scope="col" class="p-4">CLASS</th>
                        <th scope="col" class="p-4">STATUS</th>
                    </tr>
                </thead>
                <tbody class="divide-y text-white divide-neutral-300 dark:divide-neutral-700 overflow-y-auto">
                    <template x-for="seat in scheduleData" :key="seat.seat_id">
                        <tr class="m-2 text-center">
                            <td x-text="seat.seat_id" class="p-2"></td>
                            <td x-text="seat.flight_schedule_id"></td>
                            <td x-text="seat.ticket_id"></td>
                            <td x-text="seat.seat_no"></td>
                            <td x-text="seat.row"></td>
                            <td x-text="seat.column"></td>
                            <td x-text="seat.class"></td>
                            <td x-text="seat.seat_status"></td>
                        </tr>
                    </template>
                </tbody>
            </table>
        </div>
        <!-- Dialog Footer -->
        <div class="flex flex-col-reverse justify-between gap-2 border-t border-neutral-300 bg-neutral-50/60 p-4 dark:border-neutral-700 dark:bg-neutral-950/20 sm:flex-row sm:items-center md:justify-end">
            <button x-on:click="showSeatsModal = false"
                class="whitespace-nowrap rounded-sm bg-black border border-black dark:border-white px-4 py-2 text-center text-sm font-medium tracking-wide text-neutral-100 transition hover:opacity-75 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black active:opacity-100 active:outline-offset-0 dark:bg-white dark:text-black dark:focus-visible:outline-white">
                Back
            </button>
        </div>
    </div>
</div>