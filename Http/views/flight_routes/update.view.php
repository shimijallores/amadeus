<div x-cloak x-show="showUpdateModal" x-transition.opacity.duration.200ms
    x-on:keydown.esc.window="showUpdateModal = false" x-on:click.self="showUpdateModal = false"
    class="fixed inset-0 z-30 flex items-end justify-center bg-black/20 p-4 pb-8 backdrop-blur-md sm:items-center lg:p-8"
    role="dialog" aria-modal="true" aria-labelledby="defaultModalTitle">
    <!-- Modal Dialog -->
    <form action="/flight-routes" method="POST" x-show="showUpdateModal"
        x-transition:enter="transition min-w-1/3 ease-out duration-200 delay-100 motion-reduce:transition-opacity"
        x-transition:enter-start="opacity-0 scale-50" x-transition:enter-end="opacity-100 scale-100"
        class="flex max-w-lg flex-col gap-4 overflow-hidden rounded-sm border border-neutral-300 bg-white text-neutral-600 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-300">
        <!-- Dialog Header -->
        <div class="flex items-center justify-between border-b border-neutral-300 bg-neutral-50/60 p-4 dark:border-neutral-700 dark:bg-neutral-950/20">
            <h3 id="defaultModalTitle" class="font-semibold tracking-wide text-neutral-900 dark:text-white" x-text="editData ? 'Edit Route ' + editData.id : 'Edit Route'"></h3>
            <button x-on:click="showUpdateModal = false" aria-label="close modal">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true" stroke="currentColor"
                    fill="none" stroke-width="1.4" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <!-- Dialog Body -->
        <div class="px-4 py-8 w-full">
            <div class="w-full">
                <input type="hidden" name="_method" value="PATCH">
                <input type="hidden" name="id" :value="editData ? editData.id : ''">
                <div class="flex w-full flex-col gap-1 text-white">
                    <label for="airline_id" class="w-fit pl-0.5 text-sm text-white">AIRLINE</label>
                    <select id="airline_id" name="airline_id" class="w-full rounded-sm border border-neutral-300 min-w-92 font-medium bg-neutral-50 p-3 text-black text-sm focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black disabled:cursor-not-allowed disabled:opacity-75 dark:border-neutral-700 dark:bg-neutral-900/50 dark:focus-visible:outline-white">
                        <?php foreach ($airlines as $airline) : ?>
                            <option :selected="editData && editData.airline_id == <?= $airline['id'] ?>" value="<?= $airline['id'] ?>"><?= htmlspecialchars($airline['airline']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="flex w-full flex-col gap-1 text-white">
                    <label for="origin_airport_id" class="w-fit pl-0.5 text-sm text-white">ORIGIN AIRPORT</label>
                    <select id="origin_airport_id" name="origin_airport_id" class="w-full rounded-sm border border-neutral-300 min-w-92 font-medium bg-neutral-50 p-3 text-black text-sm focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black disabled:cursor-not-allowed disabled:opacity-75 dark:border-neutral-700 dark:bg-neutral-900/50 dark:focus-visible:outline-white">
                        <?php foreach ($airports as $airport) : ?>
                            <option :selected="editData && editData.origin_airport_id == <?= $airport['id'] ?>" value="<?= $airport['id'] ?>"><?= htmlspecialchars($airport['airport_name']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="flex w-full flex-col gap-1 text-white">
                    <label for="destination_airport_id" class="w-fit pl-0.5 text-sm text-white">DESTINATION AIRPORT</label>
                    <select id="destination_airport_id" name="destination_airport_id" class="w-full rounded-sm border border-neutral-300 min-w-92 font-medium bg-neutral-50 p-3 text-black text-sm focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black disabled:cursor-not-allowed disabled:opacity-75 dark:border-neutral-700 dark:bg-neutral-900/50 dark:focus-visible:outline-white">
                        <?php foreach ($airports as $airport) : ?>
                            <option :selected="editData && editData.destination_airport_id == <?= $airport['id'] ?>" value="<?= $airport['id'] ?>"><?= htmlspecialchars($airport['airport_name']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="flex w-full flex-col gap-1 text-white">
                    <label for="round_trip" class="w-fit pl-0.5 text-sm text-white">ROUND TRIP</label>
                    <select id="round_trip" name="round_trip" class="w-full rounded-sm border border-neutral-300 min-w-92 font-medium bg-neutral-50 p-3 text-black text-sm focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black disabled:cursor-not-allowed disabled:opacity-75 dark:border-neutral-700 dark:bg-neutral-900/50 dark:focus-visible:outline-white">
                        <option :selected="editData && editData.round_trip == 0" value="0">No</option>
                        <option :selected="editData && editData.round_trip == 1" value="1">Yes</option>
                    </select>
                </div>
                <div class="flex w-full flex-col gap-1 text-white">
                    <label for="aircraft_id" class="w-fit pl-0.5 text-sm text-white">AIRCRAFT</label>
                    <select id="aircraft_id" name="aircraft_id" class="w-full rounded-sm border border-neutral-300 min-w-92 font-medium bg-neutral-50 p-3 text-black text-sm focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black disabled:cursor-not-allowed disabled:opacity-75 dark:border-neutral-700 dark:bg-neutral-900/50 dark:focus-visible:outline-white">
                        <?php foreach ($aircraft as $plane) : ?>
                            <option :selected="editData && editData.aircraft_id == <?= $plane['id'] ?>" value="<?= $plane['id'] ?>"><?= htmlspecialchars($plane['model']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
        </div>
        <!-- Dialog Footer -->
        <div class="flex flex-col-reverse justify-between gap-2 border-t border-neutral-300 bg-neutral-50/60 p-4 dark:border-neutral-700 dark:bg-neutral-950/20 sm:flex-row sm:items-center md:justify-end">
            <button x-on:click="showUpdateModal = false" type="button"
                class="whitespace-nowrap rounded-sm px-4 py-2 text-center text-sm font-medium tracking-wide text-neutral-600 transition hover:opacity-75 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black active:opacity-100 active:outline-offset-0 dark:text-neutral-300 dark:focus-visible:outline-white">
                Cancel
            </button>
            <button x-on:click="showUpdateModal = false" type="submit"
                class="whitespace-nowrap rounded-sm bg-black border border-black dark:border-white px-4 py-2 text-center text-sm font-medium tracking-wide text-neutral-100 transition hover:opacity-75 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black active:opacity-100 active:outline-offset-0 dark:bg-white dark:text-black dark:focus-visible:outline-white">
                Update
            </button>
        </div>
    </form>
</div>