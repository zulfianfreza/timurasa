<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductCategoryModel extends Model
{
    protected $table = "product_category";
    protected $useTimestamps = true;

    protected $allowedFields = ['name', 'status'];
}
