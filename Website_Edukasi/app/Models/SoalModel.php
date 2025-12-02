<?php

namespace App\Models;

use CodeIgniter\Model;

class SoalModel extends Model
{
    protected $table      = 'soal';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'tutor_id', 'content_id', 'question',
        'option_a', 'option_b', 'option_c', 'option_d',
        'correct_option', 'date'
    ];
}
