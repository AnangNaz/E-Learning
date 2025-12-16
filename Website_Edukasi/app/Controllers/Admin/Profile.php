<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\TutorModel;
use App\Models\MateriModel;
use App\Models\MapelModel;
use App\Models\LikesModel;
use App\Models\CommentModel;
use App\Models\RajaModel;

class Profile extends BaseController
{
    public function index()
    {
        $tutorId = $_COOKIE['tutor_id'] ?? null;
        
        if (!$tutorId) {
            return redirect()->to('/login');
        }

        $tutorModel   = new TutorModel();
        $materiModel  = new MateriModel();
        $mapelModel   = new MapelModel();
        $likeModel    = new LikesModel();
        
        $RajaModel    = new RajaModel();

        $profile = $tutorModel->find($tutorId);
        
        // Ambil SEMUA mapel milik tutor
        $allMapels = $mapelModel->where('tutor_id', $tutorId)->findAll();
        
        // Hitung total raja dari SEMUA mapel
        $totalRaja = 0;
        $firstMapelId = null;
        $mapelWithRaja = [];
        
        if (!empty($allMapels)) {
            // Ambil ID mapel pertama untuk link
            $firstMapelId = $allMapels[0]['id'];
            
            // Hitung total raja dari semua mapel
            foreach ($allMapels as $mapel) {
                $countRaja = $RajaModel->where('mapel_id', $mapel['id'])->countAllResults();
                $totalRaja += $countRaja;
                
                // Simpan mapel yang punya raja
                if ($countRaja > 0) {
                    $mapelWithRaja[] = [
                        'id' => $mapel['id'],
                        'nama_mapel' => $mapel['nama_mapel'] ?? 'Mapel',
                        'count_raja' => $countRaja
                    ];
                }
            }
        }

        $data = [
            'profile'         => $profile,
            'total_mapel'     => count($allMapels),
            'total_materi'    => $materiModel->where('tutor_id', $tutorId)->countAllResults(),
            'total_likes'     => $likeModel->where('tutor_id', $tutorId)->countAllResults(),
            'total_Raja'      => $totalRaja,
            'mapel_id'        => $firstMapelId,
            'all_mapels'      => $allMapels,
            'mapel_with_raja' => $mapelWithRaja,
        ];

        return view('admin/profile', $data);
    }
}