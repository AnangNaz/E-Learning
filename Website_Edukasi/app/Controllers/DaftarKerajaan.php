<?php

namespace App\Controllers;

use App\Models\KerajaanModel;

class DaftarKerajaan extends BaseController
{
    public function index()
    {
        $model = new KerajaanModel();

        $data = [
            "kerajaan" => $model->findAll()
        ];

        return view('kerajaan/daftarKerajaan', $data);
    }
}
