<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\MapelModel;
use App\Models\MateriModel;
use App\Models\TutorModel;

class TambahMateri extends BaseController
{
    public function index()
    {
        $tutor_id = $this->request->getCookie('tutor_id');

        if (!$tutor_id) {
            return redirect()->to('/login');
        }

        $mapelModel = new MapelModel();
        $tutorModel = new TutorModel();

        $profile = $tutorModel->find($tutor_id);

        $data = [
            'profile' => $profile,
            'mapel'   => $mapelModel->where('tutor_id', $tutor_id)->findAll()
        ];

        return view('admin/tambah_materi', $data);
    }

    public function store()
    {
        $tutor_id = $this->request->getCookie('tutor_id');

        if (!$tutor_id) {
            return redirect()->to('/login');
        }

        $materiModel = new MateriModel();

        $data = [
            'tutor_id'    => $tutor_id,
            'playlist_id' => $this->request->getPost('mapel_id'),
            'title'       => $this->request->getPost('title'),
            'description' => $this->request->getPost('description'),
            'materi'      => $this->request->getPost('materi'),
        ];

        $materiModel->insert($data);

        return redirect()->to('/admin/mapel')->with('success', 'Materi berhasil ditambahkan!');
    }
}
