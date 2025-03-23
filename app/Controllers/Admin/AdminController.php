<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\VisitorModel;
use App\Models\UserModel; 

class AdminController extends BaseController
{
    protected $visitorModel;
    protected $userModel;
    protected $akun;
    protected $active;

    public function __construct()
    {
        $this->visitorModel = new VisitorModel();
        $this->userModel = new UserModel();
        $this->akun = session()->get('akun'); // Sesuaikan jika akun diambil dari session
        $this->active = 'dashboard'; // Sesuaikan nilai default
    }

    public function index()
    {
        // Ambil statistik pengunjung
        $visitor = $this->visitorModel->visitor_statistics();
        $bulan = [];
        $value = [];

        foreach ($visitor as $result) {
            $bulan[] = $result['tgl']; // Sudah dalam format YYYY-MM-DD
            $value[] = (int) $result['jumlah']; // Pastikan data dalam bentuk integer
        }       

        // foreach ($visitor as $result) {
        //     $bulan[] = $result['tgl'];
        //     $value[] = (float) $result['jumlah'];
        // }

        // Hitung pengunjung bulan ini
        $visitor_this_month = $this->visitorModel->count_visitor_this_month();
        if ($visitor_this_month <= 0) {
            $visitor_this_month = 1;
        }

        // Ambil jumlah user
        $all_users = $this->userModel->count_all_users();

        // Hitung jumlah pengunjung berdasarkan platform
        $chrome_visitor  = ($this->visitorModel->count_chrome_visitors() / $visitor_this_month) * 100;
        $firefox_visitor = ($this->visitorModel->count_firefox_visitors() / $visitor_this_month) * 100;
        $explorer_visitor = ($this->visitorModel->count_explorer_visitors() / $visitor_this_month) * 100;
        $safari_visitor  = ($this->visitorModel->count_safari_visitors() / $visitor_this_month) * 100;
        $opera_visitor   = ($this->visitorModel->count_opera_visitors() / $visitor_this_month) * 100;
        $robot_visitor   = ($this->visitorModel->count_robot_visitors() / $visitor_this_month) * 100;
        $other_visitor   = ($this->visitorModel->count_other_visitors() / $visitor_this_month) * 100;

        $data = [
            'akun' => $this->akun,
            'title' => 'Dashboard',
            'active' => $this->active,
            'helper_text' => helper('text'),
            'breadcrumbs' => $this->request->getUri()->getSegments(),

            // 'month' => json_encode($bulan),
            // 'value' => json_encode($value),
            'month' => json_encode($bulan, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE),
            'value' => json_encode($value, JSON_NUMERIC_CHECK),
            
            'all_visitors' => $this->visitorModel->count_all_visitors(),
            'all_post_views' => $this->visitorModel->count_all_post_views(),
            'all_posts' => $this->visitorModel->count_all_posts(),
            'top_five_articles' => $this->visitorModel->top_five_articles(),
            'all_users' => $all_users, // Tambahkan data jumlah user

            'chrome_visitor'  => $chrome_visitor,
            'firefox_visitor' => $firefox_visitor,
            'explorer_visitor' => $explorer_visitor,
            'safari_visitor'  => $safari_visitor,
            'opera_visitor'   => $opera_visitor,
            'robot_visitor'   => $robot_visitor,
            'other_visitor'   => $other_visitor
        ];

        return view('admin/v_dashboard', $data);
    }
}
