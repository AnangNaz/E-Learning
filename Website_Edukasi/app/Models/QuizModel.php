<?php namespace App\Models;

use CodeIgniter\Model;

class QuizModel extends Model
{
    protected $table = 'soal_quiz';
    protected $primaryKey = 'id';
    protected $allowedFields = ['mapel_id', 'pertanyaan', 'pilihan_a', 'pilihan_b', 'pilihan_c', 'pilihan_d', 'jawaban_benar'];
    // Asumsi: Primary Key soal_quiz adalah INTEGER/UUID, bukan VARCHAR

    /**
     * Mengambil N pertanyaan secara acak dari semua kerajaan.
     * @param int $limit
     * @return array
     */
    public function getRandomQuestions(int $limit)
    {
        return $this->select('*')
                    ->orderBy('RAND()') // Fungsi SQL untuk pengurutan acak
                    ->limit($limit)
                    ->findAll();
    }

    /**
     * Mengambil N pertanyaan secara spesifik berdasarkan ID Kerajaan (mapel_id/VARCHAR).
     * @param string $kerajaanId ID Kerajaan (VARCHAR)
     * @param int $limit
     * @return array
     */
    public function getSpecificQuestions(string $kerajaanId, int $limit)
    {
        return $this->select('*')
                    ->where('mapel_id', $kerajaanId)
                    ->orderBy('RAND()')
                    ->limit($limit)
                    ->findAll();
    }
}