<div x-cloak x-show="showUpdateModal" x-transition.opacity.duration.200ms
    x-on:keydown.esc.window="showUpdateModal = false" x-on:click.self="showUpdateModal = false"
    class="fixed inset-0 z-30 flex items-end justify-center bg-black/20 p-4 pb-8 backdrop-blur-md sm:items-center lg:p-8"
    role="dialog" aria-modal="true" aria-labelledby="defaultModalTitle">
    <!-- Modal Dialog -->
    <form action="/flight-schedules" method="POST" x-show="showUpdateModal"
        x-transition:enter="transition min-w-1/3 ease-out duration-200 delay-100 motion-reduce:transition-opacity"
        x-transition:enter-start="opacity-0 scale-50" x-transition:enter-end="opacity-100 scale-100"
        class="flex max-w-lg flex-col gap-4 overflow-hidden rounded-sm border border-neutral-300 bg-white text-neutral-600 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-300">
        <!-- Dialog Header -->
        <div class="flex items-center justify-between border-b border-neutral-300 bg-neutral-50/60 p-4 dark:border-neutral-700 dark:bg-neutral-950/20">
            <h3 id="defaultModalTitle" class="font-semibold tracking-wide text-neutral-900 dark:text-white" x-text="editData ? 'Edit Schedule ' + editData.id : 'Edit Schedule'"></h3>
            <button x-on:click="showUpdateModal = false" aria-label="close modal">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true" stroke="currentColor"
                    fill="none" stroke-width="1.4" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <!-- Dialog Body -->
        <div class="px-4 py-8 w-full">
            <div class="w-full space-y-4">
                <input type="hidden" name="_method" value="PATCH">
                <input type="hidden" name="id" :value="editData ? editData.id : ''">

                <!-- Airline User ID -->
                <div class="flex w-full flex-col gap-1 text-white">
                    <label for="airline_user_id" class="w-fit pl-0.5 text-sm text-white">Airline User</label>
                    <select id="airline_user_id" name="airline_user_id" class="w-full rounded-sm border border-neutral-300 min-w-92 font-medium bg-neutral-50 p-3 text-black dark:text-white text-sm focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black disabled:cursor-not-allowed disabled:opacity-75 dark:border-neutral-700 dark:bg-neutral-900/50 dark:focus-visible:outline-white">
                        <option value="">Select Airline User</option>
                        <?php foreach ($airline_users as $user): ?>
                            <option value="<?= $user['id'] ?>" :selected="editData && editData.airline_user_id == <?= $user['id'] ?>">
                                <?= htmlspecialchars($user['username'] . ' (' . ($user['airline'] ?? 'No Airline') . ')') ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <?php if (isset($errors['airline_user_id'])): ?>
                        <p class="text-red-500 text-sm"><?= $errors['airline_user_id'] ?></p>
                    <?php endif; ?>
                </div>

                <!-- Flight Route ID -->
                <div class="flex w-full flex-col gap-1 text-white">
                    <label for="flight_route_id" class="w-fit pl-0.5 text-sm text-white">Flight Route</label>
                    <select id="flight_route_id" name="flight_route_id" class="w-full rounded-sm border border-neutral-300 min-w-92 font-medium bg-neutral-50 p-3 text-black dark:text-white text-sm focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black disabled:cursor-not-allowed disabled:opacity-75 dark:border-neutral-700 dark:bg-neutral-900/50 dark:focus-visible:outline-white">
                        <option value="">Select Route</option>
                        <?php foreach ($flight_routes as $route): ?>
                            <option value="<?= $route['id'] ?>" :selected="editData && editData.flight_route_id == <?= $route['id'] ?>">
                                <?= htmlspecialchars($route['route_display']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <?php if (isset($errors['flight_route_id'])): ?>
                        <p class="text-red-500 text-sm"><?= $errors['flight_route_id'] ?></p>
                    <?php endif; ?>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div class="flex w-full flex-col gap-1 text-white">
                        <label for="date_departure" class="w-fit pl-0.5 text-sm text-white">Departure Date</label>
                        <input id="date_departure" type="text" :value="editData ? editData.date_departure ?? '' : ''" class="w-full rounded-sm border border-neutral-300 font-medium bg-neutral-50 p-3 text-black dark:text-white text-sm focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black disabled:cursor-not-allowed disabled:opacity-75 dark:border-neutral-700 dark:bg-neutral-900/50 dark:focus-visible:outline-white" name="date_departure" placeholder="YYYY-MM-DD" />
                        <?php if (isset($errors['date_departure'])): ?>
                            <p class="text-red-500 text-sm"><?= $errors['date_departure'] ?></p>
                        <?php endif; ?>
                    </div>
                    <div class="flex w-full flex-col gap-1 text-white">
                        <label for="time_departure" class="w-fit pl-0.5 text-sm text-white">Departure Time</label>
                        <input id="time_departure" type="text" :value="editData ? editData.time_departure ?? '' : ''" class="w-full rounded-sm border border-neutral-300 font-medium bg-neutral-50 p-3 text-black dark:text-white text-sm focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black disabled:cursor-not-allowed disabled:opacity-75 dark:border-neutral-700 dark:bg-neutral-900/50 dark:focus-visible:outline-white" name="time_departure" placeholder="HH:MM" />
                        <?php if (isset($errors['time_departure'])): ?>
                            <p class="text-red-500 text-sm"><?= $errors['time_departure'] ?></p>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div class="flex w-full flex-col gap-1 text-white">
                        <label for="date_arrival" class="w-fit pl-0.5 text-sm text-white">Arrival Date</label>
                        <input id="date_arrival" type="text" :value="editData ? editData.date_arrival ?? '' : ''" class="w-full rounded-sm border border-neutral-300 font-medium bg-neutral-50 p-3 text-black dark:text-white text-sm focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black disabled:cursor-not-allowed disabled:opacity-75 dark:border-neutral-700 dark:bg-neutral-900/50 dark:focus-visible:outline-white" name="date_arrival" placeholder="YYYY-MM-DD" />
                        <?php if (isset($errors['date_arrival'])): ?>
                            <p class="text-red-500 text-sm"><?= $errors['date_arrival'] ?></p>
                        <?php endif; ?>
                    </div>
                    <div class="flex w-full flex-col gap-1 text-white">
                        <label for="time_arrival" class="w-fit pl-0.5 text-sm text-white">Arrival Time</label>
                        <input id="time_arrival" type="text" :value="editData ? editData.time_arrival ?? '' : ''" class="w-full rounded-sm border border-neutral-300 font-medium bg-neutral-50 p-3 text-black dark:text-white text-sm focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black disabled:cursor-not-allowed disabled:opacity-75 dark:border-neutral-700 dark:bg-neutral-900/50 dark:focus-visible:outline-white" name="time_arrival" placeholder="HH:MM" />
                        <?php if (isset($errors['time_arrival'])): ?>
                            <p class="text-red-500 text-sm"><?= $errors['time_arrival'] ?></p>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="flex w-full flex-col gap-1 text-white">
                    <label for="status" class="w-fit pl-0.5 text-sm text-white">Status</label>
                    <select id="status" name="status" class="w-full rounded-sm border border-neutral-300 min-w-92 font-medium bg-neutral-50 p-3 text-black dark:text-white text-sm focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black disabled:cursor-not-allowed disabled:opacity-75 dark:border-neutral-700 dark:bg-neutral-900/50 dark:focus-visible:outline-white">
                        <option value="">Select Status</option>
                        <option value="scheduled" :selected="editData && editData.status == 'scheduled'">Scheduled</option>
                        <option value="boarding" :selected="editData && editData.status == 'boarding'">Boarding</option>
                        <option value="departed" :selected="editData && editData.status == 'departed'">Departed</option>
                        <option value="arrived" :selected="editData && editData.status == 'arrived'">Arrived</option>
                        <option value="cancelled" :selected="editData && editData.status == 'cancelled'">Cancelled</option>
                        <option value="delayed" :selected="editData && editData.status == 'delayed'">Delayed</option>
                    </select>
                    <?php if (isset($errors['status'])): ?>
                        <p class="text-red-500 text-sm"><?= $errors['status'] ?></p>
                    <?php endif; ?>
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