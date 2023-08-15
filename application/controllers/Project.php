<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Project extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->library(array('session', 'pagination', 'form_validation'));
        $this->load->database();
        $this->load->model('Model_project');

        ini_set('max_execution_time', 0);
        ini_set('memory_limit', '2048M');
    }

    public function index()
    {
        $data['title'] = 'Gallery Project - ATAP TEDUH LESTARI';
        $data['banner_title'] = 'Gallery Project';
        $project_tot = $this->Model_project->tot_project();
        $from = $this->uri->segment(3);
        $data['discover_name'] = '';

        $config['base_url'] = base_url() . 'project/index/';
        $config['total_rows'] = $project_tot;
        $config['per_page'] = 9;
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
        $config['display_pages'] = FALSE;
        $data['pagination'] = $this->pagination->create_links();
        $this->pagination->initialize($config);

        $data['project_data'] = $this->Model_project->get_project($config['per_page'], $from);

        $this->load->view('layouts/header', $data);
        $this->load->view('layouts/components/navbar');
        $this->load->view('layouts/components/banner');
        $this->load->view('projects/index');
        $this->load->view('layouts/footer');
    }

    public function discover($keyword)
    {
        $keyword = str_replace('%20', ' ', $keyword);
        $data['title'] = 'Gallery Project - ATAP TEDUH LESTARI';
        $data['banner_title'] = 'Gallery Project';
        $data['project_data'] = $this->Model_project->discover_project($keyword);
        $data['discover_name'] = $keyword;

        $this->load->view('layouts/header', $data);
        $this->load->view('layouts/components/navbar');
        $this->load->view('layouts/components/banner');
        $this->load->view('projects/index');
        $this->load->view('layouts/footer');
    }

    public function search()
    {
        $data['title'] = 'Gallery Project - ATAP TEDUH LESTARI';
        $data['banner_title'] = 'Gallery Project';

        $keyword = removeSpecialChar($this->input->post('keyword'));
        $search = ($this->uri->segment(3)) ? $this->uri->segment(3) : $keyword;
        $project_tot = $this->Model_project->tot_project($search);
        $from = $this->uri->segment(4);

        $config['base_url'] = base_url() . 'project/search/' . $search;
        $config['total_rows'] = $project_tot;
        $config['per_page'] = 9;
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
        $config['display_pages'] = FALSE;
        $this->pagination->initialize($config);

        $data['project_data'] = $this->Model_project->get_project($config['per_page'], $from, $search);

        $this->load->view('layouts/header', $data);
        $this->load->view('layouts/components/navbar');
        $this->load->view('layouts/components/banner');
        $this->load->view('projects/index');
        $this->load->view('layouts/footer');
    }

    public function videos()
    {
        $data['title'] = 'Gallery Videos - ATAP TEDUH LESTARI';
        $data['banner_title'] = 'Gallery Videos';

        $this->load->view('layouts/header', $data);
        $this->load->view('layouts/components/navbar');
        $this->load->view('layouts/components/banner');
        $this->load->view('projects/video');
        $this->load->view('layouts/footer');
    }
}
