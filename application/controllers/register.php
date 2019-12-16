<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class register extends CI_Controller{
    public function __construct()
    parent::__construct();
    if($this->session->userdata('id')){
        redirect('private_area');
    }
    $this->load->library('form_validation');
    $this->load->library('encrypt');
    $this->load->model('register_model');
}

function index(){
    $this->load->view('register');
}

function validation(){
    $this->form_validation->set_rules('user_name','Name','required|trim');
    $this->form_validation->set_rules('user_password','password','required');
    if($this->form_validation->run()){
        $result=$this->login_model->can_login($this->imput->post('user_email'),$this->imput->post('user_password'));
        if($result==''){
            redirect('private_area');
        }else{
            $this->session->set_flashdata('message',$result);
            redirect('login');
        }
    else{
        $this->index();
    }
    }
?>