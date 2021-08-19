<?php

defined('BASEPATH') OR exit('Ação não permitida');

class Categorias extends CI_Controller
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
                                       'titulo' => 'Categorias cadastradas',
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
                                         'categorias' =>  $this->core_model->get_all('categorias')
                                );

            $this->load->view('layout/header', $data);
            $this->load->view('categorias/index');
            $this->load->view('layout/footer');
    }
    
    public function edit($categoria_id = NULL)
    {
           if(!$categoria_id || !$this->core_model->get_by_id('categorias', array('categoria_id' => $categoria_id)))
           {
                   $this->session->set_flashdata('error', 'Categoria não encontrada');
                   redirect('categorias');
           }
           else
           {
                   $this->form_validation->set_rules('categoria_nome', '', 'trim|required|min_length[2]|max_length[45]|callback_check_nome');

                   if($this->form_validation->run())
                   {
                            $cat_ativa = $this->input->post('categoria_ativa');
                            
                            if($this->db->table_exists('produtos'))
                            {
                                    if($cat_ativa == 0 && $this->core_model->get_by_id('produtos', array('produto_categoria_id' => $categoria_id, 'produto_ativo' => 1)))
                                    {
                                            $this->session->set_flashdata('info', 'Esta categoria não pode ser desativada porque está sendo usada em <i class="fab fa-product-hunt"></i>  Produtos');
                                            redirect('categorias');
                                    }
                            }
                       
                            $data = elements
                                                      (
                                                               array
                                                                  (
                                                                       'categoria_nome',
                                                                       'categoria_ativa',
                                                                       'categoria_data_alteracao'
                                                                  ), $this->input->post()
                                                      );

                            $data = html_escape($data);

                            $this->core_model->atualizar('categorias', $data, array('categoria_id' => $categoria_id));
                            redirect('categorias');

    //                           exit('Validado');
              }
                   else
                   {
                       $data = array
                       (
                              'titulo' => 'Atualizar categoria',                                
                              'scripts' => array('vendor/mask/jquery.mask.min.js', 'vendor/mask/masks.js'),
                              'categoria'  => $this->core_model->get_by_id('categorias', array('categoria_id' => $categoria_id))
                       );

                       $this->load->view('layout/header', $data);
                       $this->load->view('categorias/edit');
                       $this->load->view('layout/footer');
                   }
           }
   }
    
    public function add()
    {
            $this->form_validation->set_rules('categoria_nome', '', 'trim|required|min_length[2]|max_length[45]|is_unique[categorias.categoria_nome]');

            if($this->form_validation->run())
            {
                     $data = elements
                                                       (
                                                                array
                                                                   (
                                                                        'categoria_nome',
                                                                        'categoria_ativa',
                                                                        'categoria_data_alteracao',
                                                                   ), $this->input->post()
                                                       );

                      $data = html_escape($data);

                      $this->core_model->inserir('categorias', $data);
                      redirect('categorias');

//                      exit('Validado');
            }
            else
            {
                $data = array
                (
                       'titulo' => 'Cadastrar categoria',                                
                       'scripts' => array('vendor/mask/jquery.mask.min.js', 'vendor/mask/masks.js'),
//                       'categoria'  => $this->core_model->get_by_id('categorias', array('categoria_id' => $categoria_id))
                );

                $this->load->view('layout/header', $data);
                $this->load->view('categorias/add');
                $this->load->view('layout/footer');
            }
   }
   
     public function del($cat_id = NULL)
    {
           if(!$cat_id || !$this->core_model->get_by_id('categorias', array('categoria_id' => $cat_id) ) )
           {
                   $this->session->set_flashdata('error', 'Categoria não encontrada');
                   redirect('categorias');
           }
           else
           {
                   // PESQUISAR RESTRIÇÃO PARA APENAS USUÁRIO ADMIN PODER EXCLUIR CLIENTE
                   $this->core_model->apagar('categorias', array('categoria_id' => $cat_id) );
                   $this->session->set_flashdata('sucesso', 'Categoria apagada com sucesso!');
                   redirect('categorias');
           }
    }
    
     public function check_nome($cat_nome) 
    {
           $categoria_id = $this->input->post('categoria_id');
           
           if($this->core_model->get_by_id('categorias', array('categoria_nome' => $cat_nome, 'categoria_id !=' => $categoria_id )))
           {
                 return false;
           }
           else
           {
               return true;  
           }
    }
}    