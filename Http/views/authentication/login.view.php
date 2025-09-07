<?php
require base_path('Http/views/partials/head.php');
require base_path('Http/views/partials/nav.php');
?>
<main x-data="modalIsOpen=true"
    class="flex justify-center items-center gap-8 text-black p-8 w-full text-white h-full font-bold">
    <div x-cloak x-show="modalIsOpen" x-transition.opacity.duration.200ms
        class="fixed inset-0 z-30 flex items-end justify-center bg-black/2 w-full p-4 pb-8 backdrop-blur-md sm:items-center lg:p-8"
        role="dialog" aria-modal="true" aria-labelledby="defaultModalTitle">

        <div class="flex w-full flex-col justify-center sm:h-screen p-4">
            <div class="max-w-md w-full mx-auto border border-gray-300 rounded-2xl p-8">
                <div class="text-center">
                    <a href="/airlines)">
                        <img src="<?= assets('/images/logo.svg') ?>" alt="logo" class="w-40 inline-block" />
                    </a>
                </div>

                <form method="POST" action="/login">
                    <div class="space-y-2">
                        <div>
                            <label for="username"
                                class="text-slate-900 text-sm font-medium mb-2 block">Username</label>
                            <input name="username" type="text" id="username" value="<?= old('username') ?>"
                                class="text-slate-900 bg-white border border-gray-300 w-full text-sm px-4 py-3 rounded-md outline-blue-500"
                                placeholder="Enter a username" />
                            <?php if ($errors['username'] ?? false) : ?>
                                <p class="text-red-500 text-sm mt-1">
                                    <?= $errors['username'] ?>
                                </p>
                            <?php endif; ?>
                        </div>
                        <div>
                            <label for="password"
                                class="text-slate-900 text-sm font-medium mb-2 block">Password</label>
                            <input id="password" name="password" type="password"
                                class="text-slate-900 bg-white border border-gray-300 w-full text-sm px-4 py-3 rounded-md outline-blue-500"
                                placeholder="Enter password" />
                            <?php if ($errors['password'] ?? false) : ?>
                                <p class="text-red-500 text-sm mt-1">
                                    <?= $errors['password'] ?>
                                </p>
                            <?php endif; ?>
                        </div>
                        <label for="role" class="inline-flex mt-2 justify-center items-center gap-3">
                            <input id="role" name="role" type="checkbox" class="peer sr-only" role="switch" />
                            <span class="text-slate-900 text-sm font-medium block">Airline User</span>
                            <div class="relative h-5 w-9 after:h-4 after:w-4 peer-checked:after:translate-x-4 rounded-full border border-neutral-300 bg-neutral-50 after:absolute after:bottom-0 after:left-[0.0625rem] after:top-0 after:my-auto after:rounded-full after:bg-neutral-600 after:transition-all after:content-[''] peer-checked:bg-black peer-checked:after:bg-neutral-100 peer-focus:outline-2 peer-focus:outline-offset-2 peer-focus:outline-neutral-800 peer-focus:peer-checked:outline-black peer-active:outline-offset-0 peer-disabled:cursor-not-allowed peer-disabled:opacity-70" aria-hidden="true"></div>
                        </label>

                    </div>

                    <div class="mt-6">
                        <button type="submit"
                            class="w-full py-3 px-4 text-sm tracking-wider font-medium rounded-md text-white bg-neutral-900 hover:bg-black focus:outline-none cursor-pointer">
                            Log In
                        </button>
                    </div>
                    <p class="text-black text-xs mt-4 text-center">Don't have an account? <a
                            href="/register" class="text-blue-600 font-medium hover:underline ml-1">Register here</a></p>
                </form>
            </div>
        </div>
    </div>
</main>
<?php
require base_path('Http/views/partials/footer.php');
?>