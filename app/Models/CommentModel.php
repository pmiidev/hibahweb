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
}
