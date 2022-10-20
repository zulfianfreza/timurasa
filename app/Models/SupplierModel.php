<?php

namespace App\Models;

use CodeIgniter\Model;

class SupplierModel extends Model
{
    protected $table            = "supplier";
    protected $primaryKey       = 'id_supplier';
    protected $useTimestamps    = true;

    protected $allowedFields    = ['id_supplier', 'status', 'result'];

    public function getSupplier()
    {
        $query = $this->db->table('supplier')
            ->join('supplier_detail', 'supplier.id_supplier = supplier_detail.id_supplier')
            ->orderBy('supplier.created_at', 'DESC')
            ->get();

        return $query;
    }

    public function getSupplierByStatus($status)
    {
        $query = $this->db->table('supplier')
            ->join('supplier_detail', 'supplier.id_supplier = supplier_detail.id_supplier')
            ->where('supplier.status', $status)
            ->get();

        return $query;
    }

    public function getSupplierById($id)
    {
        $query = $this->db->table('supplier')
            ->join('supplier_detail', 'supplier.id_supplier = supplier_detail.id_supplier')
            ->where('supplier.id_supplier', $id)
            ->get();

        return $query;
    }
}
