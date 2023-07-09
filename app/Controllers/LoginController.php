<?php

namespace App\Controllers;

class LoginController extends BaseController{
    private $userModel;
    private $session;
    public function __construct(){
        $this->userModel = new \App\Models\User();
        $this->session = \Config\Services::session();
    }
    public function login(){
        return view("login");
    }
    public function proses_login(){
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $admin = $this->userModel->where("username", $username)->first();
        
        if($admin){
            // Eksekusi Login
            if(password_verify($password, $admin->password)){
                // Eksekusi Session
                $session_data = ([
                    "admin_id"   => $admin->id,
                    "admin_name" => $admin->nama,
                    "admin_role" => $admin->role,
                ]);
                session()->set($session_data);
                return redirect()->to(base_url('data_supplier'));
            }else{
                // Kembali dan Error
                $this->session->setFlashdata('pesan', 'Password salah');
                return redirect()->to(base_url('login'));
            }
        }else{
            // Kembali dan Error
            $this->session->setFlashdata('pesan', 'Akun tidak ada');
            return redirect()->to(base_url('login'));
        }
    }
}
?>