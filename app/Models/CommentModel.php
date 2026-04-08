<?php

namespace App\Models;

use CodeIgniter\Model;

class CommentModel extends Model
{
    protected $table      = 'tbl_comment';
    protected $primaryKey = 'comment_id';
    protected $allowedFields = [
        'comment_name',
        'comment_email',
        'comment_message',
        'comment_status',
        'comment_parent',
        'comment_post_id',
        'comment_image'
    ];

    public function show_comments($post_id)
    {
        return $this->where('comment_post_id', $post_id)
                    ->where('comment_status', '1')
                    ->where('comment_parent', '0')
                    ->findAll();
    }

    public function show_comments_reply($comment_id)
    {
        return $this->where('comment_status', '1')
                    ->where('comment_parent', $comment_id)
                    ->findAll();
    }

    public function get_all_comment()
    {
        return $this->select('comment_id, DATE_FORMAT(comment_date, "%d %M %Y %H:%i") AS comment_date, comment_name, comment_email, comment_status, comment_message, comment_image, post_id, post_title, post_slug')
                    ->join('tbl_post', 'comment_post_id = post_id')
                    ->where('comment_parent', '0')
                    ->orderBy('comment_id', 'DESC')
                    ->findAll();
    }

    public function get_all_comment_unpublish()
    {
        return $this->select('comment_id, DATE_FORMAT(comment_date, "%d %M %Y %H:%i") AS comment_date, comment_name, comment_email, comment_status, comment_message, comment_image, post_id, post_title, post_slug')
                    ->join('tbl_post', 'comment_post_id = post_id')
                    ->where('comment_status', '0')
                    ->orderBy('comment_id', 'DESC')
                    ->findAll();
    }

    public function get_replies_post($comment_id)
    {
        return $this->select('comment_id, DATE_FORMAT(comment_date, "%d %M %Y %H:%i") AS comment_date, comment_name, comment_email, comment_message, comment_image, post_id, post_title, post_slug')
                    ->join('tbl_post', 'comment_post_id = post_id')
                    ->where('comment_parent', $comment_id)
                    ->orderBy('comment_id', 'ASC')
                    ->findAll();
    }

    public function getCommentsAuthor($user_id)
    {
        return $this->join('tbl_post', 'comment_post_id = post_id')
                    ->where('post_user_id', $user_id);
    }
}
