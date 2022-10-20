<?php

namespace App\Models;

use CodeIgniter\Model;

class SupplierProductModel extends Model
{
    protected $table            = "supplier_product";
    protected $useTimestamps    = false;

    protected $allowedFields    = ['id_supplier', 'id_product', 'product_name', 'product_description', 'price', 'unit', 'with_shipping_cost', 'capacity', 'quality', 'termin'];

    function getSupplierProduct()
    {
        $query = $this->db->table('supplier_product')
            ->select('supplier_product.id, supplier_product.id_supplier, supplier_product.id_product, product_category.name, supplier_product.product_name, supplier_product.product_description, supplier_product.price, supplier_product.unit, supplier_product.with_shipping_cost, supplier_product.capacity, supplier_product.quality, supplier_product.termin')
            ->join('product_category', 'supplier_product.id_product = product_category.id')
            ->get();

        return $query;
    }

    function getSupplierProductById($id)
    {
        $query = $this->db->table('supplier_product')
            ->select('supplier_product.id, supplier_product.id_supplier, supplier_product.id_product, product_category.name, supplier_product.product_name, supplier_product.product_description, supplier_product.price, supplier_product.unit, supplier_product.with_shipping_cost, supplier_product.capacity, supplier_product.quality, supplier_product.termin')
            ->join('product_category', 'supplier_product.id_product = product_category.id')
            ->where('supplier_product.id_supplier', $id)
            ->get();

        return $query;
    }

    function edit($id, $id_supplier, $data)
    {
        $query = $this->db->table('supplier_product')
            ->where('id', $id)
            ->where('id_supplier', $id_supplier)
            ->update($data);

        return $query;
    }
}
