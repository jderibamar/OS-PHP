<?php

defined('BASEPATH') OR exit('Ação não permitida');

class Clientes extends CI_Controller
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
                                       'titulo' => 'Clientes cadastrados',
                                        'styles' =>  array
                                                  (
                                                     'vendor/datatables/dataTables.bootstrap4.min.css'
                                                   ),
                                        'scripts' => array
                                                           (
                                                              'vendor/datatables/jquery.dataTables.min.js',
                                                               'vendor/datatables/dataTables.bootstrap4.min.js',
                                                               'vendor/datatables/app.js'
                                                           ),
                                         'clientes' =>  $this->core_model->get_all('clientes')
                                );
            
//            echo '<pre>';
//            print_r($data['clientes']);
//            exit();
            
            $this->load->view('layout/header', $data);
            $this->load->view('clientes/index');
            $this->load->view('layout/footer');
    }
    
    public function add()
    {
            $this->form_validation->set_rules('cliente_nome', '', 'trim|required|min_length[4]|max_length[45]');
            $this->form_validation->set_rules('cliente_sobrenome', '', 'trim|required|min_length[4]|max_length[150]');

            if(!empty($this->input->post('cliente_telefone')))
            {
                    $this->form_validation->set_rules('cliente_telefone', '', 'trim|max_length[20]|is_unique[clientes.cliente_telefone]');
            }

            if(!empty($this->input->post('cliente_celular')))
            {
                    $this->form_validation->set_rules('cliente_celular', '', 'trim|max_length[20]|is_unique[clientes.cliente_celular]');
            }

            $this->form_validation->set_rules('cliente_tipo', '', 'trim|exact_length[1]');
            $this->form_validation->set_rules('cliente_ativo', '', 'trim|exact_length[1]');
            $this->form_validation->set_rules('cliente_data_nascimento', '', 'trim|required');

            $cliente_tipo = $this->input->post('cliente_tipo');

            if($cliente_tipo == 1)
            {
                    $this->form_validation->set_rules('cliente_cpf', '', 'trim|required|exact_length[14]|is_unique[clientes.cliente_cpf_cnpj]|valida_cpf');
            }
            else
            {
                   $this->form_validation->set_rules('cliente_cnpj', '', 'trim|required|exact_length[18]|is_unique[clientes.cliente_cpf_cnpj]|callback_valida_cnpj');   
            }

            $this->form_validation->set_rules('cliente_rg_ie', '', 'trim|required|max_length[20]|is_unique[clientes.cliente_rg_ie]');    
            $this->form_validation->set_rules('cliente_email', '', 'trim|required|valid_email|max_length[50]|callback_check_email');    
            $this->form_validation->set_rules('cliente_endereco', '', 'trim|required|max_length[155]');
            $this->form_validation->set_rules('cliente_numero_endereco', '', 'trim|max_length[155]');
            $this->form_validation->set_rules('cliente_bairro', '', 'trim|max_length[45]');
            $this->form_validation->set_rules('cliente_complemento', '', 'trim|max_length[145]');
            $this->form_validation->set_rules('cliente_cidade', '', 'trim|required|max_length[105]');
            $this->form_validation->set_rules('cliente_estado', '', 'trim|required|exact_length[2]');
            $this->form_validation->set_rules('cliente_obs', '', 'trim|max_length[500]');
            $this->form_validation->set_rules('cliente_data_alteracao', '', 'trim');

            if($this->form_validation->run())
            {
                      $data = elements
                                                (
                                                         array
                                                            (
                                                                 'cliente_nome',
                                                                 'cliente_sobrenome',
                                                                 'cliente_email',
                                                                 'cliente_rg_ie',
                                                                 'cliente_data_nascimento',
                                                                 'cliente_telefone',
                                                                 'cliente_celular',
                                                                 'cliente_ativo',
                                                                 'cliente_endereco',
                                                                 'cliente_cep',
                                                                 'cliente_numero_endereco',
                                                                 'cliente_bairro',
                                                                 'cliente_complemento', 
                                                                 'cliente_cidade', 
                                                                 'cliente_estado', 
                                                                 'cliente_obs', 
                                                                 'cliente_tipo'
                                                            ), $this->input->post()
                                                );

                      if($cliente_tipo == 1) //IF para valildar que trata da validaçaõ do CPF / CNPJ
                      {
                               $data['cliente_cpf_cnpj']  = $this->input->post('cliente_cpf');
                      }
                      else
                      {
                                $data['cliente_cpf_cnpj']  = $this->input->post('cliente_cnpj');
                      }

                      $data['cliente_estado'] = strtoupper($this->input->post('cliente_estado'));
                      
                      $data = html_escape($data);

                      $this->core_model->inserir('clientes', $data);
                      redirect('clientes');
            }
            else
            {
                $data = array
                (
                       'titulo' => 'Cadastrar cliente',                                
                       'scripts' => array
                                                (
                                                        'vendor/mask/jquery.mask.min.js', 
                                                        'vendor/mask/masks.js', 
                                                        'js/clientes.js',
                                                        'js/scripts.js'
                                                ),
                );

                $this->load->view('layout/header', $data);
                $this->load->view('clientes/add');
                $this->load->view('layout/footer');
            }
    }
    
    public function edit($cliente_id = null)
    {
            if(!$cliente_id || !$this->core_model->get_by_id('clientes', array('cliente_id' => $cliente_id)))
            {
                    $this->session->set_flashdata('error', 'Cliente não encontrado');
                    redirect('clientes');
            }
            else
            {
                    $this->form_validation->set_rules('cliente_nome', '', 'trim|required|min_length[4]|max_length[45]');
                    $this->form_validation->set_rules('cliente_sobrenome', '', 'trim|required|min_length[4]|max_length[150]');
                    
                    if(!empty($this->input->post('cliente_telefone')))
                    {
                            $this->form_validation->set_rules('cliente_telefone', '', 'trim|max_length[20]|callback_check_telefone');
                    }
                
                    if(!empty($this->input->post('cliente_celular')))
                    {
                            $this->form_validation->set_rules('cliente_celular', '', 'trim|max_length[20]|callback_check_celular');
                    }
                                        
                    $this->form_validation->set_rules('cliente_tipo', '', 'trim|exact_length[1]');
                    $this->form_validation->set_rules('cliente_ativo', '', 'trim|exact_length[1]');
                    $this->form_validation->set_rules('cliente_data_nascimento', '', 'trim|required');
                    
                    $cliente_tipo = $this->input->post('cliente_tipo');
                    
                    if($cliente_tipo == 1)
                    {
                            $this->form_validation->set_rules('cliente_cpf', '', 'trim|required|exact_length[14]|valida_cpf');
                    }
                    else
                    {
                           $this->form_validation->set_rules('cliente_cnpj', '', 'trim|required|exact_length[18]|callback_valida_cnpj');   
                    }

                    $this->form_validation->set_rules('cliente_rg_ie', '', 'trim|required|max_length[20]|callback_check_rg_ie');    
                    $this->form_validation->set_rules('cliente_email', '', 'trim|required|valid_email|max_length[50]|callback_check_email');    
                    $this->form_validation->set_rules('cliente_endereco', '', 'trim|required|max_length[155]');
                    $this->form_validation->set_rules('cliente_numero_endereco', '', 'trim|max_length[155]');
                    $this->form_validation->set_rules('cliente_bairro', '', 'trim|max_length[45]');
                    $this->form_validation->set_rules('cliente_complemento', '', 'trim|max_length[145]');
                    $this->form_validation->set_rules('cliente_cidade', '', 'trim|required|max_length[105]');
                    $this->form_validation->set_rules('cliente_estado', '', 'trim|required|exact_length[2]');
                    $this->form_validation->set_rules('cliente_obs', '', 'trim|max_length[500]');
                    $this->form_validation->set_rules('cliente_data_alteracao', '', 'trim');

                    if($this->form_validation->run())
                    {
                                 $cli_ativo = $this->input->post('cliente_ativo');
                            
                                if($this->db->table_exists('contas_receber'))
                                {
                                        if($cli_ativo == 0 && $this->core_model->get_by_id('contas_receber', array('conta_receber_cliente_id' => $cliente_id, 'conta_receber_status' => 0)))
                                        {
                                                $this->session->set_flashdata('info', 'Este cliente não pode ser desativado porque está pendente em <i class="fas fa-money-bill-wave"></i>  Contas a receber');
                                                redirect('clientes');
                                        }
                                }
                        
                              $data = elements
                                                        (
                                                                 array
                                                                    (
                                                                         'cliente_nome',
                                                                         'cliente_sobrenome',
                                                                         'cliente_email',
                                                                         'cliente_rg_ie',
                                                                         'cliente_data_nascimento',
                                                                         'cliente_telefone',
                                                                         'cliente_celular',
                                                                         'cliente_ativo',
                                                                         'cliente_endereco',
                                                                         'cliente_cep',
                                                                         'cliente_numero_endereco',
                                                                         'cliente_bairro',
                                                                         'cliente_complemento', 
                                                                         'cliente_cidade', 
                                                                         'cliente_estado', 
                                                                         'cliente_obs', 
                                                                         'cliente_tipo'
                                                                    ), $this->input->post()
                                                        );
                              
                              if($cliente_tipo == 1) //IF para valildar que trata da validaçaõ do CPF / CNPJ
                              {
                                       $data['cliente_cpf_cnpj']  = $this->input->post('cliente_cpf');
                              }
                              else
                              {
                                        $data['cliente_cpf_cnpj']  = $this->input->post('cliente_cnpj');
                              }
                              
                              $data['cliente_estado'] = strtoupper($this->input->post('cliente_estado'));
                              $data = html_escape($data);
                              
                              $this->core_model->atualizar('clientes', $data, array('cliente_id' => $cliente_id));
                              redirect('clientes');
                    }
                    else
                    {
                        $data = array
                        (
                               'titulo' => 'Atualizar cliente',                                
                               'scripts' => array('vendor/mask/jquery.mask.min.js', 'vendor/mask/masks.js'),
                               'cliente'  => $this->core_model->get_by_id('clientes', array('cliente_id' => $cliente_id))
                        );
                                
                        $this->load->view('layout/header', $data);
                        $this->load->view('clientes/edit');
                        $this->load->view('layout/footer');
                    }
            }
    }
    
     public function del($cli_id = NULL)
    {
            if(!$cli_id || !$this->core_model->get_by_id('clientes', array('cliente_id' => $cli_id) ) )
            {
                    $this->session->set_flashdata('error', 'Cliente não encontrado');
                    redirect('clientes');
            }
            else
            {
                    // PESQUISAR RESTRIÇÃO PARA APENAS USUÁRIO ADMIN PODER EXCLUIR CLIENTE
                    $this->core_model->apagar('clientes', array('cliente_id' => $cli_id) );
                    $this->session->set_flashdata('sucesso', 'Cliente apagado com sucesso!');
                    redirect('clientes');
            }
    }
    
    public function check_rg_ie($cli_rg_ie) 
    {
           $cliente_id = $this->input->post('cliente_id');
           
           if($this->core_model->get_by_id('clientes', array('cliente_rg_ie' => $cli_rg_ie, 'cliente_id !=' => $cliente_id )))
           {
                 $this->form_validation->set_message('check_rg_ie', 'Este documento já existe');
                 return false;
           }
           else
           {
               return true;  
           }
    }
    
    public function check_email($email) 
    {
           $cliente_id = $this->input->post('cliente_id');
           
           if($this->core_model->get_by_id('clientes', array('cliente_email' => $email, 'cliente_id !=' => $cliente_id )))
           {
                 $this->form_validation->set_message('check_email', 'Este e-mail já existe, ele deve ser único');
                 return false;
           }
           else
           {
               return true;  
           }
    }
    
    public function check_telefone($telefone) 
    {
           $cliente_id = $this->input->post('cliente_id');
           
           if($this->core_model->get_by_id('clientes', array('cliente_telefone' => $telefone, 'cliente_id !=' => $cliente_id )))
           {
                 $this->form_validation->set_message('check_telefone', 'Este telefone já existe');
                 return false;
           }
           else
           {
               return true;  
           }
    }
    
    public function check_celular($telefone) 
    {
           $cliente_id = $this->input->post('cliente_id');
           
           if($this->core_model->get_by_id('clientes', array('cliente_celular' => $telefone, 'cliente_id !=' => $cliente_id )))
           {
                 $this->form_validation->set_message('check_celular', 'Este telefone já existe');
                 return false;
           }
           else
           {
               return true;  
           }
    }
  
    
}

