<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Error extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    function index()
    {
        $this->output->set_status_header('404');
        $data['title'] = 'ATAP TEDUH LESTARI';
        $data['banner_title'] = '404';

        $this->load->view('layouts/header', $data);
        $this->load->view('layouts/components/navbar');
        $this->load->view('layouts/components/banner');
        $this->load->view('layouts/components/404_custom');
        $this->load->view('layouts/footer');
    }
}
