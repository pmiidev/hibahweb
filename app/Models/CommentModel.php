<?php

namespace App\Models;

use CodeIgniter\Model;

class CommentModel extends Model
{
    protected $table            = 'tbl_comment';
    protected $primaryKey       = 'comment_id';
    protected $allowedFields    = ['comment_name', 'comment_email', 'comment_message', 'comment_status', 'comment_parent', 'comment_post_id', 'comment_image'];

    public function show_comments($post_id)
    {
        $query = $this->db->query("SELECT * FROM tbl_comment WHERE comment_post_id='$post_id' AND comment_status='1' AND comment_parent='0'");
        return $query;
    }
    public function show_comments_reply($comment_id)
    {
        $query = $this->db->query("SELECT * FROM tbl_comment WHERE comment_status='1' AND comment_parent='$comment_id'");
        return $query;
    }
    public function get_all_comment()
    {
        $result = $this->db->query("SELECT comment_id,DATE_FORMAT(comment_date,'%d %M %Y %H:%i') AS comment_date,comment_name,comment_email,comment_status,comment_message,comment_image,post_id,post_title,post_slug FROM tbl_comment JOIN tbl_post ON comment_post_id=post_id WHERE comment_parent='0' ORDER BY comment_id DESC");
        return $result;
    }
    public function get_all_comment_unpublish()
    {
        $result = $this->db->query("SELECT comment_id,DATE_FORMAT(comment_date,'%d %M %Y %H:%i') AS comment_date,comment_name,comment_email,comment_status,comment_message,comment_image,post_id,post_title,post_slug FROM tbl_comment JOIN tbl_post ON comment_post_id=post_id WHERE comment_status='0' ORDER BY comment_id DESC");
        return $result;
    }
    public function get_replies_post($comment_id)
    {
        $result = $this->db->query("SELECT comment_id,DATE_FORMAT(comment_date,'%d %M %Y %H:%i') AS comment_date,comment_name,comment_email,comment_message,comment_image,post_id,post_title,post_slug FROM tbl_comment JOIN tbl_post ON comment_post_id=post_id WHERE comment_parent='$comment_id' ORDER BY comment_id ASC");
        return $result;
    }
    public function getCommentsAuthor($user_id)
    {
        return $this->db->table('tbl_comment')
            ->join('tbl_post', 'comment_post_id=post_id')->where('post_user_id', $user_id);
    }
}
