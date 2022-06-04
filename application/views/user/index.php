<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title; ?></title>

    <link rel="icon" type="text/css" href="<?= base_url('assets/img/icon/w-icons.png') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/templateuser/css/app.css'); ?>">
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.7.3/dist/alpine.min.js" defer></script>
</head>

<body class="font-sans antialiased bg-gray-100 text-secondary-300">

    <!-- header navbar -->
    <header x-data="{open: false}" class="relative bg-white shadow">
        <nav class="container flex justify-between px-8 py-5 mx-auto">

            <div id="logo" class="font-bold text-secondary-300"><img class="w-24 sm:24 mx-auto" src="<?= base_url('assets/img/icon/b-logo.png'); ?>"></div>

            <a href="<?= base_url('home/masuk'); ?>" id="logo" class="font-bold text-secondary-300 focus:text-secondary-200">Masuk</a>
        </nav>
    </header>

    <!-- main container -->
    <main class="container px-10 mx-auto">
        <section>
            <div class="text-center">
                <h1 class="mt-20 text-3xl font-bold sm:text-5xl text-secondary-300">Satu Tempat Untuk Semua, Dengan</h1>
                <div id="logo" class="mt-4 text-3xl font-bold sm:text-5xl"><img class="w-40 sm:64 mx-auto" src="<?= base_url('assets/img/icon/b-logo.png'); ?>"></div>
            </div>
            <span class="flex justify-center mt-16">
                <a href="<?= base_url('home/masuk'); ?>" class="px-24 py-6 text-lg font-medium text-white border-2 sm:text-2xl sm:px-32 sm:py-8 bg-primary-300 border-b-10 rounded-primary border-secondary-300 focus:bg-primary-200 focus:border-secondary-200">Mulai</a>
            </span>
        </section>

        <section class="grid grid-cols-2 mt-24 mb-20">
            <div class="col-span-1 sm:ml-64">
                <img class="sm:w-40" src="<?= base_url('assets/img/icon/man.svg'); ?>" alt="this is illustration" srcset="<?= base_url('assets/img/icon/man.svg'); ?>">
            </div>

            <div class="col-span-1">
                <div class="mt-4 -ml-4 sm:ml-16">
                    <p class="text-xl font-bold sm:text-4xl text-secondary-300">Buat belajar lebih menyenangkan.</p>
                    <p class="text-xs font-medium sm:pr-48 sm:text-lg text-secondary-200">kelas, jadwal pelajaran, dan cek kehadiran di satu tempat.</p>
                </div>
            </div>
        </section>
    </main>
</body>
</html>