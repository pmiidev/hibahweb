<?php

namespace App\Models;

use CodeIgniter\Model;

class HomeModel extends Model
{
    protected $table      = 'tbl_home';
    protected $primaryKey = 'home_id';
    protected $allowedFields = [
        'home_caption_1',
        'home_caption_2',
        'home_video',
        'home_bg_heading',
        'home_bg_testimonial',
        'home_bg_testimonial2'
    ];
}
