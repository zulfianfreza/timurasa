<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

use App\Models\ServiceCategoryModel;

class Service extends BaseController
{
    public function __construct()
    {

        $this->serviceCategoryModel = new ServiceCategoryModel();
        $this->session = session();
    }

    public function index()
    {
        $service = $this->serviceCategoryModel->findAll();

        $data = [
            'active_nav' => 'service',
            'service' => $service,
        ];

        return view('admin/service/view_service', $data);
    }

    public function setActive($id)
    {
        $id_service = base64_decode($id);
        $service = $this->serviceCategoryModel->find($id_service);

        $data = [
            'status' => ($service['status'] == 1) ? 0 : 1
        ];

        $this->serviceCategoryModel->update($id_service, $data);

        $status = $service['status'] == 1 ? 'tidak aktif.' : 'aktif.';
        $this->session->setFlashdata('message_set_active', $service['name'] . ' diubah menjadi ' . $status);
        return redirect()->to(base_url() . '/admin/service');
    }

    public function viewCreate()
    {
        $data = [
            'active_nav' => 'service',
        ];

        return view('admin/service/create', $data);
    }

    public function actionCreate()
    {
        $save = $this->serviceCategoryModel->save([
            'name' => $this->request->getVar('service'),
            'status' => 1
        ]);
        if ($save) {
            $this->session->setFlashdata('message', 'Data berhasil ditambahkan.');
            return redirect()->to(base_url() . '/admin/service');
        }
    }

    public function viewUpdate($id)
    {
        $id_service = base64_decode($id);
        $service = $this->serviceCategoryModel->find($id_service);

        $data = [
            'active_nav' => 'service',
            'service' => $service,
        ];

        return view('admin/service/create', $data);
    }

    public function actionUpdate($id)
    {
        $id_service = base64_decode($id);
        $save = $this->serviceCategoryModel->update($id_service, [
            'name' => $this->request->getVar('service'),
        ]);
        // dd($id_service);
        if ($save) {
            $this->session->setFlashdata('message', 'Data berhasil diupdate.');
            return redirect()->to(base_url() . '/admin/service');
        }
    }

    public function actionDelete($id)
    {
        $id_service = base64_decode($id);
        $delete = $this->serviceCategoryModel->delete($id_service);
        if ($delete) {
            $this->session->setFlashdata('message', 'Data berhasil dihapus.');
            return redirect()->to(base_url() . '/admin/service');
        }
    }
}
