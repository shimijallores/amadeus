<?php
require base_path('Http/views/partials/head.php');
require base_path('Http/views/partials/nav.php');
?>
<main x-data="{
    showDeleteModal: false, 
    deleteId: null, 
    showUpdateModal: false, 
    editData: null,
    showVisualModal: false,
    visualData: null,
    getAircraftSeatNumber(row, col) {
        if (!this.visualData || !this.visualData.layout) return '';
        const layout = this.visualData.layout;
        const rows = layout.split(' ');
        if (row < 1 || row > rows.length) return '';
        
        const rowLayout = rows[row - 1];
        const columns = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K'];
        
        // Count only actual seats (1s) up to the current column
        let seatCount = 0;
        for (let i = 0; i < col; i++) {
            if (rowLayout[i] === '1') {
                seatCount++;
            }
        }
        
        return row + columns[seatCount - 1];
    },
    getAircraftSeatClass(row) {
        if (!this.visualData) return 'Y';
        const totalRows = this.visualData.rows;
        const seatsF = this.visualData.seats_f;
        const seatsC = this.visualData.seats_c;
        const seatsY = this.visualData.seats_y;
        const cols = this.visualData.columns;
        
        // Calculate how many rows each class takes
        const rowsF = seatsF > 0 ? Math.ceil(seatsF / cols) : 0;
        const rowsC = seatsC > 0 ? Math.ceil(seatsC / cols) : 0;
        
        if (row <= rowsF) return 'F';
        if (row <= rowsF + rowsC) return 'C';
        return 'Y';
    },
    shouldShowAircraftSeparator(rowIndex) {
        if (!this.visualData) return false;
        const currentRow = rowIndex + 1;
        const nextRow = currentRow + 1;
        
        const currentClass = this.getAircraftSeatClass(currentRow);
        const nextClass = this.getAircraftSeatClass(nextRow);
        
        return currentClass !== nextClass;
    },
    getAircraftClassLabel(rowIndex) {
        const row = rowIndex + 1;
        const seatClass = this.getAircraftSeatClass(row);
        if (seatClass === 'F') return 'First Class';
        if (seatClass === 'C') return 'Business Class';
        return 'Economy Class';
    }
}"
    class="h-full w-full flex justify-center gap-x-10 font-bold p-8">
    <!-- Delete Modal -->
    <?php require base_path('Http/views/aircraft/destroy.view.php') ?>

    <!-- Update Modal -->
    <?php require base_path('Http/views/aircraft/update.view.php') ?>

    <!-- Visual Modal -->
    <?php require base_path('Http/views/aircraft/visual.php') ?>

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
                        <th scope="col" class="p-4">SEATS</th>
                        <th scope="col" class="p-4">ROWS</th>
                        <th scope="col" class="p-4">COLUMNS</th>
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
                            <td class="p-4">
                                <p>First Class: <?= $plane['seats_f'] ?? 'N/A' ?></p>
                                <p>Business Class: <?= $plane['seats_c'] ?? 'N/A' ?></p>
                                <p>Economy Class: <?= $plane['seats_y'] ?? 'N/A' ?></p>
                            </td>
                            </td>
                            <td class="p-4" data-field="rows"><?= $plane['rows'] ?? 'N/A' ?></td>
                            <td class="p-4" data-field="columns"><?= $plane['columns'] ?? 'N/A' ?></td>
                            <?php if (!\Core\Session::role(['user', 'staff'])) : ?>
                                <td>
                                    <button @click="showUpdateModal=true; editData = <?= htmlspecialchars(json_encode($plane)) ?>"
                                        type="button"
                                        class="px-6 py-2 mr-1 bg-white w-24 text-black border border-black hover:scale-105 rounded transition duration-100 cursor-pointer">
                                        Edit
                                    </button>
                                    <button @click="showDeleteModal=true; deleteId = <?= $plane['id'] ?>" type="button"
                                        class="px-6 py-2 mr-1 bg-red-600 w-24 text-white border border-red-600 hover:scale-105 rounded transition duration-100 cursor-pointer">
                                        Delete
                                    </button>
                                    <button @click="showVisualModal=true; visualData = <?= htmlspecialchars(json_encode($plane)) ?>" type="button"
                                        class="px-6 py-2 bg-green-700 w-24 text-white border border-green-700 hover:scale-105 rounded transition duration-100 cursor-pointer">
                                        Visualize
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
        document.addEventListener('DOMContentLoaded', function() {
            const aircraftFields = [
                ["iata", "IATA"],
                ["icao", "ICAO"],
                ["model", "Model"],
                ["rows", "Rows"],
                ["columns", "Columns"],
            ];

            FilterComponent.init('filterContainer', aircraftFields, 'aircraftTable');
        });
    </script>
</main
    <?php
    require base_path('Http/views/partials/footer.php');
    ?>