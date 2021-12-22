<?php

namespace App\Controllers;

use App\Models\M_admin;


class Main extends BaseController
{
    public function __construct()
    {
        $this->M_admin = new M_admin();
    }
    public function index()
    {
        return view('dashboard');
    }
}