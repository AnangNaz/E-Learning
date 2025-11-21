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
}
