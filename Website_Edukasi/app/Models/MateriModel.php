<?php

namespace App\Models;

use CodeIgniter\Model;

class MateriModel extends Model
{
    protected $table      = 'materi';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'tutor_id', 'playlist_id', 'title', 'description',
        'date', 'status', 'materi'
    ];
}
