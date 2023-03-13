<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Post extends CI_Controller
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
        $data['title'] = 'News - ATAP TEDUH LESTARI';
        $data['banner_title'] = 'News';
        $news_tot = $this->Model_news->tot_news();
        $from = $this->uri->segment(3);

        $config['base_url'] = base_url() . 'post/index/';
        $config['total_rows'] = $news_tot;
        $config['per_page'] = 6;
        $config['first_link']       = 'First';
        $config['last_link']        = 'Last';
        $config['next_link']        = 'Next';
        $config['prev_link']        = 'Prev';
        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close']  = '</span>Next</li>';
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['last_tagl_close']  = '</span></li>';
        $data['pagination'] = $this->pagination->create_links();
        $this->pagination->initialize($config);

        $data['news_data'] = $this->Model_news->get_news($config['per_page'], $from);
        $data['archives'] = $this->Model_news->get_archive();

        $this->load->view('layouts/header', $data);
        $this->load->view('layouts/components/topbar');
        $this->load->view('layouts/components/navbar');
        $this->load->view('layouts/components/banner');
        $this->load->view('posts/index');
        $this->load->view('layouts/footer');
    }


    public function date($year, $month)
    {
        $data['title'] = 'News - ATAP TEDUH LESTARI';
        $data['banner_title'] = 'News';
        $data['archives'] = $this->Model_news->get_archive();
        $data['news_data'] = $this->Model_news->get_news_by_date($year, $month);

        $this->load->view('layouts/header', $data);
        $this->load->view('layouts/components/topbar');
        $this->load->view('layouts/components/navbar');
        $this->load->view('layouts/components/banner');
        $this->load->view('posts/index');
        $this->load->view('layouts/footer');
    }


    public function detail($id)
    {
        $data['title'] = 'Detail Posts - ATAP TEDUH LESTARI';
        $data['banner_title'] = 'Detail News';
        $data['news'] = $this->Model_news->first_news($id);
        $data['archives'] = $this->Model_news->get_archive();

        $this->load->view('layouts/header', $data);
        $this->load->view('layouts/components/topbar');
        $this->load->view('layouts/components/navbar');
        $this->load->view('layouts/components/banner', $data);
        $this->load->view('posts/detail');
        $this->load->view('layouts/footer');
    }
}
