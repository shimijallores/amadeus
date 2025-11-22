<!-- Layout Builder Modal -->
<div x-cloak x-show="showLayoutBuilder" x-transition.opacity.duration.200ms
  x-on:keydown.esc.window="showLayoutBuilder = false" x-on:click.self="showLayoutBuilder = false"
  class="fixed inset-0 z-50 flex items-end justify-center bg-black/20 p-4 pb-8 backdrop-blur-md sm:items-center lg:p-8"
  role="dialog" aria-modal="true" aria-labelledby="layoutBuilderTitle">
  <!-- Modal Dialog -->
  <div x-show="showLayoutBuilder"
    x-transition:enter="transition ease-out duration-200 delay-100 motion-reduce:transition-opacity"
    x-transition:enter-start="opacity-0 scale-50" x-transition:enter-end="opacity-100 scale-100"
    class="flex max-h-[85svh] w-full max-w-5xl overflow-y-auto flex-col gap-4 overflow-hidden rounded-sm border border-neutral-300 bg-white text-neutral-600 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-300">
    <!-- Dialog Header -->
    <div class="flex items-center justify-between border-b border-neutral-300 bg-neutral-50/60 p-4 dark:border-neutral-700 dark:bg-neutral-950/20">
      <h3 id="layoutBuilderTitle" class="font-semibold tracking-wide text-neutral-900 dark:text-white">
        Seat Layout Builder - <span x-text="builderData?.model || 'Aircraft'"></span>
      </h3>
      <button x-on:click="showLayoutBuilder = false" aria-label="close modal">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true" stroke="currentColor"
          fill="none" stroke-width="1.4" class="w-5 h-5">
          <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
        </svg>
      </button>
    </div>

    <!-- Builder Content -->
    <div class="w-full px-6 pb-6 flex flex-col gap-6">
      <div class="grid grid-cols-2 gap-x-10">
        <!-- Summary Stats -->
        <div class="border w-full border-neutral-300 dark:border-neutral-700 rounded p-3 bg-neutral-50 dark:bg-neutral-800 space-y-2">
          <h4 class="font-semibold mb-2 text-sm">Summary</h4>
          <div class="space-y-1 text-xs">
            <p><strong>Total Rows:</strong> <span x-text="layoutConfig.firstClass.rows + layoutConfig.businessClass.rows + layoutConfig.economyClass.rows"></span></p>
            <p><strong>Max Columns:</strong> <span x-text="Math.max(layoutConfig.firstClass.columns, layoutConfig.businessClass.columns, layoutConfig.economyClass.columns)"></span></p>
            <p><strong>Total Seats:</strong> <span x-text="layoutConfig.firstClass.seats + layoutConfig.businessClass.seats + layoutConfig.economyClass.seats"></span></p>
          </div>
        </div>

        <!-- Generated Layout Preview -->
        <div class="border border-neutral-300 dark:border-neutral-700 rounded p-3 bg-neutral-50 dark:bg-neutral-800">
          <h4 class="font-semibold mb-2 text-sm">Layout String:</h4>
          <code class="block p-2 bg-white dark:bg-neutral-900 rounded text-xs overflow-x-auto break-all" x-text="generateLayoutString()"></code>
        </div>
      </div>

      <!-- Left Side: Configuration Panel -->
      <div class="w-full grid grid-cols-[30%_65%] gap-x-10">
        <!-- Class Configuration -->
        <div class="space-y-3">
          <!-- First Class -->
          <div class="border border-neutral-300 dark:border-neutral-700 rounded p-2">
            <h4 class="font-semibold mb-2 text-center text-sm">First Class</h4>
            <div class="space-y-2">
              <div>
                <label class="block text-xs mb-1">Rows</label>
                <input type="number" x-model.number="layoutConfig.firstClass.rows" min="0" max="50"
                  @input="updateLayoutGrids()"
                  class="w-full px-2 py-1 text-sm border border-neutral-300 rounded focus:outline-none focus:ring-2 focus:ring-black dark:bg-neutral-800 dark:border-neutral-600">
              </div>
              <div>
                <label class="block text-xs mb-1">Columns</label>
                <input type="number" x-model.number="layoutConfig.firstClass.columns" min="0" max="11"
                  @input="updateLayoutGrids()"
                  class="w-full px-2 py-1 text-sm border border-neutral-300 rounded focus:outline-none focus:ring-2 focus:ring-black dark:bg-neutral-800 dark:border-neutral-600">
              </div>
              <div>
                <label class="block text-xs mb-1">Total Seats</label>
                <input type="number" x-model.number="layoutConfig.firstClass.seats" min="0"
                  class="w-full px-2 py-1 text-sm border border-neutral-300 rounded bg-neutral-100 dark:bg-neutral-800 dark:border-neutral-600" readonly>
              </div>
            </div>
          </div>

          <!-- Business Class -->
          <div class="border border-neutral-300 dark:border-neutral-700 rounded p-2">
            <h4 class="font-semibold mb-2 text-center text-sm">Business Class</h4>
            <div class="space-y-2">
              <div>
                <label class="block text-xs mb-1">Rows</label>
                <input type="number" x-model.number="layoutConfig.businessClass.rows" min="0" max="50"
                  @input="updateLayoutGrids()"
                  class="w-full px-2 py-1 text-sm border border-neutral-300 rounded focus:outline-none focus:ring-2 focus:ring-black dark:bg-neutral-800 dark:border-neutral-600">
              </div>
              <div>
                <label class="block text-xs mb-1">Columns</label>
                <input type="number" x-model.number="layoutConfig.businessClass.columns" min="0" max="11"
                  @input="updateLayoutGrids()"
                  class="w-full px-2 py-1 text-sm border border-neutral-300 rounded focus:outline-none focus:ring-2 focus:ring-black dark:bg-neutral-800 dark:border-neutral-600">
              </div>
              <div>
                <label class="block text-xs mb-1">Total Seats</label>
                <input type="number" x-model.number="layoutConfig.businessClass.seats" min="0"
                  class="w-full px-2 py-1 text-sm border border-neutral-300 rounded bg-neutral-100 dark:bg-neutral-800 dark:border-neutral-600" readonly>
              </div>
            </div>
          </div>

          <!-- Economy Class -->
          <div class="border border-neutral-300 dark:border-neutral-700 rounded p-2">
            <h4 class="font-semibold mb-2 text-center text-sm">Economy Class</h4>
            <div class="space-y-2">
              <div>
                <label class="block text-xs mb-1">Rows</label>
                <input type="number" x-model.number="layoutConfig.economyClass.rows" min="0" max="50"
                  @input="updateLayoutGrids()"
                  class="w-full px-2 py-1 text-sm border border-neutral-300 rounded focus:outline-none focus:ring-2 focus:ring-black dark:bg-neutral-800 dark:border-neutral-600">
              </div>
              <div>
                <label class="block text-xs mb-1">Columns</label>
                <input type="number" x-model.number="layoutConfig.economyClass.columns" min="0" max="11"
                  @input="updateLayoutGrids()"
                  class="w-full px-2 py-1 text-sm border border-neutral-300 rounded focus:outline-none focus:ring-2 focus:ring-black dark:bg-neutral-800 dark:border-neutral-600">
              </div>
              <div>
                <label class="block text-xs mb-1">Total Seats</label>
                <input type="number" x-model.number="layoutConfig.economyClass.seats" min="0"
                  class="w-full px-2 py-1 text-sm border border-neutral-300 rounded bg-neutral-100 dark:bg-neutral-800 dark:border-neutral-600" readonly>
              </div>
            </div>
          </div>
        </div>

        <!-- Right Side: Layout Grids -->
        <div class="overflow-y-auto space-y-6">
          <!-- First Class Grid -->
          <template x-if="layoutConfig.firstClass.rows > 0 && layoutConfig.firstClass.columns > 0">
            <div>
              <h4 class="font-semibold mb-3 text-center py-2 bg-blue-100 dark:bg-blue-900/30 rounded">First Class Layout</h4>
              <div class="flex flex-col gap-1 items-center">
                <template x-for="row in layoutConfig.firstClass.rows" :key="'f-' + row">
                  <div class="flex gap-1">
                    <div class="w-8 text-xs text-center font-semibold text-neutral-500 flex items-center justify-center" x-text="row"></div>
                    <template x-for="col in layoutConfig.firstClass.columns" :key="'f-' + row + '-' + col">
                      <div @mouseover="toggleCell('firstClass', row - 1, col - 1)"
                        class="w-10 h-10 flex items-center justify-center text-xs font-semibold rounded border-2 cursor-pointer transition hover:scale-110 duration-200"
                        :class="layoutConfig.firstClass.grid[row - 1][col - 1] === 1 ? 'border-blue-500 bg-blue-100 dark:bg-blue-900/50' : 'border-gray-400 bg-gray-100 dark:bg-gray-800'"
                        :title="layoutConfig.firstClass.grid[row - 1][col - 1] === 1 ? 'Seat' : 'Hallway'">
                        <span x-show="layoutConfig.firstClass.grid[row - 1][col - 1] === 1">💺</span>
                      </div>
                    </template>
                  </div>
                </template>
              </div>
            </div>
          </template>

          <!-- Business Class Grid -->
          <template x-if="layoutConfig.businessClass.rows > 0 && layoutConfig.businessClass.columns > 0">
            <div>
              <h4 class="font-semibold mb-3 text-center py-2 bg-yellow-100 dark:bg-yellow-900/30 rounded">Business Class Layout</h4>
              <div class="flex flex-col gap-1 items-center">
                <template x-for="row in layoutConfig.businessClass.rows" :key="'b-' + row">
                  <div class="flex gap-1">
                    <div class="w-8 text-xs text-center font-semibold text-neutral-500 flex items-center justify-center" x-text="layoutConfig.firstClass.rows + row"></div>
                    <template x-for="col in layoutConfig.businessClass.columns" :key="'b-' + row + '-' + col">
                      <div @mouseover="toggleCell('businessClass', row - 1, col - 1)"
                        class="w-10 h-10 flex items-center justify-center text-xs font-semibold rounded border-2 cursor-pointer transition hover:scale-110 duration-200"
                        :class="layoutConfig.businessClass.grid[row - 1][col - 1] === 1 ? 'border-blue-500 bg-blue-100 dark:bg-blue-900/50' : 'border-gray-400 bg-gray-100 dark:bg-gray-800'"
                        :title="layoutConfig.businessClass.grid[row - 1][col - 1] === 1 ? 'Seat' : 'Hallway'">
                        <span x-show="layoutConfig.businessClass.grid[row - 1][col - 1] === 1">💺</span>
                      </div>
                    </template>
                  </div>
                </template>
              </div>
            </div>
          </template>

          <!-- Economy Class Grid -->
          <template x-if="layoutConfig.economyClass.rows > 0 && layoutConfig.economyClass.columns > 0">
            <div>
              <h4 class="font-semibold mb-3 text-center py-2 bg-green-100 dark:bg-green-900/30 rounded">Economy Class Layout</h4>
              <div class="flex flex-col gap-1 items-center">
                <template x-for="row in layoutConfig.economyClass.rows" :key="'e-' + row">
                  <div class="flex gap-1">
                    <div class="w-8 text-xs text-center font-semibold text-neutral-500 flex items-center justify-center"
                      x-text="layoutConfig.firstClass.rows + layoutConfig.businessClass.rows + row"></div>
                    <template x-for="col in layoutConfig.economyClass.columns" :key="'e-' + row + '-' + col">
                      <div @mouseover="toggleCell('economyClass', row - 1, col - 1)"
                        class="w-10 h-10 flex items-center justify-center text-xs font-semibold rounded border-2 cursor-pointer transition hover:scale-110 duration-200"
                        :class="layoutConfig.economyClass.grid[row - 1][col - 1] === 1 ? 'border-blue-500 bg-blue-100 dark:bg-blue-900/50' : 'border-gray-400 bg-gray-100 dark:bg-gray-800'"
                        :title="layoutConfig.economyClass.grid[row - 1][col - 1] === 1 ? 'Seat' : 'Hallway'">
                        <span x-show="layoutConfig.economyClass.grid[row - 1][col - 1] === 1">💺</span>
                      </div>
                    </template>
                  </div>
                </template>
              </div>
            </div>
          </template>
        </div>
      </div>
    </div>

    <!-- Form to submit -->
    <form method="POST" action="/aircraft-layout" class="hidden" x-ref="layoutForm">
      <input type="hidden" name="aircraft_id" :value="builderData?.id">
      <input type="hidden" name="_method" value="PATCH">
      <input type="hidden" name="layout" :value="generateLayoutString()">
      <input type="hidden" name="rows" :value="layoutConfig.firstClass.rows + layoutConfig.businessClass.rows + layoutConfig.economyClass.rows">
      <input type="hidden" name="columns" :value="Math.max(layoutConfig.firstClass.columns, layoutConfig.businessClass.columns, layoutConfig.economyClass.columns)">
      <input type="hidden" name="seats_f" :value="layoutConfig.firstClass.seats">
      <input type="hidden" name="seats_c" :value="layoutConfig.businessClass.seats">
      <input type="hidden" name="seats_y" :value="layoutConfig.economyClass.seats">
      <input type="hidden" name="_method" value="PATCH">
    </form>

    <!-- Dialog Footer -->
    <div class="flex flex-col-reverse justify-between gap-2 border-t border-neutral-300 bg-neutral-50/60 p-4 dark:border-neutral-700 dark:bg-neutral-950/20 sm:flex-row sm:items-center">
      <button type="button" x-on:click="showLayoutBuilder = false"
        class="whitespace-nowrap rounded-sm bg-white border border-black px-4 py-2 text-center text-sm font-medium tracking-wide text-black transition hover:bg-neutral-100">
        Cancel
      </button>
      <button type="button" x-on:click="$refs.layoutForm.submit()"
        class="whitespace-nowrap rounded-sm bg-black border border-black px-4 py-2 text-center text-sm font-medium tracking-wide text-white transition hover:opacity-75">
        Save Layout
      </button>
    </div>
  </div>
</div>