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
    showLayoutBuilder: false,
    builderData: null,
    layoutConfig: {
        firstClass: { rows: 0, columns: 0, seats: 0, grid: [] },
        businessClass: { rows: 0, columns: 0, seats: 0, grid: [] },
        economyClass: { rows: 0, columns: 0, seats: 0, grid: [] }
    },
    initLayoutBuilder(aircraft) {
        this.builderData = aircraft;
        this.layoutConfig = {
            firstClass: { rows: 0, columns: 0, seats: aircraft.seats_f || 0, grid: [] },
            businessClass: { rows: 0, columns: 0, seats: aircraft.seats_c || 0, grid: [] },
            economyClass: { rows: 0, columns: 0, seats: aircraft.seats_y || 0, grid: [] }
        };
        if (aircraft.layout) {
            this.parseExistingLayout(aircraft);
        }
        this.showLayoutBuilder = true;
    },
    parseExistingLayout(aircraft) {
        if (!aircraft.layout) return;
        const rows = aircraft.layout.split(' ');
        const cols = aircraft.columns || 0;
        
        // Determine rows for each class based on seat counts
        const rowsF = aircraft.seats_f > 0 ? Math.ceil(aircraft.seats_f / cols) : 0;
        const rowsC = aircraft.seats_c > 0 ? Math.ceil(aircraft.seats_c / cols) : 0;
        const rowsY = rows.length - rowsF - rowsC;
        
        this.layoutConfig.firstClass.rows = rowsF;
        this.layoutConfig.firstClass.columns = cols;
        this.layoutConfig.businessClass.rows = rowsC;
        this.layoutConfig.businessClass.columns = cols;
        this.layoutConfig.economyClass.rows = rowsY > 0 ? rowsY : 0;
        this.layoutConfig.economyClass.columns = cols;
        
        this.updateLayoutGrids();
        
        // Parse existing layout
        rows.forEach((row, idx) => {
            const rowArray = row.split('').map(c => parseInt(c));
            if (idx < rowsF && this.layoutConfig.firstClass.grid[idx]) {
                this.layoutConfig.firstClass.grid[idx] = rowArray;
            } else if (idx < rowsF + rowsC && this.layoutConfig.businessClass.grid[idx - rowsF]) {
                this.layoutConfig.businessClass.grid[idx - rowsF] = rowArray;
            } else if (this.layoutConfig.economyClass.grid[idx - rowsF - rowsC]) {
                this.layoutConfig.economyClass.grid[idx - rowsF - rowsC] = rowArray;
            }
        });
        
        this.calculateSeats();
    },
    updateLayoutGrids() {
        ['firstClass', 'businessClass', 'economyClass'].forEach(cls => {
            const config = this.layoutConfig[cls];
            config.grid = [];
            for (let i = 0; i < config.rows; i++) {
                config.grid[i] = [];
                for (let j = 0; j < config.columns; j++) {
                    config.grid[i][j] = 0;
                }
            }
        });
        this.calculateSeats();
    },
    toggleCell(className, row, col) {
        const config = this.layoutConfig[className];
        if (config.grid[row] && config.grid[row][col] !== undefined) {
            config.grid[row][col] = config.grid[row][col] === 1 ? 0 : 1;
            this.calculateSeats();
        }
    },
    calculateSeats() {
        ['firstClass', 'businessClass', 'economyClass'].forEach(cls => {
            const config = this.layoutConfig[cls];
            config.seats = config.grid.reduce((total, row) => 
                total + row.filter(cell => cell === 1).length, 0
            );
        });
    },
    generateLayoutString() {
        let layout = [];
        
        ['firstClass', 'businessClass', 'economyClass'].forEach(cls => {
            const config = this.layoutConfig[cls];
            config.grid.forEach(row => {
                layout.push(row.join(''));
            });
        });
        
        return layout.join(' ');
    },
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

    <!-- Layout Builder Modal -->
    <?php require base_path('Http/views/aircraft/layout_builder.php') ?>

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
                                        class="px-6 py-2 mr-1 bg-green-700 w-24 text-white border border-green-700 hover:scale-105 rounded transition duration-100 cursor-pointer">
                                        Visualize
                                    </button>
                                    <button @click="initLayoutBuilder(<?= htmlspecialchars(json_encode($plane)) ?>)" type="button"
                                        class="px-6 py-2 bg-neutral-800 w-24 text-white border border-neutral-700 hover:scale-105 rounded transition duration-100 cursor-pointer">
                                        Edit Layout
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