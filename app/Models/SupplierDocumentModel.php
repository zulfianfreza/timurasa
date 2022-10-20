<?php

namespace App\Models;

use CodeIgniter\Model;

class SupplierDocumentModel extends Model
{
    protected $table = "supplier_document";
    protected $useTimestamps = false;

    protected $allowedFields = ['id_supplier', 'document'];

    public function getSupplierDocumentById($id)
    {
        $query = $this->db->table('supplier_document')
            ->where('id_supplier', $id)
            ->get();

        return $query;
    }

    public function deleteSupplierDocumentById($id_supplier, $id)
    {
        $query = $this->db->table('supplier_document')
            ->delete(['id_supplier' => $id_supplier, 'id' => $id]);

        return $query;
    }
}
