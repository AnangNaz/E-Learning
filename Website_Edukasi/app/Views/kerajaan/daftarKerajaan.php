<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Kerajaan | Nusantara Heritage</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Cinzel', serif;
        }
    </style>
</head>

<body class="bg-gradient-to-b from-indigo-50 to-white text-gray-800">

    <!-- NAVBAR -->
    <header class="bg-white/80 backdrop-blur-md shadow-md fixed top-0 left-0 right-0 z-50">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">
            <h1 class="text-3xl font-bold text-indigo-700 tracking-wide">Nusantara Heritage</h1>
            <nav class="space-x-6 text-lg">
                <a href="/" class="hover:text-indigo-600 transition">Home</a>
                <a href="<?= base_url('peta') ?>" class="hover:text-indigo-600 transition">Peta</a>
                <a href="/kerajaan" class="hover:text-indigo-600 transition text-indigo-700 font-bold">Daftar Kerajaan</a>
                <a href="/tentang" class="hover:text-indigo-600 transition">Tentang</a>
            </nav>
        </div>
    </header>

    <!-- CONTENT -->
    <div class="container mx-auto px-6 pt-32 pb-20 max-w-6xl">

        <h2 class="text-4xl font-bold text-indigo-800 text-center mb-14 tracking-wide">
            Semua Kerajaan Nusantara
        </h2>
        <form method="GET" action="<?= base_url('daftar') ?>" class="max-w-md mx-auto mb-10">
            <input
                type="text"
                name="q"
                placeholder="Cari kerajaan..."
                value="<?= esc($_GET['q'] ?? '') ?>"
                class="w-full px-4 py-3 rounded-xl border border-indigo-300 shadow-sm 
               focus:ring-2 focus:ring-indigo-500 focus:outline-none">
        </form>


        <?php if (!empty($kerajaan)): ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12">

                <?php foreach ($kerajaan as $k): ?>
                    <div
                        class="bg-white rounded-3xl shadow-xl hover:shadow-2xl border border-indigo-100 overflow-hidden transform hover:-translate-y-2 transition">

                        <!-- FOTO -->
                        <div class="h-64 w-full overflow-hidden">
                            <img
                                src="<?= !empty($k['foto_raja'])
                                            ? base_url('uploaded_files/' . $k['foto_raja'])
                                            : 'https://via.placeholder.com/600x400?text=Tidak+Ada+Foto' ?>"
                                class="w-full h-full object-cover hover:scale-110 transition duration-700">
                        </div>

                        <!-- CONTENT -->
                        <div class="p-8">
                            <h3 class="text-3xl font-bold text-indigo-700 mb-2">
                                <?= $k['nama_kerajaan'] ?>
                            </h3>

                            <p class="text-sm text-gray-600 italic mb-4">
                                Berdiri: <?= $k['tahun_berdiri'] ?> • Lokasi: <?= $k['lokasi'] ?>
                            </p>

                            <p class="text-gray-700 leading-relaxed mb-6">
                                <?= substr(strip_tags($k['deskripsi']), 0, 120) ?>...
                            </p>

                            <a href="/kerajaan/detail/<?= $k['id'] ?>"
                                class="inline-block px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl 
                   font-semibold transition shadow-md w-full text-center">
                                Lihat Detail →
                            </a>
                        </div>

                    </div>
                <?php endforeach; ?>

            </div>

        <?php else: ?>
            <p class="text-center text-gray-600 text-lg mt-10">Belum ada data kerajaan.</p>
        <?php endif; ?>

    </div>

    <!-- FOOTER -->
    <footer class="bg-indigo-900 text-gray-200 py-12 mt-16">
        <div class="container mx-auto px-6 text-center">
            <h3 class="text-2xl font-bold mb-3">Nusantara Heritage</h3>
            <p class="mb-6 max-w-xl mx-auto">
                Platform yang menghadirkan sejarah kerajaan Nusantara dengan tampilan modern dan informatif.
            </p>

            <div class="flex justify-center space-x-6 mb-6">
                <a href="/" class="hover:text-white">Home</a>
                <a href="/kerajaan" class="hover:text-white font-bold">Daftar Kerajaan</a>
                <a href="/tentang" class="hover:text-white">Tentang</a>
            </div>

            <p class="text-sm opacity-70">
                © <?= date('Y') ?> Nusantara Heritage — All Rights Reserved
            </p>
        </div>
    </footer>

</body>

</html>