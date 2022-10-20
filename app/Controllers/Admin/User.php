<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

use App\Models\UserModel;

class User extends BaseController
{
    public function __construct()
    {

        $this->userModel = new UserModel();
        $this->session = session();
    }

    public function index()
    {
        $user = $this->userModel->getAllUser()->getResult();

        $data = [
            'active_nav' => 'user',
            'user' => $user,
        ];

        return view('admin/user/view_user', $data);
    }

    public function viewCreate()
    {
        $data = [
            'active_nav' => 'user',
        ];

        return view('admin/user/create', $data);
    }

    public function actionCreate()
    {
        if (!$this->validate([
            'name' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Harap isi nama',
                ],
            ],
            'username' => [
                'rules' => 'required|max_length[12]',
                'errors' => [
                    'required' => 'Harap isi username',
                    'max_length' => 'Username tidak boleh lebih 12 karakter',
                ],
            ],
            'password' => [
                'rules' => 'required|min_length[6]|max_length[12]',
                'errors' => [
                    'required' => 'Harap isi password',
                    'min_length' => 'Password harus lebih dari 6 karakter',
                    'max_length' => 'Password tidak boleh lebih dari 12 karakter',
                ],
            ],
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        }

        $data = [
            'name' => $this->request->getVar('name'),
            'username' => $this->request->getVar('username'),
            'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
            'role' => $this->request->getVar('role'),
        ];

        $this->userModel->insert($data);

        return redirect()->to(base_url('admin/user'));
    }

    public function actionDelete($username)
    {
        $plain_username = base64_decode($username);
        // dd($plain_username);
        $delete = $this->userModel->where('username', $plain_username)->delete();
        if ($delete) {
            $this->session->setFlashdata('message', 'Data berhasil dihapus.');
            return redirect()->to(base_url() . '/admin/user');
        }
    }
}
