// Dynamic Filter Component using Alpine.js
const FilterComponent = {
    init(containerId, fields, tableId) {
        this.containerId = containerId;
        this.fields = fields;
        this.tableId = tableId;
        this.generateFilterForm();
    },

    generateFilterForm() {
        const container = document.getElementById(this.containerId);
        if (!container) return;

        // Initialize filters data
        const filtersData = {};
        this.fields.forEach(([fieldId]) => {
            filtersData[fieldId] = { active: false, value: '' };
        });

        let formHTML = '<div x-data="filterData()">';

        this.fields.forEach(([fieldId, fieldLabel]) => {
            formHTML += `
                <div class="grid grid-cols-[20%_50%_20%] gap-4 items-center mb-4">
                    <p class="text-sm font-bold text-black">${fieldLabel}</p>
                    <input type="text" 
                           x-model="filters.${fieldId}.value"
                           :disabled="!filters.${fieldId}.active"
                           :class="!filters.${fieldId}.active ? 'w-full border border-gray-300 rounded px-3 py-2 filter-input bg-gray-100' : 'w-full border border-gray-300 rounded px-3 py-2 filter-input'"
                           data-field="${fieldId}">
                    <input type="checkbox" 
                           x-model="filters.${fieldId}.active"
                           class="form-checkbox h-5 w-5 text-blue-600 filter-checkbox"
                           data-field="${fieldId}">
                </div>
            `;
        });

        formHTML += `
            <div class="text-right mt-4">
                <button type="button" @click="clearFilters()"
                    class="px-6 py-2 m-4 bg-white w-30 min-w-30 text-black border border-black hover:scale-105 rounded transition duration-100 cursor-pointer">
                    Clear
                </button>
                <button type="button" @click="applyFilters()"
                    class="px-6 py-2 transition duration-100 hover:scale-105 min-w-30 bg-black text-white rounded hover:bg-neutral-700 cursor-pointer">
                    Filter
                </button>
            </div>
        </div>`;

        container.innerHTML = formHTML;

        // Define Alpine.js component globally
        window.filterData = () => {
            const tableId = this.tableId;
            return {
                filters: filtersData,

                clearFilters() {
                    Object.keys(this.filters).forEach(fieldId => {
                        this.filters[fieldId] = { active: false, value: '' };
                    });
                    this.applyFilters();
                },

                applyFilters() {
                    const table = document.getElementById(tableId);
                    if (!table) return;

                    const rows = table.querySelectorAll('tbody tr');

                    rows.forEach(row => {
                        let showRow = true;

                        Object.entries(this.filters).forEach(([fieldId, filter]) => {
                            if (filter.active && filter.value) {
                                const cellSelector = 'td[data-field="' + fieldId + '"]';
                                const cellValue = row.querySelector(cellSelector)?.textContent?.toLowerCase() || '';
                                const filterValue = filter.value.toLowerCase();

                                if (!cellValue.includes(filterValue)) {
                                    showRow = false;
                                }
                            }
                        });

                        row.style.display = showRow ? '' : 'none';
                    });
                }
            }
        };
    }
};
