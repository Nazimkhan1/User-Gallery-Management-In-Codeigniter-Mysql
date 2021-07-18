<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$config['protocol'] = 'smtp';
$config['smtp_host'] = 'smtp.mail.gov.in';
$config['smtp_port'] = '465'; 
//$config['smtp_crypto'] = 'tls';
$config['smtp_crypto'] = 'ssl';
$config['smtp_user'] = 'bookings.bis';
$config['smtp_pass'] = 'Hari@9935';
$config['charset'] = 'utf-8';
$config['mailtype'] = 'html';
$config['newline'] = "rn";
