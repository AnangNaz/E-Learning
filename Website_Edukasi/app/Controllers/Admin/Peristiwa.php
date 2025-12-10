<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PeristiwaModel;
use App\Models\KerajaanModel;

class Peristiwa extends BaseController
{
    public function tambah()
    {
        $kerajaanModel = new KerajaanModel();
        $data['kerajaan'] = $kerajaanModel->findAll();

        return view('admin/peristiwa/tambahperistiwa', $data);
    }

    public function simpan()
    {
        $model = new PeristiwaModel();

        $data = [
            'kerajaan_id'    => $this->request->getPost('kerajaan_id'),
            'nama_peristiwa' => $this->request->getPost('nama_peristiwa'),
            'tahun'          => $this->request->getPost('tahun'),
            'deskripsi'      => $this->request->getPost('deskripsi'),
            'fakta_menarik'  => $this->request->getPost('fakta_menarik'),
            'lokasi'         => $this->request->getPost('lokasi'),
        ];

        if ($model->save($data)) {
            return redirect()->to('/admin/peristiwa')->with('success', 'Peristiwa berhasil ditambahkan!');
        }

        return redirect()->back()->with('error', 'Gagal menambahkan peristiwa.');
    }
}
