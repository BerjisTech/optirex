<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Flutter Wave Library for CodeIgniter 3.X.X
 *
 * Library for Flutter Wave payment gateway. It helps to integrate Flutter Wave payment gateway's Standard Method
 * in the CodeIgniter application.
 *
 * It requires Flutterwave configuration file and it should be placed in the config directory.
 *
 * @package     CodeIgniter
 * @category    Libraries
 * @author      Jaydeep Goswami
 * @link        https://infinitietech.com
 * @GITHUB link https://github.com/jaydeepgiri/Flutterwave-Payments-CodeIgniter-3.X.X-Library
 * @license     https://github.com/jaydeepgiri/Flutterwave-Payments-CodeIgniter-3.X.X-Library/blob/master/LICENSE
 * @version     1.0
 */


// ------------------------------------------------------------------------
// Flutter Wave library configuration
// ------------------------------------------------------------------------

// Flutter Wave environment, Sandbox or Live

$config['sandbox'] = FALSE; //TRUE for Sandbox - FALSE for live environment

// Flutter Wave API endpoints for Sandbox & Live
$config['payment_endpoint'] = ($config['sandbox']) ? 'https://ravesandboxapi.flutterwave.com/flwv3-pug/getpaidx/api/v2/hosted/pay' : 'https://api.ravepay.co/flwv3-pug/getpaidx/api/v2/hosted/pay';
$config['verify_endpoint'] = ($config['sandbox']) ? 'https://ravesandboxapi.flutterwave.com/flwv3-pug/getpaidx/api/v2/verify' : 'https://api.ravepay.co/flwv3-pug/getpaidx/api/v2/verify';

/* Configuration stars from here */
// Flutter Wave Credentials 
$config['PBFPubKey'] = ($config['sandbox']) ? 'FLWPUBK-7e91968abdbf7916012959d7ec34ddaa-X' : 'FLWPUBK-7e91968abdbf7916012959d7ec34ddaa-X'; /* Public Key for Sandbox : Live */
$config['SECKEY'] = ($config['sandbox']) ? 'FLWSECK-0505fb5d9d3f48dcd46fc725667c6131-X' : 'FLWSECK-0505fb5d9d3f48dcd46fc725667c6131-X'; /* Secret Key for Sandbox : Live */
$config['encryption_key'] = ($config['sandbox']) ? '0505fb5d9d3f6f2b773b837d' : '0505fb5d9d3f6f2b773b837d'; /* Encryption Key for Sandbox : Live */

// Webhook Secret Hash 
$config['secret_hash'] = ($config['sandbox']) ? 'TEST_SECRET_HASH' : 'LIVE_SECRET_HASH$'; /* Secret HASH for Sandbox : Live */

// What is the default currency?
// $config['currency'] = 'USD';  /* Store Currency Code */
$config['currency'] = 'KES';  /* Store Currency Code */

// Transaction Prefix if any
$config['txn_prefix'] = 'TXN_PREFIX';  /* Transaction ID Prefix if any */
