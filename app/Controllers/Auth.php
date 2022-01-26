<?php

namespace App\Controllers;

use App\Models\M_admin;


class Auth extends BaseController
{
    public function __construct()
    {
        $this->M_admin = new M_admin();
        // $this->M_seller = new M_seller();
    }
    public function index()
    {
        return redirect()->to(site_url('auth/login'));
    }
    public function login()
    {
        if (session('id_admin')) {
            return redirect()->to(site_url('main'));
        }
        $data = [
            'title' => 'Add Category Product',
            'validation' => \Config\Services::validation()
        ];
        return view('auth/login', $data);
    }
    //     public function loginAdmin(){
    //         return view('auth/login_admin.php');
    //     }
    public function loginProcess()
    {
        if (!$this->validate([
            'id_admin' => [
                'rules'  => 'required|numeric',
                'errors' => [
                    'required' => 'Silahkan masukkan ID terlebih dahulu!',
                    'numeric' => 'Anda hanya dapat memasukkan angka!'
                ],
            ],
            'password'    => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Password belum anda isi!',
                ],
            ],
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to('/auth/login')->withInput()->with('validation', $validation);
        }

        $data = $this->M_admin->getAdmin($this->request->getPost('id_admin'));
        if ($data) {
            if ($data['password'] === md5($this->request->getPost('password'))) {
                $ses_data = [
                    'id_admin'    => $data['id_admin'],
                    'name'     => $data['name'],
                    'img'   => $data['img'],
                    'role'     => $data['role']
                ];
                session()->set($ses_data);
                return redirect()->to('/main');
            } else {
                return redirect()->back()->with('error', 'ID atau Password salah!');
            }
        } else {
            return redirect()->back()->with('error', 'ID tidak terdaftar');
        }
    }
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/auth/login');
    }
    
}
