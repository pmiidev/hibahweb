<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table            = 'tbl_user';
    protected $primaryKey       = 'user_id';
    protected $allowedFields    = ['user_name', 'user_email', 'user_password', 'user_level', 'user_status', 'user_photo'];
}
