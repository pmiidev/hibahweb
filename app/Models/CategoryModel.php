<?php

namespace App\Models;

use CodeIgniter\Model;

class CategoryModel extends Model
{
    protected $table      = 'tbl_category';
    protected $primaryKey = 'category_id';
    protected $allowedFields = ['category_name', 'category_slug'];

    public function get_post_by_category(string $slug)
    {
        return $this->select('tbl_post.*, tbl_category.*, user_name, user_photo')
                    ->join('tbl_post', 'post_category_id = category_id', 'left')
                    ->join('tbl_user', 'post_user_id = user_id', 'left')
                    ->where('category_slug', $slug)
                    ->findAll();
    }
}
