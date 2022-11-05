<?php

namespace App\Models;

use CodeIgniter\Model;

class VisitorModel extends Model
{
    protected $table            = 'tbl_visitors';
    protected $primaryKey       = 'visit_id';
    protected $allowedFields    = ['visit_date', 'visit_ip', 'visit_platform'];

    public function count_visitor($user_ip, $agent)
    {
        $cek_ip = $this->db->query("SELECT * FROM tbl_visitors WHERE visit_ip='$user_ip' AND DATE(visit_date)=CURDATE()")->getNumRows();
        if ($cek_ip < 1) {
            $hsl = $this->db->query("INSERT INTO tbl_visitors (visit_ip,visit_platform) VALUES('$user_ip','$agent')");
            return $hsl;
        }
    }
}
