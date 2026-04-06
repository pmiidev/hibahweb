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
}
