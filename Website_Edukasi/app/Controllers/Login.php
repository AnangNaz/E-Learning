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

    // DEBUG
    echo "<h3>LOGIN PROCESS DEBUG</h3>";
    echo "Email: $email<br>";
    echo "Password Hash: $hashedPassword<br>";
    
    // INISIALISASI VARIABLE $tutor DULU
    $tutor = null;
    
    try {
        // Cek apakah model TutorModel ada
        if (!class_exists('App\Models\TutorModel')) {
            echo "ERROR: TutorModel class not found!<br>";
            echo "Make sure file exists at: app/Models/TutorModel.php<br>";
            exit;
        }
        
        $tutorModel = new \App\Models\TutorModel();
        echo "TutorModel instantiated successfully<br>";
        
        // Cek data di database
        $tutor = $tutorModel
            ->where('email', $email)
            ->where('password', $hashedPassword)
            ->first();
            
        echo "Database query executed<br>";
        
    } catch (\Exception $e) {
        echo "ERROR: " . $e->getMessage() . "<br>";
        echo "Line: " . $e->getLine() . "<br>";
        exit;
    }
    
    // SEKARANG CEK $tutor
    echo "Tutor data: ";
    var_dump($tutor);
    echo "<br>";
    
    if ($tutor && !empty($tutor)) {
        echo "<h3 style='color:green'>LOGIN BERHASIL!</h3>";
        echo "Tutor ID: " . $tutor['id'] . "<br>";
        echo "Tutor Name: " . ($tutor['name'] ?? 'N/A') . "<br>";
        
        // Set cookie
        $tutor_id = $tutor['id'];
        setcookie('tutor_id', $tutor_id, time() + (60*60*24*30), '/');
        $_COOKIE['tutor_id'] = $tutor_id;
        
        echo "Cookie tutor_id telah di-set: $tutor_id<br>";
        
        // Redirect ke dashboard
        echo "<script>
            setTimeout(function() {
                window.location.href = '" . base_url('admin/dashboard') . "';
            }, 2000);
        </script>";
        
    } else {
        echo "<h3 style='color:red'>LOGIN GAGAL!</h3>";
        echo "Tidak ditemukan tutor dengan email dan password tersebut.<br>";
        
        // Cek apakah email ada di database
        try {
            $tutorModel = new \App\Models\TutorModel();
            $checkEmail = $tutorModel->where('email', $email)->first();
            
            if ($checkEmail) {
                echo "Email ditemukan, tapi password salah.<br>";
                echo "Password di database: " . $checkEmail['password'] . "<br>";
                echo "Password yang dimasukkan (hash): $hashedPassword<br>";
            } else {
                echo "Email tidak ditemukan di database.<br>";
            }
        } catch (\Exception $e) {
            echo "Error checking email: " . $e->getMessage();
        }
        
        echo "<br><a href='/login'>Kembali ke Login</a>";
    }
    
    exit;
}

public function logout()
{
    // Hapus cookie dengan 3 cara sekaligus
    helper('cookie');
    
    // Cara 1: delete_cookie()
    delete_cookie('tutor_id');
    
    // Cara 2: set_cookie dengan waktu expired
    set_cookie('tutor_id', '', -3600);
    
    // Cara 3: PHP native
    setcookie('tutor_id', '', time() - 3600, '/');
    
    // Destroy session
    session()->destroy();
    
    // Redirect ke login
    return redirect()->to('/login')->with('success', 'Logout berhasil!');
}
}