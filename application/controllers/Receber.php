<?php

defined('BASEPATH') OR exit('Ação não permitida');

class Receber extends CI_Controller
{
    public function __construct()
    {
            parent::__construct();
            
              if (!$this->ion_auth->logged_in()) //verifica se o usuário está logado
                {
                       $this->session->set_flashdata('info', 'Sua sessão expirou, faça LOGIN novamente!'); 
                       redirect('login');
                }
                
                $this->load->model('financeiro_model');
    }
    
     public function index() 
    {
            $data = array
                                (
                                       'titulo' => 'Contas a receber cadastradas',
                                        'styles' =>  array
                                                  (
                                                     'vendor/datatables/dataTables.bootstrap4.min.css'
                                                   ),
                                        'scripts' => array
                                                           (
                                                              'vendor/datatables/jquery.dataTables.min.js',
                                                               'vendor/datatables/dataTables.bootstrap4.min.js',
                                                               'vendor/datatables/app.js',
                                                           ),
                                         'contas_receber' =>  $this->financeiro_model->get_all_receber(),
                                );

//                                echo '<pre>';
//                                print_r($data['contas_receber']);
//                                exit();
            
            $this->load->view('layout/header', $data);
            $this->load->view('receber/index');
            $this->load->view('layout/footer');
    }
    
        public function edit($receber_id = NULL)
    {
           if(!$receber_id || !$this->core_model->get_by_id('contas_receber', array('conta_receber_id' => $receber_id)))
           {
                   $this->session->set_flashdata('error', 'Conta não encontrada');
                   redirect('receber');
           }
           else
           {
                   $this->form_validation->set_rules('conta_receber_valor', '', 'trim|required|min_length[2]|max_length[15]');
                   $this->form_validation->set_rules('conta_receber_data_vencimento', '', 'trim|required|min_length[2]|max_length[20]');
                   $this->form_validation->set_rules('conta_receber_cliente_id', '', 'required');
                   $this->form_validation->set_rules('conta_receber_obs', '', 'max_length[500]');

                   if($this->form_validation->run())
                   {
                         
                             $data = elements
                                                       (
                                                                array
                                                                   (
                                                                        'conta_receber_cliente_id',
                                                                        'conta_receber_valor',
                                                                        'conta_receber_data_vencimento',
                                                                        'conta_receber_data_pagamento',
                                                                        'conta_receber_data_alteracao',
                                                                        'conta_receber_status',
                                                                        'conta_receber_obs',
                                                                   ), $this->input->post()
                                                       );
//                             $status = $this->input->post('conta_receber_status');
                             
                             $data = html_escape($data);

                             $this->core_model->atualizar('contas_receber', $data, array('conta_receber_id' => $receber_id));
                             redirect('receber');

//                           exit('Validado');
                   }
                   else
                   {
                       $data = array
                       (
                              'titulo' => 'Atualizar conta a receber', 
                              'styles' => array('vendor/select2/select2.min.css'),
                              'scripts' => array('vendor/select2/select2.min.js', 'vendor/select2/custom.js', 'vendor/mask/jquery.mask.min.js', 'vendor/mask/masks.js', 'js/scripts.js'),
                              'conta_receber'  => $this->core_model->get_by_id('contas_receber', array('conta_receber_id' => $receber_id)),
                              'clientes'  => $this->core_model->get_all('clientes'),
//                              'data_vencimento' => $this->core_model->get_by_id('contas_receber', array('conta_receber_data_vencimento' => $receber_id))
                       );
                       
                       $this->load->view('layout/header', $data);
                       $this->load->view('receber/edit');
                       $this->load->view('layout/footer');
                   }
           }
   }
    
     public function add()
    {
                   $this->form_validation->set_rules('conta_receber_valor', '', 'trim|required|min_length[2]|max_length[15]');
                   $this->form_validation->set_rules('conta_receber_data_vencimento', '', 'trim|required|min_length[2]|max_length[20]');
                   $this->form_validation->set_rules('conta_receber_cliente_id', '', 'required');
                   $this->form_validation->set_rules('conta_receber_obs', '', 'max_length[500]');

                   if($this->form_validation->run())
                   {
                            $data = elements
                                                      (
                                                               array
                                                                  (
                                                                       'conta_receber_cliente_id',
                                                                       'conta_receber_valor',
                                                                       'conta_receber_data_vencimento',
                                                                       'conta_receber_data_pagamento',
                                                                       'conta_receber_data_alteracao',
                                                                       'conta_receber_status',
                                                                       'conta_receber_obs',
                                                                  ), $this->input->post()
                                                      );
//                            $status = $this->input->post('conta_receber_status');

                            $data = html_escape($data);

                            $this->core_model->inserir('contas_receber', $data);
                            redirect('receber');

    //                           exit('Validado');
                   }
                   else
                   {
                       $data = array
                       (
                              'titulo' => 'Cadastrar conta a receber', 
                              'styles' => array('vendor/select2/select2.min.css'),
                              'scripts' => array('vendor/select2/select2.min.js', 'vendor/select2/custom.js', 'vendor/mask/jquery.mask.min.js', 'vendor/mask/masks.js', 'js/scripts.js'),
                              'clientes'  => $this->core_model->get_all('clientes')
                       );

                       $this->load->view('layout/header', $data);
                       $this->load->view('receber/add');
                       $this->load->view('layout/footer');
                   }
   }
   
   public function del($pg_id = null)
   {
          if(!$pg_id || !$this->core_model->get_by_id('contas_receber', array('conta_receber_id' => $pg_id)))
          {
                $this->session->set_flashdata('error', 'Conta não encontrada!');
                redirect('receber');
          }
          
          if($this->core_model->get_by_id('contas_receber', array('conta_receber_id' => $pg_id, 'conta_receber_status' => 0)))
          {
                $this->session->set_flashdata('info', 'Esta conta não pode se excluída porque não foi paga!');
                redirect('receber');
          }
          
          else
          {
                $this->core_model->apagar('contas_receber', array('conta_receber_id' => $pg_id));
                $this->session->set_flashdata('sucesso', 'Conta apagada com sucesso!');
                redirect('receber');
          }
   }
    
}    