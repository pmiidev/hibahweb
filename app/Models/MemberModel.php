<?php

namespace App\Models;

use CodeIgniter\Model;

class MemberModel extends Model
{
    protected $table            = 'tbl_member';
    protected $primaryKey       = 'member_id';
    protected $allowedFields    = ['member_name', 'member_link', 'member_desc', 'member_image'];
}
