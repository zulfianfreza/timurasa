<?php

namespace App\Models;

use CodeIgniter\Model;

class SupplierOfferingLetterModel extends Model
{
    protected $table = "supplier_offering_letter";
    protected $useTimestamps = false;

    protected $allowedFields = ['id_supplier', 'offering_letter'];

    public function getSupplierOfferingLetterById($id)
    {
        $query = $this->db->table('supplier_offering_letter')
            ->where('id_supplier', $id)
            ->get();

        return $query;
    }

    function edit($id_supplier, $data)
    {
        $query = $this->db->table('supplier_offering_letter')
            ->where('id_supplier', $id_supplier)
            ->update($data);

        return $query;
    }
}
