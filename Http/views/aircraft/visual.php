<div x-cloak x-show="showVisualModal" x-transition.opacity.duration.200ms
    x-on:keydown.esc.window="showVisualModal = false" x-on:click.self="showVisualModal = false"
    class="fixed inset-0 z-30 flex items-end justify-center bg-black/20 p-4 pb-8 backdrop-blur-md sm:items-center lg:p-8"
    role="dialog" aria-modal="true" aria-labelledby="aircraftVisualModalTitle">
    <!-- Modal Dialog -->
    <div x-show="showVisualModal"
        x-transition:enter="transition ease-out duration-200 delay-100 motion-reduce:transition-opacity"
        x-transition:enter-start="opacity-0 scale-50" x-transition:enter-end="opacity-100 scale-100"
        class="flex max-h-[80svh] overflow-y-auto flex-col gap-4 overflow-hidden rounded-sm border border-neutral-300 bg-white text-neutral-600 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-300">
        <!-- Dialog Header -->
        <div class="flex items-center justify-between border-b border-neutral-300 bg-neutral-50/60 p-4 dark:border-neutral-700 dark:bg-neutral-950/20">
            <h3 id="aircraftVisualModalTitle" class="font-semibold tracking-wide text-neutral-900 dark:text-white" x-text="visualData?.model + ' - Seat Layout'"></h3>
            <button x-on:click="showVisualModal = false" aria-label="close modal">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true" stroke="currentColor"
                    fill="none" stroke-width="1.4" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Seat Visualization -->
        <div class="px-4 flex flex-col justify-end">
            <template x-if="visualData && visualData.layout">
                <div class="flex flex-col items-center gap-2 py-4">
                    <!-- Aircraft Info -->
                    <div class="mb-4 text-sm text-center space-y-2">
                        <p class="font-semibold text-lg" x-text="visualData.model"></p>
                        <p class="text-neutral-600 dark:text-neutral-400">
                            <span x-text="visualData.rows"></span> rows × 
                            <span x-text="visualData.columns"></span> columns
                        </p>
                        <div class="flex gap-4 justify-center">
                            <span>First: <strong x-text="visualData.seats_f"></strong></span>
                            <span>Business: <strong x-text="visualData.seats_c"></strong></span>
                            <span>Economy: <strong x-text="visualData.seats_y"></strong></span>
                        </div>
                    </div>

                    <!-- Aircraft Legend -->
                    <div class="flex gap-4 mb-4 text-sm">
                        <div class="flex items-center gap-2">
                            <div class="w-4 h-4 border-2 border-blue-400 rounded"></div>
                            <span>Seat</span>
                        </div>
                    </div>

                    <!-- Seat Map -->
                    <div class="flex flex-col gap-1">
                        <template x-for="(row, rowIndex) in visualData.layout.split(' ')" :key="rowIndex">
                            <div>
                                <!-- Class Label -->
                                <div x-show="rowIndex === 0 || shouldShowAircraftSeparator(rowIndex - 1)"
                                    class="text-xs font-bold mb-2 text-center py-2 px-4 bg-neutral-100 dark:bg-neutral-800 rounded"
                                    x-text="getAircraftClassLabel(rowIndex)">
                                </div>

                                <div class="flex gap-1 items-center">
                                    <!-- Row Number -->
                                    <div class="w-8 text-xs text-center font-semibold text-neutral-500" x-text="rowIndex + 1"></div>

                                    <!-- Seats in Row -->
                                    <template x-for="(col, colIndex) in row.split('')" :key="colIndex">
                                        <div>
                                            <div x-show="col === '1'"
                                                class="w-10 h-10 flex items-center justify-center text-xs font-semibold rounded border-2 border-blue-400 cursor-pointer transition hover:scale-110 duration-300"
                                                x-text="getAircraftSeatNumber(rowIndex + 1, colIndex + 1)"
                                                :title="'Seat ' + getAircraftSeatNumber(rowIndex + 1, colIndex + 1)">
                                            </div>
                                            <div x-show="col === '0'" class="w-10 h-10 flex items-center justify-center text-neutral-400 text-xs">
                                                <!-- Aisle space -->
                                            </div>
                                        </div>
                                    </template>
                                </div>

                                <!-- Class Separator (show after last row of each class) -->
                                <div x-show="shouldShowAircraftSeparator(rowIndex)"
                                    class="h-px bg-neutral-300 dark:bg-neutral-600 my-2">
                                </div>
                            </div>
                        </template>
                    </div>
                </div>
            </template>
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
