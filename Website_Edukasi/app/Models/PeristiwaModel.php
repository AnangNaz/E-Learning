<?php

namespace App\Models;

use CodeIgniter\Model;

class PeristiwaModel extends Model
{
    protected $table = 'peristiwa';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'kerajaan_id',
        'judul',
        'tahun',
        'deskripsi'
    ];

    public $useTimestamps = false;
}
