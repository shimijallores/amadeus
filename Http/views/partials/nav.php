<?php

use Core\Session;

?>
<nav x-data="{ mobileMenuIsOpen: false }" x-on:click.away="mobileMenuIsOpen = false"
     class="flex justify-between items-center bg-blue-50 dark:bg-blue-900 px-6 py-4 border-blue-300 dark:border-blue-700 border-b"
     aria-label="penguin ui menu">
    <!-- Brand Logo -->
    <a href="/" class="font-bold text-neutral-900 dark:text-white text-2xl">
        <span>Global Distribution System</span>
        <!-- <img src="./your-logo.svg" alt="brand logo" class="w-10" /> -->
    </a>
    <!-- Desktop Menu -->
    <ul class="hidden sm:flex items-center gap-4">
        <li>
            <a href="/"
               class="<?= url('/airlines') ? 'bg-neutral-700/50 py-2 px-3 rounded-md' : '' ?> font-medium underline-offset-2 hover:text-black transition duration-100 hover:opacity-70 focus:outline-hidden focus:underline dark:text-white dark:hover:text-white"
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
        <?php if (!Session::role(['user', 'staff'])) : ?>
            <li>
                <a href="/airline-users"
                   class="<?= url('/airline-users') ? 'bg-neutral-700/50 py-2 px-3 rounded-md' : '' ?> font-medium text-black underline-offset-2 hover:text-black hover:opacity-70 focus:outline-hidden focus:underline dark:text-white dark:hover:text-white"
                   aria-current="page">Users
                </a>
            </li>
        <?php endif; ?>
        <li>
            <a href="/flight-routes"
               class="<?= url('/flight-routes') ? 'bg-neutral-700/50 py-2 px-3 rounded-md' : '' ?> font-medium text-black underline-offset-2 hover:text-black hover:opacity-70 focus:outline-hidden focus:underline dark:text-white dark:hover:text-white"
               aria-current="page">Routes
            </a>
        </li>
        <li>
            <a href="/flight-schedules"
               class="<?= url('/flight-schedules') ? 'bg-neutral-700/50 py-2 px-3 rounded-md' : '' ?> font-medium text-black underline-offset-2 hover:text-black hover:opacity-70 focus:outline-hidden focus:underline dark:text-white dark:hover:text-white"
               aria-current="page">Schedules
            </a>
        </li>

        <!-- To be continued -->
        <!-- CTA Button -->
        <li>
            <?php if (!Session::get('user') ?? false) : ?>
                <a href="/register"
                   class="bg-black dark:bg-white hover:opacity-75 active:opacity-100 px-4 py-2 border dark:border-white border-black rounded-sm focus-visible:outline-2 focus-visible:outline-black dark:focus-visible:outline-white focus-visible:outline-offset-2 active:outline-offset-0 font-medium text-neutral-100 dark:text-black text-sm text-center tracking-wide">Sign
                    Up
                </a>
            <?php else : ?>
                <form action="/logout" method="POST">
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="submit"
                       class="bg-black dark:bg-white hover:opacity-75 active:opacity-100 px-4 py-2 border dark:border-white border-black rounded-sm focus-visible:outline-2 focus-visible:outline-black dark:focus-visible:outline-white focus-visible:outline-offset-2 active:outline-offset-0 font-medium text-neutral-100 dark:text-black text-sm text-center tracking-wide">Log
                        Out
                    </button>
                </form>

            <?php endif; ?>
        </li>
    </ul>
</nav>