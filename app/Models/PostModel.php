<?php

namespace App\Models;

use CodeIgniter\Model;

class PostModel extends Model
{
    protected $table            = 'tbl_post';
    protected $primaryKey       = 'post_id';
    protected $allowedFields    = [];
    protected $useTimestamps = true;
    protected $createdField  = 'post_date';
    protected $updatedField  = 'post_last_update';
}
