<?php

namespace App\Models;

use CodeIgniter\Model;

class TutorModel extends Model
{
    protected $table      = 'tutors';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'id', 'name', 'profession', 'email', 'password', 'image'
    ];
}
