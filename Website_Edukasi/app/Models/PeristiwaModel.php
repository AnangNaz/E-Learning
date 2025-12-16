<?php

namespace App\Models;

use CodeIgniter\Model;

class PeristiwaModel extends Model
{
    protected $table = 'peristiwa';
    protected $primaryKey = 'id';

    // SESUAIKAN dengan kolom yang ada di database
    protected $allowedFields = [
        'kerajaan_id',      // varchar(50)
        'nama_peristiwa',   // varchar(255)
        'tahun',            // varchar(50) - OPSIONAL
        'deskripsi',        // text
        'fakta_menarik',    // text - OPSIONAL
        'lokasi',           // varchar(255) - OPSIONAL
        'foto_peristiwa'    // varchar(255) - OPSIONAL
    ];

    public $useTimestamps = false;
}