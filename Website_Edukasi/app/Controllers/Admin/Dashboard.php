<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\TutorModel;
use App\Models\MateriModel;
use App\Models\MapelModel;
use App\Models\CommentModel;
use App\Models\RajaModel;

class Dashboard extends BaseController
{
    public function index()
    {
        // ambil cookie dengan cara CI4 yang benar
        $tutor_id = $this->request->getCookie('tutor_id');

        if (!$tutor_id) {
            return redirect()->to('/login');
        }

        $tutors  = new TutorModel();
        $materi  = new MateriModel();
        $mapel   = new MapelModel();

        $raja    = new RajaModel();

        $profile = $tutors->find($tutor_id);
        
        // Hitung total raja dari semua mapel milik tutor ini
        $totalRaja = 0;
        $mapels = $mapel->where('tutor_id', $tutor_id)->findAll();
        
        foreach ($mapels as $mapelItem) {
            $totalRaja += $raja->where('mapel_id', $mapelItem['id'])->countAllResults();
        }

        return view('admin/dashboard', [
            'profile'        => $profile,
            'total_contents' => $materi->where('tutor_id', $tutor_id)->countAllResults(),
            'total_mapel'    => count($mapels), // atau $mapel->where('tutor_id', $tutor_id)->countAllResults()
            'total_raja'     => $totalRaja, // Tambahkan ini
        ]);
    }
}