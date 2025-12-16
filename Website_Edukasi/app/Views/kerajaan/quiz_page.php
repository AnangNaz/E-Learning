<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?= $title ?? 'Kuis Warisan Nusantara' ?> | Nusantara Heritage</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700;900&family=Poppins:wght@300;400;600;700&display=swap"
        rel="stylesheet" />

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
        /* --- GAYA KONSISTEN DARI quiz_index_selection.php --- */
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f3f4f6;
        }

        .header-font {
            font-family: 'Cinzel', serif;
        }

        /* Card Putih Elegan */
        .card-elegant {
            background: white;
            border: 1px solid #e5e7eb;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -4px rgba(0, 0, 0, 0.05);
        }

        /* --- AKHIR GAYA KONSISTEN --- */


        /* Gaya Khusus untuk Pilihan Jawaban */
        .option-label {
            transition: all 0.2s ease-in-out;
            border: 1px solid #e5e7eb;
            background-color: white;
            /* Menggunakan gaya card-elegant untuk opsi yang belum terpilih */
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        }

        .option-label:hover {
            background-color: #f7f7f9;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -2px rgba(0, 0, 0, 0.03);
        }

        .option-label input:checked+span {
            /* Warna Accent-Gold sebagai penanda terpilih */
            background-color: #F59E0B;
            color: #1f2937;
            /* Teks gelap di atas gold */
            border-color: #F59E0B;
            box-shadow: 0 10px 15px -3px rgba(245, 158, 11, 0.3), 0 4px 6px -4px rgba(245, 158, 11, 0.2);
        }
    </style>
</head>

<body class="text-gray-800 pt-24">

    <header id="navbar" class="bg-primary-indigo shadow-lg fixed top-0 left-0 right-0 z-50 transition duration-300 border-b-2 border-accent-gold/50">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">

            <div class="flex items-center space-x-6">

                <a href="<?= site_url('quiz') ?>"
                    class="px-3 py-2 bg-accent-gold text-white font-semibold rounded-lg hover:bg-accent-gold/90 transition text-sm flex items-center shadow-md">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 15l-3-3m0 0l3-3m-3 3h8m-9 1a2 2 0 01-2-2v-2a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2z"></path>
                    </svg>
                    Pilih Kuis Lain
                </a>

                <h1 class="text-3xl font-bold text-amber-400 tracking-wide header-font">Nusantara Heritage</h1>
            </div>

            <div id="quiz-progress" class="text-amber-400 text-lg font-semibold tracking-wide border-l-2 border-accent-gold pl-4"></div>
        </div>
    </header>

    <div class="container mx-auto px-6 lg:px-10 py-10 max-w-3xl">

        <div class="card-elegant p-8 rounded-xl shadow-xl border-t-4 border-accent-gold text-center mb-10">

            <?php if (!empty($selected_mapel)): ?>
                <h2 class="text-3xl font-bold text-primary-indigo header-font mb-4">
                    Kuis Kerajaan: <?= $selected_mapel['nama_mapel'] ?? $selected_mapel['nama'] ?? 'Pilihan' ?>
                </h2>
                <p class="text-gray-600 italic mb-6">Fokus pada sejarah dan warisan <?= $selected_mapel['nama_mapel'] ?? $selected_mapel['nama'] ?? 'Kerajaan ini' ?></p>

                <?php if (!empty($selected_mapel['foto_raja'])): ?>
                    <img src="<?= base_url('uploaded_files/' . $selected_mapel['foto_raja']); ?>"
                        class="w-32 h-32 object-cover rounded-full mx-auto shadow-lg border-4 border-accent-gold transform transition duration-300 hover:scale-105">
                <?php endif; ?>

            <?php else: ?>
                <h2 class="text-3xl font-bold text-primary-indigo header-font mb-4">Kuis Acak Nusantara</h2>
                <p class="text-gray-600 italic mb-6">
                    Pertanyaan acak dari berbagai kerajaan, uji wawasan Anda secara luas.
                </p>
                <div class="flex justify-center items-center mx-auto w-32 h-32 rounded-full bg-primary-indigo/10 border-4 border-primary-indigo/30 text-primary-indigo font-bold text-xl shadow-lg">
                    ACAK
                </div>
            <?php endif; ?>
        </div>

        <h2 class="text-3xl font-bold text-primary-indigo header-font mt-10 mb-6 text-center tracking-wide">
            <span id="question-index-display"></span>
            (Total: <?= count($questions ?? []) ?> Soal)
        </h2>

        <div id="progress-bar-container" class="w-full bg-gray-200 rounded-full h-2 mb-8 shadow-inner">
            <div id="progress-bar-fill" class="bg-accent-gold h-2 rounded-full transition-all duration-300 ease-out" style="width: 0%"></div>
        </div>


        <form id="quiz-form" action="<?= site_url('quiz/submit') ?>" method="post">

            <div id="question-container"
                class="card-elegant p-8 rounded-xl shadow-2xl border-l-4 border-primary-indigo min-h-[300px]">
            </div>

            <div class="mt-10 flex justify-between">
                <button type="button" id="prev-btn"
                    class="flex items-center space-x-2 px-6 py-3 bg-gray-300 text-gray-800 rounded-lg font-semibold transition duration-300 hover:bg-gray-400 disabled:opacity-50 disabled:cursor-not-allowed shadow-md">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    <span>Sebelumnya</span>
                </button>

                <button type="button" id="next-btn"
                    class="flex items-center space-x-2 px-6 py-3 bg-primary-indigo text-white rounded-lg font-semibold transition duration-300 hover:bg-primary-indigo/90 shadow-lg">
                    <span>Selanjutnya</span>
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                    </svg>
                </button>

                <button type="submit" id="submit-btn"
                    class="hidden px-8 py-3 bg-accent-gold text-white rounded-lg font-bold transition duration-300 hover:bg-accent-gold/90 shadow-lg">
                    Selesaikan Kuis
                </button>
            </div>
        </form>
    </div>

    <footer class="bg-primary-indigo text-gray-300 py-6 mt-16 text-center text-sm">
        <p>© <?= date('Y') ?> Nusantara Heritage — Uji Pengetahuan Sejarah</p>
    </footer>

    <script>
        const questions = <?= json_encode($questions ?? []) ?>;
        let current = 0;

        // Gunakan object map untuk menyimpan jawaban user berdasarkan question ID
        const userAnswers = {};

        // Ambil elemen-elemen DOM
        const quizForm = document.getElementById("quiz-form");
        const container = document.getElementById("question-container");
        const prevBtn = document.getElementById("prev-btn");
        const nextBtn = document.getElementById("next-btn");
        const submitBtn = document.getElementById("submit-btn");
        const progressDisplay = document.getElementById("quiz-progress");
        const indexDisplay = document.getElementById("question-index-display");
        const progressBarFill = document.getElementById("progress-bar-fill");

        // --- FUNGSI KRUSIAL BARU: Menyimpan jawaban saat pilihan diubah ---
        function handleOptionChange(qid, value) {
            userAnswers[qid] = value;
        }

        function renderQuestion() {
            if (questions.length === 0) {
                container.innerHTML = `<p class="text-center text-red-500 font-semibold text-xl p-8">
                Maaf, tidak ada soal kuis yang ditemukan.
            </p>`;
                prevBtn.disabled = true;
                nextBtn.classList.add("hidden");
                submitBtn.classList.add("hidden");
                progressDisplay.textContent = '0 dari 0';
                indexDisplay.textContent = 'Tidak Ada Soal';
                return;
            }

            const q = questions[current];
            const totalQuestions = questions.length;

            // Update Tampilan Progress
            progressDisplay.textContent = `Soal ${current + 1} dari ${totalQuestions}`;
            indexDisplay.textContent = `Soal Ke-${current + 1}`;

            // Update Progress Bar
            const percentage = ((current + 1) / totalQuestions) * 100;
            progressBarFill.style.width = `${percentage}%`;

            container.innerHTML = `
            <div class="text-xl font-bold mb-6 text-primary-indigo leading-relaxed">
                <span class="text-accent-gold mr-2 text-2xl font-extrabold">${current + 1}.</span>
                ${q.pertanyaan}
            </div>

            <div class="space-y-4">
                ${renderOptions(q)}
            </div>
        `;

            // Cek dan tandai jawaban yang sudah dipilih
            if (userAnswers[q.id]) {
                const selectedInput = document.querySelector(`input[name="answers[${q.id}]"][value="${userAnswers[q.id]}"]`);
                if (selectedInput) {
                    selectedInput.checked = true;
                }
            }

            updateButtons();
        }

        function renderOptions(q) {
            const opts = [{
                    key: "A",
                    value: q.pilihan_a
                },
                {
                    key: "B",
                    value: q.pilihan_b
                },
                {
                    key: "C",
                    value: q.pilihan_c
                },
                {
                    key: "D",
                    value: q.pilihan_d
                },
            ];

            // MENGHILANGKAN LISTENER LAMA, GANTI DENGAN onchange='handleOptionChange(...)'
            return opts.map(opt => `
            <label class="option-label flex items-center p-4 rounded-xl cursor-pointer shadow-sm">
                <input type="radio" 
                    name="answers_temp" 
                    value="${opt.key}" 
                    data-question-id="${q.id}"
                    onchange="handleOptionChange('${q.id}', this.value)" 
                    class="hidden">
                <span class="w-8 h-8 flex items-center justify-center border-2 border-primary-indigo rounded-full font-bold mr-4 text-primary-indigo">${opt.key}</span>
                <span class="text-gray-800 font-medium">${opt.value}</span>
            </label>
        `).join('');
        }

        // CATATAN: Saya mengubah name radio button menjadi 'answers_temp'
        // agar hanya satu jawaban yang tercentang di DOM, dan 
        // form utama akan mendapatkan semua jawaban dari input hidden yang kita buat saat submit.

        // Menghapus event listener lama di container (yang kini tidak perlu)
        /*
        container.addEventListener("change", e => {
            if (e.target.type === "radio") {
                const qid = e.target.getAttribute("data-question-id");
                userAnswers[qid] = e.target.value;
            }
        });
        */

        // --- FUNGSI KRUSIAL BARU: Menambahkan jawaban ke Form sebelum Submit ---
        quizForm.addEventListener("submit", function(e) {
            // 1. Hapus input tersembunyi 'answers' sebelumnya (jika ada)
            quizForm.querySelectorAll('input[name^="answers"]').forEach(input => input.remove());

            // 2. Tambahkan input tersembunyi untuk setiap jawaban yang tersimpan
            let answersCount = 0;
            for (const qid in userAnswers) {
                if (userAnswers.hasOwnProperty(qid)) {
                    const answer = userAnswers[qid];

                    // Buat elemen input hidden
                    const hiddenInput = document.createElement('input');
                    hiddenInput.type = 'hidden';
                    // PENTING: Gunakan format array yang benar agar Controller PHP bisa membacanya
                    hiddenInput.name = `answers[${qid}]`;
                    hiddenInput.value = answer;

                    // Masukkan ke dalam formulir
                    quizForm.appendChild(hiddenInput);
                    answersCount++;
                }
            }

            // 3. Pengecekan Ketersediaan Jawaban
            if (answersCount < questions.length) {
                const unanswered = questions.length - answersCount;
                if (!confirm(`Anda baru menjawab ${answersCount} dari ${questions.length} soal. Apakah Anda yakin ingin menyelesaikan kuis? (Soal belum terjawab: ${unanswered})`)) {
                    e.preventDefault();
                    return false;
                }
            }
        });

        // --- Tombol Navigasi ---

        function updateButtons() {
            prevBtn.disabled = current === 0;

            if (questions.length === 0) {
                return;
            }

            // Atur visibilitas tombol Next dan Submit
            if (current === questions.length - 1) {
                nextBtn.classList.add("hidden");
                submitBtn.classList.remove("hidden");
            } else {
                nextBtn.classList.remove("hidden");
                submitBtn.classList.add("hidden");
            }
        }

        nextBtn.onclick = () => {
            if (current < questions.length - 1) {
                current++;
                renderQuestion();
            }
        };

        prevBtn.onclick = () => {
            if (current > 0) {
                current--;
                renderQuestion();
            }
        };

        // Mulai rendering
        renderQuestion();
    </script>
</body>

</html>