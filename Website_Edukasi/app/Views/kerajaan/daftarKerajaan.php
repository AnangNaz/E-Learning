<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galeri Kerajaan | Nusantara Heritage</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700;900&family=Poppins:wght@300;400;600;700&display=swap"
        rel="stylesheet">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'primary-indigo': '#242A5C',
                        'accent-gold': '#F59E0B',
                    },
                }
            }
        }
    </script>

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f3f4f6;
        }

        .header-font {
            font-family: 'Cinzel', serif;
        }

        .hover-lift {
            transition: all 0.3s ease-out;
        }

        .hover-lift:hover {
            transform: translateY(-8px);
            /* Sedikit lebih terangkat */
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
            /* Bayangan lebih dramatis */
        }

        .card-bg {
            background-image: linear-gradient(135deg, #ffffff 80%, #f9fafb 100%);
        }
    </style>
</head>

<body class="text-gray-800">

    <header class="bg-white/95 backdrop-blur-md shadow-lg fixed top-0 left-0 right-0 z-50 transition duration-300 border-b-2 border-accent-gold/50">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">
            <h1 class="text-3xl font-extrabold text-primary-indigo header-font tracking-wider">Nusantara Heritage</h1>
            <nav class="space-x-6 text-lg font-semibold">
                <a href="<?= base_url('/') ?>" class="hover:text-primary-indigo transition">Home</a>
                <a href="<?= base_url('peta') ?>" class="hover:text-primary-indigo transition">Peta</a>
                <a href="<?= base_url('kerajaan') ?>" class="text-accent-gold font-extrabold border-b-2 border-accent-gold pb-1 transition">Daftar Kerajaan</a>
                <a href="<?= base_url('quiz') ?>" class="px-3 py-1 bg-accent-gold text-white rounded-full hover:bg-amber-600 transition font-semibold shadow-md">Quiz</a>
                <a href="<?= base_url('tentang') ?>" class="hover:text-primary-indigo transition">Tentang</a>
            </nav>
        </div>
    </header>

    <div class="container mx-auto px-6 pt-32 pb-20 max-w-7xl">

        <div class="text-center mb-16">
            <h2 class="text-6xl font-extrabold text-primary-indigo header-font mb-4 tracking-wide drop-shadow-lg">
                Galeri Kerajaan Nusantara
            </h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                Eksplorasi koleksi lengkap kerajaan-kerajaan besar di Nusantara, dari masa Hindu-Buddha hingga Kesultanan Islam.
            </p>
            <?php if (isset($kerajaan)): ?>
                <div class="mt-6 inline-flex items-center space-x-2 bg-indigo-100/50 text-primary-indigo px-4 py-2 rounded-full font-semibold border border-indigo-300 shadow-sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 0v10M12 12V3"></path>
                    </svg>
                    <span><?= count($kerajaan) ?> Kerajaan Ditemukan</span>
                </div>
            <?php endif; ?>
        </div>

        <form id="filter-form" method="GET" action="<?= base_url('kerajaan') ?>" class="max-w-4xl mx-auto mb-16 bg-white p-6 rounded-2xl shadow-xl border border-gray-100">
             <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-end">
                
                <div class="md:col-span-1">
                    <label for="q" class="block text-sm font-medium text-gray-700 mb-1">Pencarian Cepat</label>
                    <div class="relative">
                        <input
                            type="text"
                            name="q"
                            id="q"
                            placeholder="Cari nama, lokasi, atau tahun berdiri..."
                            value="<?= esc($_GET['q'] ?? '') ?>"
                            class="w-full px-5 py-3 pr-12 rounded-lg border border-gray-300 shadow-sm
                            focus:ring-2 focus:ring-accent-gold/70 focus:border-accent-gold focus:outline-none transition text-base">
                        <button type="submit" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-indigo-500 hover:text-primary-indigo transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </button>
                    </div>
                </div>

                <div>
                    <label for="provinsi" class="block text-sm font-medium text-gray-700 mb-1">Filter Provinsi</label>
                    <?php
                    $current_provinsi = $_GET['provinsi'] ?? '';
                    // Daftar Provinsi (Bisa disederhanakan/diambil dari DB)
                    $provinsi_list = [
                        'Aceh', 'Sumatera Utara', 'Sumatera Barat', 'Riau', 'Kepulauan Riau', 
                        'Jambi', 'Sumatera Selatan', 'Bengkulu', 'Lampung', 'Bangka Belitung', 
                        'DKI Jakarta', 'Jawa Barat', 'Jawa Tengah', 'DI Yogyakarta', 'Jawa Timur', 'Banten', 
                        'Kalimantan Barat', 'Kalimantan Tengah', 'Kalimantan Selatan', 'Kalimantan Timur', 'Kalimantan Utara',
                        'Sulawesi Utara', 'Sulawesi Tengah', 'Sulawesi Selatan', 'Sulawesi Tenggara', 'Gorontalo', 'Sulawesi Barat',
                        'Bali', 'Nusa Tenggara Barat', 'Nusa Tenggara Timur',
                        'Maluku', 'Maluku Utara', 'Papua', 'Papua Barat', 'Papua Tengah', 'Papua Pegunungan', 'Papua Selatan', 'Papua Barat Daya'
                    ];
                    sort($provinsi_list); // Mengurutkan berdasarkan abjad
                    ?>
                    <select name="provinsi" id="provinsi" onchange="this.form.submit()"
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 shadow-sm bg-white
                        focus:ring-2 focus:ring-accent-gold/70 focus:border-accent-gold focus:outline-none appearance-none cursor-pointer">
                        <option value="">Semua Provinsi</option>
                        <?php foreach ($provinsi_list as $provinsi): ?>
                            <option value="<?= esc($provinsi) ?>" <?= $current_provinsi === $provinsi ? 'selected' : '' ?>><?= $provinsi ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                
                <div>
                    <label for="periode" class="block text-sm font-medium text-gray-700 mb-1">Filter Periode</label>
                    <?php
                    $current_periode = $_GET['periode'] ?? '';
                    ?>
                    <select name="periode" id="periode" onchange="this.form.submit()"
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 shadow-sm bg-white
                        focus:ring-2 focus:ring-accent-gold/70 focus:border-accent-gold focus:outline-none appearance-none cursor-pointer">
                        <option value="">Semua Periode</option>
                        <option value="Hindu-Buddha" <?= $current_periode === 'Hindu-Buddha' ? 'selected' : '' ?>>Hindu-Buddha</option>
                        <option value="Islam" <?= $current_periode === 'Islam' ? 'selected' : '' ?>>Islam</option>
                        <option value="Lainnya" <?= $current_periode === 'Lainnya' ? 'selected' : '' ?>>Lainnya</option>
                    </select>
                </div>
            </div>
        </form>

        <?php if (!empty($kerajaan)): ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">

                <?php foreach ($kerajaan as $k):
                    // Tentukan warna tag berdasarkan periode (Asumsi: Anda punya field 'periode' di $k)
                    $periode = $k['periode'] ?? 'Lainnya';
                    $periode_class = 'bg-gray-400';
                    if ($periode === 'Hindu-Buddha') {
                        $periode_class = 'bg-amber-600';
                    } elseif ($periode === 'Islam') {
                        $periode_class = 'bg-green-600';
                    }
                ?>
                    <div class="card-bg rounded-2xl shadow-xl border border-gray-200 overflow-hidden hover-lift border-t-8 border-primary-indigo/70">

                        <div class="h-48 w-full overflow-hidden relative">
                            <img
                                src="<?= !empty($k['foto_raja'])
                                              ? base_url('uploaded_files/' . $k['foto_raja'])
                                              : 'https://via.placeholder.com/600x400/242A5C/FFFFFF?text=Tidak+Ada+Foto' ?>"
                                class="w-full h-full object-cover transition duration-700 hover:scale-110">

                            <span class="absolute top-3 left-3 px-3 py-1 text-xs font-bold text-white uppercase rounded-full shadow-md <?= $periode_class ?>">
                                <?= $periode ?>
                            </span>
                             <?php 
                                $provinsi_lokasi = $k['provinsi'] ?? 'Tidak Diketahui'; // Asumsi: field 'provinsi' ada di data kerajaan
                            ?>
                             <span class="absolute top-3 right-3 px-3 py-1 text-xs font-bold text-white bg-primary-indigo/80 rounded-full shadow-md">
                                <?= $provinsi_lokasi ?>
                            </span>
                            </div>

                        <div class="p-6">
                            <h3 class="text-2xl font-bold text-primary-indigo header-font mb-2 line-clamp-2">
                                <?= $k['nama_kerajaan'] ?>
                            </h3>

                            <div class="space-y-2 text-sm text-gray-600 mb-5">
                                <span class="flex items-center">
                                    <svg class="w-4 h-4 mr-2 text-accent-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    Tahun: <strong class="ml-1 text-gray-800"><?= $k['tahun_berdiri'] ?></strong>
                                </span>
                                <span class="flex items-start">
                                    <svg class="w-4 h-4 mt-0.5 flex-shrink-0 mr-2 text-accent-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    Lokasi: <strong class="ml-1 text-gray-800 line-clamp-1"><?= $k['lokasi'] ?></strong>
                                </span>
                            </div>

                            <p class="text-gray-700 text-sm leading-relaxed mb-6 line-clamp-3">
                                <?= substr(strip_tags($k['deskripsi']), 0, 100) ?><?= strlen(strip_tags($k['deskripsi'])) > 100 ? '...' : '' ?>
                            </p>

                            <a href="<?= base_url('kerajaan/detail/' . $k['id']) ?>"
                                class="inline-block px-6 py-3 bg-primary-indigo hover:bg-indigo-700 text-white rounded-xl 
                                font-semibold transition shadow-lg w-full text-center transform hover:scale-[1.02] border-b-4 border-accent-gold/80">
                                Lihat Detail →
                            </a>
                        </div>

                    </div>
                <?php endforeach; ?>

            </div>

        <?php else: ?>
            <div class="text-center text-gray-600 text-xl mt-10 p-12 bg-white rounded-2xl shadow-xl border-l-8 border-red-500 max-w-xl mx-auto">
                <p class="font-semibold text-2xl mb-4 text-red-700">Pencarian Tidak Ditemukan!</p>
                <p>Maaf, tidak ada data kerajaan yang ditemukan sesuai kriteria pencarian.</p>
                <?php if (isset($_GET['q']) && $_GET['q'] !== ''): ?>
                    <a href="<?= base_url('kerajaan') ?>" class="text-indigo-600 font-bold mt-6 block hover:text-indigo-700 underline">Tampilkan Semua Kerajaan</a>
                <?php endif; ?>
            </div>
        <?php endif; ?>

    </div>

    <footer class="bg-primary-indigo text-gray-200 py-12 mt-16 border-t-6 border-accent-gold">
        <div class="container mx-auto px-6 text-center">
            <h3 class="header-font text-3xl font-bold mb-3 text-amber-400">Nusantara Heritage</h3>
            <p class="mb-6 max-w-xl mx-auto opacity-80 font-light">
                Platform yang menghadirkan sejarah kerajaan Nusantara dengan tampilan modern dan informatif.
            </p>

            <div class="flex justify-center space-x-6 mb-6 font-semibold text-md">
                <a href="<?= base_url('/') ?>" class="hover:text-white transition">Home</a>
                <a href="<?= base_url('kerajaan') ?>" class="hover:text-white transition">Daftar Kerajaan</a>
                <a href="<?= base_url('peta') ?>" class="hover:text-white transition">Peta Sejarah</a>
                <a href="<?= base_url('tentang') ?>" class="hover:text-white transition">Tentang</a>
            </div>

            <p class="text-sm opacity-70 mt-8">
                © <?= date('Y') ?> Nusantara Heritage — All Rights Reserved
            </p>
        </div>
    </footer>

</body>

</html>