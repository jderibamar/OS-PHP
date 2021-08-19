<?php

defined('BASEPATH') Or exit('Ação não permitida');

class Home extends CI_Controller
{
    public function __construct()
    {
          parent::__construct();
           
          if (!$this->ion_auth->logged_in()) //verifica se o usuário está logado
                {
                       $this->session->set_flashdata('info', 'Sua sessão expirou, faça LOGIN novamente!'); 
                       redirect('login');
                }
    }
    
    public function index()
    {           
           $this->load->view('layout/header');
           $this->load->view('home/index');
           $this->load->view('layout/footer');
                  
    }
}