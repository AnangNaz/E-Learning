<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\TutorModel;
use App\Models\MateriModel;
use App\Models\MapelModel;
use App\Models\CommentModel;
use App\Models\RajaModel;
use App\Models\PeristiwaModel; // Tambahkan ini
use App\Models\SoalModel;      // Tambahkan ini

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
        $peristiwa = new PeristiwaModel(); // Tambahkan ini
        $soal      = new SoalModel();      // Tambahkan ini

        $profile = $tutors->find($tutor_id);
        
        // Hitung total raja dari semua mapel milik tutor ini
        $totalRaja = 0;
        $mapels = $mapel->where('tutor_id', $tutor_id)->findAll();
        
        foreach ($mapels as $mapelItem) {
            $totalRaja += $raja->where('mapel_id', $mapelItem['id'])->countAllResults();
        }

        // Hitung total peristiwa dari semua mapel milik tutor ini
        $totalPeristiwa = 0;
        foreach ($mapels as $mapelItem) {
            $totalPeristiwa += $peristiwa->where('kerajaan_id', $mapelItem['id'])->countAllResults();
        }

        // Hitung total soal (asumsi soal tidak terikat ke tutor tertentu)
        $totalSoal = $soal->countAllResults();

        return view('admin/dashboard', [
            'profile'         => $profile,
            'total_contents'  => $materi->where('tutor_id', $tutor_id)->countAllResults(),
            'total_mapel'     => count($mapels),
            'total_raja'      => $totalRaja,
            'total_peristiwa' => $totalPeristiwa, // Tambahkan ini
            'total_soal'      => $totalSoal       // Tambahkan ini
        ]);
    }
}