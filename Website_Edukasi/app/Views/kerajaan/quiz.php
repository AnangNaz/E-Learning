<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pilih Kuis | Nusantara Heritage</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700;900&family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet" />

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'primary-indigo': '#242A5C', // Konsisten: Indigo Gelap
                        'accent-gold': '#F59E0B', // Konsisten: Amber/Gold
                    },
                }
            }
        }
    </script>

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f3f4f6;
            /* Latar belakang abu-abu sangat terang */
        }

        .header-font {
            font-family: 'Cinzel', serif;
        }

        /* Mengganti Glassmorphism dengan Card Putih Elegan */
        .card-elegant {
            background: white;
            border: 1px solid #e5e7eb;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -4px rgba(0, 0, 0, 0.05);
        }

        /* Efek hover konsisten */
        .hover-lift {
            transition: all 0.3s ease-out;
        }

        .hover-lift:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
        }
    </style>
</head>

<body class="text-gray-800 pt-24">

    <header class="bg-primary-indigo shadow-lg fixed top-0 left-0 right-0 z-50 transition duration-300 border-b-2 border-accent-gold/50">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">
            <a href="<?= site_url('/') ?>"
                class="text-3xl font-extrabold text-amber-400 tracking-wide header-font drop-shadow">
                Nusantara Heritage
            </a>

            <a href="<?= site_url('/') ?>"
                class="px-4 py-2 bg-accent-gold text-white font-semibold rounded-lg hover:bg-accent-gold/90 transition text-md shadow-md">
                ← Kembali ke Beranda
            </a>
        </div>
    </header>

    <div class="container mx-auto px-6 lg:px-12 py-16 max-w-6xl">

        <header class="text-center mb-16">
            <h1 class="text-5xl font-extrabold text-primary-indigo header-font drop-shadow mb-5">
                Uji Pengetahuan Nusantara
            </h1>
            <p class="text-lg text-gray-600 max-w-3xl mx-auto">
                Tantang diri Anda: Mulai kuis acak untuk wawasan luas, atau pilih kerajaan spesifik
                untuk mendalami sejarahnya secara detail.
            </p>
        </header>

        <div class="card-elegant p-10 rounded-xl shadow-xl border-t-4 border-accent-gold text-center mb-20 hover-lift">

            <div class="flex items-center justify-center space-x-4 mb-4">
                <svg class="w-10 h-10 text-accent-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 00-2 2v10a2 2 0 002 2m0-10a2 2 0 012 2v10a2 2 0 01-2 2m10-10a2 2 0 012 2v10a2 2 0 01-2 2M7 10h10a2 2 0 012 2v10a2 2 0 01-2 2H7a2 2 0 01-2-2V12a2 2 0 012-2z"></path>
                </svg>
                <h2 class="text-3xl font-bold text-primary-indigo header-font">Mode Acak</h2>
            </div>

            <p class="text-gray-700 mb-7 max-w-xl mx-auto">
                Pertanyaan dari berbagai periode dan kerajaan. Cocok untuk menguji seberapa luas pengetahuan Anda!
            </p>

            <a href="<?= site_url('quiz/start/random') ?>"
                class="inline-block px-12 py-4 text-lg bg-primary-indigo hover:bg-primary-indigo/90 text-white font-bold rounded-lg shadow-xl transition duration-300 transform hover:scale-[1.03]">
                Mulai Kuis Acak →
            </a>
        </div>

        <h2 class="text-4xl font-bold text-primary-indigo header-font text-center mb-12">
            Pilih Kerajaan Spesifik
        </h2>
        <p class="text-center text-gray-600 mb-10">Pilih salah satu kerajaan di bawah ini untuk memulai kuis yang terfokus.</p>

        <?php if (!empty($kerajaan)): ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

                <?php foreach ($kerajaan as $k): ?>
                    <div class="card-elegant rounded-xl overflow-hidden shadow-lg hover-lift">

                        <?php if (!empty($k['foto_raja'])): ?>
                            <div class="h-48 overflow-hidden">
                                <img src="<?= base_url('uploaded_files/' . $k['foto_raja']); ?>"
                                    alt="Raja <?= $k['nama_kerajaan']; ?>"
                                    class="w-full h-full object-cover transition duration-500 hover:scale-110">
                            </div>
                        <?php else: ?>
                            <div class="w-full h-48 bg-primary-indigo/10 flex items-center justify-center text-primary-indigo italic font-semibold">
                                <svg class="w-8 h-8 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-12 0h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                Ilustrasi Raja
                            </div>
                        <?php endif; ?>

                        <div class="p-6">
                            <h3 class="text-2xl font-bold text-primary-indigo mb-2 header-font border-b border-accent-gold/50 pb-1">
                                <?= $k['nama_kerajaan'] ?>
                            </h3>

                            <div class="flex items-center space-x-2 text-sm text-gray-500 mb-5 mt-3">
                                <svg class="w-4 h-4 text-accent-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                <span>Lokasi: <span class="font-semibold"><?= $k['lokasi'] ?? 'N/A' ?></span></span>
                            </div>

                            <a href="<?= site_url('quiz/start/' . $k['id']) ?>"
                                class="block w-full text-center py-3 bg-accent-gold hover:bg-accent-gold/90 
                                        text-white font-semibold rounded-lg shadow-md transition transform hover:scale-[1.01]">
                                Mulai Kuis <?= $k['nama_kerajaan'] ?>
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>

            </div>

        <?php else: ?>
            <p class="text-center text-gray-700 text-lg mt-10 p-8 bg-white rounded-xl shadow-xl border-l-4 border-red-400">
                Maaf, data kerajaan belum tersedia untuk pembuatan kuis.
            </p>
        <?php endif; ?>

    </div>

    <footer class="bg-primary-indigo text-gray-300 py-6 mt-16 text-center text-sm">
        <p>© <?= date('Y') ?> Nusantara Heritage — Uji Pengetahuan Sejarah</p>
    </footer>

</body>

</html>