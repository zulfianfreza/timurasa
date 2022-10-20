<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;

class Profile extends BaseController
{
    public function __construct()
    {

        $this->userModel = new UserModel();
        $this->username = session()->get('username');
        $this->user = $this->userModel->getUserByUsername($this->username)->getResult();
        $this->session = session();
    }

    public function index()
    {

        $data = [
            'active_nav' => '',
            'user' => $this->user,

        ];
        return view('admin/profile/view_profile', $data);
    }

    public function viewUpdate($column)
    {
        $data = [
            'active_nav' => '',
            'user' => $this->user,
            'column' => $column,

        ];

        return view('admin/profile/update', $data);
    }

    public function actionUpdate($column)
    {
        if ($column == 'password') {
            $old_password = $this->request->getVar('old_password');
            $new_password =  password_hash($this->request->getVar('new_password'), PASSWORD_DEFAULT);

            $verify_password = password_verify($old_password, $this->user[0]->password);

            if ($verify_password) {
                $this->userModel->set($column, $new_password)->where('username', $this->username)->update();

                $this->session->setFlashdata('message', 'Profile berhasil diperbarui.');
                return redirect()->to(base_url('admin/profile'));
            }

            $this->session->setFlashData('error', 'Password yang sekarang tidak sesuai.');
            return redirect()->back();
        }

        $value = $this->request->getVar('value');

        $this->userModel->set($column, $value)->where('username', $this->username)->update();

        $this->session->setFlashdata('message', 'Profile berhasil diperbarui.');
        $this->session->set('name', $value);
        return redirect()->to(base_url('admin/profile'));
    }
}
