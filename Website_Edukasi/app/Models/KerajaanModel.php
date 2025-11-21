<?php

namespace App\Models;
use CodeIgniter\Model;

class KerajaanModel extends Model
{
    protected $table = 'mapel';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'tutor_id', 'nama_kerajaan', 'tahun_berdiri', 'lokasi',
        'deskripsi', 'daftar_raja', 'foto_raja', 'status'
    ];
}
