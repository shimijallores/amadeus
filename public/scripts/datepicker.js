// Fix date picker handler - handle spans with data-date attributes
document.addEventListener('DOMContentLoaded', function() {
    const datepicker = document.getElementById('datepicker-inline');
    if (!datepicker) return;

    // Listen for any clicks on the datepicker with event delegation
    datepicker.addEventListener('click', function(event) {
        const target = event.target;

        // Check if it's a date cell (span with data-date attribute)
        let isDateCell = false;
        let timestamp = null;

        if (target.tagName === 'SPAN' && target.classList.contains('datepicker-cell')) {
            const dataDate = target.getAttribute('data-date');
            if (dataDate) {
                timestamp = parseInt(dataDate);
                isDateCell = true;
            }
        }

        // Also check for button elements as fallback
        if (!isDateCell && target.tagName === 'BUTTON') {
            const text = target.textContent.trim();
            if (text.match(/^\d{1,2}$/)) {
                const num = parseInt(text);
                if (num >= 1 && num <= 31) {
                    isDateCell = true;
                }
            }
        }

        if (isDateCell) {
            // Small delay to let Flowbite process the click
            setTimeout(() => {
                try {
                    let formattedDate = null;

                    if (timestamp) {
                        // Convert timestamp to date
                        const selectedDate = new Date(timestamp);
                        formattedDate = selectedDate.getFullYear() + '-' +
                            String(selectedDate.getMonth() + 1).padStart(2, '0') + '-' +
                            String(selectedDate.getDate()).padStart(2, '0');
                    } else {
                        // Fallback method for button clicks
                        const dayNumber = parseInt(target.textContent.trim());

                        // Try to get month/year from calendar header
                        const monthYearSelectors = [
                            '[data-testid="datepicker-view-button"]',
                            '.datepicker-view',
                            'button[type="button"]:not([data-date]):not([aria-label*="day"])'
                        ];

                        let month = null;
                        let year = null;

                        for (const selector of monthYearSelectors) {
                            const monthYearButton = datepicker.querySelector(selector);
                            if (monthYearButton && monthYearButton.textContent) {
                                const monthYearText = monthYearButton.textContent.trim();
                                const match = monthYearText.match(/(\w+)\s+(\d{4})/);
                                if (match) {
                                    const monthNames = ['January', 'February', 'March', 'April', 'May', 'June',
                                        'July', 'August', 'September', 'October', 'November', 'December'];
                                    month = monthNames.indexOf(match[1]);
                                    year = parseInt(match[2]);
                                    break;
                                }
                            }
                        }

                        if (month !== null && year !== null) {
                            const selectedDate = new Date(year, month, dayNumber);
                            formattedDate = selectedDate.getFullYear() + '-' +
                                String(selectedDate.getMonth() + 1).padStart(2, '0') + '-' +
                                String(selectedDate.getDate()).padStart(2, '0');
                        }
                    }

                    if (formattedDate) {
                        // Navigate to filtered page
                        window.location.href = window.location.pathname + '?date=' + formattedDate;
                    }
                } catch (error) {
                    // Silently handle errors
                }
            }, 100);
        }
    });
});