<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class MY_Exceptions extends CI_Exceptions
{
    public function __construct()
    {
        parent::__construct();
    }

    function show_404($page = '', $log_error = TRUE)
    {
        $CI = &get_instance();
        $CI->output->set_status_header('404');
        $data['title'] = 'ATAP TEDUH LESTARI';
        $data['banner_title'] = '404';

        $CI->load->view('layouts/header', $data);
        $CI->load->view('layouts/components/navbar');
        $CI->load->view('layouts/components/banner');
        $CI->load->view('layouts/components/404_custom');
        $CI->load->view('layouts/footer');
        echo $CI->output->get_output();
        exit;
    }
}
