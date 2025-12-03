<?php

namespace App\Controllers;

use App\Models\KerajaanModel;

class DaftarKerajaan extends BaseController
{
    public function index()
    {
        $model = new KerajaanModel();

        // Ambil keyword search (jika ada)
        $q = $this->request->getGet('q');

        if (!empty($q)) {
            $model->groupStart()
                ->like('nama_kerajaan', $q)
                ->orLike('lokasi', $q)
                ->orLike('tahun_berdiri', $q)
                ->orLike('deskripsi', $q)
                ->groupEnd();
        }

        $data = [
            "kerajaan" => $model->findAll(),
            "q" => $q
        ];

        return view('kerajaan/daftarKerajaan', $data);
    }
}
