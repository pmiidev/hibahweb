<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class ExampleAdminController extends BaseController
{
    public function __construct()
    {
    }
    public function index()
    {

        $data = [];

        return view('admin/v_example', $data);
    }
}
