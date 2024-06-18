<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Product extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->library(array('session', 'pagination'));
        $this->load->database();
        $this->load->model('Model_product');

        ini_set('max_execution_time', 0);
        ini_set('memory_limit', '2048M');
    }

    public function index()
    {
        $data['title'] = 'Produk - Atap, Waterproofing, Genteng Metal, Struktur Rangka, lnsulasi, Kusen, Pintu, dan Jendela';
        $data['banner_title'] = 'Product - ATAP TEDUH LESTARI';
        $data['meta_desc'] = 'Produk - Atap, Waterproofing, Genteng Metal, Struktur Rangka, lnsulasi, Kusen, Pintu, dan Jendela';

        $product_tot = $this->Model_product->tot_product();
        $data['product_tot'] = $product_tot;

        $config['base_url'] = base_url() . 'product/index/';
        $config['total_rows'] = $product_tot;
        $config['per_page'] = 9;
        $from = $this->uri->segment(3);
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

        $data['product_data'] = $this->Model_product->get_product($config['per_page'], $from);

        $this->load->view('layouts/header', $data);
        $this->load->view('layouts/components/navbar');
        $this->load->view('layouts/components/banner');
        $this->load->view('products/index');
        $this->load->view('layouts/footer');
    }

    public function kategori($id)
    {
        $product_tot = $this->Model_product->tot_product_category($id);
        $data['product_tot'] = $product_tot;

        $config['total_rows'] = $product_tot;
        $config['per_page'] = 9;
        $from = $this->uri->segment(4);
        $config['base_url'] = base_url() . 'product/kategori/' . $id . '/';
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

        $data['product_data'] = $this->Model_product->get_product_category($id, $config['per_page'], $from);
        $data['title'] = $data['product_data'][0]->page_title  . ' - PT. ATAP TEDUH LESTARI';
        $data['meta_desc'] = $data['product_data'][0]->meta_desc;
        $data['banner_title'] = 'Product Category: ' . $data['product_data'][0]->nama_kategori;

        $this->load->view('layouts/header', $data);
        $this->load->view('layouts/components/navbar');
        $this->load->view('layouts/components/banner');
        $this->load->view('products/index');
        $this->load->view('layouts/footer');
    }

    public function subkategori($id)
    {
        $product_tot = $this->Model_product->tot_product_subcategory($id);
        $data['product_tot'] = $product_tot;

        $config['base_url'] = base_url() . 'product/subkategori/' . $id . '/';
        $config['total_rows'] = $product_tot;
        $config['per_page'] = 9;
        $from = $this->uri->segment(4);
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

        $data['product_data'] = $this->Model_product->get_product_subcategory($id, $config['per_page'], $from);
        $data['title'] = $data['product_data'][0]->nama_subkategori . ' - PT. ATAP TEDUH LESTARI';
        $data['banner_title'] = 'Product Category: ' . $data['product_data'][0]->nama_subkategori;
        $data['meta_desc'] = $data['product_data'][0]->meta_desc;

        $this->load->view('layouts/header', $data);
        $this->load->view('layouts/components/navbar');
        $this->load->view('layouts/components/banner');
        $this->load->view('products/index');
        $this->load->view('layouts/footer');
    }

    public function detail($id)
    {
        if ($id == 56) header("Location: https://lestarijendela.com/");

        $data['product'] = $this->Model_product->product_first($id);
        $data['gambar_product'] = $this->Model_product->image_product($id);
        $data['gambar_project'] = $this->Model_product->image_project($id);
        $data['banner_title'] = 'Detail Product - ' . $data['product']->nama_produk;
        $data['title'] = $data['product']->page_title . ' - PT. ATAP TEDUH LESTARI';
        $data['meta_desc'] = $data['product']->meta_desc;
        $data['total_project'] =  $this->Model_product->tot_project($id);

        $this->load->view('layouts/header', $data);
        $this->load->view('layouts/components/navbar');
        $this->load->view('layouts/components/banner');
        $this->load->view('products/detail');
        $this->load->view('layouts/footer');
    }

    // public function search()
    // {

    //     $data['title'] = 'Product - ATAP TEDUH LESTARI';
    //     $data['banner_title'] = 'Product - ATAP TEDUH LESTARI';
    //     echo $this->input->post('keywords');
    //     die;
    // }
}
