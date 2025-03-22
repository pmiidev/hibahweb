<?php

namespace App\Models;

use CodeIgniter\Model;

class VisitorModel extends Model
{
    protected $table            = 'tbl_visitors';
    protected $primaryKey       = 'visit_id';
    protected $allowedFields    = ['visit_date', 'visit_ip', 'visit_platform'];

    /**
     * Fungsi untuk mencatat kunjungan pengguna berdasarkan IP dan platform
     */
    public function count_visitor($user_ip, $agent)
    {
        $cek_ip = $this->where('visit_ip', $user_ip)
                       ->where('DATE(visit_date)', date('Y-m-d'))
                       ->countAllResults();

        if ($cek_ip < 1) {
            return $this->insert([
                'visit_ip'      => $user_ip,
                'visit_date'    => date('Y-m-d H:i:s'),
                'visit_platform'=> $agent
            ]);
        }
        return false;
    }

    /**
     * Statistik Pengunjung Bulan Ini
     */
    // public function visitor_statistics()
    // {
    //     return $this->select("DATE_FORMAT(visit_date,'%d') AS tgl, COUNT(visit_ip) AS jumlah")
    //                 ->where('MONTH(visit_date)', date('m'))
    //                 ->groupBy('tgl')
    //                 ->orderBy('tgl', 'ASC')
    //                 ->findAll();
    // }
    public function visitor_statistics()
    {
        return $this->select("DATE(visit_date) AS tgl, COUNT(visit_ip) AS jumlah")
                    ->where('MONTH(visit_date)', date('m'))
                    ->where('YEAR(visit_date)', date('Y')) // Pastikan hanya mengambil data tahun ini
                    ->groupBy('tgl')
                    ->orderBy('tgl', 'ASC')
                    ->findAll();
    }

    /**
     * Hitung Total Pengunjung
     */
    public function count_all_visitors()
    {
        return $this->countAll();
    }

    /**
     * Hitung Total View di Semua Post
     */
    public function count_all_post_views()
    {
        return $this->db->table('tbl_post_views')->countAll();
    }

    /**
     * Hitung Total Postingan
     */
    public function count_all_posts()
    {
        return $this->db->table('tbl_post')->countAll();
    }

    /**
     * Hitung Total Komentar
     */
    public function count_all_comments()
    {
        return $this->db->table('tbl_comment')->countAll();
    }

    /**
     * Ambil 5 Artikel Terpopuler berdasarkan View
     */
    public function top_five_articles()
    {
        return $this->db->table('tbl_post')
                        ->orderBy('post_views', 'DESC')
                        ->limit(5)
                        ->get()
                        ->getResultArray();
    }

    /**
     * Hitung Pengunjung Bulan Ini
     */
    public function count_visitor_this_month()
    {
        return $this->where('MONTH(visit_date)', date('m'))->countAllResults();
    }

    /**
     * Hitung Pengunjung Berdasarkan Browser
     */
    private function count_browser_visitors($browser)
    {
        return $this->where('visit_platform', $browser)
                    ->where('MONTH(visit_date)', date('m'))
                    ->countAllResults();
    }

    public function count_chrome_visitors()
    {
        return $this->count_browser_visitors('Chrome');
    }

    public function count_firefox_visitors()
    {
        return $this->whereIn('visit_platform', ['Firefox', 'Mozilla'])
                    ->where('MONTH(visit_date)', date('m'))
                    ->countAllResults();
    }

    public function count_explorer_visitors()
    {
        return $this->count_browser_visitors('Internet Explorer');
    }

    public function count_safari_visitors()
    {
        return $this->count_browser_visitors('Safari');
    }

    public function count_opera_visitors()
    {
        return $this->count_browser_visitors('Opera');
    }

    /**
     * Hitung Pengunjung yang merupakan Robot (Bot)
     */
    public function count_robot_visitors()
    {
        return $this->whereIn('visit_platform', ['YandexBot', 'Googlebot', 'Yahoo'])
                    ->where('MONTH(visit_date)', date('m'))
                    ->countAllResults();
    }

    /**
     * Hitung Pengunjung dari Browser Lainnya
     */
    public function count_other_visitors()
    {
        $excluded_platforms = ['YandexBot', 'Googlebot', 'Yahoo', 'Chrome', 'Firefox', 'Mozilla', 'Internet Explorer', 'Safari', 'Opera'];

        return $this->whereNotIn('visit_platform', $excluded_platforms)
                    ->where('MONTH(visit_date)', date('m'))
                    ->countAllResults();
    }
}
