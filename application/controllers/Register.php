<?php

if (!defined('BASEPATH'))
exit('No direct script access allowed');

class Register extends CI_Controller {

    
    /*
 * SamMarie Application V.1.0 Copyright 2014
 * Build Date : 17 Juli 2014
 * Founder & Programmer : Wisnu Groho Aji 
 * Website : http://wiqi.co
 */
    function __construct() {
        parent::__construct();
        $this->load->model("Models_auth");
    }
    
    function index(){
        
        $this->load->view("auth/Register");
    }
    
    function set(){
        $params['first_name'] = $this->input->post("firstname");
        $params['last_name'] = $this->input->post("lastname");
        $params['birth_date'] = $this->input->post("birth");
        $params['email'] = $this->input->post("email");
        $params['password'] = $this->input->post("password");
        $params['phone'] = $this->input->post("phone");
        $params['address'] = $this->input->post("address");
        $params['city'] = $this->input->post("city");
        $params['identity'] = $this->input->post("identity");
        $params['bank'] = $this->input->post("bank");
        $params['account'] = $this->input->post("account");
        $this->Models_auth->member_register($params);
    }
}
