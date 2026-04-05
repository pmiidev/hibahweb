<?php

namespace App\Models;

use CodeIgniter\Model;

class SliderModel extends Model
{
    protected $table      = 'tbl_slider';
    protected $primaryKey = 'slider_id';
    protected $allowedFields = [
        'slider_title',
        'slider_caption',
        'slider_image',
        'slider_order'
    ];
}
