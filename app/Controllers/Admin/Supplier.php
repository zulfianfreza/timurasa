<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ProductCategoryModel;
use App\Models\ServiceCategoryModel;
use App\Models\SupplierDetailModel;
use App\Models\SupplierDocumentModel;
use App\Models\SupplierModel;
use App\Models\SupplierOfferingLetterModel;
use App\Models\SupplierProductModel;
use App\Models\SupplierServiceModel;

class Supplier extends BaseController
{
    public function __construct()
    {

        $this->session = session();
        $this->productCategoryModel = new ProductCategoryModel();
        $this->serviceCategoryModel = new ServiceCategoryModel();
        $this->supplierModel = new SupplierModel();
        $this->supplierDetailModel = new SupplierDetailModel();
        $this->supplierDocumentModel = new SupplierDocumentModel();
        $this->supplierDetailModel = new SupplierDetailModel();
        $this->supplierProductModel = new SupplierProductModel();
        $this->supplierServiceModel = new SupplierServiceModel();
        $this->supplierOfferingLetterModel = new SupplierOfferingLetterModel();


        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://kodepos-2d475.firebaseio.com/list_propinsi.json?print=pretty",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache"
            ),
        ));

        $response = curl_exec($curl);
        // $err = curl_error($curl);

        $provinsi = json_decode($response, true);

        $this->provinsi = $provinsi;
    }

    public function index()
    {
        $supplier = $this->supplierModel->getSupplier()->getResult();
        $product = $this->supplierProductModel->getSupplierProduct()->getResult();
        $service = $this->supplierServiceModel->getSupplierService()->getResult();

        $data = [
            'active_nav' => 'supplier',
            'supplier' => $supplier,
            'product' => $product,
            'service' => $service,

        ];

        return view('admin/supplier/view_supplier', $data);
    }

    public function getSupplierById($id)
    {
        $id_supplier = base64_decode($id);

        $supplier = $this->supplierModel->getSupplierById($id_supplier)->getResult();
        $document = $this->supplierDocumentModel->getSupplierDocumentById($id_supplier)->getResult();

        $product = $this->supplierProductModel->getSupplierProductById($id_supplier)->getResult();
        $service = $this->supplierServiceModel->getSupplierServiceById($id_supplier)->getResult();

        $data = [
            'active_nav' => 'supplier',
            'supplier' => $supplier,
            'product' => $product,
            'document' => $document,
            'service' => $service,
        ];

        return view('admin/supplier/detail', $data);
    }

    public function verificationSupplier($id, $status)
    {
        $id_supplier = base64_decode($id);

        $supplier = $this->supplierModel->find($id_supplier);

        $data = [
            'status' => $status
        ];

        $this->supplierModel->update($id_supplier, $data);

        $supplier = $this->supplierModel->find($id_supplier);

        $status = $supplier['status'] == 1 ? 'verifikasi.' : 'belum verifikasi.';
        $this->session->setFlashdata('message_set_active', $supplier['id_supplier'] . ': status diubah menjadi ' . $status);
        return redirect()->to(base_url() . '/admin/supplier');
    }

    public function exportToExcel()
    {
        $supplier = $this->supplierModel->getSupplier()->getResult();

        $data = [
            'supplier' => $supplier,
        ];
        return view('admin/export_to_excel', $data);
    }


    public function viewFirstStep()
    {

        $data = [
            'active_nav' => 'supplier',
            'step' => 1
        ];

        return view('admin/supplier/first_step', $data);
    }
    public function viewSecondStep()
    {

        $data = [
            'active_nav' => 'supplier',
            'provinsi' => $this->provinsi,
        ];

        return view('admin/supplier/second_step', $data);
    }
    public function viewThirdStep()
    {
        $service = $this->serviceCategoryModel->where('status', 1)->findAll();

        $product = $this->productCategoryModel->where('status', 1)->findAll();

        $data = [
            'active_nav' => 'supplier',
            'product' => $product,
            'service' => $service,
        ];

        return view('admin/supplier/third_step', $data);
    }

    public function viewFourthStep()
    {

        $product_category = session()->get('data_product_category');
        $service_category = session()->get('data_service_category');
        $product = $product_category != null ? $this->productCategoryModel->whereIn('id', $product_category)->findAll() : '';
        $service = $service_category != null ? $this->serviceCategoryModel->whereIn('id', $service_category)->findAll() : '';
        $data = [
            'active_nav' => 'supplier',
            'product' => $product,
            'service' => $service,
        ];

        return view('admin/supplier/fourth_step', $data);
    }

    public function viewFifthStep()
    {
        $data = [
            'active_nav' => 'supplier',
        ];

        return view('admin/supplier/fifth_step', $data);
    }

    public function saveFirstStep()
    {

        $data_supplier_detail = [
            'name' => $this->request->getVar('name'),
            'email' => $this->request->getVar('email'),
            'phone_number' => $this->request->getVar('phone_number'),
            'company' => $this->request->getVar('company'),
            'whatsapp' => $this->request->getVar('whatsapp'),
            'facebook' => $this->request->getVar('facebook'),
            'instagram' => $this->request->getVar('instagram'),
        ];

        $this->session->set('data_supplier_detail', $data_supplier_detail);

        return redirect()->to(base_url('admin/supplier/second_step'));
    }

    public function saveSecondStep()
    {
        $data = [
            'address' => $this->request->getVar('address'),
            'province' => $this->request->getVar('province'),
            'city' => $this->request->getVar('city'),
            'zip_code' => $this->request->getVar('zip_code'),
        ];

        $this->session->push('data_supplier_detail', $data);

        return redirect()->to(base_url('admin/supplier/third_step'));
    }

    public function saveThirdStep()
    {

        $product = $this->request->getVar('product');
        $service = $this->request->getVar('service');
        $business_major = $this->request->getVar('business_major');
        $data = [
            'business_major' => $business_major,
        ];
        $this->session->push('data_supplier_detail', $data);
        $this->session->set('data_product_category', $product);
        $this->session->set('data_service_category', $service);

        return redirect()->to(base_url('admin/supplier/fourth_step'));
    }

    public function saveFourthStep()
    {

        $product_name = $this->request->getVar('product_name');
        $product_description = $this->request->getVar('product_description');
        $price = $this->request->getVar('price');
        $unit = $this->request->getVar('unit');
        $capacity = $this->request->getVar('capacity');
        $quality = $this->request->getVar('quality');
        $termin = $this->request->getVar('termin');
        $with_shipping_cost = $this->request->getVar('with_shipping_cost');

        $data_product = [
            'product_name' => $product_name,
            'product_description' => $product_description,
            'price' => $price,
            'unit' => $unit,
            'with_shipping_cost' => $with_shipping_cost,
            'capacity' => $capacity,
            'quality' => $quality,
            'termin' => $termin,
        ];

        $this->session->set('data_product', $data_product);

        $service_name = $this->request->getVar('service_name');
        $service_description = $this->request->getVar('service_description');

        $data_service = [
            'service_name' => $service_name,
            'service_description' => $service_description,
        ];

        $this->session->set('data_service', $data_service);

        return redirect()->to(base_url('admin/supplier/fifth_step'));
    }

    public function saveFifthStep()
    {
        $data = $this->supplierModel->findAll();
        $get_row = count($data) + 1;
        $counter = str_pad($get_row, 4, 0, STR_PAD_LEFT); // Updated line to include '0'
        $id = "SUP" . "-";
        $year = date('y');
        $month = date("m");
        $day = date("d");
        $id_supplier = $id . $year . $month . $day . $counter;


        $data_supplier_detail = session()->get('data_supplier_detail');
        $data_product_category = session()->get('data_product_category');
        $data_service_category = session()->get('data_service_category');
        $data_product = session()->get('data_product');
        $data_service = session()->get('data_service');


        $this->supplierModel->insert([
            'id_supplier' => $id_supplier,
            'status' => 0,
            'result' => 'process'
        ]);

        $this->supplierDetailModel->save([
            'id_supplier' => $id_supplier,
            'name' => $data_supplier_detail['name'],
            'email' => $data_supplier_detail['email'],
            'phone_number' => $data_supplier_detail['phone_number'],
            'company' => $data_supplier_detail['company'],
            'facebook' => $data_supplier_detail['facebook'],
            'instagram' => $data_supplier_detail['instagram'],
            'whatsapp' => $data_supplier_detail['whatsapp'],
            'address' => $data_supplier_detail['address'],
            'province' => $data_supplier_detail['province'],
            'city' => $data_supplier_detail['city'],
            'zip_code' => $data_supplier_detail['zip_code'],
            'business_major' => $data_supplier_detail['business_major'],
        ]);


        $this->supplierOfferingLetterModel->save([
            'id_supplier' => $id_supplier,
            'offering_letter' => $this->request->getVar('offering_letter'),
        ]);

        if ($data_product_category != null) {
            foreach ($data_product_category as $key => $element) {
                $data = [
                    'id_supplier' => $id_supplier,
                    'id_product' => (int) $element,
                    'product_name' => $data_product['product_name'][$key],
                    'product_description' => $data_product['product_description'][$key],
                    'price' => $data_product['price'][$key],
                    'unit' => $data_product['unit'][$key],
                    'with_shipping_cost' => $data_product['with_shipping_cost'][$key],
                    'capacity' => $data_product['capacity'][$key],
                    'quality' => $data_product['quality'][$key],
                    'termin' => $data_product['termin'][$key],
                ];
                $this->supplierProductModel->save($data);
            }
        }

        if ($data_service_category != null) {
            foreach ($data_service_category as $key => $element) {
                $data = [
                    'id_supplier' => $id_supplier,
                    'id_service' => (int) $element,
                    'service_name' => $data_service['service_name'][$key],
                    'service_description' => $data_service['service_description'][$key],
                ];
                $this->supplierServiceModel->save($data);
            }
        }



        $document = $this->request->getFileMultiple('document');
        for ($i = 0; $i < count($document); $i++) {
            $document[$i]->move('document');
            $this->supplierDocumentModel->save([
                'id_supplier' => $id_supplier,
                'document' => $document[$i]->getName(),
            ]);
        }

        $this->session->setFlashdata('success', true);
        $this->session->setFlashdata('id_supplier', $id_supplier);
        return redirect()->to(base_url('admin/supplier'));
    }

    public function actionDelete($id)
    {
        $id_supplier = base64_decode($id);
        $delete = $this->supplierModel->delete($id_supplier);
        if ($delete) {
            $this->session->setFlashdata('message', 'Data Supplier berhasil dihapus.');
            return redirect()->to(base_url() . '/admin/supplier');
        }
    }

    public function viewUpdateFirst($id)
    {
        $id_supplier = base64_decode($id);

        $supplier = $this->supplierModel->getSupplierById($id_supplier)->getResultArray();

        $data = [
            'active_nav' => 'supplier',
            'supplier' => $supplier,
        ];

        return view('admin/supplier/edit_first', $data);
    }

    public function actionUpdateFirst($id)
    {
        $id_supplier = base64_decode($id);

        $data = [
            'name' => $this->request->getVar('name'),
            'email' => $this->request->getVar('email'),
            'phone_number' => $this->request->getVar('phone_number'),
            'company' => $this->request->getVar('company'),
            'whatsapp' => $this->request->getVar('whatsapp'),
            'facebook' => $this->request->getVar('facebook'),
            'instagram' => $this->request->getVar('instagram'),
        ];

        $this->supplierDetailModel->edit($id_supplier, $data);

        return redirect()->to(base_url('admin/supplier/edit/second/' . $id));
    }

    public function viewUpdateSecond($id)
    {
        $id_supplier = base64_decode($id);

        $supplier = $this->supplierModel->getSupplierById($id_supplier)->getResultArray();

        $data = [
            'active_nav' => 'supplier',
            'supplier' => $supplier,
            'provinsi' => $this->provinsi,
        ];

        return view('admin/supplier/edit_second', $data);
    }

    public function actionUpdateSecond($id)
    {
        $id_supplier = base64_decode($id);

        $data = [
            'address' => $this->request->getVar('address'),
            'province' => $this->request->getVar('province'),
            'city' => $this->request->getVar('city'),
            'zip_code' => $this->request->getVar('zip_code'),
        ];

        $this->supplierDetailModel->edit($id_supplier, $data);

        return redirect()->to(base_url('admin/supplier/edit/third/' . $id));
    }

    public function viewUpdateThird($id)
    {
        $id_supplier = base64_decode($id);

        $supplier = $this->supplierModel->getSupplierById($id_supplier)->getResultArray();

        $service = $this->serviceCategoryModel->where('status', 1)->findAll();

        $product = $this->productCategoryModel->where('status', 1)->findAll();

        $supplier_product = $this->supplierProductModel->getSupplierProductById($id_supplier)->getResultArray();
        $supplier_service = $this->supplierServiceModel->getSupplierServiceById($id_supplier)->getResultArray();

        $data = [
            'active_nav' => 'supplier',
            'product' => $product,
            'service' => $service,
            'supplier' => $supplier,
            'supplier_product' => $supplier_product,
            'supplier_service' => $supplier_service
        ];

        return view('admin/supplier/edit_third', $data);
    }

    public function actionUpdateThird($id)
    {
        $id_supplier = base64_decode($id);

        $data = [
            'business_major' => $this->request->getVar('business_major'),
        ];

        $this->supplierDetailModel->edit($id_supplier, $data);

        return redirect()->to(base_url('admin/supplier/edit/fourth/' . $id));
    }

    public function viewUpdateFourth($id)
    {
        $id_supplier = base64_decode($id);

        $supplier = $this->supplierModel->getSupplierById($id_supplier)->getResultArray();

        $service = $this->serviceCategoryModel->where('status', 1)->findAll();

        $product = $this->productCategoryModel->where('status', 1)->findAll();

        $supplier_product = $this->supplierProductModel->getSupplierProductById($id_supplier)->getResultArray();
        $supplier_service = $this->supplierServiceModel->getSupplierServiceById($id_supplier)->getResultArray();

        $data = [
            'active_nav' => 'supplier',
            'product' => $product,
            'service' => $service,
            'supplier' => $supplier,
            'supplier_product' => $supplier_product,
            'supplier_service' => $supplier_service
        ];

        return view('admin/supplier/edit_fourth', $data);
    }

    public function actionUpdateFourth($id)
    {
        $id_supplier = base64_decode($id);

        $id_supplier_product = $this->request->getVar('id_supplier_product');
        $product_name = $this->request->getVar('product_name');
        $product_description = $this->request->getVar('product_description');
        $price = $this->request->getVar('price');
        $unit = $this->request->getVar('unit');
        $capacity = $this->request->getVar('capacity');
        $quality = $this->request->getVar('quality');
        $termin = $this->request->getVar('termin');
        $with_shipping_cost = $this->request->getVar('with_shipping_cost');

        $id_supplier_service = $this->request->getVar('id_supplier_service');
        $service_name = $this->request->getVar('service_name');
        $service_description = $this->request->getVar('service_description');


        if ($id_supplier_product != null) {
            for ($i = 0; $i < count($id_supplier_product); $i++) {
                $data = [
                    'product_name' => $product_name[$i],
                    'product_description' => $product_description[$i],
                    'price' => $price[$i],
                    'unit' => $unit[$i],
                    'with_shipping_cost' => $with_shipping_cost[$i],
                    'capacity' => $capacity[$i],
                    'quality' => $quality[$i],
                    'termin' => $termin[$i],
                ];

                $this->supplierProductModel->edit($id_supplier_product[$i], $id_supplier, $data);

                d($data);
            }
        }

        if ($id_supplier_service != null) {
            for ($i = 0; $i < count($id_supplier_service); $i++) {
                $data = [
                    'service_name' => $service_name[$i],
                    'service_description' => $service_description[$i],
                ];

                $this->supplierServiceModel->edit($id_supplier_service[$i], $id_supplier, $data);

                d($data);
                d($id_supplier_service);
            }
        }

        return redirect()->to(base_url('admin/supplier/edit/fifth/' . $id));
    }

    public function viewUpdateFifth($id)
    {
        $id_supplier = base64_decode($id);

        $offering_letter = $this->supplierOfferingLetterModel->getSupplierOfferingLetterById($id_supplier)->getResult();
        $document = $this->supplierDocumentModel->getSupplierDocumentById($id_supplier)->getResult();
        $supplier = $this->supplierModel->getSupplierById($id_supplier)->getResultArray();

        $data = [
            'active_nav' => 'supplier',
            'offering_letter' => $offering_letter,
            'supplier' => $supplier,
            'document' => $document,
        ];

        return view('admin/supplier/edit_fifth', $data);
    }

    public function actionUpdateFifth($id)
    {
        $id_supplier = base64_decode($id);

        // dd($id_supplier);
        $data = [
            'offering_letter' => $this->request->getVar('offering_letter'),
        ];

        $this->supplierOfferingLetterModel->edit(
            $id_supplier,
            $data
        );

        $document = $this->request->getFileMultiple('document');

        d($document);
        if ($document[0]->getError() != 4) {
            for ($i = 0; $i < count($document); $i++) {
                $document[$i]->move('document');
                $this->supplierDocumentModel->save([
                    'id_supplier' => $id_supplier,
                    'document' => $document[$i]->getName(),
                ]);
            }
        }
        return redirect()->to(base_url('admin/supplier'));
    }

    public function deleteDocument($id_supplier, $id)
    {
        $id_supplier = base64_decode($id_supplier);
        $id = base64_decode($id);

        // d($id_supplier);
        // d($id);

        $data = $this->supplierDocumentModel->find($id);
        $image = $data['document'];
        if (file_exists('document/' . $image)) {
            unlink('document/' . $image);
        }
        $delete = $this->supplierDocumentModel->deleteSupplierDocumentById($id_supplier, $id);
        if ($delete) {
            $this->session->setFlashdata('message', 'Data Supplier berhasil dihapus.');
            return redirect()->to(base_url('admin/supplier/edit/fifth/' . base64_encode($id_supplier)));
        }
    }
}
