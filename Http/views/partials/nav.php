<nav x-data="{ mobileMenuIsOpen: false }" x-on:click.away="mobileMenuIsOpen = false"
     class="flex items-center justify-between bg-neutral-50 border-b border-neutral-300 px-6 py-4 dark:border-neutral-700 dark:bg-neutral-900"
     aria-label="penguin ui menu">
    <!-- Brand Logo -->
    <a href="#" class="text-2xl font-bold text-neutral-900 dark:text-white">
        <span>Amade<span class="text-black dark:text-white">us</span></span>
        <!-- <img src="./your-logo.svg" alt="brand logo" class="w-10" /> -->
    </a>
    <!-- Desktop Menu -->
    <ul class="hidden items-center gap-4 sm:flex">
        <li>
            <a href="/"
               class="<?= url('/') ? 'bg-neutral-700/50 py-2 px-3 rounded-md' : '' ?> font-medium underline-offset-2 hover:text-black transition duration-100 hover:opacity-70 focus:outline-hidden focus:underline dark:text-white dark:hover:text-white"
               aria-current="page">Airlines
            </a>
        </li>
        <li>
            <a href="/airports"
               class="<?= url('/airports') ? 'bg-neutral-700/50 py-2 px-3 rounded-md' : '' ?> font-medium text-black underline-offset-2 hover:text-black hover:opacity-70 focus:outline-hidden focus:underline dark:text-white dark:hover:text-white"
               aria-current="page">Airports
            </a>
        </li>
        <li>
            <a href="/aircraft"
               class="<?= url('/aircraft') ? 'bg-neutral-700/50 py-2 px-3 rounded-md' : '' ?> font-medium text-black underline-offset-2 hover:text-black hover:opacity-70 focus:outline-hidden focus:underline dark:text-white dark:hover:text-white"
               aria-current="page">Aircraft
            </a>
        </li>
        <li>
            <a href="/users"
               class="<?= url('/users') ? 'bg-neutral-700/50 py-2 px-3 rounded-md' : '' ?> font-medium text-black underline-offset-2 hover:text-black hover:opacity-70 focus:outline-hidden focus:underline dark:text-white dark:hover:text-white"
               aria-current="page">Users
            </a>
        </li>
        <li>
            <a href="/routes"
               class="<?= url('/routes') ? 'bg-neutral-700/50 py-2 px-3 rounded-md' : '' ?> font-medium text-black underline-offset-2 hover:text-black hover:opacity-70 focus:outline-hidden focus:underline dark:text-white dark:hover:text-white"
               aria-current="page">Routes
            </a>
        </li>
        <li>
            <a href="/schedules"
               class="<?= url('/schedule') ? 'bg-neutral-700/50 py-2 px-3 rounded-md' : '' ?> font-medium text-black underline-offset-2 hover:text-black hover:opacity-70 focus:outline-hidden focus:underline dark:text-white dark:hover:text-white"
               aria-current="page">Schedules
            </a>
        </li>

        <!-- To be continued -->
        <!-- CTA Button -->
        <li>
            <a href="/register"
               class="rounded-sm bg-black border border-black px-4 py-2 text-center text-sm font-medium tracking-wide text-neutral-100 hover:opacity-75 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black active:opacity-100 active:outline-offset-0 dark:bg-white dark:border-white dark:text-black dark:focus-visible:outline-white">Sign
                Up
            </a>
        </li>
    </ul>
</nav>

