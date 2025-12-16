<?php

namespace App\Controllers;

use App\Models\MapelModel;
use App\Models\QuizModel;

class QuizController extends BaseController
{
    protected $mapelModel;
    protected $quizModel;

    public function __construct()
    {
        // Pastikan nama model sudah benar dan berada di App\Models
        $this->mapelModel = new MapelModel();
        $this->quizModel = new QuizModel();
    }

    /**
     * Menampilkan halaman pemilihan kuis (menu utama kuis / pilih_kuis.php).
     */
    public function index()
    {
        // Mengambil semua data kerajaan/mapel yang tersedia
        $kerajaan = $this->mapelModel->findAll();

        $data = [
            'title' => "Pilih Kategori Kuis | Nusantara Heritage",
            'kerajaan' => $kerajaan,
        ];

        // Pastikan Anda menggunakan nama view yang benar di sini, sesuai file HTML/PHP Anda.
        return view('kerajaan/quiz', $data);
    }

    /**
     * Memulai kuis, diarahkan setelah user memilih mode atau kerajaan.
     * $mapelId akan berisi 'random' atau ID Kerajaan (angka/string).
     */
    public function start($mapelId = 'random')
    {
        $questions = [];
        $kerajaan = null;
        $title = "Kuis Umum Nusantara";
        $limit = 20; // Batasi jumlah soal per kuis menjadi 10 (bisa disesuaikan)

        // 1. Sanitasi input
        $mapelId = filter_var($mapelId, FILTER_SANITIZE_STRING);

        $queryBuilder = $this->quizModel
            ->select('id, pertanyaan, pilihan_a, pilihan_b, pilihan_c, pilihan_d, jawaban_benar');

        if ($mapelId === 'random') {
            // MODE: Kuis Acak dari seluruh database

            // PERBAIKAN: Mengganti orderBy('id', 'RANDOM') dengan orderBy(RAND())
            // Ini biasanya memaksa database untuk melakukan pengacakan yang lebih segar.
            $questions = $queryBuilder
                ->orderBy('RAND()')
                ->findAll($limit);
            $title = "Kuis Acak Nusantara ({$limit} Soal)";
        } else {
            // MODE: Kuis Spesifik berdasarkan mapelId

            // A. Cari data kerajaan/mapel untuk judul dan validasi
            $kerajaan = $this->mapelModel->find($mapelId);

            if (!$kerajaan) {
                // Gagal: ID Kerajaan tidak ditemukan
                return redirect()->to(site_url('quiz'))->with('error', 'Kerajaan/Kategori kuis tidak ditemukan (ID: ' . $mapelId . ').');
            }

            // B. Ambil soal untuk ID spesifik, diacak, dan dibatasi
            // PERBAIKAN: Mengganti orderBy('id', 'RANDOM') dengan orderBy(RAND())
            $questions = $queryBuilder
                ->where('mapel_id', $mapelId)
                ->orderBy('RAND()')
                ->findAll($limit);

            // C. Tentukan judul kuis
            $title = "Kuis: " . ($kerajaan['nama_kerajaan'] ?? $kerajaan['nama_mapel'] ?? 'Kerajaan Tertentu');
        }

        // 2. Pengecekan data sebelum ditampilkan
        if (empty($questions)) {
            $message = ($mapelId === 'random') ?
                'Maaf, tidak ada soal kuis yang tersedia secara acak.' :
                'Maaf, belum ada soal kuis untuk kategori: ' . ($kerajaan['nama_kerajaan'] ?? 'Kerajaan Tertentu') . '.';

            // Gagal: Soal tidak ditemukan
            return redirect()->to(site_url('quiz'))->with('warning', $message);
        }

        // 3. Jika soal ditemukan, muat halaman soal kuis
        return view('kerajaan/quiz_page', [
            'title' => $title,
            'questions' => $questions,
            'selected_mapel' => $kerajaan, // Untuk menampilkan info kerajaan di quiz_page
        ]);
    }


    /**
     * Memproses jawaban kuis dan menampilkan hasilnya.
     */
    public function submit()
    {
        $answers = $this->request->getPost('answers');

        if (empty($answers) || !is_array($answers)) {
            return redirect()->back()->with('error', 'Tidak ada jawaban yang dikirim! Silakan pilih jawaban sebelum menyelesaikan kuis.');
        }

        $score = 0;
        $total = count($answers);
        $results = [];
        $title = 'Hasil Kuis Anda';

        foreach ($answers as $id => $answer) {
            $question = $this->quizModel->find($id);

            if ($question) {
                $correct_answer = strtoupper($question['jawaban_benar'] ?? '');
                $user_answer_label = strtoupper($answer);
                $is_correct = $correct_answer === $user_answer_label;

                if ($is_correct) {
                    $score++;
                }

                // Logika Perbaikan: Ambil Teks Jawaban Pilihan
                $user_choice_key = 'pilihan_' . strtolower($user_answer_label);
                $correct_choice_key = 'pilihan_' . strtolower($correct_answer);

                // Pastikan key ada dan gunakan null coalescing operator untuk fallback
                $user_answer_text = $question[$user_choice_key] ?? null;
                $correct_answer_text = $question[$correct_choice_key] ?? null;

                $results[] = [
                    'question'           => $question['pertanyaan'] ?? 'N/A',

                    // Label jawaban (A, B, C, D)
                    'user_answer_label'  => $user_answer_label,
                    'correct_answer_label' => $correct_answer,

                    // Teks lengkap dari pilihan (PENTING untuk view)
                    'user_answer_text'   => $user_answer_text,
                    'correct_answer_text' => $correct_answer_text,

                    'is_correct'         => $is_correct,
                ];
            }
        }

        $percentage = ($total > 0) ? round(($score / $total) * 100, 2) : 0;

        $data = [
            'score'      => $score,
            'total'      => $total,
            'percentage' => $percentage,
            'results'    => $results,
            'title'      => $title
        ];

        return view('kerajaan/result_page', $data);
    }
}
