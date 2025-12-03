<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\MateriModel;
use App\Models\TutorModel;

class ViewMateri extends BaseController
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

        // Ambil data materi sesuai ID dan tutor
        $materi = $materiModel
                    ->where('id', $id)
                    ->where('tutor_id', $tutor_id)
                    ->first();

        if (!$materi) {
            return redirect()->to('/admin/materi')->with('error', 'Materi tidak ditemukan!');
        }

        return view('admin/view_materi', [
            'profile' => $profile,
            'materi'  => $materi
        ]);
    }
}
