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
        <div class="max-w-4xl mt-14 mx-auto rounded-lg bg-white h-fit shadow-md rounded min-w-1/4">
            <div class="p-4 w-full bg-black flex gap-x-2 items-center">
                <p class="text-white">Search</p>
                <svg fill="#ffffff" height="16px" width="16px" version="1.1" id="Capa_1"
                     xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                     viewBox="0 0 488.4 488.4" xml:space="preserve">
                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                    <g id="SVGRepo_iconCarrier">
                        <g>
                            <g>
                                <path d="M0,203.25c0,112.1,91.2,203.2,203.2,203.2c51.6,0,98.8-19.4,134.7-51.2l129.5,129.5c2.4,2.4,5.5,3.6,8.7,3.6 s6.3-1.2,8.7-3.6c4.8-4.8,4.8-12.5,0-17.3l-129.6-129.5c31.8-35.9,51.2-83,51.2-134.7c0-112.1-91.2-203.2-203.2-203.2 S0,91.15,0,203.25z M381.9,203.25c0,98.5-80.2,178.7-178.7,178.7s-178.7-80.2-178.7-178.7s80.2-178.7,178.7-178.7 S381.9,104.65,381.9,203.25z"></path>
                            </g>
                        </g>
                    </g>
            </svg>
            </div>

            <!-- Dynamic Filter Form Container -->
            <div id="filterContainer" class="p-6 space-y-3 mb-2 w-full">
                <!-- Filter fields will be dynamically generated here -->
            </div>
        </div>

        <div class="flex flex-col gap-y-4 w-full">
            <div class="w-full flex justify-end items-center">
                <!-- Import Form -->
                <form action="/airlines" method="POST" x-ref="storeForm" enctype="multipart/form-data">
                    <input type="file" name="excel"
                           @change="if ($el.files.length > 0) { setTimeout(() => $refs.storeForm.submit(), 200) }"
                           x-ref="storeInput"
                           class="hidden" accept=".xlsx">
                    <button @click="$refs.storeInput.click()" type="button"
                            class="px-6 py-2 bg-black text-white border border-black hover:scale-105 rounded transition duration-100 cursor-pointer">
                        Upload
                    </button>
                </form>
            </div>


            <!-- Main Table -->
            <div class="overflow-y-auto w-full h-fit overflow-x-auto rounded-sm border border-neutral-300 dark:border-neutral-700">
                <table id="airlinesTable" class="w-full font-medium text-left text-sm text-black dark:text-black">
                    <thead class="border-b border-neutral-300 bg-neutral-50 text-sm text-black dark:border-neutral-700 dark:bg-neutral-900 dark:text-white">
                    <tr>
                        <th scope="col" class="p-4">ID</th>
                        <th scope="col" class="p-4">IATA</th>
                        <th scope="col" class="p-4">ICAO</th>
                        <th scope="col" class="p-4">AIRLINE</th>
                        <th scope="col" class="p-4">CALLSIGN</th>
                        <th scope="col" class="p-4">COUNTRY</th>
                        <th scope="col" class="p-4">COMMENTS</th>
                        <th scope="col" class="p-4">ACTION</th>
                    </tr>
                    </thead>
                    <tbody class="divide-y divide-neutral-300 dark:divide-neutral-700">
                    <?php foreach ($airlines as $airline) : ?>
                        <tr class="even:bg-black/5 dark:even:bg-white/10">
                            <td class="p-4" data-field="id"><?= $airline['id'] ?? 'N/A' ?></td>
                            <td class="p-4" data-field="iata"><?= $airline['iata'] ?? 'N/A' ?></td>
                            <td class="p-4" data-field="icao"><?= $airline['icao'] ?? 'N/A' ?></td>
                            <td class="p-4" data-field="airline"><?= $airline['airline'] ?? 'N/A' ?></td>
                            <td class="p-4" data-field="callsign"><?= $airline['callsign'] ?? 'N/A' ?></td>
                            <td class="p-4" data-field="country"><?= $airline['country'] ?? 'N/A' ?></td>
                            <td class="p-4" data-field="comments"><?= $airline['comments'] ?? 'N/A' ?></td>
                            <td>
                                <button @click="showUpdateModal=true; editData = <?= htmlspecialchars(json_encode($airline)) ?>"
                                        type="button"
                                        class="px-6 py-2 m-4 bg-white min-w-10 text-black border border-black hover:scale-105 rounded transition duration-100 cursor-pointer">
                                    Edit
                                </button>
                                <button @click="showDeleteModal=true; deleteId = <?= $airline['id'] ?>" type="button"
                                        class="px-6 py-2 transition duration-100 hover:scale-105 min-w-10 bg-black text-white rounded hover:bg-neutral-700 cursor-pointer">
                                    Delete
                                </button>
                            </td>
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