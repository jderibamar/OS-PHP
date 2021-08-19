<?php


defined('BASEPATH') OR exit('Ação não permitida');

class Vendedores extends CI_Controller
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
                                   'titulo' => 'Vendedores cadastrados',
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
                                     'vendedores' =>  $this->core_model->get_all('vendedores')
                            );

//            echo '<pre>';
//            print_r($data['vendedores']);
//            exit();

        $this->load->view('layout/header', $data);
        $this->load->view('vendedores/index');
        $this->load->view('layout/footer');
}

   public function edit($vendedor_id = NULL)
 {
        if(!$vendedor_id || !$this->core_model->get_by_id('vendedores', array('vendedor_id' => $vendedor_id)))
        {
                $this->session->set_flashdata('error', 'Vendedor não encontrado');
                redirect('vendedores');
        }
        else
        {
                $this->form_validation->set_rules('vendedor_nome_completo', '', 'trim|required|min_length[4]|max_length[145]');
                $this->form_validation->set_rules('vendedor_telefone', '', 'trim|max_length[20]|required|callback_check_telefone');
                $this->form_validation->set_rules('vendedor_celular', '', 'trim|max_length[20]|required|callback_check_celular');
                $this->form_validation->set_rules('vendedor_ativo', '', 'trim|exact_length[1]');
                $this->form_validation->set_rules('vendedor_data_cadastro', '', 'trim|required');
                $this->form_validation->set_rules('vendedor_cpf', '', 'trim|required|exact_length[14]|valida_cpf');
                $this->form_validation->set_rules('vendedor_rg', '', 'trim|required|max_length[20]|callback_check_rg');    
                $this->form_validation->set_rules('vendedor_email', '', 'trim|required|valid_email|max_length[50]|callback_check_email');    
                $this->form_validation->set_rules('vendedor_endereco', '', 'trim|required|max_length[155]');
                $this->form_validation->set_rules('vendedor_numero_endereco', '', 'trim|max_length[155]');
                $this->form_validation->set_rules('vendedor_bairro', '', 'trim|max_length[45]');
                $this->form_validation->set_rules('vendedor_complemento', '', 'trim|max_length[145]');
                $this->form_validation->set_rules('vendedor_cidade', '', 'trim|required|max_length[105]');
                $this->form_validation->set_rules('vendedor_estado', '', 'trim|required|exact_length[2]');
                $this->form_validation->set_rules('vendedor_obs', '', 'trim|max_length[500]');
                $this->form_validation->set_rules('vendedor_data_alteracao', '', 'trim');

                if($this->form_validation->run())
                {
                          $data = elements
                                                    (
                                                             array
                                                                (
                                                                     'vendedor_matricula',
                                                                     'vendedor_data_cadastro',
                                                                     'vendedor_nome_completo',
                                                                     'vendedor_cpf',
                                                                     'vendedor_rg',
                                                                     'vendedor_telefone',
                                                                     'vendedor_celular',
                                                                     'vendedor_email',
                                                                     'vendedor_cep',
                                                                     'vendedor_endereco',
                                                                     'vendedor_numero_endereco',
                                                                     'vendedor_bairro',
                                                                     'vendedor_complemento', 
                                                                     'vendedor_cidade', 
                                                                     'vendedor_estado', 
                                                                     'vendedor_ativo',
                                                                     'vendedor_obs', 
                                                                     'vendedor_data_alteracao'
                                                                ), $this->input->post()
                                                    );

                          $data['vendedor_estado'] = strtoupper($this->input->post('vendedor_estado'));
                          $data = html_escape($data);

                          $this->core_model->atualizar('vendedores', $data, array('vendedor_id' => $vendedor_id));
                          redirect('vendedores');

//                        exit('Validado');
                }
                else
                {
                    $data = array
                    (
                           'titulo' => 'Atualizar vendedor',                                
                           'scripts' => array('vendor/mask/jquery.mask.min.js', 'vendor/mask/masks.js'),
                           'vendedor'  => $this->core_model->get_by_id('vendedores', array('vendedor_id' => $vendedor_id))
                    );

                    $this->load->view('layout/header', $data);
                    $this->load->view('vendedores/edit');
                    $this->load->view('layout/footer');
                }
        }
}


    public function add()
    {
    //        $this->form_validation->set_rules('vendedor_matricula', '', 'trim|required|min_length[4]|max_length[10]|is_unique[vendedores.vendedor_matricula]');
            $this->form_validation->set_rules('vendedor_nome_completo', '', 'trim|required|min_length[4]|max_length[145]');
            $this->form_validation->set_rules('vendedor_telefone', '', 'trim|max_length[20]|required|is_unique[vendedores.vendedor_telefone]');
            $this->form_validation->set_rules('vendedor_celular', '', 'trim|max_length[20]|required|is_unique[vendedores.vendedor_celular]');
            $this->form_validation->set_rules('vendedor_ativo', '', 'trim|exact_length[1]');
            $this->form_validation->set_rules('vendedor_data_cadastro', '', 'trim|required');
            $this->form_validation->set_rules('vendedor_cpf', '', 'trim|required|exact_length[14]|valida_cpf|is_unique[vendedores.vendedor_cpf]');
            $this->form_validation->set_rules('vendedor_rg', '', 'trim|required|max_length[20]|is_unique[vendedores.vendedor_rg]');
            $this->form_validation->set_rules('vendedor_email', '', 'trim|required|valid_email|max_length[50]|is_unique[vendedores.vendedor_email]');    
            $this->form_validation->set_rules('vendedor_endereco', '', 'trim|required|max_length[155]');
            $this->form_validation->set_rules('vendedor_numero_endereco', '', 'trim|max_length[155]');
            $this->form_validation->set_rules('vendedor_bairro', '', 'trim|max_length[45]');
            $this->form_validation->set_rules('vendedor_complemento', '', 'trim|max_length[145]');
            $this->form_validation->set_rules('vendedor_cidade', '', 'trim|required|max_length[105]');
            $this->form_validation->set_rules('vendedor_estado', '', 'trim|required|exact_length[2]');
            $this->form_validation->set_rules('vendedor_obs', '', 'trim|max_length[500]');
            $this->form_validation->set_rules('vendedor_data_alteracao', '', 'trim');

            if($this->form_validation->run())
            {
                      $data = elements
                                                (
                                                         array
                                                            (
                                                                 'vendedor_matricula',
                                                                 'vendedor_data_cadastro',
                                                                 'vendedor_nome_completo',
                                                                 'vendedor_cpf',
                                                                 'vendedor_rg',
                                                                 'vendedor_telefone',
                                                                 'vendedor_celular',
                                                                 'vendedor_email',
                                                                 'vendedor_cep',
                                                                 'vendedor_endereco',
                                                                 'vendedor_numero_endereco',
                                                                 'vendedor_bairro',
                                                                 'vendedor_complemento', 
                                                                 'vendedor_cidade', 
                                                                 'vendedor_estado', 
                                                                 'vendedor_ativo',
                                                                 'vendedor_obs', 
                                                                 'vendedor_data_alteracao'
                                                            ), $this->input->post()
                                                );

    //                  $data['vendedor_estado'] = strtoupper($this->input->post('vendedor_estado'));
                      $data = html_escape($data);

                      $this->core_model->inserir('vendedores', $data);
                      redirect('vendedores');

    //                exit('Validado');
            }
            else
            {
                $data = array
                (
                       'titulo' => 'Cadastrar vendedor',                                
                       'scripts' => array
                                                (
                                                       'vendor/mask/jquery.mask.min.js', 
                                                       'vendor/mask/masks.js',
                                                       'js/scripts.js'
                                                ),
                      'vendedor_matricula' => $this->core_model->gerar_codigo_unico('vendedores', 'numeric', 8, 'vendedor_matricula')
                );

                $this->load->view('layout/header', $data);
                $this->load->view('vendedores/add');
                $this->load->view('layout/footer');
            }
        }

    public function del($ven_id = NULL)
    {
           if(!$ven_id || !$this->core_model->get_by_id('vendedores', array('vendedor_id' => $ven_id) ) )
           {
                   $this->session->set_flashdata('error', 'Cliente não encontrado');
                   redirect('vendedores');
           }
           else
           {
                   // PESQUISAR RESTRIÇÃO PARA APENAS USUÁRIO ADMIN PODER EXCLUIR CLIENTE
                   $this->core_model->apagar('vendedores', array('vendedor_id' => $ven_id) );
                   $this->session->set_flashdata('sucesso', 'Vendedor apagado com sucesso!');
                   redirect('vendedores');
           }
    }

    public function check_rg($ven_rg) 
    {
           $vendedor_id = $this->input->post('vendedor_id');

           if($this->core_model->get_by_id('vendedores', array('vendedor_rg' => $ven_rg, 'vendedor_id !=' => $vendedor_id )))
           {
                 $this->form_validation->set_message('check_rg', 'Este documento já existe, ele deve ser único');
                 return false;
           }
           else
           {
               return true;  
           }
    }

    public function check_email($email) 
    {
           $vendedor_id = $this->input->post('vendedor_id');

           if($this->core_model->get_by_id('vendedores', array('vendedor_email' => $email, 'vendedor_id !=' => $vendedor_id )))
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
           $vendedor_id = $this->input->post('vendedor_id');

           if($this->core_model->get_by_id('vendedores', array('vendedor_telefone' => $telefone, 'vendedor_id !=' => $vendedor_id )))
           {
                 $this->form_validation->set_message('check_telefone', 'Este telefone já existe');
                 return false;
           }
           else
           {
               return true;  
           }
    }

    public function check_celular($celular) 
    {
           $vendedor_id = $this->input->post('vendedor_id');

           if($this->core_model->get_by_id('vendedores', array('vendedor_celular' => $celular, 'vendedor_id !=' => $vendedor_id )))
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