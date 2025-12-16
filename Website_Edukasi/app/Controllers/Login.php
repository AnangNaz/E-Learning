<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\TutorModel;

class Login extends BaseController
{
    public function index()
    {
        // Jika sudah login, redirect ke dashboard
        $tutor_id = $this->request->getCookie('tutor_id');
        if ($tutor_id) {
            return redirect()->to('/admin/dashboard');
        }

        $data = [
            'title' => 'Login Tutor'
        ];

        return view('login', $data);
    }

    public function process()
    {
        // Validasi input
        $validation = \Config\Services::validation();
        $validation->setRules([
            'email' => 'required|valid_email',
            'pass' => 'required|min_length[3]'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $email = $this->request->getPost('email');
        $password = $this->request->getPost('pass');
        
        // Hash password dengan SHA1
        $hashedPassword = sha1($password);
        
        $tutorModel = new \App\Models\TutorModel();
        $tutor = $tutorModel
            ->where('email', $email)
            ->where('password', $hashedPassword)
            ->first();
        
        if ($tutor) {
            // Set cookie
            $tutor_id = $tutor['id'];
            setcookie('tutor_id', $tutor_id, time() + (60*60*24*30), '/');
            $_COOKIE['tutor_id'] = $tutor_id;
            
            // Redirect ke dashboard
            return redirect()->to('/admin/dashboard');
        } else {
            return redirect()->back()->withInput()->with('error', 'Email atau password salah');
        }
    }

    public function logout()
    {
        // Hapus cookie
        helper('cookie');
        delete_cookie('tutor_id');
        setcookie('tutor_id', '', time() - 3600, '/');
        
        // Destroy session
        session()->destroy();
        
        // Redirect ke login
        return redirect()->to('/login')->with('success', 'Logout berhasil!');
    }
}