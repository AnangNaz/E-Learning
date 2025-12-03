<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Kerajaan | Nusantara Heritage</title>

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Fonts (SAMA SEPERTI PAGE DETAIL & PETA) -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Inter:wght@300;400;600&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        .title-font {
            font-family: 'Playfair Display', serif;
        }
    </style>
</head>

<body class="bg-gradient-to-br from-indigo-50 via-white to-purple-100 min-h-screen">

    <!-- NAVBAR (SAMA SEPERTI PETA & DETAIL) -->
    <header class="backdrop-blur-md bg-white/70 shadow-md fixed top-0 left-0 right-0 z-50 border-b border-indigo-100">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <h1 class="text-3xl title-font font-bold text-indigo-700">Nusantara Heritage</h1>
            <nav class="space-x-6 text-lg font-semibold text-gray-700">
                <a href="/" class="hover:text-indigo-600 transition">Home</a>
                <a href="/peta" class="hover:text-indigo-600 transition">Peta</a>
                <a href="/kerajaan" class="text-indigo-700 font-bold hover:text-indigo-600 transition">Daftar Kerajaan</a>
                <a href="/tentang" class="hover:text-indigo-600 transition">Tentang</a>
            </nav>
        </div>
    </header>

    <!-- HERO SECTION (DISESUAIKAN SEPERTI PETA) -->
    <section class="pt-28 pb-10 text-center">
        <h2 class="title-font text-5xl font-bold text-indigo-800 tracking-wide">
            Daftar Kerajaan Nusantara
        </h2>

        <p class="mt-6 text-lg text-gray-700 max-w-3xl mx-auto">
            Temukan informasi sejarah, lokasi, tokoh, dan peninggalan dari kerajaan-kerajaan besar di Nusantara.
        </p>

        <img src="https://images.unsplash.com/photo-1526481280695-3c720685208b"
            class="w-40 mx-auto mt-8 rounded-xl opacity-90 shadow-lg">
    </section>

    <!-- SEARCH BAR -->
    <div class="max-w-md mx-auto mb-12 px-6">
        <form method="GET" action="<?= base_url('daftar') ?>">
            <input type="text" name="q"
                placeholder="Cari kerajaan..."
                value="<?= esc($_GET['q'] ?? '') ?>"
                class="w-full px-4 py-3 rounded-xl border border-indigo-300 shadow-sm focus:ring-2 focus:ring-indigo-500 focus:outline-none">
        </form>
    </div>

    <!-- LIST KERAJAAN -->
    <div class="max-w-7xl mx-auto px-6 pb-20">

        <?php if (!empty($kerajaan)): ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12">

                <?php foreach ($kerajaan as $k): ?>
                    <div class="bg-white rounded-2xl shadow-xl border border-gray-200 overflow-hidden hover:shadow-2xl transition hover:-translate-y-2">

                        <!-- FOTO -->
                        <div class="h-64 w-full overflow-hidden">
                            <img src="<?= !empty($k['foto_raja'])
                                            ? base_url('uploaded_files/' . $k['foto_raja'])
                                            : 'https://via.placeholder.com/600x400?text=Tidak+Ada+Foto' ?>"
                                class="w-full h-full object-cover hover:scale-110 transition duration-700">
                        </div>

                        <!-- CARD CONTENT -->
                        <div class="p-8">
                            <h3 class="title-font text-3xl font-bold text-indigo-700 mb-2">
                                <?= $k['nama_kerajaan'] ?>
                            </h3>

                            <p class="text-sm text-gray-600 italic mb-4">
                                Berdiri: <?= $k['tahun_berdiri'] ?> • Lokasi: <?= $k['lokasi'] ?>
                            </p>

                            <p class="text-gray-700 leading-relaxed mb-6">
                                <?= substr(strip_tags($k['deskripsi']), 0, 130) ?>...
                            </p>

                            <a href="/kerajaan/detail/<?= $k['id'] ?>"
                                class="inline-block px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl font-semibold transition shadow-md w-full text-center">
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

    <!-- FOOTER (SAMA PERSIS) -->
    <footer class="bg-indigo-900 text-gray-200 py-12 mt-10">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <h3 class="title-font text-2xl font-bold mb-3">Nusantara Heritage</h3>
            <p class="mb-6 max-w-xl mx-auto">
                Platform yang menghadirkan sejarah kerajaan Nusantara dengan tampilan modern dan informatif.
            </p>

            <div class="flex justify-center space-x-6 mb-6 font-semibold">
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