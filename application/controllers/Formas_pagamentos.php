
<?php

defined('BASEPATH') OR exit('Ação não permitida');

class Formas_pagamentos extends CI_Controller
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
            $data = array
                                (
                                       'titulo' => 'Formas de pagamentos cadastradas',
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
                                         'formas_pagamentos' =>  $this->core_model->get_all('formas_pagamentos'),
                                );

//                                echo '<pre>';
//                                print_r($data['formas_pagamentos']);
//                                exit();
            
            $this->load->view('layout/header', $data);
            $this->load->view('formas_pagamentos/index');
            $this->load->view('layout/footer');
    }
    
     public function edit($f_pgto_id = NULL)
    {
           if(!$f_pgto_id || !$this->core_model->get_by_id('formas_pagamentos', array('forma_pagamento_id' => $f_pgto_id)))
           {
                   $this->session->set_flashdata('error', 'Forma de pagamento não encontrada');
                   redirect('formas_pagamentos');
           }
           else
           {
                   $this->form_validation->set_rules('forma_pagamento_nome', '', 'trim|required|min_length[2]|max_length[45]|callback_check_nome');

                   if($this->form_validation->run())
                   {
                            $f_pgto_ativa = $this->input->post('forma_pagamento_ativa');
                            
                            //verificação para vendas
                            if($this->db->table_exists('vendas'))
                            {
                                    if($f_pgto_ativa == 0 && $this->core_model->get_by_id('vendas', array('venda_forma_pagamento_id' => $f_pgto_id, 'venda_status' => 0)))
                                    {
                                            $this->session->set_flashdata('info', 'Essa forma de pagamento não pode ser desativada, pois está sendo utilizada em Vendas');
                                            redirect('pagamento');
                                    }
                            }
                            
                            //verificação para OSs
                            if($this->db->table_exists('ordem_servicos'))
                            {
                                    if($f_pgto_ativa == 0 && $this->core_model->get_by_id('ordem_servicos', array('ordem_servico_forma_pagamento_id' => $f_pgto_id, 'ordem_servico_status' => 0)))
                                    {
                                            $this->session->set_flashdata('info', 'Essa forma de pagamento não pode ser desativada, pois está sendo utilizada em Vendas');
                                            redirect('pagamento');
                                    }
                            }
                        
                            $data = elements
                                                      (
                                                               array
                                                                  (
                                                                       'forma_pagamento_nome',
                                                                       'forma_pagamento_aceita_parc',
                                                                       'forma_pagamento_ativa',
                                                                       'forma_pagamento_data_alteracao'
                                                                  ), $this->input->post()
                                                      );

                            $data = html_escape($data);

                            $this->core_model->atualizar('formas_pagamentos', $data, array('forma_pagamento_id' => $f_pgto_id));
                            redirect('pagamento');

    //                           exit('Validado');
              }
                   else
                   {
                       $data = array
                       (
                              'titulo' => 'Atualizar forma de pagamento',                                
                              'scripts' => array('vendor/mask/jquery.mask.min.js', 'vendor/mask/masks.js'),
                              'f_pgto'  => $this->core_model->get_by_id('formas_pagamentos', array('forma_pagamento_id' => $f_pgto_id))
                       );

                       $this->load->view('layout/header', $data);
                       $this->load->view('formas_pagamentos/edit');
                       $this->load->view('layout/footer');
                   }
           }
   }
       
     public function add()
    {
                   $this->form_validation->set_rules('forma_pagamento_nome', 'Forma pagamento', 'trim|required|min_length[2]|max_length[45]|is_unique[formas_pagamentos.forma_pagamento_nome]');

                   if($this->form_validation->run())
                   {
                            $data = elements
                                                      (
                                                               array
                                                                  (
                                                                       'forma_pagamento_nome',
                                                                       'forma_pagamento_aceita_parc',
                                                                       'forma_pagamento_ativa',
                                                                       'forma_pagamento_data_alteracao'
                                                                  ), $this->input->post()
                                                      );

                            $data = html_escape($data);

                            $this->core_model->inserir('formas_pagamentos', $data);
                            redirect('pagamento');

    //                           exit('Validado');
              }
                   else
                   {
                       $data = array
                       (
                              'titulo' => 'Cadastrar forma de pagamento',                                
                              'scripts' => array('vendor/mask/jquery.mask.min.js', 'vendor/mask/masks.js'),
                       );

                       $this->load->view('layout/header', $data);
                       $this->load->view('formas_pagamentos/add');
                       $this->load->view('layout/footer');
                   }
   }
   
   public function del($f_pgto_id = nll) 
   {
         if(!$f_pgto_id || !$this->core_model->get_by_id('formas_pagamentos', array('forma_pagamento_id' => $f_pgto_id)))
         {
             $this->session->set_flashdata('error', 'Forma de pagamento não encontrada!');
         }
         
         if($this->core_model->get_by_id('formas_pagamentos', array('forma_pagamento_id' => $f_pgto_id, 'forma_pagamento_ativa' => 1)))
         {
                $this->session->set_flashdata('info', 'Não é possível excluir uma forma de pagamento ativa');
                redirect('pagamento');
         }
         
         else
         {
                $this->core_model->apagar('formas_pagamentos', array('forma_pagamento_id' => $f_pgto_id));
                $this->session->set_flashdata('sucesso', 'Forma de pagamento apagada com sucesso');
                redirect('pagamento');
         }
   }
   
   public function check_nome($nome) 
   {
            $f_pg_id = $this->input->post('forma_pagamento_id');
            
            if($this->core_model->get_by_id('formas_pagamentos', array('forma_pagamento_nome' => $nome, 'forma_pagamento_id !=' => $f_pg_id)))
            {
                    $this->form_validation->set_message('check_nome', 'Esta forma de pagamento já existe');
                    return false;
            }
            else
            {
                return true;
            }
   }
}    