<?php

namespace App\Models;

use CodeIgniter\Model;

class AboutModel extends Model
{
    protected $table            = 'tbl_about';
    protected $primaryKey       = 'about_id';
    protected $allowedFields    = ['about_name', 'about_image', 'about_description', 'about_alamat'];
}
