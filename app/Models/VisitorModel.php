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
    function visitor_statistics()
    {
        $query = $this->db->query("SELECT DATE_FORMAT(visit_date,'%d') AS tgl,COUNT(visit_ip) AS jumlah FROM tbl_visitors WHERE MONTH(visit_date)=MONTH(CURDATE()) GROUP BY DATE(visit_date)");

        if ($query->getNumRows() > 0) {
            foreach ($query->getResult() as $data) {
                $result[] = $data;
            }
            return $result;
        }
    }

    function count_all_visitors()
    {
        $query = $this->db->table('tbl_visitors')->countAll();
        return $query;
    }

    function count_all_post_views()
    {
        $query = $this->db->table('tbl_post_views')->countAll();
        return $query;
    }

    function count_all_posts()
    {
        $query = $this->db->table('tbl_post')->countAll();
        return $query;
    }

    function count_all_comments()
    {
        $query = $this->db->table('tbl_comment')->countAll();
        return $query;
    }

    function top_five_articles()
    {
        $query = $this->db->query("SELECT * FROM tbl_post ORDER BY post_views DESC LIMIT 5");
        return $query;
    }

    function count_visitor_this_month()
    {
        $query = $this->db->query("SELECT COUNT(*) tot_visitor FROM tbl_visitors WHERE MONTH(visit_date)=MONTH(CURDATE())");
        return $query;
    }

    function count_chrome_visitors()
    {
        $query = $this->db->query("SELECT COUNT(*) chrome_visitor FROM tbl_visitors WHERE visit_platform='Chrome' AND MONTH(visit_date)=MONTH(CURDATE())");
        return $query;
    }

    function count_firefox_visitors()
    {
        $query = $this->db->query("SELECT COUNT(*) firefox_visitor FROM tbl_visitors WHERE (visit_platform='Firefox' OR visit_platform='Mozilla') AND MONTH(visit_date)=MONTH(CURDATE())");
        return $query;
    }

    function count_explorer_visitors()
    {
        $query = $this->db->query("SELECT COUNT(*) explorer_visitor FROM tbl_visitors WHERE visit_platform='Internet Explorer' AND MONTH(visit_date)=MONTH(CURDATE())");
        return $query;
    }

    function count_safari_visitors()
    {
        $query = $this->db->query("SELECT COUNT(*) safari_visitor FROM tbl_visitors WHERE visit_platform='Safari' AND MONTH(visit_date)=MONTH(CURDATE())");
        return $query;
    }

    function count_opera_visitors()
    {
        $query = $this->db->query("SELECT COUNT(*) opera_visitor FROM tbl_visitors WHERE visit_platform='Opera' AND MONTH(visit_date)=MONTH(CURDATE())");
        return $query;
    }

    function count_robot_visitors()
    {
        $query = $this->db->query("SELECT COUNT(*) robot_visitor FROM tbl_visitors WHERE (visit_platform='YandexBot' OR visit_platform='Googlebot' OR visit_platform='Yahoo') AND MONTH(visit_date)=MONTH(CURDATE())");
        return $query;
    }

    function count_other_visitors()
    {
        $query = $this->db->query("SELECT COUNT(*) other_visitor FROM tbl_visitors WHERE 
			(NOT visit_platform='YandexBot' AND NOT visit_platform='Googlebot' AND NOT visit_platform='Yahoo' 
			AND NOT visit_platform='Chrome' AND NOT visit_platform='Firefox' AND NOT visit_platform='Mozilla'
			AND NOT visit_platform='Internet Explorer' AND NOT visit_platform='Safari' AND NOT visit_platform='Opera') 
			AND MONTH(visit_date)=MONTH(CURDATE())");
        return $query;
    }
}
