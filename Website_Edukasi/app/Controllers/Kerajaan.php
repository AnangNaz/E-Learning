<?php

namespace App\Controllers;
use App\Models\KerajaanModel;

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
        $model = new KerajaanModel();
        $data['kerajaan'] = $model->find($id);

        if (!$data['kerajaan']) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Data kerajaan tidak ditemukan");
        }

        return view('kerajaan/detail', $data);
    }
}
