<?php

namespace App\Controllers;

use App\Models\UserModel;

class AuthController extends BaseController
{
    public function landing()
    {
        if (session()->get('isLoggedIn')) {
            if (session()->get('role') === 'admin') {
                return redirect()->to('/admin/dashboard');
            } else {
                return $this->redirectUserBasedOnAssessment(session()->get('id'));
            }
        }
        return view('landing_page');
    }

    public function index()
    {
        if (session()->get('isLoggedIn')) {
            if (session()->get('role') === 'admin') {
                return redirect()->to('/admin/dashboard');
            } else {
                return $this->redirectUserBasedOnAssessment(session()->get('id'));
            }
        }
        
        return view('auth/login');
    }

    public function process()
    {
        $session = session();
        $userModel = new UserModel();

        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');

        $dataUser = $userModel->where('username', $username)->first();

        if ($dataUser) {
            if (password_verify($password, $dataUser['password'])) {
                $sessionData = [
                    'id'         => $dataUser['id'],
                    'username'   => $dataUser['username'],
                    'role'       => $dataUser['role'],
                    'isLoggedIn' => TRUE
                ];
                $session->set($sessionData);

                if ($dataUser['role'] === 'admin') {
                    return redirect()->to('/admin/dashboard');
                } else {
                    return $this->redirectUserBasedOnAssessment($dataUser['id']);
                }
            } else {
                $session->setFlashdata('error', 'Password salah!');
                return redirect()->to('/login');
            }
        } else {
            $session->setFlashdata('error', 'Username tidak ditemukan!');
            return redirect()->to('/login');
        }
    }

    public function register()
    {
        return view('auth/register');
    }

    public function register_process()
    {
        $db = \Config\Database::connect();
        
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');
        $nama_kampus = $this->request->getVar('nama_kampus');

        $existingUser = $db->table('users')->where('username', $username)->get()->getRow();
        if ($existingUser) {
            return redirect()->back()->with('error', 'Gagal! Username tersebut sudah terdaftar.');
        }

        $userData = [
            'username' => $username,
            'password' => password_hash($password, PASSWORD_BCRYPT),
            'role'     => 'user'
        ];
        $db->table('users')->insert($userData);
        $userId = $db->insertID();

        $db->table('campuses')->insert([
            'user_id'     => $userId,
            'nama_kampus' => $nama_kampus,
            'alamat'      => '-'
        ]);

        return redirect()->to('/login')->with('success', 'Registrasi berhasil! Silakan login menggunakan akun Anda.');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }

    private function redirectUserBasedOnAssessment($userId)
    {
        $db = \Config\Database::connect();
        
        $campus = $db->table('campuses')->where('user_id', $userId)->get()->getRow();
        
        if ($campus) {
            $hasAssessment = $db->table('assessments')->where('campus_id', $campus->id)->countAllResults();
            
            if ($hasAssessment > 0) {
                return redirect()->to('/user/dashboard');
            }
        }
        
        return redirect()->to('/user/assessment');
    }
}