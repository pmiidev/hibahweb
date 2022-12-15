<?php

namespace App\Models;

use CodeIgniter\Model;

class CategoryModel extends Model
{
    protected $table            = 'tbl_category';
    protected $primaryKey       = 'category_id';
    protected $allowedFields    = ['category_name', 'category_slug'];

    public function get_post_by_category($slug)
    {
        $query = $this->db->query("SELECT tbl_post.*,tbl_category.*,user_name,user_photo FROM
			tbl_post LEFT JOIN tbl_category ON post_category_id=category_id 
			LEFT JOIN tbl_user ON post_user_id=user_id WHERE category_slug='$slug'");
        return $query;
    }
}
