<?php

if (!defined('BASEPATH'))
exit('No direct script access allowed');

class Models_auth extends CI_model {
/*
 * SamMarie Application V.1.0 Copyright 2014
 * Build Date : 17 Juli 2014
 * Founder & Programmer : Wisnu Groho Aji 
 * Website : http://wiqi.co
 */
    
    function __construct() {
        parent::__construct();
        $this->load->library("Encoder");
    }
   
    function member_register($params=array()){
        $email['tb_email_member'] = $params['email'];
        
        //checked email
        $check = $this->db->get_where('wq_member',$email)->num_rows();
        if($check>0){
            $this->session->set_flashdata("result_register","Email Sudah Terdaftar");
        }
        else{
            $insert['tb_firstname_member'] = $params['first_name'];
            $insert['tb_lastname_member'] = $params['last_name'];
            $insert['tb_birthdate_member'] = $params['birth_date'];
            $insert['tb_email_member'] = $params['email'];
            $encodepass = md5($params['password']);
            $insert['tb_password_member'] = $this->encoder->encode($encodepass);
            $insert['tb_phone_member'] = $params['phone'];
            $insert['tb_address_member'] = $params['address'];
            $insert['tb_city_member'] = $params['city'];
            $insert['tb_identity_member'] = $params['identity'];
            $insert['tb_bank_member'] = $params['bank'];
            $insert['tb_accountbank_member'] = $params['account'];
            
            //insert data
            $this->db->insert("wq_member",$insert);
            $this->session->set_flashdata("result_register","Pendaftaran Sukses, Tim Kami Melakukan Verifikasi Data Anda Terlebih Dahulu");
            
            redirect("auth");
        } 
    }
    
    function member_login($params=array()){
        $check['tb_email_member'] = $params['email'];
        $encodepass = md5($params['password']);
        //check user
        $checked = $this->db->get_where("wq_member",$check);
        if($checked->num_rows()>0){
            foreach ($checked->result() as $a){
                $encodedb = $this->encoder->decode($a->tb_password_member);
            }
            if($encodepass == $encodedb){
            foreach($checked->result() as $var){
                if ($var->tb_status_member==1 && $var->tb_verify_member==1){
                    //member active
                    $sess['token_verify'] = $this->encoder->encode($this->config->item('skey'));
                    $sess['fullname'] = $var->tb_firstname_member;
                    $sess['member_id'] = $this->encoder->encode($var->tb_id_member);
                    $this->session->set_userdata($sess);
                    redirect("Member/dashboard");
                }
                elseif ($var->tb_status_member==0 && $var->tb_verify_member==0) {
                    //member waiting verification
                    $this->session->set_flashdata("result_login",'Silahkan Tunggu User anda sedang dalam proses Verifikasi');
                    redirect("Auth/login");
                }
                else {
                    //member in blacklist
                    $this->session->set_flashdata("result_login",'Maaf User anda sudah masuk kedalam daftar Blacklist, silahkan hubungi report@wiqi.co');
                    redirect("Auth/login");
                }
            }
            }
            else{
                $this->session->set_flashdata("result_login",'Maaf Username Atau Password Anda Salah');
                redirect("Auth/login");
            }
        }
         else{
            $this->session->set_flashdata("result_login",'Maaf Anda Belum Terdaftar, Silahkan Register Terlebih Dahulu.');
            redirect("Auth/login");
          }
    }
}
