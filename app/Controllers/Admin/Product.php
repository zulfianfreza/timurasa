<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ProductCategoryModel;

class Product extends BaseController
{
    public function __construct()
    {

        $this->productCategoryModel = new ProductCategoryModel();
        $this->session = session();
    }
    public function index()
    {
        $product = $this->productCategoryModel->findAll();

        $data = [
            'active_nav' => 'product',
            'product' => $product,
        ];

        return view('admin/product/view_product', $data);
    }

    public function setActive($id)
    {
        $id_product = base64_decode($id);
        $product = $this->productCategoryModel->find($id_product);

        $data = [
            'status' => ($product['status'] == 1) ? 0 : 1
        ];

        $this->productCategoryModel->update($id_product, $data);

        $status = $product['status'] == 1 ? 'tidak aktif.' : 'aktif.';
        $this->session->setFlashdata('message_set_active', $product['name'] . ' diubah menjadi ' . $status);
        return redirect()->to(base_url() . '/admin/product');
    }

    public function viewCreate()
    {
        $data = [
            'active_nav' => 'product',
        ];

        return view('admin/product/create', $data);
    }

    public function actionCreate()
    {
        $save = $this->productCategoryModel->save([
            'name' => $this->request->getVar('product'),
            'status' => 1
        ]);
        if ($save) {
            $this->session->setFlashdata('message', 'Data berhasil ditambahkan.');
            return redirect()->to(base_url() . '/admin/product');
        }
    }

    public function viewUpdate($id)
    {
        $id_product = base64_decode($id);
        $product = $this->productCategoryModel->find($id_product);

        $data = [
            'active_nav' => 'product',
            'product' => $product,
        ];

        return view('admin/product/create', $data);
    }

    public function actionUpdate($id)
    {
        $id_product = base64_decode($id);
        $save = $this->productCategoryModel->update($id_product, [
            'name' => $this->request->getVar('product'),
        ]);
        if ($save) {
            $this->session->setFlashdata('message', 'Data berhasil diupdate.');
            return redirect()->to(base_url() . '/admin/product');
        }
    }

    public function actionDelete($id)
    {
        $id_product = base64_decode($id);
        $delete = $this->productCategoryModel->delete($id_product);
        if ($delete) {
            $this->session->setFlashdata('message', 'Data berhasil dihapus.');
            return redirect()->to(base_url() . '/admin/product');
        }
    }
}
