<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\MapelModel;
use App\Models\TutorModel;

class UpdateMapel extends BaseController
{
    public function index($id)
    {
        $tutor_id = $this->request->getCookie('tutor_id');

        if (!$tutor_id) {
            return redirect()->to('/login');
        }

        $mapelModel = new MapelModel();
        $tutorModel = new TutorModel();

        $profile = $tutorModel->find($tutor_id);

        // Dapatkan data mapel berdasarkan id + tutor id
        $mapel = $mapelModel->where(['id' => $id, 'tutor_id' => $tutor_id])->first();

        if (!$mapel) {
            return redirect()->to('/admin/mapel')->with('error', 'Mapel tidak ditemukan!');
        }

        return view('admin/update_mapel', [
            'profile' => $profile,
            'mapel'   => $mapel
        ]);
    }

    public function update($id)
    {
        $tutor_id = $this->request->getCookie('tutor_id');
        if (!$tutor_id) return redirect()->to('/login');

        $mapelModel = new MapelModel();

        $mapel = $mapelModel->where(['id' => $id, 'tutor_id' => $tutor_id])->first();
        if (!$mapel) {
            return redirect()->to('/admin/mapel')->with('error', 'Data tidak ditemukan!');
        }

        // Ambil input
        $data = [
            'nama_kerajaan' => $this->request->getPost('nama_kerajaan'),
            'tahun_berdiri' => $this->request->getPost('tahun_berdiri'),
            'lokasi'        => $this->request->getPost('lokasi'),
            'deskripsi'     => $this->request->getPost('deskripsi'),
            'daftar_raja'   => $this->request->getPost('daftar_raja'),
            'status'        => $this->request->getPost('status'),
        ];

        // Handle upload foto
        $file = $this->request->getFile('foto_raja');

        if ($file && $file->isValid() && !$file->hasMoved()) {

            $newName = $file->getRandomName();
            $file->move(FCPATH . 'uploaded_files', $newName);

            // Hapus foto lama jika ada
            if ($mapel['foto_raja'] && file_exists(FCPATH . 'uploaded_files/' . $mapel['foto_raja'])) {
                unlink(FCPATH . 'uploaded_files/' . $mapel['foto_raja']);
            }

            $data['foto_raja'] = $newName;
        }

        // Simpan update
        $mapelModel->update($id, $data);

        return redirect()->to('/admin/mapel')->with('success', 'Data berhasil diperbarui!');
    }
}
