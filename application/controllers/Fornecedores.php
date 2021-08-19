<?php


defined('BASEPATH') OR exit('Ação não permitida');

class Fornecedores extends CI_Controller
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
                                       'titulo' => 'Fornecedores cadastrados',
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
                                         'fornecedores' =>  $this->core_model->get_all('fornecedores')
                                );
            
//            echo '<pre>';
//            print_r($data['fornecedores']);
//            exit();
            
            $this->load->view('layout/header', $data);
            $this->load->view('fornecedores/index');
            $this->load->view('layout/footer');
    }
    
    public function edit($for_id = null) 
    {
            if(!$for_id || !$this->core_model->get_by_id('fornecedores', array('fornecedor_id' => $for_id)) )
            {
                    $this->session->set_flashdata('error', 'Fornecedor não encontrado!');
                    redirect('fornecedores');
            }
            else
            {
                    $this->form_validation->set_rules('fornecedor_razao', '', 'trim|required|min_length[4]|max_length[200]|callback_check_razao_social');
                    $this->form_validation->set_rules('fornecedor_nome_fantasia', '', 'trim|required|min_length[4]|max_length[145]|callback_check_nome_fantasia');
                    $this->form_validation->set_rules('fornecedor_ativo', '', 'trim|exact_length[1]');
//                    $this->form_validation->set_rules('fornecedor_cnpj', '', 'trim|required|exact_length[18]|callback_valida_cnpj');   
                    $this->form_validation->set_rules('fornecedor_cnpj', '', 'trim|exact_length[18]|callback_check_cnpj|valida_cnpj');
                    $this->form_validation->set_rules('fornecedor_ie', '', 'trim|required|max_length[20]|callback_check_ie');
                    $this->form_validation->set_rules('fornecedor_email', '', 'trim|required|valid_email|max_length[50]|callback_check_email');
                    $this->form_validation->set_rules('fornecedor_celular', '', 'trim|required|max_length[20]|callback_check_celular');
                    $this->form_validation->set_rules('fornecedor_telefone', '', 'trim|required|max_length[20]|callback_check_telefone');
                    
                    $this->form_validation->set_rules('fornecedor_endereco', '', 'trim|required|max_length[155]');
                    $this->form_validation->set_rules('fornecedor_numero_endereco', '', 'trim|max_length[155]');
                    $this->form_validation->set_rules('fornecedor_bairro', '', 'trim|max_length[45]');
                    $this->form_validation->set_rules('fornecedor_complemento', '', 'trim|max_length[145]');
                    $this->form_validation->set_rules('fornecedor_cidade', '', 'trim|required|max_length[105]');
                    $this->form_validation->set_rules('fornecedor_estado', '', 'trim|required|exact_length[2]');
                    $this->form_validation->set_rules('fornecedor_obs', '', 'trim|max_length[500]');
                    $this->form_validation->set_rules('fornecedor_data_alteracao', '', 'trim');
                    
                    if($this->form_validation->run())
                    {
                            $for_ativo = $this->input->post('fornecedor_ativo');
                            
                            if($this->db->table_exists('produtos'))
                            {
                                    if($for_ativo == 0 && $this->core_model->get_by_id('produtos', array('produto_fornecedor_id' => $for_id, 'produto_ativo' => 1)))
                                    {
                                            $this->session->set_flashdata('info', 'Este fornecedor não pode ser desativado porque está sendo usado em  <i class="fab fa-product-hunt"></i>  Produtos');
                                            redirect('fornecedores');
                                    }
                            }
                            
                            $data = elements
                                                     (
                                                              array
                                                                 (
                                                                      'fornecedor_razao',
                                                                      'fornecedor_nome_fantasia',
                                                                      'fornecedor_cnpj',
                                                                      'fornecedor_email',
                                                                      'fornecedor_contato',
                                                                      'fornecedor_ie',
                                                                      'fornecedor_telefone',
                                                                      'fornecedor_celular',
                                                                      'fornecedor_ativo',
                                                                      'fornecedor_endereco',
                                                                      'fornecedor_cep',
                                                                      'fornecedor_numero_endereco',
                                                                      'fornecedor_bairro',
                                                                      'fornecedor_complemento', 
                                                                      'fornecedor_cidade', 
                                                                      'fornecedor_estado', 
                                                                      'fornecedor_obs', 
                                                                 ), $this->input->post()
                                                     );

                           $data['fornecedor_estado'] = strtoupper($this->input->post('fornecedor_estado'));
                           $data = html_escape($data);

                           $this->core_model->atualizar('fornecedores', $data, array('fornecedor_id' => $for_id));
                           redirect('fornecedores'); 

//                            exit('Validado');
                    }
                    else
                    {
                            //Erro de validação
                            $data = array
                                                (
                                                       'titulo' => 'Atualizar fornecedor',
                                                       'scripts' => array('vendor/mask/jquery.mask.min.js', 'vendor/mask/masks.js'),
                                                       'fornecedor'  => $this->core_model->get_by_id('fornecedores', array('fornecedor_id' => $for_id))
                                                );
//                        
                            $this->load->view('layout/header', $data);
                            $this->load->view('fornecedores/edit');
                            $this->load->view('layout/footer');
                    }
                
            }
    }
    
    public function add() 
    {
            $this->form_validation->set_rules('fornecedor_razao', '', 'trim|required|min_length[4]|max_length[200]|is_unique[fornecedores.fornecedor_razao]');
            $this->form_validation->set_rules('fornecedor_nome_fantasia', '', 'trim|required|min_length[4]|max_length[145]|is_unique[fornecedores.fornecedor_nome_fantasia]');
            $this->form_validation->set_rules('fornecedor_ativo', '', 'trim|exact_length[1]');
//                    $this->form_validation->set_rules('fornecedor_cnpj', '', 'trim|required|exact_length[18]|callback_valida_cnpj');   
            $this->form_validation->set_rules('fornecedor_cnpj', '', 'trim|required|exact_length[18]|is_unique[fornecedores.fornecedor_cnpj]|valida_cnpj');
            $this->form_validation->set_rules('fornecedor_ie', '', 'trim|required|max_length[20]|is_unique[fornecedores.fornecedor_ie]');
            $this->form_validation->set_rules('fornecedor_email', '', 'trim|required|valid_email|max_length[50]|is_unique[fornecedores.fornecedor_email]');
            $this->form_validation->set_rules('fornecedor_celular', '', 'trim|required|max_length[20]|is_unique[fornecedores.fornecedor_celular]');
            $this->form_validation->set_rules('fornecedor_telefone', '', 'trim|required|max_length[20]|is_unique[fornecedores.fornecedor_telefone]');

            $this->form_validation->set_rules('fornecedor_endereco', '', 'trim|required|max_length[155]');
            $this->form_validation->set_rules('fornecedor_numero_endereco', '', 'trim|max_length[155]');
            $this->form_validation->set_rules('fornecedor_bairro', '', 'trim|max_length[45]');
            $this->form_validation->set_rules('fornecedor_complemento', '', 'trim|max_length[145]');
            $this->form_validation->set_rules('fornecedor_cidade', '', 'trim|required|max_length[105]');
            $this->form_validation->set_rules('fornecedor_estado', '', 'trim|required|exact_length[2]');
            $this->form_validation->set_rules('fornecedor_obs', '', 'trim|max_length[500]');
            $this->form_validation->set_rules('fornecedor_data_alteracao', '', 'trim');

            if($this->form_validation->run())
            {
                       $data = elements
                                                (
                                                         array
                                                            (
                                                                 'fornecedor_razao',
                                                                 'fornecedor_nome_fantasia',
                                                                 'fornecedor_cnpj',
                                                                 'fornecedor_email',
                                                                 'fornecedor_contato',
                                                                 'fornecedor_ie',
                                                                 'fornecedor_telefone',
                                                                 'fornecedor_celular',
                                                                 'fornecedor_ativo',
                                                                 'fornecedor_endereco',
                                                                 'fornecedor_cep',
                                                                 'fornecedor_numero_endereco',
                                                                 'fornecedor_bairro',
                                                                 'fornecedor_complemento', 
                                                                 'fornecedor_cidade', 
                                                                 'fornecedor_estado', 
                                                                 'fornecedor_obs', 
                                                            ), $this->input->post()
                                                );

                      $data['fornecedor_estado'] = strtoupper($this->input->post('fornecedor_estado'));
                      $data = html_escape($data);

                      $this->core_model->inserir('fornecedores', $data);
                      redirect('fornecedores'); 

//                            exit('Validado');
            }
            else
            {
                    //Erro de validação
                        $data = array
                                            (
                                                   'titulo' => 'Cadastrar fornecedor',                                
                                                   'scripts' => array
                                                                            (
                                                                                    'vendor/mask/jquery.mask.min.js', 
                                                                                    'vendor/mask/masks.js'
                                                                            ),
                                            );

                $this->load->view('layout/header', $data);
                $this->load->view('fornecedores/add');
                $this->load->view('layout/footer');
            }
    }
    
    public function del($for_id = NULL)
    {
            if(!$for_id || !$this->core_model->get_by_id('fornecedores', array('fornecedor_id' => $for_id) ) )
            {
                    $this->session->set_flashdata('error', 'Fornecedor não encontrado');
                    redirect('fornecedores');
            }
            else
            {
                    // PESQUISAR RESTRIÇÃO PARA APENAS USUÁRIO ADMIN PODER EXCLUIR CLIENTE
                    $this->core_model->apagar('fornecedores', array('fornecedor_id' => $for_id) );
                    $this->session->set_flashdata('sucesso', 'Fornecedor apagado com sucesso!');
                    redirect('fornecedores');
            }
    }
    
     public function check_ie($for_ie) 
    {
           $fornecedor_id = $this->input->post('fornecedor_id');
           
           if($this->core_model->get_by_id('fornecedores', array('fornecedor_ie' => $for_ie, 'fornecedor_id !=' => $fornecedor_id )))
           {
                 $this->form_validation->set_message('check_ie', 'Esta inscrição estadual já existe');
                 return false;
           }
           else
           {
               return true;  
           }
    }
    
     public function check_razao_social($for_razao) 
    {
           $fornecedor_id = $this->input->post('fornecedor_id');
           
           if($this->core_model->get_by_id('fornecedores', array('fornecedor_razao' => $for_razao, 'fornecedor_id !=' => $fornecedor_id )))
           {
                 $this->form_validation->set_message('check_razao_social', 'Esta razão social já existe');
                 return false;
           }
           else
           {
               return true;  
           }
    }
    
     public function check_nome_fantasia($for_fantasia) 
    {
           $fornecedor_id = $this->input->post('fornecedor_id');
           
           if($this->core_model->get_by_id('fornecedores', array('fornecedor_nome_fantasia' => $for_fantasia, 'fornecedor_id !=' => $fornecedor_id )))
           {
                 $this->form_validation->set_message('check_nome_fantasia', 'Este nome fantasia já existe');
                 return false;
           }
           else
           {
               return true;  
           }
    }
    
     public function check_email($email) 
    {
           $fornecedor_id = $this->input->post('fornecedor_id');
           
           if($this->core_model->get_by_id('fornecedores', array('fornecedor_email' => $email, 'fornecedor_id !=' => $fornecedor_id )))
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
           $fornecedor_id = $this->input->post('fornecedor_id');
           
           if($this->core_model->get_by_id('fornecedores', array('fornecedor_telefone' => $telefone, 'fornecedor_id !=' => $fornecedor_id )))
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
           $fornecedor_id = $this->input->post('fornecedor_id');
           
           if($this->core_model->get_by_id('fornecedores', array('fornecedor_celular' => $telefone, 'fornecedor_id !=' => $fornecedor_id )))
           {
                 $this->form_validation->set_message('check_celular', 'Este telefone já existe');
                 return false;
           }
           else
           {
               return true;  
           }
    }
    
    //função para checar se está o CNPJ do registro que está sendo atualizado é igual a algum outro já cadastrado
    public function check_cnpj($cnpj) 
    {
       // Verifica se um número foi informado
        if (empty($cnpj)) 
        {
//            $this->form_validation->set_message('fornecedor_cnpj', 'CNPJ deve ser preenchido!');
            return false;
        }

        if ($this->input->post('fornecedor_id')) 
        {

            $fornecedor_id = $this->input->post('fornecedor_id');

            if ($this->core_model->get_by_id('fornecedores', array('fornecedor_id !=' => $fornecedor_id, 'fornecedor_cnpj' => $cnpj))) 
            {
                $this->form_validation->set_message('valida_cnpj', 'Esse CNPJ já existe');
                return FALSE;
            }
        }
    }
    
}    