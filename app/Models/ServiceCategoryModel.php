<?php

namespace App\Models;

use CodeIgniter\Model;

class ServiceCategoryModel extends Model
{
    protected $table = "service_category";
    protected $useTimestamps = false;

    protected $allowedFields = ['name', 'status'];
}
