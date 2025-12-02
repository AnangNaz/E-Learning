<?php

namespace App\Models;

use CodeIgniter\Model;

class MapelModel extends Model
{
    protected $table      = 'mapel';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'id', 'tutor_id', 'nama_kerajaan', 'tahun_berdiri',
        'lokasi', 'deskripsi', 'daftar_raja', 'foto_raja',
        'date', 'status'
    ];
}
