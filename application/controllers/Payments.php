<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Payments extends CI_Controller
{
    protected $response = '';

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
        $this->load->library('flutterwave_lib');

        $this->load->model('crud_model');
        $this->load->model('email_model');
        $this->load->model('sms_model');
        $this->load->model('frontend_model');
        
		$this->load->helper('url');
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

    public function create_transaction()
	{
		$data = $this->input->post();
		echo "<pre>";
		// print_r($data);
		$data = array(
            'amount'=>$data['amount'],
			'customer_email' => $data['customer_email'],
			'redirect_url'=>base_url("payments/payment_status/".$data['payment_type'].'/'.$this->session->userdata('login_user_id').'/'.$data['invoice_id'].'/'.$data['amount'].'/'.$this->session->userdata('login_type')),
			'payment_plan'=>$data['payment_plan']
		);
		$this->response = $this->flutterwave_lib->create_payment($data);
		print_r($this->response);
		if(!empty($this->response) || $this->response != ''){
			$this->response = json_decode($this->response,1);
			if(isset($this->response['status']) && $this->response['status'] == 'success'){
				redirect($this->response['data']['link']);
			}else{
				redirect(base_url('payments/'.$data['invoice_id'].'/'.$data['amount'].'?message_type=danger&message=API returned error >> '.$this->response['message']));
			}
		}
		// $this->load->view('payments/payment_form');
	}
	public function payment_status($payment_type, $login_user_id, $invoice_id, $amount, $login_type)
	{
        $this->session->set_userdata('login_type', $login_type);
        $this->session->set_userdata('login_user_id', $login_user_id);
        $this->session->set_userdata($login_type.'_login', 1);
        $data['invoice_id'] = $invoice_id;
        $data['amount'] = $amount;

		$params = $this->input->get();
		if(empty($params)){
			$data['status'] = 'error';
			$data['message'] = "No parameters found.";
				
            $data['page_name'] = 'payment_status';
            $data['page_title'] = get_phrase('error');
            $this->load->view('backend/index', $data);
			
		}elseif(isset($params['txref']) && !empty($params['txref'])){
			$response = $this->flutterwave_lib->verify_transaction($params['txref']);
			if(!empty($response)){
				$response = json_decode($response,1);
				if($response['status'] == 'success' && isset($response['data']['chargecode']) && ( $response['data']['chargecode'] == '00' || $response['data']['chargecode'] == '0') ){
					
					$data['payment_plan']    = $response['data']['paymentplan'];
					$data['customer_email']         = $response['data']['custemail'];
					$data['txn_id']         = $response['data']['txref'];
					$data['amount']    = $response['data']['amount'];
					$data['currency_code']  = $response['data']['currency'];
					$data['status']         = $response['data']['status'];
					$data['message']        = $response['message'];
					$data['full_data']      = $response;
					$data['payment_method']      = $response['data']['authmodel'];
					
					/* 
						Perform Database Operations here 
						Add your custom code here for any other operation like 
						selling good / inserting / update transaction record in database / anything else
							Or 
						to make payment system more secure you can make use of Webhook for one extra layer of security.  
                    */
                    $pay = array( 
                        'payment_id' => "",
                        'type' => $payment_type, 
                        'amount' => $amount, 
                        'title' => $data['txn_id'], 
                        'description' => $data['message'], 
                        'payment_method' => $data['payment_method'], 
                        'invoice_number' => $invoice_id, 
                        'timestamp' => time());
                    
                    $this->db->insert('payment', $pay);
                    $this->db->where('invoice_id', $invoice_id)->set('status', 'paid')->update('invoice');
					
				
                    $data['page_name'] = 'payment_status';
                    $data['page_title'] = get_phrase('success');
                    $this->load->view('backend/index', $data);
					
				}elseif( (isset($params['cancelled']) && $params['cancelled'] == true)){
					$data['status'] = 'cancelled';
					$data['message'] = 'Payment Cancelled by you or some other reasons. Try again!';
					$data['full_data']      = "No data found";
				
                    $data['page_name'] = 'payment_status';
                    $data['page_title'] = get_phrase('cancelled');
                    $this->load->view('backend/index', $data);
				}elseif( $response['status'] == 'error'){
					$data['status'] = 'error';
					$data['message'] = $response['message'];
					$data['full_data']      = $response;
				
                    $data['page_name'] = 'payment_status';
                    $data['page_title'] = get_phrase('error');
                    $this->load->view('backend/index', $data);
				}
			}else{
				$data['status'] = 'error';
				$data['message'] = "No data returned from ";
				
                $data['page_name'] = 'payment_status';
                $data['page_title'] = get_phrase('error');
                $this->load->view('backend/index', $data);
			}
		}
	}/* end of payment_status() */
	
	
	/* 
		Flutter wave webhook 
		-------------------------------------------------------------
		You can give this URL in flutter wave dashboard as webhook URL 
		Ex: yourdomain.com/payments/webhook
	*/
    public function webhook(){
        $this->config->load('flutterwave');
        
        $local_secret_hash = $this->config->item('secret_hash');
        
        $body = @file_get_contents("php://input");
        
        $response = json_decode($body,1);
        
		/* 
			to store the flutter wave response and server response into the log file, 
			which can be found under 'application/logs/' folder

			Make a note many times codeIgniter cannot directly read the values of '$_SERVER' variable therefore if such problem arises 
			you can add the following line in your root .htaccess file
			
			SetEnvIf Authorization "(.*)" HTTP_AUTHORIZATION=$1 
			
		*/
        log_message('debug', 'Flutter Wave Webhook - Normal Response - JSON DATA --> ' . var_export($response, true));
        log_message('debug', 'Server Variable --> '.var_export($_SERVER,true));
        
		/* Reading the signature sent by flutter wave webhook */
        $signature = (isset($_SERVER['HTTP_VERIF_HASH']))?$_SERVER['HTTP_VERIF_HASH']:'';
        
		/* comparing our local signature with received signature */
        if(empty($signature) || $signature != $local_secret_hash ){
            log_message('error', 'Flutter Wave Webhook - Invalid Signature - JSON DATA --> ' . var_export($response, true));
            log_message('error', 'Server Variable --> '.var_export($_SERVER,true));
            exit();
        }
		
        if(strtolower($response['status']) == 'successful') {
            // TIP: you may still verify the transaction
            // before giving value.
            $response = $this->flutterwave->verify_transaction($response['txRef']);
            
            $response = json_decode($response,1);
            
            if(!empty($response) && isset($response['data']['status']) && strtolower($response['data']['status']) == 'successful' 
                && isset($response['data']['chargecode']) && ( $response['data']['chargecode'] == '00' || $response['data']['chargecode'] == '0')
            ){
                
                $payer_email = $response['data']['custemail'];
                $paymentplan = $response['data']['paymentplan'];
                
                /* 
					Perform Database Operations here 
					Add your custom code here for any other operation like 
					selling good / inserting / update transaction record in database / anything else
				*/
                
            }else{
                /* Transaction failed */
                log_message('error', 'Flutter Wave Webhook - Inner Verification Failed --> ' . var_export($response, true));
                log_message('error', 'Server Variable -->  '.var_export($_SERVER,true));
            }
            
        }else{
            /* Transaction failed */
            log_message('error', 'Flutter Wave Webhook - Outter Verification Failed --> ' . var_export($response, true));
            log_message('error', 'Server Variable -->  '.var_export($_SERVER,true));
        }
        
    }

}
