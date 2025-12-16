<?php

namespace App\Models;

use CodeIgniter\Model;

class SoalModel extends Model
{
    protected $table      = 'soal_quiz'; // Ubah ke nama tabel yang benar
    protected $primaryKey = 'id';

    // Ubah allowedFields sesuai dengan struktur tabel
    protected $allowedFields = [
        'mapel_id', 
        'pertanyaan',
        'pilihan_a', 
        'pilihan_b', 
        'pilihan_c', 
        'pilihan_d',
        'jawaban_benar',
        'dibuat_pada',
        'diubah_pada'
    ];

    // Timestamps otomatis dihandle oleh database
    protected $useTimestamps = false; // Karena sudah ada dibuat_pada dan diubah_pada

    // Format tanggal untuk CodeIgniter
    protected $dateFormat = 'datetime';

    // Atur default untuk created_at dan updated_at jika perlu
    // Tapi karena tabel sudah punya kolom sendiri, kita nonaktifkan
    protected $createdField = 'dibuat_pada';
    protected $updatedField = 'diubah_pada';

    // Validasi
    protected $validationRules = [
        'mapel_id' => 'required',
        'pertanyaan' => 'required|min_length[5]',
        'pilihan_a' => 'required',
        'pilihan_b' => 'required',
        'pilihan_c' => 'required',
        'pilihan_d' => 'required',
        'jawaban_benar' => 'required|in_list[a,b,c,d]'
    ];

    protected $validationMessages = [
        'mapel_id' => [
            'required' => 'Mapel ID harus diisi'
        ],
        'pertanyaan' => [
            'required' => 'Pertanyaan harus diisi',
            'min_length' => 'Pertanyaan minimal 5 karakter'
        ],
        'pilihan_a' => [
            'required' => 'Pilihan A harus diisi'
        ],
        'pilihan_b' => [
            'required' => 'Pilihan B harus diisi'
        ],
        'pilihan_c' => [
            'required' => 'Pilihan C harus diisi'
        ],
        'pilihan_d' => [
            'required' => 'Pilihan D harus diisi'
        ],
        'jawaban_benar' => [
            'required' => 'Jawaban benar harus dipilih',
            'in_list' => 'Jawaban harus a, b, c, atau d'
        ]
    ];
}