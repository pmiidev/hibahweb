<?php

namespace App\Models;

use CodeIgniter\Model;

class SiteModel extends Model
{
    protected $table            = 'tbl_site';
    protected $primaryKey       = 'site_id';
    protected $allowedFields    = ['site_name', 'site_title', 'site_description', 'site_favicon', 'site_logo_header', 'site_logo_footer', 'site_logo_big', 'site_facebook', 'site_twitter', 'site_instagram', 'site_pinterest', 'site_linkedin', 'site_wa', 'site_mail'];
}
