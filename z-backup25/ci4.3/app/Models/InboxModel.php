<?php

namespace App\Models;

use CodeIgniter\Model;

class InboxModel extends Model
{
    protected $table            = 'tbl_inbox';
    protected $primaryKey       = 'inbox_id';
    protected $allowedFields    = ['inbox_name', 'inbox_email', 'inbox_subject', 'inbox_message', 'inbox_status'];
}
