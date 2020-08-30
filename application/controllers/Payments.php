<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Payments extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');

        $this->load->model('crud_model');
        $this->load->model('email_model');
        $this->load->model('sms_model');
        $this->load->model('frontend_model');
    }

    public function index()
    {
        $data['page_name'] = 'payments';
        $data['page_title'] = get_phrase('invoice_payment');
        $this->load->view('backend/index', $data);
    }

    public function pay($invoice_id, $amount)
    {
        $data['invoice_id'] = $invoice_id;
        $data['page_name'] = 'payments';
        $data['page_title'] = get_phrase('invoice_payment');
        $this->load->view('backend/index', $data);
    }

}
