<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

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
    
    function index()
    {
        
        $data['page_name']  = 'dashboard';
        $data['page_title'] = get_phrase('accountant_dashboard');
        $this->load->view('backend/index', $data);
    }
    
    function pay($invoice_id, $amount)
    {
        
        $data['page_name']  = 'dashboard';
        $data['page_title'] = get_phrase('accountant_dashboard');
        $this->load->view('backend/index', $data);
    }
    
}