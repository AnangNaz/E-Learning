<?php

namespace App\Models;

use CodeIgniter\Model;

class ContentModel extends Model
{
    protected $table      = 'content';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'tutor_id', 'title', 'description', 'thumb', 'video',
        'date', 'status'
    ];
}