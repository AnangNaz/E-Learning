<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ContentModel;
use App\Models\MapelModel;
use App\Models\TutorModel;  
use CodeIgniter\HTTP\ResponseInterface;

class TambahVideo extends BaseController
{
    public function index()
    {
        if (!isset($_COOKIE['tutor_id'])) {
            return redirect()->to('/login');
        }

        $tutor_id = $_COOKIE['tutor_id'];

        // Data untuk header
        $tutorModel = new TutorModel();
        $profile = $tutorModel->find($tutor_id);

        // List mapel
        $mapelModel = new MapelModel();
        $mapel = $mapelModel->orderBy('nama_kerajaan', 'ASC')->findAll();

        return view('admin/tambah_video', [
            'mapel'   => $mapel,
            'profile' => $profile,
        ]);
    }

    public function save()
    {
        if (!isset($_COOKIE['tutor_id'])) {
            return redirect()->to('/login');
        }

        helper(['text']);

        $contentModel = new ContentModel();
        $tutor_id = $_COOKIE['tutor_id'];

        // Data input
        $id         = random_string('alnum', 16);
        $status     = $this->request->getPost('status');
        $title      = $this->request->getPost('title');
        $desc       = $this->request->getPost('description');
        $playlist   = $this->request->getPost('playlist');

        // File uploads
        $thumbFile  = $this->request->getFile('thumb');
        $videoFile  = $this->request->getFile('video');

        // Nama baru
        $thumbNew = random_string('alnum', 16) . '.' . $thumbFile->getExtension();
        $videoNew = random_string('alnum', 16) . '.' . $videoFile->getExtension();

        // Validasi thumbnail max 2MB
        if ($thumbFile->getSize() > 2000000) {
            return redirect()->back()->with('error', 'Ukuran thumbnail maksimal 2MB.');
        }

        // ⬇⬇⬇ S I M P A N  K E  uploaded_files/  SAJA ⬇⬇⬇
        $thumbFile->move(FCPATH . 'uploaded_files/', $thumbNew);
        $videoFile->move(FCPATH . 'uploaded_files/', $videoNew);

        // Insert database
        $contentModel->insert([
            'id'          => $id,
            'tutor_id'    => $tutor_id,
            'playlist_id' => $playlist,
            'title'       => $title,
            'description' => $desc,
            'video'       => $videoNew,
            'thumb'       => $thumbNew,
            'status'      => $status,
        ]);

        return redirect()->back()->with('success', 'Video berhasil diunggah!');
    }
}
