<?php

namespace App\Models;

use CodeIgniter\Model;

class TagModel extends Model
{
    protected $table            = 'tbl_tags';
    protected $primaryKey       = 'tag_id';
    protected $allowedFields    = ['tag_name'];
}
