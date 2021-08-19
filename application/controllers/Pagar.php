<?php

defined('BASEPATH') OR exit('Ação não permitida');

class Pagar extends CI_Controller
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
                                       'titulo' => 'Contas a pagar cadastradas',
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
                                         'contas_pagar' =>  $this->financeiro_model->get_all_pagar(),
                                );

//                                echo '<pre>';
//                                print_r($data['contas_pagar']);
//                                exit();
            
            $this->load->view('layout/header', $data);
            $this->load->view('pagar/index');
            $this->load->view('layout/footer');
    }
    
        public function edit($pagar_id = NULL)
    {
           if(!$pagar_id || !$this->core_model->get_by_id('contas_pagar', array('conta_pagar_id' => $pagar_id)))
           {
                   $this->session->set_flashdata('error', 'Conta não encontrada');
                   redirect('pagar');
           }
           else
           {
                   $this->form_validation->set_rules('conta_pagar_valor', '', 'trim|required|min_length[2]|max_length[15]');
                   $this->form_validation->set_rules('conta_pagar_data_vencimento', '', 'trim|required|min_length[2]|max_length[20]');
                   $this->form_validation->set_rules('conta_pagar_fornecedor_id', '', 'required');
                   $this->form_validation->set_rules('conta_pagar_obs', '', 'max_length[500]');

                   if($this->form_validation->run())
                   {
                         
                             $data = elements
                                                       (
                                                                array
                                                                   (
                                                                        'conta_pagar_fornecedor_id',
                                                                        'conta_pagar_valor',
                                                                        'conta_pagar_data_vencimento',
                                                                        'conta_pagar_data_pagamento',
                                                                        'conta_pagar_data_alteracao',
                                                                        'conta_pagar_status',
                                                                        'conta_pagar_obs',
                                                                   ), $this->input->post()
                                                       );
//                             $status = $this->input->post('conta_pagar_status');
                             
                             $data = html_escape($data);

                             $this->core_model->atualizar('contas_pagar', $data, array('conta_pagar_id' => $pagar_id));
                             redirect('pagar');

//                           exit('Validado');
                   }
                   else
                   {
                       $data = array
                       (
                              'titulo' => 'Atualizar contas a pagar', 
                              'styles' => array('vendor/select2/select2.min.css'),
                              'scripts' => array('vendor/select2/select2.min.js', 'vendor/select2/custom.js', 'vendor/mask/jquery.mask.min.js', 'vendor/mask/masks.js', 'js/scripts.js'),
                              'conta_pagar'  => $this->core_model->get_by_id('contas_pagar', array('conta_pagar_id' => $pagar_id)),
                              'fornecedores'  => $this->core_model->get_all('fornecedores'),
//                              'data_vencimento' => $this->core_model->get_by_id('contas_pagar', array('conta_pagar_data_vencimento' => $pagar_id))
                       );
                       
                       $this->load->view('layout/header', $data);
                       $this->load->view('pagar/edit');
                       $this->load->view('layout/footer');
                   }
           }
   }
    
     public function add()
    {
                   $this->form_validation->set_rules('conta_pagar_valor', '', 'trim|required|min_length[2]|max_length[15]');
                   $this->form_validation->set_rules('conta_pagar_data_vencimento', '', 'trim|required|min_length[2]|max_length[20]');
                   $this->form_validation->set_rules('conta_pagar_fornecedor_id', '', 'required');
                   $this->form_validation->set_rules('conta_pagar_obs', '', 'max_length[500]');

                   if($this->form_validation->run())
                   {
                            $data = elements
                                                      (
                                                               array
                                                                  (
                                                                       'conta_pagar_fornecedor_id',
                                                                       'conta_pagar_valor',
                                                                       'conta_pagar_data_vencimento',
                                                                       'conta_pagar_data_pagamento',
                                                                       'conta_pagar_data_alteracao',
                                                                       'conta_pagar_status',
                                                                       'conta_pagar_obs',
                                                                  ), $this->input->post()
                                                      );
//                            $status = $this->input->post('conta_pagar_status');

                            $data = html_escape($data);

                            $this->core_model->inserir('contas_pagar', $data);
                            redirect('pagar');

    //                           exit('Validado');
                   }
                   else
                   {
                       $data = array
                       (
                              'titulo' => 'Cadastrar contas a pagar', 
                              'styles' => array('vendor/select2/select2.min.css'),
                              'scripts' => array('vendor/select2/select2.min.js', 'vendor/select2/custom.js', 'vendor/mask/jquery.mask.min.js', 'vendor/mask/masks.js', 'js/scripts.js'),
                              'fornecedores'  => $this->core_model->get_all('fornecedores')
                       );

                       $this->load->view('layout/header', $data);
                       $this->load->view('pagar/add');
                       $this->load->view('layout/footer');
                   }
   }
   
   public function del($pg_id = null)
   {
          if(!$pg_id || !$this->core_model->get_by_id('contas_pagar', array('conta_pagar_id' => $pg_id)))
          {
                $this->session->set_flashdata('error', 'Conta não encontrada!');
                redirect('pagar');
          }
          
          if($this->core_model->get_by_id('contas_pagar', array('conta_pagar_id' => $pg_id, 'conta_pagar_status' => 0)))
          {
                $this->session->set_flashdata('info', 'Esta conta não pode se excluída porque não foi paga!');
                redirect('pagar');
          }
          
          else
          {
                $this->core_model->apagar('contas_pagar', array('conta_pagar_id' => $pg_id));
                $this->session->set_flashdata('sucesso', 'Conta apagada com sucesso!');
                redirect('pagar');
          }
   }
    
}    