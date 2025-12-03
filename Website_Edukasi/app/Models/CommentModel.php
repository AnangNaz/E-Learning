<?php

namespace App\Models;

use CodeIgniter\Model;

class CommentModel extends Model
{
    protected $table      = 'comments';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'id', 'content_id', 'user_id', 'tutor_id', 'comment', 'date'
    ];
}
