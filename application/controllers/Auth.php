<?php

if (!defined('BASEPATH'))
exit('No direct script access allowed');

class Auth extends CI_Controller {
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
       $this->load->view("auth/login");
   }
   
   function login(){
       $this->load->view("auth/login");
   }
   
   function logout(){
       session_destroy(); 
       redirect("auth/login");
   }
   
   function set(){
       $checked['email'] = $this->input->post("email");
       $checked['password'] = $this->input->post("password");
       $this->Models_auth->member_login($checked);
   }
}
