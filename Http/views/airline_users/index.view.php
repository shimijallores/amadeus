<?php
require base_path('Http/views/partials/head.php');
require base_path('Http/views/partials/nav.php');
?>
<main x-data="{showDeleteModal: false, deleteId: null, showUpdateModal: false, editData: null}"
    class="h-full w-full flex justify-center gap-x-10 font-bold p-8">
    <!-- Delete Modal -->
    <?php require base_path('Http/views/airline_users/destroy.view.php') ?>

    <!-- Update Modal -->
    <?php require base_path('Http/views/airline_users/update.view.php') ?>

    <!-- Filter Component -->
    <div class="max-w-4xl mx-auto rounded-lg bg-white h-fit shadow-md rounded min-w-1/4">
        <div class="p-4 w-full bg-black flex gap-x-2 items-center">
            <p class="text-white">Filter</p>
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
        <table id="airlineUsersTable" class="w-full font-medium text-left text-sm text-black dark:text-black">
            <thead class="border-b border-neutral-300 bg-neutral-50 text-sm text-black dark:border-neutral-700 dark:bg-neutral-900 dark:text-white">
                <tr>
                    <th scope="col" class="p-4">ID</th>
                    <th scope="col" class="p-4">AIRLINE ID</th>
                    <th scope="col" class="p-4">AIRLINE NAME</th>
                    <th scope="col" class="p-4">USERNAME</th>
                    <th scope="col" class="p-4">PASSWORD</th>
                    <th scope="col" class="p-4">TYPE</th>
                    <th scope="col" class="p-4">ACTION</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-neutral-300 dark:divide-neutral-700">
                <?php foreach ($airline_users as $airline_user) : ?>
                    <tr class="even:bg-black/5 dark:even:bg-white/10">
                        <td class="p-4" data-field="id"><?= $airline_user['id'] ?? 'N/A' ?></td>
                        <td class="p-4" data-field="airline_id"><?= $airline_user['airline_id'] ?? 'N/A' ?></td>
                        <td class="p-4" data-field="airline_name"><?= $airline_user['airline_name'] ?? 'N/A' ?></td>
                        <td class="p-4" data-field="user"><?= $airline_user['user'] ?? 'N/A' ?></td>
                        <td class="p-4" data-field="password"><?= str_repeat('*', min(8, strlen($airline_user['password'] ?? ''))) ?></td>
                        <td class="p-4" data-field="type"><?= $airline_user['type'] ?? 'N/A' ?></td>
                        <td>
                            <button @click="showUpdateModal=true; editData = <?= htmlspecialchars(json_encode($airline_user)) ?>"
                                type="button"
                                class="px-6 py-2 m-4 bg-white min-w-10 text-black border border-black hover:scale-105 rounded transition duration-100 cursor-pointer">
                                Edit
                            </button>
                            <button @click="showDeleteModal=true; deleteId = <?= $airline_user['id'] ?>" type="button"
                                class="px-6 py-2 transition duration-100 hover:scale-105 min-w-10 bg-black text-white rounded hover:bg-neutral-700 cursor-pointer">
                                Delete
                            </button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</main>

<script>
    // Initialize the filter component for airline users
    document.addEventListener('DOMContentLoaded', function() {
        const airlineUsersFields = [
            ["airline_id", "Airline ID"],
            ["airline_name", "Airline Name"],
            ["user", "Username"],
            ["type", "Type"]
        ];

        FilterComponent.init('filterContainer', airlineUsersFields, 'airlineUsersTable');
    });
</script>

<?php
require base_path('Http/views/partials/footer.php');
?>