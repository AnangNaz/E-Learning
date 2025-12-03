<?php

namespace App\Controllers;

use App\Models\KerajaanModel;
use App\Models\PeristiwaModel;

class Kerajaan extends BaseController
{
    public function index()
    {
        $model = new KerajaanModel();
        $data['kerajaan'] = $model->where('status', 'active')->findAll();

        return view('kerajaan/index', $data);
    }

    public function detail($id)
    {
        $kerajaanModel = new KerajaanModel();
        $peristiwaModel = new PeristiwaModel();

        // Ambil data kerajaan
        $data['kerajaan'] = $kerajaanModel->find($id);

        if (!$data['kerajaan']) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        // Ambil peristiwa yang terkait
        $data['peristiwa'] = $peristiwaModel
            ->where('kerajaan_id', $id)
            ->orderBy('tahun', 'ASC')
            ->findAll();

        return view('kerajaan/detail', $data);
    }
}
