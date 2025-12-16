<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\TutorModel;

class Update extends BaseController
{
    public function index()
    {
        // Cek cookie login untuk admin
        $tutor_id = $this->request->getCookie('tutor_id');
        if (!$tutor_id) {
            return redirect()->to('/admin/login')->with('error', 'Please login first!');
        }

        // Ambil data tutor dari database
        $tutorModel = new TutorModel();
        $profile = $tutorModel->find($tutor_id);
        
        if (!$profile) {
            // Hapus cookie jika data tidak ditemukan
            helper('cookie');
            delete_cookie('tutor_id');
            return redirect()->to('/admin/login')->with('error', 'Session expired!');
        }

        $data = [
            'title' => 'Update Profile - Admin',
            'profile' => $profile // Menggunakan $profile
        ];

        return view('admin/update', $data);
    }

    public function process()
    {
        // Cek cookie login untuk admin
        $tutor_id = $this->request->getCookie('tutor_id');
        if (!$tutor_id) {
            return redirect()->to('/admin/login')->with('error', 'Please login first!');
        }

        // Ambil data tutor dari database
        $tutorModel = new TutorModel();
        $profile = $tutorModel->find($tutor_id);
        
        if (!$profile) {
            // Hapus cookie jika data tidak ditemukan
            helper('cookie');
            delete_cookie('tutor_id');
            return redirect()->to('/admin/login')->with('error', 'Session expired!');
        }

        $prev_pass = $profile['password'];
        $prev_image = $profile['image'];
        $empty_pass = 'da39a3ee5e6b4b0d3255bfef95601890afd80709'; // sha1('')
        
        // Inisialisasi messages
        $messages = [];

        // Proses update jika ada data yang diubah
        $name = $this->request->getPost('name');
        $profession = $this->request->getPost('profession');
        $email = $this->request->getPost('email');
        $old_pass = sha1($this->request->getPost('old_pass') ?? '');
        $new_pass = sha1($this->request->getPost('new_pass') ?? '');
        $cpass = sha1($this->request->getPost('cpass') ?? '');
        $image = $this->request->getFile('image');

        // Update name
        if (!empty($name) && $name != $profile['name']) {
            $tutorModel->update($tutor_id, ['name' => $name]);
            $messages[] = 'Username updated successfully!';
        }

        // Update profession
        if (!empty($profession) && $profession != $profile['profession']) {
            $tutorModel->update($tutor_id, ['profession' => $profession]);
            $messages[] = 'Profession updated successfully!';
        }

        // Update email
        if (!empty($email) && $email != $profile['email']) {
            // Cek apakah email sudah digunakan
            $existingProfile = $tutorModel->where('email', $email)->first();
            
            if ($existingProfile && $existingProfile['id'] != $tutor_id) {
                $messages[] = 'Email already taken!';
            } else {
                $tutorModel->update($tutor_id, ['email' => $email]);
                $messages[] = 'Email updated successfully!';
            }
        }

        // Update image
        if ($image && $image->isValid() && !$image->hasMoved()) {
            // Validasi ukuran file (max 2MB)
            if ($image->getSize() > 2000000) {
                $messages[] = 'Image size too large!';
            } else {
                $newName = uniqid() . '.' . $image->getExtension();
                $image->move(ROOTPATH . 'public/uploaded_files', $newName);
                
                $tutorModel->update($tutor_id, ['image' => $newName]);
                
                // Hapus gambar lama jika bukan default
                if (!empty($prev_image) && file_exists(ROOTPATH . 'public/uploaded_files/' . $prev_image)) {
                    unlink(ROOTPATH . 'public/uploaded_files/' . $prev_image);
                }
                
                $messages[] = 'Image updated successfully!';
            }
        }

        // Update password
        if ($old_pass != $empty_pass) {
            if ($old_pass != $prev_pass) {
                $messages[] = 'Old password not matched!';
            } elseif ($new_pass != $cpass) {
                $messages[] = 'Confirm password not matched!';
            } else {
                if ($new_pass != $empty_pass) {
                    $tutorModel->update($tutor_id, ['password' => $cpass]);
                    $messages[] = 'Password updated successfully!';
                } else {
                    $messages[] = 'Please enter a new password!';
                }
            }
        }

        // Update data profile untuk session
        if (!empty($messages)) {
            // Refresh data profile
            $updatedProfile = $tutorModel->find($tutor_id);
            session()->set('profile', $updatedProfile);
        }

        // Redirect dengan messages
        if (!empty($messages)) {
            return redirect()->to('/admin/update')->with('messages', $messages);
        } else {
            return redirect()->to('/admin/update')->with('info', 'No changes made.');
        }
    }
}