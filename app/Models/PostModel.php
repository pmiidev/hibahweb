<?php

namespace App\Models;

use CodeIgniter\Model;

class PostModel extends Model
{
    protected $table            = 'tbl_post';
    protected $primaryKey       = 'post_id';
    protected $allowedFields    = ['post_title', 'post_description', 'post_contents', 'post_image', 'post_category_id', 'post_tags', 'post_slug', 'post_status', 'post_views', 'post_user_id'];
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
    public function get_related_post($category_id, $kode)
    {
        $query = $this->db->query("SELECT * FROM tbl_post LEFT JOIN tbl_user ON post_user_id=user_id 
			WHERE post_category_id='$category_id' AND NOT post_id='$kode' ORDER BY post_views DESC LIMIT 4");
        return $query;
    }
    public function search_post($query)
    {
        $result = $this->db->query("SELECT tbl_post.*,user_name,user_photo FROM tbl_post
			LEFT JOIN tbl_user ON post_user_id=user_id
			LEFT JOIN tbl_category ON post_category_id=category_id
			WHERE post_title LIKE '%$query%' OR category_name LIKE '%$query%' OR post_tags LIKE '%$query%' LIMIT 12");
        return $result;
    }
    public function get_all_post($user_id = null)
    {
        if ($user_id == null) {
            $result = $this->db->query("SELECT post_id,post_title,post_slug,post_user_id,post_image,DATE_FORMAT(post_date,'%d %M %Y') AS post_date,category_name,post_tags,post_status,post_views FROM tbl_post JOIN tbl_category ON post_category_id=category_id");
            return $result;
        } else {
            $result = $this->db->query("SELECT post_id,post_title,post_slug,post_user_id,post_image,DATE_FORMAT(post_date,'%d %M %Y') AS post_date,category_name,post_tags,post_status,post_views FROM tbl_post JOIN tbl_category ON post_category_id=category_id where post_user_id=$user_id");
            return $result;
        }
    }
}
