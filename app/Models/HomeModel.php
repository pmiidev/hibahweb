<?php

namespace App\Models;

use CodeIgniter\Model;

class HomeModel extends Model
{
    protected $table            = 'tbl_home';
    protected $primaryKey       = 'home_id';
    protected $allowedFields    = ['home_caption_1', 'home_caption_2', 'home_video', 'home_bg_heading', 'home_bg_testimonial', 'home_bg_testimonial2'];

    function get_post_header()
    {
        return $this->db->table('tbl_post')
            ->join('tbl_user', 'post_user_id=user_id', 'left')->limit(1)->orderBy('post_id', 'DESC')->get()->getRowArray();
    }

    function get_post_header_2()
    {
        return $this->db->table('tbl_post')
            ->join('tbl_user', 'post_user_id=user_id', 'left')->limit(2, 1)->orderBy('post_id', 'DESC')->get()->getRowArray();
    }

    function get_post_header_3()
    {
        return $this->db->table('tbl_post')
            ->join('tbl_user', 'post_user_id=user_id', 'left')->limit(3, 3)->orderBy('post_id', 'DESC')->get()->getRowArray();
    }

    function get_latest_post()
    {
        return $this->db->table('tbl_post')
            ->join('tbl_user', 'post_user_id=user_id', 'left')->limit(6)->orderBy('post_id', 'DESC')->get()->getRowArray();
    }

    function get_popular_post()
    {
        return $this->db->table('tbl_post')
            ->join('tbl_user', 'post_user_id=user_id', 'left')->limit(5)->orderBy('post_views', 'DESC')->get()->getRowArray();
    }

    function checking_email($email)
    {
        $query = $this->db->query("SELECT * FROM tbl_subscribe WHERE subscribe_email='$email'");
        return $query;
    }

    function save_subcribe($email)
    {
        $query = $this->db->query("INSERT INTO tbl_subscribe (subscribe_email) VALUES ('$email')");
        return $query;
    }
}
