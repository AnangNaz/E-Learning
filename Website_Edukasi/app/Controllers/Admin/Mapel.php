<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\MapelModel;
use App\Models\TutorModel;

class Mapel extends BaseController
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
            'mapel'   => $mapelModel->where('tutor_id', $tutor_id)->orderBy('date', 'DESC')->findAll()
        ];

        return view('admin/mapel', $data);
    }

    // ========== DELETE KERAJAAN ==========
    public function delete($id)
    {
        $tutor_id = $this->request->getCookie('tutor_id');


        if (!$tutor_id) {
            return redirect()->to('/login');
        }

        $mapelModel = new MapelModel();

        // cek apakah data sesuai tutor
        $mapel = $mapelModel->where(['id' => $id, 'tutor_id' => $tutor_id])->first();

        if (!$mapel) {
            return redirect()->back()->with('error', 'Kerajaan tidak ditemukan!');
        }

        // hapus file foto
        if (!empty($mapel['foto_raja']) && file_exists(FCPATH . 'uploaded_files/' . $mapel['foto_raja'])) {
            unlink(FCPATH . 'uploaded_files/' . $mapel['foto_raja']);
        }

        // hapus data
        $mapelModel->delete($id);

        return redirect()->back()->with('success', 'Kerajaan berhasil dihapus!');
    }
}
