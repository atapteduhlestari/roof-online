<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url', 'html', 'file'));
        $this->load->library(array('session', 'pagination', 'form_validation'));
        $this->load->database();
        $this->load->model(array('Model_news', 'Model_product', 'Model_candidates'));

        ini_set('max_execution_time', 0);
        ini_set('memory_limit', '2048M');
    }

    public $hiring = true;

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
        $data['title'] = 'Tentang - PT. ATAP TEDUH LESTARI';
        $data['banner_title'] = 'Tentang Kami';
        $data['meta_desc'] = 'Berawal dari sebuah usaha distributor Genteng Beton di Kota Medan yang dimulai pada tahun 1979, Ir. Eddy Mahadi mulai merintis usahanya sebagai Specialist Atap. Kemudian tahun 1991 membuka toko ATAP di Kota Medan, sebagai penyedia produk - produk atap yang menjadi cikal bakal berdirinya kantor - kantor PT. Atap Teduh Lestari di Indonesia';

        $this->load->view('layouts/header', $data);
        $this->load->view('layouts/components/navbar');
        $this->load->view('layouts/components/banner');
        $this->load->view('profile/about');
        $this->load->view('layouts/components/logo_product');
        $this->load->view('layouts/footer');
    }

    public function contact()
    {
        $data['title'] = 'Hubungi Kami - PT. ATAP TEDUH LESTARI';
        $data['banner_title'] = 'Hubungi Kami';
        $data['meta_desc'] = false;

        $this->load->view('layouts/header', $data);
        $this->load->view('layouts/components/navbar');
        $this->load->view('layouts/components/banner');
        $this->load->view('profile/contact');
        $this->load->view('layouts/footer');
    }

    public function career()
    {
        $data['title'] = 'Karir - PT. ATAP TEDUH LESTARI';
        $data['banner_title'] = 'Karir';
        $data['meta_desc'] = false;
        $data['hiring'] = $this->hiring;

        $this->load->view('layouts/header', $data);
        $this->load->view('layouts/components/navbar');
        $this->load->view('layouts/components/banner');
        $this->load->view('profile/career');
        $this->load->view('layouts/footer');
    }

    public function save()
    {
        if (!$this->input->post()) {
            $this->session->set_flashdata('error', 'Silahkan isi form lamaran');
            redirect('/karir', 'refresh');
        }
        if (!$this->hiring) {
            $this->session->set_flashdata('error', 'Belum ada lowongan!');
            redirect('/karir', 'refresh');
        }

        $this->form_validation->set_rules('nama', 'Nama', 'trim|required|callback_validate_name');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('phone', 'Phone', 'trim|required|integer');
        $this->form_validation->set_rules('position', 'Position', 'trim|required');
        $this->form_validation->set_rules('file_upload', 'File', 'trim|callback_file_check');
        $this->form_validation->set_rules('g-recaptcha-response', 'Captcha', 'trim|callback_captcha_check');
        if ($this->form_validation->run() == FALSE) {
            $this->career();
        }
        $data = $this->input->post();

        if ($this->form_validation->run()) {
            $candidateName = str_replace(' ', '_', trim($this->input->post('nama', TRUE)));
            $extension =  pathinfo($_FILES['file_upload']['name'], PATHINFO_EXTENSION);
            $filename = date('d-m-Y_his') . '-' . "$candidateName.$extension";
            $config['file_name']    = $filename;
            $config['upload_path']   = FCPATH . '/assets/documents/';
            $config['allowed_types'] = 'pdf|jpg|png|jpeg';
            $config['max_size']      = '1024';
            $config['overwrite']     = TRUE;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('file_upload')) {
                $this->session->set_flashdata('error', $this->upload->display_errors());
                redirect('/karir', 'refresh');
            }

            $data = [
                'nama' => $this->input->post('nama', TRUE),
                'email' => $this->input->post('email', TRUE),
                'phone' => $this->input->post('phone', TRUE),
                'position' => $this->input->post('position', TRUE),
                'file_upload' => $filename,
            ];

            $this->Model_candidates->insertDataCandidate($data);
            $this->session->set_flashdata('success', 'Terima kasih, lamaran anda akan segera kami proses!');
            redirect('/karir');
        }
        $this->session->set_flashdata('danger', 'Silahkan coba lagi!');
    }

    public function validate_name($name)
    {
        if (!preg_match('/^[a-zA-Z\s]+$/', $name)) {
            $this->form_validation->set_message('validate_name', 'The %s field may only contain alpha characters & White spaces');
            return false;
        }
        return true;
    }

    public function file_check()
    {
        $allowed_mime_type_arr = array('application/pdf');
        $maxsize  = 1048576;

        if (isset($_FILES['file_upload']['name']) && $_FILES['file_upload']['name'] != "") {

            if (($_FILES['file_upload']['size'] >= $maxsize) || ($_FILES["file_upload"]["size"] == 0)) {
                $this->form_validation->set_message('file_check', 'File harus kurang dari 1MB');
                return false;
            }

            $mime = get_mime_by_extension($_FILES['file_upload']['name']);

            if (in_array($mime, $allowed_mime_type_arr)) {
                trim($_FILES['file_upload']['name']);
                return true;
            }

            $this->form_validation->set_message('file_check', 'Unggah hanya file PDF');
            return false;
        }

        $this->form_validation->set_message('file_check', 'Mohon unggah CV anda');
        return false;
    }

    public function captcha_check()
    {
        if (isset($_POST['g-recaptcha-response']) && $_POST['g-recaptcha-response'] != "") {
            trim($_POST['g-recaptcha-response']);
            return true;
        }

        $this->form_validation->set_message('captcha_check', 'Please finish captcha');
        return false;
    }


    public function slug($table = false)
    {
        $data = $this->Model_product->set_slug($table);
        return $data;
    }

    // public function page_title($table = false)
    // {
    //     $data = $this->Model_product->set_page_title($table);
    //     return $data;
    // }
}
