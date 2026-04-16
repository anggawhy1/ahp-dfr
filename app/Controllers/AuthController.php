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

        if (!$this->validate([
            'username'     => 'required|is_unique[users.username]',
            'nama_lengkap' => 'required',
            'email'        => 'required|valid_email',
            'nama_kampus'  => 'required',
            'password'     => 'required|min_length[5]',
        ])) {
            return redirect()->back()->withInput()->with('error', 'Cek kembali form Anda (Email harus valid & Username harus unik)');
        }

        $userData = [
            'username'     => $this->request->getPost('username'),
            'nama_lengkap' => $this->request->getPost('nama_lengkap'),
            'email'        => $this->request->getPost('email'),
            'password'     => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'role'         => 'user'
        ];
        $db->table('users')->insert($userData);
        $userId = $db->insertID();

        $db->table('campuses')->insert([
            'user_id'     => $userId,
            'nama_kampus' => $this->request->getPost('nama_kampus')
        ]);

        return redirect()->to('/login')->with('success', 'Registrasi berhasil! Silakan masuk.');
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
