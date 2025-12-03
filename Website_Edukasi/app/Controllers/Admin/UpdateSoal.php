<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\SoalModel;
use App\Models\ContentModel;
use App\Models\TutorModel;

class UpdateSoal extends BaseController
{
    public function index($id = null)
    {
        // Cek login
        $tutor_id = $this->request->getCookie('tutor_id');
        if (!$tutor_id) {
            return redirect()->to('/login');
        }

        // Jika tidak ada ID
        if (!$id) {
            return redirect()->to('/admin/soal');
        }

        $soalModel = new SoalModel();
        $contentModel = new ContentModel();
        $tutorModel = new TutorModel();

        // Ambil data soal berdasarkan ID dan tutor_id
        $soal = $soalModel
            ->where('id', $id)
            ->where('tutor_id', $tutor_id)
            ->first();

        if (!$soal) {
            return redirect()->to('/admin/soal')->with('error', 'Soal tidak ditemukan!');
        }

        // Ambil profile tutor
        $profile = $tutorModel->find($tutor_id);

        // Ambil semua video untuk dropdown
        $videos = $contentModel
            ->where('tutor_id', $tutor_id)
            ->findAll();

        $data = [
            'profile' => $profile,
            'soal' => $soal,
            'videos' => $videos,
            'title' => 'Update Soal'
        ];

        return view('admin/update_soal', $data);
    }

public function update($id = null)
{
    // Cek login
    $tutor_id = $this->request->getCookie('tutor_id');
    if (!$tutor_id) {
        return redirect()->to('/login');
    }

    // Jika tidak ada ID
    if (!$id) {
        return redirect()->to('/admin/soal');
    }

    // Validasi input (HAPUS validasi content_id)
    $validation = \Config\Services::validation();
    $validation->setRules([
        'question' => 'required',
        'option_a' => 'required',
        'option_b' => 'required',
        'option_c' => 'required',
        'option_d' => 'required',
        'correct_option' => 'required|in_list[a,b,c,d]',
        // 'content_id' => 'required' // <-- HAPUS INI
    ]);

    if (!$validation->withRequest($this->request)->run()) {
        return redirect()->back()->withInput()->with('errors', $validation->getErrors());
    }

    $soalModel = new SoalModel();

    // Cek apakah soal milik tutor ini
    $existing = $soalModel
        ->where('id', $id)
        ->where('tutor_id', $tutor_id)
        ->first();

    if (!$existing) {
        return redirect()->to('/admin/soal')->with('error', 'Soal tidak ditemukan!');
    }

    // Data untuk update
    $data = [
        'question' => $this->request->getPost('question'),
        'option_a' => $this->request->getPost('option_a'),
        'option_b' => $this->request->getPost('option_b'),
        'option_c' => $this->request->getPost('option_c'),
        'option_d' => $this->request->getPost('option_d'),
        'correct_option' => $this->request->getPost('correct_option'),
        'content_id' => $this->request->getPost('content_id'), // Biarkan apa adanya
        'tutor_id' => $tutor_id
    ];

    // Update soal
    $soalModel->update($id, $data);

    return redirect()->back()->with('success', 'Soal berhasil diperbarui!');
}
}