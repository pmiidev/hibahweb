<?php

namespace App\Models;

use CodeIgniter\Model;

class TagModel extends Model
{
    protected $table = 'tbl_tags';
    protected $primaryKey = 'tag_id';
    protected $allowedFields = ['tag_name'];

    public function get_post_by_tags(string $tag)
    {
        return $this->select('tbl_post.*, user_name, user_photo')
            ->join('tbl_user', 'post_user_id = user_id', 'left')
            ->like('post_tags', $tag)
            ->findAll();
    }
}
