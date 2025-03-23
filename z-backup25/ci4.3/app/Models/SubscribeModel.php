<?php

namespace App\Models;

use CodeIgniter\Model;

class SubscribeModel extends Model
{
    protected $table            = 'tbl_subscribe';
    protected $primaryKey       = 'subscribe_id';
    protected $allowedFields    = ['subscribe_email', 'subscribe_status', 'subscribe_rating'];
}
