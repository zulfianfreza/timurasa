<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\SupplierModel;

class Dashboard extends BaseController
{
    public function __construct()
    {

        $this->supplierModel = new SupplierModel();
    }
    public function index()
    {
        $supplier = $this->supplierModel->getSupplier()->getResult();

        $process = $this->supplierModel->getSupplierByStatus(2)->getResult();
        $verified = $this->supplierModel->getSupplierByStatus(1)->getResult();
        $not_verified = $this->supplierModel->getSupplierByStatus(0)->getResult();

        $data = [
            'active_nav' => 'dashboard',
            'supplier' => $supplier,
            'supplier_process' => $process,
            'supplier_verified' => $verified,
            'supplier_not_verified' => $not_verified,

        ];
        return view('admin/dashboard/view_dashboard', $data);
    }
}
