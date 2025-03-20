<?php

namespace App\Models;

use CodeIgniter\Model;

class TeamModel extends Model
{
    protected $table            = 'tbl_team';
    protected $primaryKey       = 'team_id';
    protected $allowedFields    = ['team_name', 'team_jabatan', 'team_image', 'team_twitter', 'team_facebook', 'team_instagram', 'team_linked'];
}
