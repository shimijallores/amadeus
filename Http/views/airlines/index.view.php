<?php
require base_path('Http/views/partials/head.php');
require base_path('Http/views/partials/nav.php');
?>
    <main x-data="{showDeleteModal: false, deleteId: null, showUpdateModal: false, editData: null}"
          class="h-full w-full flex justify-center gap-x-10 font-bold p-8">
        <!-- Delete Modal -->
        <?php require base_path('Http/views/airlines/destroy.view.php') ?>

        <!-- Update Modal -->
        <?php require base_path('Http/views/airlines/update.view.php') ?>

        <!-- Filter Component -->
        <?php require base_path('Http/views/partials/filter.php') ?>

        <div class="flex flex-col gap-y-4 w-full">
            <div class="w-full flex justify-end items-center">
                <!-- Import Form -->
                <?php if (!Core\Session::role(['user', 'staff'])) : ?>
                    <form action="/airlines" method="POST" x-ref="storeForm" enctype="multipart/form-data">
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
                <table id="airlinesTable" class="w-full font-medium text-left text-sm text-black dark:text-black">
                    <thead class="border-b border-blue-300 bg-blue-50 text-sm text-black dark:border-blue-700 dark:bg-blue-900 dark:text-white">
                    <tr>
                        <th scope="col" class="p-4">ID</th>
                        <th scope="col" class="p-4">IATA</th>
                        <th scope="col" class="p-4">ICAO</th>
                        <th scope="col" class="p-4">AIRLINE</th>
                        <th scope="col" class="p-4">CALLSIGN</th>
                        <th scope="col" class="p-4">COUNTRY</th>
                        <th scope="col" class="p-4">COMMENTS</th>
                        <?php if (!\Core\Session::role(['user', 'staff'])) : ?>
                            <th scope="col" class="p-4">ACTION</th>
                        <?php endif; ?>
                    </tr>
                    </thead>
                    <tbody class="divide-y divide-blue-300 dark:divide-blue-700">
                    <?php foreach ($airlines as $airline) : ?>
                        <tr class="even:bg-blue-900/5 dark:even:bg-white/10">
                            <td class="p-4" data-field="id"><?= $airline['id'] ?? 'N/A' ?></td>
                            <td class="p-4" data-field="iata"><?= $airline['iata'] ?? 'N/A' ?></td>
                            <td class="p-4" data-field="icao"><?= $airline['icao'] ?? 'N/A' ?></td>
                            <td class="p-4" data-field="airline"><?= $airline['airline'] ?? 'N/A' ?></td>
                            <td class="p-4" data-field="callsign"><?= $airline['callsign'] ?? 'N/A' ?></td>
                            <td class="p-4" data-field="country"><?= $airline['country'] ?? 'N/A' ?></td>
                            <td class="p-4" data-field="comments"><?= $airline['comments'] ?? 'N/A' ?></td>
                            <?php if (!\Core\Session::role(['user', 'staff'])) : ?>
                                <td>
                                    <button @click="showUpdateModal=true; editData = <?= htmlspecialchars(json_encode($airline)) ?>"
                                            type="button"
                                            class="px-6 py-2 m-4 bg-white min-w-10 text-black border border-blue-900 hover:scale-105 rounded transition duration-100 cursor-pointer">
                                        Edit
                                    </button>
                                    <button @click="showDeleteModal=true; deleteId = <?= $airline['id'] ?>"
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
        // Initialize the filter component for airlines
        document.addEventListener('DOMContentLoaded', function () {
            const airlinesFields = [
                ["iata", "IATA"],
                ["icao", "ICAO"],
                ["airline", "Airline Name"],
                ["callsign", "Callsign"],
                ["country", "Country"],
                ["comments", "Comments"]
            ];

            FilterComponent.init('filterContainer', airlinesFields, 'airlinesTable');
        });
    </script>

<?php
require base_path('Http/views/partials/footer.php');
?>