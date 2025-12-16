<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\TutorModel;

class Register extends BaseController
{
    public function index()
    {
        // Jika sudah login, redirect ke dashboard
        $tutor_id = $this->request->getCookie('tutor_id');
        if ($tutor_id) {
            return redirect()->to('/admin/dashboard');
        }

        $data = [
            'title' => 'Register Tutor'
        ];

        return view('register', $data);
    }

    public function process()
    {
        // Validasi input
        $validation = \Config\Services::validation();
        $validation->setRules([
            'name' => 'required|min_length[3]|max_length[50]',
            'profession' => 'required|in_list[developer,teacher]',
            'email' => 'required|valid_email|max_length[20]',
            'pass' => 'required|min_length[3]|max_length[20]',
            'cpass' => 'required|matches[pass]',
            'image' => 'uploaded[image]|max_size[image,2048]|is_image[image]|mime_in[image,image/jpg,image/jpeg,image/png,image/gif]'
        ], [
            'cpass' => [
                'matches' => 'Confirm password not matched!'
            ]
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        // Ambil data dari form
        $name = $this->request->getPost('name');
        $profession = $this->request->getPost('profession');
        $email = $this->request->getPost('email');
        $password = sha1($this->request->getPost('pass'));
        $image = $this->request->getFile('image');

        // Cek apakah email sudah terdaftar
        $tutorModel = new TutorModel();
        $existingTutor = $tutorModel->where('email', $email)->first();
        
        if ($existingTutor) {
            return redirect()->back()->withInput()->with('error', 'Email already taken!');
        }

        // Generate unique ID
        $id = uniqid();

        // Proses upload gambar
        $newName = $id . '.' . $image->getExtension();
        $image->move(ROOTPATH . 'public/uploaded_files', $newName);

        // Simpan data ke database
        $data = [
            'id' => $id,
            'name' => $name,
            'profession' => $profession,
            'email' => $email,
            'password' => $password,
            'image' => $newName
        ];

        if ($tutorModel->insert($data)) {
            return redirect()->to('/login')->with('success', 'New tutor registered! Please login now.');
        } else {
            return redirect()->back()->withInput()->with('error', 'Registration failed. Please try again.');
        }
    }
}