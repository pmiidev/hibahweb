<?php

namespace App\Models;

use CodeIgniter\Model;

class TagModel extends Model
{
    protected $table            = 'tbl_tags';
    protected $primaryKey       = 'tag_id';
    protected $allowedFields    = ['tag_name'];

    function get_post_by_tags($tag)
    {
        $query = $this->db->query("SELECT tbl_post.*,user_name,user_photo FROM tbl_post
			LEFT JOIN tbl_user ON post_user_id=user_id
			WHERE post_tags LIKE '%$tag%'");
        return $query;
    }
}
