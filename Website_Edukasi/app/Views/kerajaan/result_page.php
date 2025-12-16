<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Kuis | <?= esc($title) ?></title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700;900&family=Poppins:wght@300;400;600;700&display=swap"
        rel="stylesheet" />

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
    </style>
</head>

<body class="pt-24">

    <header class="bg-primary-indigo shadow-lg fixed top-0 left-0 right-0 z-50 border-b-2 border-accent-gold/50">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">
            <h1 class="text-3xl font-extrabold text-amber-400 header-font tracking-wider drop-shadow">
                Hasil: <?= esc($title) ?>
            </h1>
            <div class="flex space-x-3">
                <a href="<?= site_url('/') ?>"
                    class="px-4 py-2 bg-indigo-600 text-white rounded-lg font-semibold transition hover:bg-indigo-700 shadow-md">
                    Beranda
                </a>
                <a href="<?= site_url('quiz') ?>"
                    class="px-4 py-2 bg-amber-600 text-white rounded-lg font-semibold transition hover:bg-amber-700 shadow-md">
                    ← Pilih Kuis
                </a>
            </div>
        </div>
    </header>

    <div class="container mx-auto px-6 lg:px-12 py-12 max-w-4xl">

        <h2 class="text-4xl font-extrabold text-primary-indigo header-font mb-10 text-center">
            Analisis Hasil Kuis Anda
        </h2>

        <div class="bg-white p-10 rounded-xl shadow-2xl border-t-8 border-accent-gold mb-12 text-center transform hover:shadow-3xl transition duration-300">
            <h3 class="text-3xl font-bold mb-4 text-primary-indigo">Selamat! Anda Telah Menyelesaikan Kuis.</h3>

            <div class="flex justify-center items-baseline space-x-4 mb-6">
                <span class="text-8xl font-extrabold header-font drop-shadow
                    <?php
                    // Atur warna berdasarkan persentase
                    if ($percentage >= 80) echo 'text-green-600';
                    else if ($percentage >= 50) echo 'text-amber-600';
                    else echo 'text-red-600';
                    ?>">
                    <?= esc($score) ?>
                </span>
                <span class="text-5xl text-gray-500">/ <?= esc($total) ?></span>
            </div>

            <p class="text-4xl font-bold text-gray-700 mb-4">
                <span class="text-primary-indigo"><?= esc($percentage) ?>%</span> Akurat
            </p>

            <p class="mt-4 text-lg font-medium text-gray-600">
                <?php
                if ($percentage >= 80) echo 'Luar biasa! Pengetahuan Anda tentang Warisan Nusantara sangat mendalam. Terus pertahankan!';
                else if ($percentage >= 50) echo 'Cukup bagus! Anda memiliki dasar yang baik. Pelajari lagi bagian yang salah untuk nilai sempurna!';
                else echo 'Terus semangat belajar! Sejarah Nusantara sangat luas dan menarik. Gunakan rincian jawaban untuk panduan belajar.';
                ?>
            </p>
        </div>

        <h3 class="text-3xl font-bold text-primary-indigo header-font mb-8 border-b-2 border-indigo-200 pb-2">
            Rincian Jawaban
        </h3>

        <?php $questionNumber = 1; ?>
        <?php foreach ($results as $r): ?>
            <div class="bg-white p-6 rounded-lg shadow-lg mb-6 border-l-8
                <?php echo $r['is_correct'] ? 'border-green-500' : 'border-red-500'; ?>">

                <div class="mb-4 flex items-center justify-between">
                    <h4 class="text-xl font-bold text-gray-800">Soal #<?= $questionNumber++ ?></h4>
                    <span class="px-4 py-1 text-sm rounded-full font-bold uppercase tracking-wider
                        <?php echo $r['is_correct'] ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700'; ?>">
                        <?php echo $r['is_correct'] ? 'BENAR' : 'SALAH'; ?>
                    </span>
                </div>

                <p class="text-gray-700 mb-3 font-medium leading-relaxed">
                    <?= esc($r['question']) ?>
                </p>

                <div class="text-md space-y-3 mt-4 p-4 bg-gray-50 rounded-lg border border-gray-200">

                    <p class="<?php echo $r['is_correct'] ? 'text-gray-600' : 'text-red-700 font-semibold'; ?>">
                        <span class="font-bold mr-2">Jawaban Anda (<?= esc($r['user_answer_label'] ?? '?') ?>):</span>
                        <?php
                        // Memastikan variabel teks ada dan tidak kosong
                        if (isset($r['user_answer_text']) && $r['user_answer_text'] !== null) {
                            echo esc($r['user_answer_text']);
                        } else {
                            // Menampilkan label 'Tidak dijawab' jika tidak ada jawaban
                            echo '<span class="italic text-gray-500">Tidak dijawab</span>';
                        }
                        ?>
                    </p>

                    <p class="text-green-700 font-bold">
                        <span class="font-bold mr-2">Jawaban Benar (<?= esc($r['correct_answer_label'] ?? '?') ?>):</span>
                        <?= esc($r['correct_answer_text'] ?? 'Data Jawaban Tidak Ditemukan') ?>
                    </p>
                </div>
            </div>

        <?php endforeach; ?>

        <div class="text-center mt-16 mb-10 flex justify-center space-x-6">

            <a href="<?= site_url('quiz') ?>"
                class="inline-block px-8 py-4 bg-primary-indigo text-white font-bold rounded-lg shadow-xl transition hover:bg-primary-indigo/90 transform hover:scale-105">
                <span class="hidden md:inline">←</span> Pilih Kuis Lainnya
            </a>

            <a href="<?= site_url('/') ?>"
                class="inline-block px-8 py-4 bg-amber-600 text-white font-bold rounded-lg shadow-xl transition hover:bg-amber-700 transform hover:scale-105">
                <svg class="w-5 h-5 inline mr-2 -mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                </svg>
                Beranda
            </a>
        </div>

    </div>
    <footer class="bg-primary-indigo text-gray-300 py-6 text-center text-sm">
        <p>© <?= date('Y') ?> Nusantara Heritage — Terima kasih telah berpartisipasi!</p>
    </footer>
</body>

</html>