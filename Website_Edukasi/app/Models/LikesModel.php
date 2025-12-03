<?php
namespace App\Models;
use CodeIgniter\Model;

class LikesModel extends Model
{
    protected $table = 'likes';
    protected $primaryKey = 'id';

    protected $allowedFields = ['tutor_id', 'content_id'];
}
