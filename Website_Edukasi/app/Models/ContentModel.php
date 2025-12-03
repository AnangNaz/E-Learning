<?php

namespace App\Models;

use CodeIgniter\Model;

class ContentModel extends Model
{
    protected $table      = 'content';
    protected $primaryKey = 'id';

protected $allowedFields = [
   'id','tutor_id','playlist_id','title','description',
        'video','thumb','status'
    ];

}