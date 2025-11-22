<!-- Seat Edit Modal -->
<div x-cloak x-show="showSeatEditModal" x-transition.opacity.duration.200ms
  x-on:keydown.esc.window="showSeatEditModal = false" x-on:click.self="showSeatEditModal = false"
  class="fixed inset-0 z-50 flex items-end justify-center bg-black/20 p-4 pb-8 backdrop-blur-md sm:items-center lg:p-8"
  role="dialog" aria-modal="true" aria-labelledby="seatEditModalTitle">
  <!-- Modal Dialog -->
  <div x-show="showSeatEditModal"
    x-transition:enter="transition ease-out duration-200 delay-100 motion-reduce:transition-opacity"
    x-transition:enter-start="opacity-0 scale-50" x-transition:enter-end="opacity-100 scale-100"
    class="flex max-w-md w-full flex-col gap-4 overflow-hidden rounded-sm border border-neutral-300 bg-white text-neutral-600 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-300">
    <!-- Dialog Header -->
    <div class="flex items-center justify-between border-b border-neutral-300 bg-neutral-50/60 p-4 dark:border-neutral-700 dark:bg-neutral-950/20">
      <h3 id="seatEditModalTitle" class="font-semibold tracking-wide text-neutral-900 dark:text-white" x-text="'Edit Seat ' + (selectedSeat?.seat_no || '')"></h3>
      <button x-on:click="showSeatEditModal = false" aria-label="close modal">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true" stroke="currentColor"
          fill="none" stroke-width="1.4" class="w-5 h-5">
          <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
        </svg>
      </button>
    </div>

    <!-- Form Content -->
    <form method="POST" action="/seats" class="px-4 pb-4 space-y-4">
      <input type="hidden" name="seat_id" :value="selectedSeat?.seat_id">
      <input type="hidden" name="_method" value="PATCH">

      <!-- Seat Info -->
      <div class="bg-neutral-100 dark:bg-neutral-800 p-3 rounded text-sm">
        <p><strong>Seat:</strong> <span x-text="selectedSeat?.seat_no"></span></p>
        <p><strong>Class:</strong> <span x-text="selectedSeat?.class === 'F' ? 'First Class' : selectedSeat?.class === 'C' ? 'Business Class' : 'Economy Class'"></span></p>
      </div>

      <!-- Status -->
      <div>
        <label class="block text-sm font-medium mb-1">Status</label>
        <select name="status" :value="selectedSeat?.seat_status"
          class="w-full px-3 py-2 border border-neutral-300 rounded focus:outline-none focus:ring-2 focus:ring-black dark:bg-neutral-800 dark:border-neutral-600">
          <option value="available">Available</option>
          <option value="occupied">Occupied</option>
          <option value="blocked">Blocked</option>
        </select>
      </div>

      <!-- Price -->
      <div>
        <label class="block text-sm font-medium mb-1">Price</label>
        <input type="number" name="price" :value="selectedSeat?.price" step="0.01" min="0"
          class="w-full px-3 py-2 border border-neutral-300 rounded focus:outline-none focus:ring-2 focus:ring-black dark:bg-neutral-800 dark:border-neutral-600">
      </div>

      <!-- Customer Name -->
      <div>
        <label class="block text-sm font-medium mb-1">Customer Name</label>
        <input type="text" name="customer_name" :value="selectedSeat?.customer_name"
          class="w-full px-3 py-2 border border-neutral-300 rounded focus:outline-none focus:ring-2 focus:ring-black dark:bg-neutral-800 dark:border-neutral-600">
      </div>

      <!-- Customer Number -->
      <div>
        <label class="block text-sm font-medium mb-1">Customer Number</label>
        <input type="tel" name="customer_number" :value="selectedSeat?.customer_number"
          class="w-full px-3 py-2 border border-neutral-300 rounded focus:outline-none focus:ring-2 focus:ring-black dark:bg-neutral-800 dark:border-neutral-600">
      </div>

      <!-- Agency Number -->
      <div>
        <label class="block text-sm font-medium mb-1">Agency Number</label>
        <input type="tel" name="agency_number" :value="selectedSeat?.agency_number"
          class="w-full px-3 py-2 border border-neutral-300 rounded focus:outline-none focus:ring-2 focus:ring-black dark:bg-neutral-800 dark:border-neutral-600">
      </div>

      <!-- Dialog Footer -->
      <div class="flex flex-col-reverse gap-2 pt-4 sm:flex-row sm:justify-end">
        <button type="button" x-on:click="showSeatEditModal = false"
          class="whitespace-nowrap rounded-sm bg-white border border-black px-4 py-2 text-center text-sm font-medium tracking-wide text-black transition hover:bg-neutral-100">
          Cancel
        </button>
        <button type="submit"
          class="whitespace-nowrap rounded-sm bg-black border border-black px-4 py-2 text-center text-sm font-medium tracking-wide text-white transition hover:opacity-75">
          Save Changes
        </button>
      </div>
    </form>
  </div>
</div>