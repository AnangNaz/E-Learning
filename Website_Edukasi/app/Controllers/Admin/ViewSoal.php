<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\SoalModel;
use App\Models\MateriModel;
use App\Models\TutorModel;

class ViewSoal extends BaseController
{
    public function index($id = null)
    {
        // Cek login
        $tutor_id = $this->request->getCookie('tutor_id');
        if (!$tutor_id) {
            return redirect()->to('/login');
        }

        // Jika tidak ada ID dari parameter URL
        if (!$id) {
            // Coba ambil dari GET parameter
            $id = $this->request->getGet('id') ?? $this->request->getGet('get_id');
            
            if (!$id) {
                return redirect()->to('/admin/soal')->with('error', 'ID soal tidak ditemukan!');
            }
        }

        $soalModel = new SoalModel();
        $materiModel = new MateriModel();
        $tutorModel = new TutorModel();

        // Query untuk ambil soal dengan join materi
        $db = \Config\Database::connect();
        $builder = $db->table('soal');
        $builder->select('soal.*, materi.title as materi_title');
        $builder->join('materi', 'materi.id = soal.content_id', 'left');
        $builder->where('soal.id', $id);
        $builder->where('soal.tutor_id', $tutor_id);
        $query = $builder->get();
        
        if ($query->getNumRows() == 0) {
            return redirect()->to('/admin/soal')->with('error', 'Soal tidak ditemukan!');
        }

        $data = $query->getRowArray();

        // Ambil profile tutor
        $profile = $tutorModel->find($tutor_id);

        $viewData = [
            'profile' => $profile,
            'data' => $data,
            'title' => 'Detail Soal'
        ];

        return view('admin/view_soal', $viewData);
    }
}