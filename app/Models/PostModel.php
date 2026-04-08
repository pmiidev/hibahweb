<?php

namespace App\Models;

use CodeIgniter\Model;

class PostModel extends Model
{
    protected $table = 'tbl_post';
    protected $primaryKey = 'post_id';
    protected $allowedFields = ['post_title', 'post_description', 'post_contents', 'post_image', 'post_category_id', 'post_tags', 'post_slug', 'post_status', 'post_views', 'post_user_id'];
    protected $useTimestamps = true;
    protected $createdField = 'post_date';
    protected $updatedField = 'post_last_update';

    public function get_post_by_slug($slug)
    {
        return $this->select('tbl_post.*, user_name, user_photo, tbl_comment.*, COUNT(comment_id) AS comment_total, tbl_category.*')
            ->join('tbl_user', 'post_user_id = user_id', 'left')
            ->join('tbl_comment', 'post_id = comment_post_id', 'left')
            ->join('tbl_category', 'post_category_id = category_id', 'left')
            ->where('post_slug', $slug)
            ->groupBy('post_id')
            ->first();
    }

    public function count_views($user_ip, $post_id)
    {
        $this->db->transStart();
        $this->db->table('tbl_post_views')->insert([
            'view_ip' => $user_ip,
            'view_post_id' => $post_id
        ]);
        $this->db->table('tbl_post')->set('post_views', 'post_views + 1', false)->where('post_id', $post_id)->update();
        $this->db->transComplete();
        return $this->db->transStatus();
    }

    public function get_related_post($category_id, $kode)
    {
        return $this->select('*')
            ->join('tbl_user', 'post_user_id = user_id', 'left')
            ->where('post_category_id', $category_id)
            ->where('post_id !=', $kode)
            ->orderBy('post_views', 'DESC')
            ->limit(4)
            ->findAll();
    }

    public function search_post($query)
    {
        return $this->select('tbl_post.*, user_name, user_photo')
            ->join('tbl_user', 'post_user_id = user_id', 'left')
            ->join('tbl_category', 'post_category_id = category_id', 'left')
            ->groupStart()
            ->like('post_title', $query)
            ->orLike('category_name', $query)
            ->orLike('post_tags', $query)
            ->groupEnd()
            ->limit(12)
            ->findAll();
    }

    public function get_all_post($user_id = null)
    {
        $this->select('post_id, post_title, post_slug, post_user_id, post_image, DATE_FORMAT(post_date, "%d %M %Y") AS post_date, category_name, post_tags, post_status, post_views')
            ->join('tbl_category', 'post_category_id = category_id');

        if ($user_id !== null) {
            $this->where('post_user_id', $user_id);
        }

        return $this->findAll();
    }
}