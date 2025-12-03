<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\TutorModel;
use App\Models\ContentModel;
use App\Models\SoalModel;

class TambahSoal extends BaseController
{
    public function index()
    {
        $tutor_id = $this->request->getCookie('tutor_id');

        if (!$tutor_id) {
            return redirect()->to('/login');
        }

        $tutorModel   = new TutorModel();
        $contentModel = new ContentModel();

        $profile = $tutorModel->find($tutor_id);

        // AMBIL VIDEO (CONTENT) -> INI YANG BENAR
        $materi = $contentModel->where('tutor_id', $tutor_id)->findAll();

        return view('admin/tambah_soal', [
            'profile' => $profile,
            'materi'  => $materi
        ]);
    }

    public function simpan()
    {
        $tutor_id = $this->request->getCookie('tutor_id');

        if (!$tutor_id) {
            return redirect()->to('/login');
        }

        $soalModel = new SoalModel();

        $data = [
            'tutor_id'       => $tutor_id,
            'content_id'     => $this->request->getPost('materi_id'),
            'question'       => $this->request->getPost('question'),
            'option_a'       => $this->request->getPost('option_a'),
            'option_b'       => $this->request->getPost('option_b'),
            'option_c'       => $this->request->getPost('option_c'),
            'option_d'       => $this->request->getPost('option_d'),
            'correct_option' => $this->request->getPost('correct'),
        ];

        $soalModel->insert($data);

        return redirect()->back()->with('success', 'Soal berhasil ditambahkan!');
    }
}
