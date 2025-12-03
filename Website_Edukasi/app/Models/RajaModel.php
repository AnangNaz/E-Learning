<?php
namespace App\Models;

use CodeIgniter\Model;

class RajaModel extends Model
{
    protected $table = 'raja';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'mapel_id',
        'nama', 
        'foto', 
        'cerita',
        'longitude',
        'latitude'
        // JANGAN tambah 'created_at' di sini karena bukan input dari form
    ];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = false;
    
    // Konstruktor untuk debug
    public function __construct()
    {
        parent::__construct();
        // echo "RajaModel initialized<br>";
    }
    
    // Override insert method untuk debug
    public function insert($data = null, bool $returnID = true)
    {
        echo "DEBUG - Data to insert:<pre>";
        print_r($data);
        echo "</pre>";
        
        // Hapus created_at jika ada (karena sudah dihandle oleh useTimestamps)
        if (isset($data['created_at'])) {
            unset($data['created_at']);
        }
        
        return parent::insert($data, $returnID);
    }
}