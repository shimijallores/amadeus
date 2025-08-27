<?php
require base_path('Http/views/partials/head.php');
require base_path('Http/views/partials/nav.php');
?>
    <main x-data="{showDeleteModal: false, deleteId: null, showUpdateModal: false, editData: null}"
          class="h-full w-full flex justify-center gap-x-10 font-bold p-8">
        <!-- Delete Modal -->
        <?php require base_path('Http/views/aircraft/destroy.view.php') ?>

        <!-- Update Modal -->
        <?php require base_path('Http/views/aircraft/update.view.php') ?>

        <!-- Filter Component -->
        <?php require base_path('Http/views/partials/filter.php') ?>

        <div class="flex flex-col gap-y-4 w-full">
            <div class="w-full flex justify-end items-center">
                <?php if (!Core\Session::role(['user', 'staff'])) : ?>
                    <!-- Import Form -->
                    <form action="/aircraft" method="POST" x-ref="storeForm" enctype="multipart/form-data">
                        <input type="file" name="excel"
                               @change="if ($el.files.length > 0) { setTimeout(() => $refs.storeForm.submit(), 200) }"
                               x-ref="storeInput"
                               class="hidden" accept=".xlsx">
                        <button @click="$refs.storeInput.click()" type="button"
                                class="px-6 py-2 bg-black text-white border border-black hover:scale-105 rounded transition duration-100 cursor-pointer">
                            Import
                        </button>
                    </form>
                <?php endif; ?>
            </div>


            <!-- Main Table -->
            <div class="overflow-auto w-full h-fit mb-12 rounded-sm border border-neutral-300 dark:border-neutral-700">
                <table id="aircraftTable" class="w-full font-medium text-left text-sm text-black dark:text-black">
                    <thead class="border-b border-neutral-300 bg-neutral-50 text-sm text-black dark:border-neutral-700 dark:bg-neutral-900 dark:text-white">
                    <tr>
                        <th scope="col" class="p-4">ID</th>
                        <th scope="col" class="p-4">IATA</th>
                        <th scope="col" class="p-4">ICAO</th>
                        <th scope="col" class="p-4">MODEL</th>
                        <?php if (!\Core\Session::role(['user', 'staff'])) : ?>
                            <th scope="col" class="p-4">ACTION</th>
                        <?php endif; ?>
                    </tr>
                    </thead>
                    <tbody class="divide-y divide-neutral-300 dark:divide-neutral-700">
                    <?php foreach ($aircraft as $plane) : ?>
                        <tr class="even:bg-black/5 dark:even:bg-white/10">
                            <td class="p-4" data-field="id"><?= $plane['id'] ?? 'N/A' ?></td>
                            <td class="p-4" data-field="iata"><?= $plane['iata'] ?? 'N/A' ?></td>
                            <td class="p-4" data-field="icao"><?= $plane['icao'] ?? 'N/A' ?></td>
                            <td class="p-4" data-field="model"><?= $plane['model'] ?? 'N/A' ?></td>
                            <?php if (!\Core\Session::role(['user', 'staff'])) : ?>
                                <td>
                                    <button @click="showUpdateModal=true; editData = <?= htmlspecialchars(json_encode($plane)) ?>"
                                            type="button"
                                            class="px-6 py-2 m-4 bg-white min-w-10 text-black border border-black hover:scale-105 rounded transition duration-100 cursor-pointer">
                                        Edit
                                    </button>
                                    <button @click="showDeleteModal=true; deleteId = <?= $plane['id'] ?>" type="button"
                                            class="px-6 py-2 transition duration-100 hover:scale-105 min-w-10 bg-black text-white rounded hover:bg-neutral-700 cursor-pointer">
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

        <script>
            // Initialize the filter component for aircraft
            document.addEventListener('DOMContentLoaded', function () {
                const aircraftFields = [
                    ["iata", "IATA"],
                    ["icao", "ICAO"],
                    ["model", "Model"]
                ];

                FilterComponent.init('filterContainer', aircraftFields, 'aircraftTable');
            });
        </script>
    </main
<?php
require base_path('Http/views/partials/footer.php');
?>