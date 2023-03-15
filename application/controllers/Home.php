<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library(array('session', 'pagination'));
        $this->load->database();
        $this->load->model('Model_news');

        ini_set('max_execution_time', 0);
        ini_set('memory_limit', '2048M');
    }

    public function index()
    {
        $data['title'] = 'ATAP TEDUH LESTARI';
        $data['news_data'] = $this->Model_news->get_news();

        $this->load->view('layouts/header', $data);
        $this->load->view('layouts/components/navbar');
        $this->load->view('home');
        $this->load->view('layouts/footer');
    }

    public function about()
    {
        $data['title'] = 'About - ATAP TEDUH LESTARI';
        $data['banner_title'] = 'About Us';

        $this->load->view('layouts/header', $data);
        $this->load->view('layouts/components/navbar');
        $this->load->view('layouts/components/banner', $data);
        $this->load->view('profile/about');
        $this->load->view('layouts/footer');
    }

    public function contact()
    {
        $data['title'] = 'Contact - ATAP TEDUH LESTARI';
        $data['banner_title'] = 'Contact';

        $this->load->view('layouts/header', $data);
        $this->load->view('layouts/components/navbar');
        $this->load->view('layouts/components/banner', $data);
        $this->load->view('profile/contact');
        $this->load->view('layouts/footer');
    }
}
