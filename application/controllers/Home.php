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
        $data['title'] = 'PT. ATAP TEDUH LESTARI - Atap, Waterproofing, Genteng Metal, Struktur Rangka, lnsulasi, Kusen, Pintu, dan Jendela';
        $data['meta_desc'] = false;
        $data['news_data'] = $this->Model_news->get_news();

        $this->load->view('layouts/header', $data);
        $this->load->view('layouts/components/navbar');
        $this->load->view('home');
        $this->load->view('layouts/footer');
    }

    public function about()
    {
        $data['title'] = 'About - PT. ATAP TEDUH LESTARI';
        $data['banner_title'] = 'About Us';
        $data['meta_desc'] = 'Berawal dari sebuah usaha distributor Genteng Beton di Kota Medan yang dimulai pada tahun 1979, Ir. Eddy Mahadi mulai merintis usahanya sebagai Specialist Atap. Kemudian tahun 1991 membuka toko ATAP di Kota Medan, sebagai penyedia produk - produk atap yang menjadi cikal bakal berdirinya kantor - kantor PT. Atap Teduh Lestari di Indonesia';

        $this->load->view('layouts/header', $data);
        $this->load->view('layouts/components/navbar');
        $this->load->view('layouts/components/banner', $data);
        $this->load->view('profile/about');
        $this->load->view('layouts/components/logo_product');
        $this->load->view('layouts/footer');
    }

    public function contact()
    {
        $data['title'] = 'Contact Us - PT. ATAP TEDUH LESTARI';
        $data['banner_title'] = 'Contact Us';
        $data['meta_desc'] = false;

        $this->load->view('layouts/header', $data);
        $this->load->view('layouts/components/navbar');
        $this->load->view('layouts/components/banner', $data);
        $this->load->view('profile/contact');
        $this->load->view('layouts/footer');
    }
}
