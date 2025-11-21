<?php
require base_path('Http/views/partials/head.php');
require base_path('Http/views/partials/nav.php');
?>
<main x-data="{
    showDeleteModal: false, 
    deleteId: null, 
    showUpdateModal: false, 
    editData: null, 
    showSeatsModal: false, 
    showVisualModal: false, 
    scheduleData: [],
    getSeatNumber(row, col) {
        const columns = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K'];
        return row + columns[col - 1];
    },
    getSeatStatus(row, col) {
        if (!this.scheduleData || this.scheduleData.length === 0) return 'available';
        const seatNumber = this.getSeatNumber(row, col);
        const seat = this.scheduleData.find(s => s.seat_no === seatNumber);
        return seat ? seat.seat_status : 'available';
    },
    getSeatDetails(row, col) {
        if (!this.scheduleData || this.scheduleData.length === 0) return 'No details available';
        const seatNumber = this.getSeatNumber(row, col);
        const seat = this.scheduleData.find(s => s.seat_no === seatNumber);
        
        if (!seat) return 'Seat: ' + seatNumber + '\nStatus: available';
        
        const className = seat.class === 'F' ? 'First Class' : seat.class === 'C' ? 'Business Class' : 'Economy Class';
        let details = `Seat: ${seat.seat_no}\n`;
        details += `Ticket ID: ${seat.ticket_id || 'N/A'}\n`;
        details += `Customer: ${seat.customer_name || 'N/A'}\n`;
        details += `Class: ${className}\n`;
        details += `Status: ${seat.seat_status}`;
        
        return details;
    },
    getSeatClass(row, col) {
        if (!this.scheduleData || this.scheduleData.length === 0) return 'Y';
        const seatNumber = this.getSeatNumber(row, col);
        const seat = this.scheduleData.find(s => s.seat_no === seatNumber);
        return seat ? seat.class : 'Y';
    },
    shouldShowSeparator(rowIndex) {
        if (!this.scheduleData || this.scheduleData.length === 0) return false;
        const currentRow = rowIndex + 1;
        const nextRow = currentRow + 1;
        
        // Get the class of the first seat in current row and next row
        const currentClass = this.getSeatClass(currentRow, 1);
        const nextClass = this.getSeatClass(nextRow, 1);
        
        return currentClass !== nextClass;
    },
    getClassLabel(rowIndex) {
        const row = rowIndex + 1;
        const seatClass = this.getSeatClass(row, 1);
        if (seatClass === 'F') return 'First Class';
        if (seatClass === 'C') return 'Business Class';
        return 'Economy Class';
    }
}"
    class="h-full w-full flex justify-center gap-x-10 font-bold p-8">
    <!-- Delete Modal -->
    <?php require base_path('Http/views/flight_schedules/destroy.view.php') ?>

    <!-- Update Modal -->
    <?php require base_path('Http/views/flight_schedules/update.view.php') ?>

    <!-- Seats Modal -->
    <?php require base_path('Http/views/flight_schedules/seats.php') ?>

    <!-- Seats Visualization Modal -->
    <?php require base_path('Http/views/flight_schedules/visual.php') ?>

    <!-- Filter Component -->
    <div class="max-w-4xl mx-auto rounded-lg bg-white h-fit shadow-md min-w-1/4">
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

    <!-- Main Table -->
    <div class="overflow-hidden w-full h-fit overflow-x-auto rounded-sm border border-neutral-300 dark:border-neutral-700">
        <table id="flightSchedulesTable" class="w-full font-medium text-left text-sm text-black dark:text-black">
            <thead class="border-b border-neutral-300 bg-neutral-50 text-sm text-black dark:border-neutral-700 dark:bg-neutral-900 dark:text-white">
                <tr>
                    <th scope="col" class="p-4">ID</th>
                    <th scope="col" class="p-4">AIRLINE USER</th>
                    <th scope="col" class="py-4 px-2">AIRLINE</th>
                    <th scope="col" class="p-4 w-64">ROUTE</th>
                    <th scope="col" class="p-4">DEPARTURE</th>
                    <th scope="col" class="p-4">ARRIVAL</th>
                    <th scope="col" class="p-4">STATUS</th>
                    <th scope="col" class="p-4">BASE PRICE</th>
                    <?php if (!\Core\Session::role('user')) : ?>
                        <th scope="col" class="p-4">ACTION</th>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody class="divide-y divide-neutral-300 dark:divide-neutral-700">
                <?php foreach ($flight_schedules as $schedule) : ?>
                    <tr class="even:bg-black/5 dark:even:bg-white/10">
                        <td class="p-4" data-field="id"><?= $schedule['id'] ?? 'N/A' ?></td>
                        <td class="p-4"
                            data-field="airline_user_name"><?= $schedule['airline_user_name'] ?? 'N/A' ?></td>
                        <td class="py-4 px-2" data-field="airline_name"><?= $schedule['airline_name'] ?? 'N/A' ?></td>
                        <td class="p-4 text-wrap w-64" data-field="route_display"><?= $schedule['route_display'] ?? 'N/A' ?></td>
                        <td class="p-4"
                            data-field="departure"><?= ($schedule['date_departure'] ?? 'N/A') ?></td>
                        <td class="p-4"
                            data-field="arrival"><?= ($schedule['date_arrival'] ?? 'N/A') ?></td>
                        <td class="p-4" data-field="status">
                            <span class="px-2 py-1 text-xs font-medium rounded-full
                                <?php
                                switch ($schedule['status'] ?? '') {
                                    case 'scheduled':
                                        echo 'bg-blue-100 text-blue-800';
                                        break;
                                    case 'boarding':
                                        echo 'bg-yellow-100 text-yellow-800';
                                        break;
                                    case 'departed':
                                        echo 'bg-green-100 text-green-800';
                                        break;
                                    case 'arrived':
                                        echo 'bg-purple-100 text-purple-800';
                                        break;
                                    case 'cancelled':
                                        echo 'bg-red-100 text-red-800';
                                        break;
                                    case 'delayed':
                                        echo 'bg-orange-100 text-orange-800';
                                        break;
                                    default:
                                        echo 'bg-gray-100 text-gray-800';
                                }
                                ?>">
                                <?= $schedule['status'] ?? 'N/A' ?>
                            </span>
                        </td>
                        <td class="p-4" data-field="pricing">
                            <div>
                                <p>First: <?= '₱' . number_format($schedule['price_f'])  ?></p>
                                <p>Business: <?= '₱' . number_format($schedule['price_c'])  ?></p>
                                <p>Economy: <?= '₱' . number_format($schedule['price_y'])  ?></p>
                            </div>
                        </td>
                        <?php if (!\Core\Session::role('user')) : ?>
                            <td class="grid grid-cols-2 grid-rows-2">
                                <button @click="showUpdateModal=true; editData = <?= htmlspecialchars(json_encode($schedule)) ?>"
                                    type="button"
                                    class="px-6 py-2 m-2 bg-white min-w-10 text-black border border-black hover:scale-105 rounded transition duration-100 cursor-pointer">
                                    Edit
                                </button>
                                <button @click="showDeleteModal=true; deleteId = <?= $schedule['id'] ?>" type="button"
                                    class="px-6 py-2 m-2 bg-red-600 min-w-10 text-white border border-red-700 hover:scale-105 rounded transition duration-100 cursor-pointer">
                                    Delete
                                </button>
                                <button @click="showSeatsModal=true; scheduleData = <?= htmlspecialchars(json_encode($schedule['seats'])) ?>;" type="button"
                                    class="px-6 py-2 m-2 bg-neutral-900 min-w-10 text-white border border-black hover:scale-105 rounded transition duration-100 cursor-pointer">
                                    Seats
                                </button>
                                <button @click="showVisualModal=true; scheduleData=<?= htmlspecialchars(json_encode($schedule['seats'])) ?>; console.log(scheduleData);" type="button"
                                    class="px-6 py-2 m-2 bg-green-700 min-w-10 text-white border border-green-700 hover:scale-105 rounded transition duration-100 cursor-pointer">
                                    Visualize
                                </button>
                            </td>
                        <?php endif; ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</main>

<script>
    // Initialize the filter component for flight schedules
    document.addEventListener('DOMContentLoaded', function() {
        const flightSchedulesFields = [
            ["airline_name", "Airline"],
            ["route_display", "Route"],
            ["departure", "Departure Date"],
            ["arrival", "Arrival Date"],
            ["status", "Status"]
        ];

        FilterComponent.init('filterContainer', flightSchedulesFields, 'flightSchedulesTable', <?= json_encode($selectedRoute ? $selectedRoute['airline'] : '') ?>);
    });
</script>

<?php
require base_path('Http/views/partials/footer.php');
?>