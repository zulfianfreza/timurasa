<?php

namespace App\Controllers;

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
        $this->supplierProductModel = new SupplierProductModel();
        $this->supplierServiceModel = new SupplierServiceModel();
        $this->supplierOfferingLetterModel = new SupplierOfferingLetterModel();
        $this->supplierDocumentModel = new SupplierDocumentModel();

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
        $data = [
            'step' => 1,
            'validation' => \Config\Services::validation(),
        ];
        return view('supplier/first_step', $data);
    }
    public function viewSecondStep()
    {
        $data = [
            'provinsi' => $this->provinsi,
            'step' => 2,
        ];
        return view('supplier/second_step', $data);
    }

    public function viewThirdStep()
    {
        $service = $this->serviceCategoryModel->where('status', 1)->findAll();

        $product = $this->productCategoryModel->where('status', 1)->findAll();

        $data = [
            'service' => $service,
            'product' => $product,
            'step' => 3,
        ];
        return view('supplier/third_step', $data);
    }

    public function viewFourthStep()
    {

        $product_category = session()->get('data_product_category');
        $service_category = session()->get('data_service_category');
        $product = $product_category != null ? $this->productCategoryModel->whereIn('id', $product_category)->findAll() : '';
        $service = $service_category != null ? $this->serviceCategoryModel->whereIn('id', $service_category)->findAll() : '';
        $data = [
            'step' => 4,
            'product' => $product,
            'service' => $service,
        ];

        return view('supplier/fourth_step', $data);
    }

    public function viewFifthStep()
    {
        $data = [
            'step' => 5,
        ];

        return view('supplier/fifth_step', $data);
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

        return redirect()->to(base_url('second_step'));
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

        return redirect()->to(base_url('third_step'));
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

        return redirect()->to(base_url('fourth_step'));
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
        return redirect()->to(base_url('fifth_step'));
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
        return redirect()->to(base_url());
    }

    public function getSupplierById($id)
    {
        $id_supplier = $this->request->getVar('id_supplier');

        $check = $this->supplierModel->find($id_supplier);

        if ($check) {



            $this->session->setFlashdata('found', true);
            $this->session->setFlashdata('id_supplier', $id_supplier);
            $this->session->setFlashdata('status', $check['status']);
            return redirect()->to(base_url(''));
        } else {
            $this->session->setFlashdata('not_found', true);
            $this->session->setFlashdata('id_supplier', 'Kode dengan ' . $id_supplier . ' tidak ditemukan.');
            return redirect()->to(base_url(''));
        }
    }
}
