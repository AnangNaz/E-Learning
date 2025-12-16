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
    ];
    
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = null;
    
    /**
     * Method untuk ambil raja dengan JOIN ke mapel
     * Filter berdasarkan tutor_id di tabel MAPEL, bukan di tabel RAJA
     */
    public function getRajaByTutorId($tutor_id)
    {
        return $this->db->table('raja')
            ->select('raja.*, mapel.nama as mapel_nama, mapel.tutor_id')
            ->join('mapel', 'mapel.id = raja.mapel_id')
            ->where('mapel.tutor_id', $tutor_id) // Filter di tabel MAPEL
            ->orderBy('raja.created_at', 'DESC')
            ->get()
            ->getResultArray();
    }
    
    /**
     * Method alternatif tanpa JOIN (lebih aman)
     */
    public function getRajaByMapelIds(array $mapel_ids)
    {
        if (empty($mapel_ids)) {
            return [];
        }
        
        return $this->db->table('raja')
            ->whereIn('mapel_id', $mapel_ids)
            ->orderBy('created_at', 'DESC')
            ->get()
            ->getResultArray();
    }
}