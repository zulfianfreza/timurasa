<?php

namespace App\Models;

use CodeIgniter\Model;

class SupplierServiceModel extends Model
{
    protected $table            = "supplier_service";
    protected $useTimestamps    = false;

    protected $allowedFields    = ['id_supplier', 'id_service', 'service_name', 'service_description'];

    function getSupplierService()
    {
        $query = $this->db->table('supplier_service')
            ->select('supplier_service.id, supplier_service.id_supplier, supplier_service.id_service, service_category.name, supplier_service.service_name, supplier_service.service_description')
            ->join('service_category', 'supplier_service.id_service = service_category.id')
            ->get();

        return $query;
    }

    function getSupplierserviceById($id)
    {
        $query = $this->db->table('supplier_service')
            ->select('supplier_service.id, supplier_service.id_supplier, supplier_service.id_service, service_category.name, supplier_service.service_name, supplier_service.service_description')
            ->join('service_category', 'supplier_service.id_service = service_category.id')
            ->where('supplier_service.id_supplier', $id)
            ->get();

        return $query;
    }

    function edit($id, $id_supplier, $data)
    {
        $query = $this->db->table('supplier_service')
            ->where('id', $id)
            ->where('id_supplier', $id_supplier)
            ->update($data);

        return $query;
    }
}
