<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\MapelModel;
use App\Models\PeristiwaModel; // Ganti dengan PeristiwaModel
use App\Models\SoalModel;
use App\Models\TutorModel;

class ViewMapel extends BaseController
{
    public function index($id)
    {
        $tutor_id = $this->request->getCookie('tutor_id');
        if (!$tutor_id) {
            return redirect()->to('/login');
        }

        $mapelModel     = new MapelModel();
        $peristiwaModel = new PeristiwaModel(); // Ganti ContentModel dengan PeristiwaModel
        $soalModel      = new SoalModel();
        $tutorModel     = new TutorModel();

        // ambil profil tutor
        $profile = $tutorModel->find($tutor_id);

        // Hapus filter tutor_id agar semua mapel bisa dilihat
        $mapel = $mapelModel->find($id);
        
        if (!$mapel) {
            return redirect()->back()->with('error', 'Kerajaan tidak ditemukan!');
        }

        // Ambil peristiwa berdasarkan kerajaan_id (ganti playlist_id dengan kerajaan_id)
        $peristiwa = $peristiwaModel->where('kerajaan_id', $id)->findAll();
        
        // Ambil soal
        $soal = $soalModel->where('mapel_id', $id)->findAll();

        $data = [
            'profile'    => $profile,
            'mapel'      => $mapel,
            'peristiwa'  => $peristiwa, // Ganti videos dengan peristiwa
            'soal'       => $soal,
        ];

        return view('admin/view_mapel', $data);
    }
}