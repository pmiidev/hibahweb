<?php

namespace App\Models;

use CodeIgniter\Model;

class CategoryModel extends Model
{
    protected $table            = 'tbl_category';
    protected $primaryKey       = 'category_id';
    protected $allowedFields    = ['category_name', 'category_slug'];
}
