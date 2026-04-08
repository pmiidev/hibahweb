<?php

namespace App\Models;

use CodeIgniter\Model;

class TestimonialModel extends Model
{
    protected $table            = 'tbl_testimonial';
    protected $primaryKey       = 'testimonial_id';
    protected $allowedFields    = ['testimonial_name', 'testimonial_angkatan', 'testimonial_content', 'testimonial_image'];
}