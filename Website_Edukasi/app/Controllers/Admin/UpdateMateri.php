<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\MateriModel;
use App\Models\TutorModel;

class UpdateMateri extends BaseController
{
    public function index($id)
    {
        $tutor_id = $this->request->getCookie('tutor_id');
        if (!$tutor_id) {
            return redirect()->to('/login');
        }

        $materiModel = new MateriModel();
        $tutorModel  = new TutorModel();

        $profile = $tutorModel->find($tutor_id);

        $materi = $materiModel->where('id', $id)->first();
        if (!$materi) {
            return redirect()->to('/admin/materi')->with('error', 'Materi tidak ditemukan!');
        }

        $data = [
            'profile' => $profile,
            'materi'  => $materi
        ];

        return view('admin/update_materi', $data);
    }

    // proses update
    public function update($id)
    {
        $tutor_id = $this->request->getCookie('tutor_id');
        if (!$tutor_id) {
            return redirect()->to('/login');
        }

        $materiModel = new MateriModel();

        $data = [
            'title'       => $this->request->getPost('title'),
            'description' => $this->request->getPost('description'),
            'materi'      => $this->request->getPost('materi'),
        ];

        $materiModel->update($id, $data);

        return redirect()->back()->with('success', 'Materi berhasil diperbarui!');
    }
}
