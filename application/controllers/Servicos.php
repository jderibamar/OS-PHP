<?php

defined('BASEPATH') OR exit('Ação não permitida');

class Servicos extends CI_Controller
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
                                       'titulo' => 'Serviços cadastrados',
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
                                         'servicos' =>  $this->core_model->get_all('servicos')
                                );

    //            echo '<pre>';
    //            print_r($data['servicos']);
    //            exit();

            $this->load->view('layout/header', $data);
            $this->load->view('servicos/index');
            $this->load->view('layout/footer');
    }
    
    public function edit($servico_id = NULL)
    {
           if(!$servico_id || !$this->core_model->get_by_id('servicos', array('servico_id' => $servico_id)))
           {
                   $this->session->set_flashdata('error', 'Serviço não encontrado');
                   redirect('servicos');
           }
           else
           {
                   $this->form_validation->set_rules('servico_nome', '', 'trim|required|min_length[4]|max_length[145]|callback_check_nome');
                   $this->form_validation->set_rules('servico_preco', '', 'trim|max_length[20]|required');
                   $this->form_validation->set_rules('servico_descricao', '', 'trim|max_length[500]|required');
                   $this->form_validation->set_rules('servico_ativo', '', 'trim|exact_length[1]');
                   $this->form_validation->set_rules('servico_data_alteracao', '', 'trim|max_length[20]');

                   if($this->form_validation->run())
                   {
                             $data = elements
                                                       (
                                                                array
                                                                   (
                                                                        'servico_nome',
                                                                        'servico_preco',
                                                                        'servico_descricao',
                                                                        'servico_ativo',
                                                                        'servico_data_alteracao',
                                                                   ), $this->input->post()
                                                       );

                             $data = html_escape($data);

                             $this->core_model->atualizar('servicos', $data, array('servico_id' => $servico_id));
                             redirect('servicos');

//                           exit('Validado');
                   }
                   else
                   {
                       $data = array
                       (
                              'titulo' => 'Atualizar serviço',                                
                              'scripts' => array('vendor/mask/jquery.mask.min.js', 'vendor/mask/masks.js'),
                              'servico'  => $this->core_model->get_by_id('servicos', array('servico_id' => $servico_id))
                       );

                       $this->load->view('layout/header', $data);
                       $this->load->view('servicos/edit');
                       $this->load->view('layout/footer');
                   }
           }
   }
    
    public function add()
    {
            $this->form_validation->set_rules('servico_nome', '', 'trim|required|min_length[4]|max_length[145]|is_unique[servicos.servico_nome]');
            $this->form_validation->set_rules('servico_preco', '', 'trim|max_length[20]|required');
            $this->form_validation->set_rules('servico_descricao', '', 'trim|max_length[500]|required');
            $this->form_validation->set_rules('servico_ativo', '', 'trim|exact_length[1]');
            $this->form_validation->set_rules('servico_data_alteracao', '', 'trim|max_length[20]');

            if($this->form_validation->run())
            {
                      $data = elements
                                                (
                                                         array
                                                            (
                                                                 'servico_nome',
                                                                 'servico_preco',
                                                                 'servico_descricao',
                                                                 'servico_ativo',
                                                                 'servico_data_alteracao',
                                                            ), $this->input->post()
                                                );

                      $data = html_escape($data);

                      $this->core_model->inserir('servicos', $data);
                      redirect('servicos');

//                      exit('Validado');
            }
            else
            {
                $data = array
                (
                       'titulo' => 'Cadastrar servico',                                
                       'scripts' => array('vendor/mask/jquery.mask.min.js', 'vendor/mask/masks.js'),
//                       'servico'  => $this->core_model->get_by_id('servicos', array('servico_id' => $servico_id))
                );

                $this->load->view('layout/header', $data);
                $this->load->view('servicos/add');
                $this->load->view('layout/footer');
            }
   }
   
     public function del($ser_id = NULL)
    {
           if(!$ser_id || !$this->core_model->get_by_id('servicos', array('servico_id' => $ser_id) ) )
           {
                   $this->session->set_flashdata('error', 'Serviço não encontrado');
                   redirect('servicos');
           }
           else
           {
                   // PESQUISAR RESTRIÇÃO PARA APENAS USUÁRIO ADMIN PODER EXCLUIR CLIENTE
                   $this->core_model->apagar('servicos', array('servico_id' => $ser_id) );
                   $this->session->set_flashdata('sucesso', 'Serviço apagado com sucesso!');
                   redirect('servicos');
           }
    }
    
     public function check_nome($ser_nome) 
    {
           $servico_id = $this->input->post('servico_id');
           
           if($this->core_model->get_by_id('servicos', array('servico_nome' => $ser_nome, 'servico_id !=' => $servico_id )))
           {
                 $this->form_validation->set_message('check_nome', 'Este serviço já existe, ele deve ser único!');
                 return false;
           }
           else
           {
               return true;  
           }
    }
}    