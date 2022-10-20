<?php

namespace App\Models;

use CodeIgniter\Model;

class SupplierDetailModel extends Model
{
    protected $table = "supplier_detail";
    protected $useTimestamps = false;

    protected $allowedFields = [
        'id_supplier',
        'name',
        'email',
        'phone_number',
        'company',
        'whatsapp',
        'facebook',
        'instagram',
        'address',
        'province',
        'city',
        'zip_code',
        'business_major'
    ];

    public function edit($id_supplier, $data)
    {
        $query = $this->db->table('supplier_detail')
            ->where('id_supplier', $id_supplier)
            ->update($data);
        return $query;
    }
}
