<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\TutorModel;

class TambahMapel extends BaseController
{
    public function index()
    {
        $tutor_id = $this->request->getCookie('tutor_id');

        if (!$tutor_id) {
            return redirect()->to('/login');
        }

        $tutorModel = new TutorModel();
        $profile = $tutorModel->find($tutor_id);

        return view('admin/tambah_mapel', [
            'profile' => $profile
        ]);
    }

    public function store()
    {
        $tutor_id = $this->request->getCookie('tutor_id');
        if (!$tutor_id) {
            return redirect()->to('/login');
        }

        // Ambil data POST
        $id            = uniqid(); // fungsi unik
        $nama          = $this->request->getPost('nama_kerajaan');
        $tahun         = $this->request->getPost('tahun_berdiri');
        $lokasi        = $this->request->getPost('lokasi');
        $deskripsi     = $this->request->getPost('deskripsi');
        $daftar_raja   = $this->request->getPost('daftar_raja');
        $status        = $this->request->getPost('status');

        // Upload File Foto
        $image = $this->request->getFile('foto_raja');
        $newName = $image->getRandomName();
        $image->move('uploaded_files', $newName);

        // Insert data database
        $db = \Config\Database::connect();
        $query = $db->table('mapel')->insert([
            'id'            => $id,
            'tutor_id'      => $tutor_id,
            'nama_kerajaan' => $nama,
            'tahun_berdiri' => $tahun,
            'lokasi'        => $lokasi,
            'deskripsi'     => $deskripsi,
            'daftar_raja'   => $daftar_raja,
            'foto_raja'     => $newName,
            'status'        => $status
        ]);

        if ($query) {
            return redirect()->to('/admin/tambah-mapel')->with('success', 'Kerajaan berhasil ditambahkan!');
        } else {
            return redirect()->back()->with('error', 'Gagal menambahkan data!');
        }
    }
}
