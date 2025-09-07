<?php
require base_path('Http/views/partials/head.php');
require base_path('Http/views/partials/nav.php');
?>
<main x-data="{modalIsOpen:true, currentRole: null}"
    class="flex justify-center items-center gap-8 p-8 w-full text-white h-full font-bold">
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

                <form method="POST" action="/register">
                    <div class="space-y-2">
                        <!-- Airline Selector (For Airline staff) -->
                        <div x-show="currentRole === 'staff'">
                            <label for="airline_id"
                                class="text-slate-900 text-sm font-medium mb-2 block">Airline</label>
                            <select class="text-slate-900 bg-white border border-gray-300 w-full text-sm px-4 py-3 rounded-md outline-blue-500" name="airline_id" id="airline_id">
                                <?php foreach ($airlines as $airline): ?>
                                    <option value="<?= $airline['id'] ?>" class="font-medium"><?= $airline['airline'] ?></option>
                                <?php endforeach; ?>
                            </select>
                            <?php if ($errors['airline_id'] ?? false) : ?>
                                <p class="text-red-500 text-sm mt-1">
                                    <?= $errors['airline_id'] ?>
                                </p>
                            <?php endif; ?>
                        </div>
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
                        <div>
                            <label for="role"
                                class="text-slate-900 text-sm font-medium mb-2 block">Role</label>
                            <select @change="currentRole = $event.target.value" name="role" id="role" class="text-slate-900 bg-white border border-gray-300 w-full text-sm px-4 py-3 rounded-md outline-blue-500 text-medium">
                                <option value="user" selected>User</option>
                                <option value="staff">Staff</option>
                                <option value="admin">Admin</option>
                            </select>
                        </div>
                    </div>

                    <div class="mt-8">
                        <button type="submit"
                            class="w-full py-3 px-4 text-sm tracking-wider font-medium rounded-md text-white bg-neutral-900 hover:bg-black focus:outline-none cursor-pointer">
                            Create an account
                        </button>
                    </div>
                    <p class="text-black text-xs mt-4 text-center">Already have an account? <a
                            href="/login" class="text-blue-600 font-medium hover:underline ml-1">Login
                            here</a></p>
                </form>
            </div>
        </div>
    </div>
</main>
<?php
require base_path('Http/views/partials/footer.php');
?>