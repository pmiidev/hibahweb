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

    public function get_post_by_slug($slug)
    {
        $query = $this->db->query("SELECT tbl_post.*,user_name,user_photo,tbl_comment.*,COUNT(comment_id) AS comment_total,tbl_category.* FROM tbl_post 
			LEFT JOIN tbl_user ON post_user_id=user_id
			LEFT JOIN tbl_comment ON post_id=comment_post_id
			LEFT JOIN tbl_category ON post_category_id=category_id
			WHERE post_slug='$slug' GROUP BY post_id LIMIT 1");
        return $query;
    }
    public function count_views($user_ip, $post_id)
    {
        $this->db->transStart();
        $this->db->query("INSERT INTO tbl_post_views (view_ip,view_post_id) VALUES('$user_ip','$post_id')");
        $this->db->query("UPDATE tbl_post SET post_views=post_views+1 where post_id='$post_id'");
        $this->db->transComplete();
        if ($this->db->transStatus() == TRUE) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    public function get_related_post($category_id, $post_id)
    {
        // $query = $this->db->query("SELECT * FROM tbl_post LEFT JOIN tbl_user ON post_user_id=user_id 
        // 	WHERE post_category_id='$category_id' AND NOT post_id='$post_id' ORDER BY post_views DESC LIMIT 4");
        // return $query;
    }
}
