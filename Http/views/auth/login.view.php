<?php
require base_path('Http/views/admin/partials/head.php');
require base_path('Http/views/admin/partials/nav.php');
?>

    <main class="flex justify-center items-center gap-8  p-8 w-full h-full font-bold">
        <!-- Login Modal  -->
        <div
                class="fixed inset-0 z-30 flex items-end justify-center bg-black/20 p-4 pb-8 backdrop-blur-md sm:items-center lg:p-8"
                role="dialog" aria-modal="true" aria-labelledby="defaultModalTitle">
            <!-- Modal Dialog -->
            <div
                    class="flex max-w-2xl flex-col gap-4 overflow-hidden rounded-xl border border-neutral-300 bg-white text-neutral-600">
                <!-- Dialog Header -->
                <div class="flex items-start justify-between bg-neutral-50/60 mr-4 mt-4">
                    <!--    Logo-->
                    <div class="flex items-center">
                        <img src="/images/logo.png" alt="Merica Rocks logo" class="ml-2 my-2 w-24">
                        <div class="flex flex-col">
                            <h1 class="font-edwardian text-4xl text-glow-strong">Merica House of Rocks</h1>
                            <h2 class="font-century text-[0.7rem] italic tracking-widest">Where Nature Meets Design</h2>
                        </div>
                    </div>
                </div>
                <!-- Dialog Body -->
                <div class="w-full px-4 pb-4 flex items-center flex-col text-black">
                    <form action="../../../public/index.php" method="POST" class="flex w-full px-4 flex-col">
                        <h1 class="text-2xl mb-2">Security</h1>

                        <label for="username">Username</label>
                        <input type="text" name="username" id="username" value="<?= old('username') ?>"
                               class="p-1 rounded-md focus:ring-2 focus:ring-glow font-medium">
                        <?php if ($errors['username'] ?? false) : ?>
                            <p class="text-red-500 text-sm mt-1">
                                <?= $errors['username'] ?>
                            </p>
                        <?php endif; ?>
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password"
                               class="p-1 rounded-md focus:ring-2 focus:ring-glow font-medium">
                        <?php if ($errors['password'] ?? false) : ?>
                            <p class="text-red-500 text-sm mt-1">
                                <?= $errors['password'] ?>
                            </p>
                        <?php endif; ?>

                        <?php if ($errors['body'] ?? false) : ?>
                            <p class="text-red-500 text-sm mt-1">
                                <?= $errors['body'] ?>
                            </p>
                        <?php endif; ?>
                        <button type="submit"
                                class="self-center mt-4 hover:scale-105 opacity-80 cursor-pointer transition duration-100">
                            <img src="/images/login.png" alt="login button" class=""/>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </main>

<?php
require base_path('Http/views/admin/partials/footer.php');
?>