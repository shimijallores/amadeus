<?php
require base_path('Http/views/partials/head.php');
require base_path('Http/views/partials/nav.php');
?>
    <main x-data="{showDeleteModal: false, deleteId: null, showUpdateModal: false, editData: null}"
          class="h-full w-full flex justify-center gap-x-10 font-bold p-8">
        <!-- Delete Modal -->
        <?php require base_path('Http/views/airports/destroy.view.php') ?>

        <!-- Update Modal -->
        <?php require base_path('Http/views/airports/update.view.php') ?>

        <!-- Filter Component -->
        <?php require base_path('Http/views/partials/filter.php') ?>

        <div class="flex flex-col gap-y-4 w-full">
            <div class="w-full flex justify-end items-center">
                <?php if (!Core\Session::role(['user', 'staff'])) : ?>
                    <!-- Import Form -->
                    <form action="/airports" method="POST" x-ref="storeForm" enctype="multipart/form-data">
                        <input type="file" name="excel"
                               @change="if ($el.files.length > 0) { setTimeout(() => $refs.storeForm.submit(), 200) }"
                               x-ref="storeInput"
                               class="hidden" accept=".xlsx">
                        <button @click="$refs.storeInput.click()" type="button"
                                class="px-6 py-2 bg-blue-900 text-white border border-blue-900 hover:scale-105 rounded transition duration-100 cursor-pointer">
                            Import
                        </button>
                    </form>
                <?php endif; ?>
            </div>


            <!-- Main Table -->
            <div class="overflow-y-auto w-full h-fit overflow-x-auto rounded-sm border border-blue-300 dark:border-blue-700">
                <table id="airportsTable" class="w-full font-medium text-left text-sm text-black dark:text-black">
                    <thead class="border-b border-blue-300 bg-blue-50 text-sm text-black dark:border-blue-700 dark:bg-blue-900 dark:text-white">
                    <tr>
                        <th scope="col" class="p-4">ID</th>
                        <th scope="col" class="p-4">IATA</th>
                        <th scope="col" class="p-4">ICAO</th>
                        <th scope="col" class="p-4">AIRPORT NAME</th>
                        <th scope="col" class="p-4">LOCATION SERVED</th>
                        <th scope="col" class="p-4">TIME ZONE</th>
                        <th scope="col" class="p-4">DST</th>
                        <?php if (!\Core\Session::role(['user', 'staff'])) : ?>
                            <th scope="col" class="p-4">ACTION</th>
                        <?php endif; ?>
                    </tr>
                    </thead>
                    <tbody class="divide-y divide-blue-300 dark:divide-blue-700">
                    <?php foreach ($airports as $airport) : ?>
                        <tr class="even:bg-blue-900/5 dark:even:bg-white/10">
                            <td class="p-4" data-field="id"><?= $airport['id'] ?? 'N/A' ?></td>
                            <td class="p-4" data-field="iata"><?= $airport['iata'] ?? 'N/A' ?></td>
                            <td class="p-4" data-field="icao"><?= $airport['icao'] ?? 'N/A' ?></td>
                            <td class="p-4" data-field="airport_name"><?= $airport['airport_name'] ?? 'N/A' ?></td>
                            <td class="p-4"
                                data-field="location_served"><?= $airport['location_served'] ?? 'N/A' ?></td>
                            <td class="p-4" data-field="time"><?= $airport['time'] ?? 'N/A' ?></td>
                            <td class="p-4" data-field="dst"><?= $airport['dst'] ?? 'N/A' ?></td>
                            <?php if (!\Core\Session::role(['user', 'staff'])) : ?>
                                <td>
                                    <button @click="showUpdateModal=true; editData = <?= htmlspecialchars(json_encode($airport)) ?>"
                                            type="button"
                                            class="px-6 py-2 m-4 bg-white min-w-10 text-black border border-blue-900 hover:scale-105 rounded transition duration-100 cursor-pointer">
                                        Edit
                                    </button>
                                    <button @click="showDeleteModal=true; deleteId = <?= $airport['id'] ?>"
                                            type="button"
                                            class="px-6 py-2 transition duration-100 hover:scale-105 min-w-10 bg-blue-900 text-white rounded hover:bg-blue-700 cursor-pointer">
                                        Delete
                                    </button>
                                </td>
                            <?php endif; ?>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

    </main>

    <script>
        // Initialize the filter component for airports
        document.addEventListener('DOMContentLoaded', function () {
            const airportsFields = [
                ["iata", "IATA"],
                ["icao", "ICAO"],
                ["airport_name", "Airport Name"],
                ["location_served", "Location Served"],
                ["time", "Time Zone"],
                ["dst", "DST"]
            ];

            FilterComponent.init('filterContainer', airportsFields, 'airportsTable');
        });
    </script>

<?php
require base_path('Http/views/partials/footer.php');
?>