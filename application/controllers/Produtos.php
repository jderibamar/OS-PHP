<?php

defined('BASEPATH') OR exit('Ação não permitida');

class Produtos extends CI_Controller
{
    public function __construct()
    {
            parent::__construct();
            
              if (!$this->ion_auth->logged_in()) //verifica se o usuário está logado
                {
                       $this->session->set_flashdata('info', 'Sua sessão expirou, faça LOGIN novamente!'); 
                       redirect('login');
                }
                
                $this->load->model('produtos_model');
    }
    
     public function index() 
    {
            $data = array
                                (
                                       'titulo' => 'Produtos cadastrados',
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
                                         'produtos' =>  $this->produtos_model->get_all()
                                );
            
//                                echo '<pre>';
//                                print_r($data['produtos']);
//                                exit();
                                

            $this->load->view('layout/header', $data);
            $this->load->view('produtos/index');
            $this->load->view('layout/footer');
    }
    
      public function edit($pro_id = null) 
    {
            if(!$pro_id || !$this->core_model->get_by_id('produtos', array('produto_id' => $pro_id)) )
            {
                    $this->session->set_flashdata('error', 'Produto não encontrado!');
                    redirect('produtos');
            }
            else
            {
                    $this->form_validation->set_rules('produto_descricao', '', 'trim|required|min_length[4]|max_length[145]|callback_check_descricao');
//                    $this->form_validation->set_rules('produto_ativo', '', 'trim|exact_length[1]');
                    $this->form_validation->set_rules('produto_unidade', 'Unidade', 'trim|max_length[10]|min_length[2]');
                    $this->form_validation->set_rules('produto_preco_custo', 'Preço de custo', 'trim|required|max_length[20]');
                    $this->form_validation->set_rules('produto_preco_venda', '', 'trim|required|max_length[20]|callback_check_preco_venda');
                    $this->form_validation->set_rules('produto_estoque_minimo', 'Estoque mínimo', 'trim|required|max_length[10]|greater_than_equal_to[0]');
                    $this->form_validation->set_rules('produto_qtde_estoque', 'Quantidade em estoque', 'trim|required');
                    $this->form_validation->set_rules('produto_obs', '', 'trim|max_length[200]');
                    
                    if($this->form_validation->run())
                    {
                                 $produto_preco_venda = str_replace('.', '', trim($this->input->post('produto_preco_venda'))); 
                               $data = elements
                                                        (
                                                                 array
                                                                    (
                                                                         'produto_descricao',
                                                                         'produto_unidade',
                                                                         'produto_categoria_id',
                                                                         'produto_marca_id',
                                                                         'produto_fornecedor_id',
                                                                         'produto_unidade',
                                                                         'produto_preco_custo',
                                                                         'produto_preco_venda',
                                                                         'produto_estoque_minimo',
                                                                         'produto_qtde_estoque', 
                                                                         'produto_ativo', 
                                                                         'produto_obs',
                                                                         'produto_data_alteracao'
                                                                    ), $this->input->post()
                                                        );

                               $data['produto_preco_venda'] = $produto_preco_venda;
                               $data = html_escape($data);
                              
//                        echo '<pre>';
//                        print_r($this->input->post());
//                        exit();
//                              
                              $this->core_model->atualizar('produtos', $data, array('produto_id' => $pro_id));
                              redirect('produtos'); 
                              
//                            exit('Validado');
                    }
                    else
                    {
                            //Erro de validação
                            $data = array
                                                (
                                                       'titulo' => 'Atualizar produto',
                                                       'scripts' => array('vendor/mask/jquery.mask.min.js', 'vendor/mask/masks.js'),
                                                       'produto'  => $this->core_model->get_by_id('produtos', array('produto_id' => $pro_id)),
                                                       'marcas' => $this->core_model->get_all('marcas', array('marca_ativa' => 1)),
                                                       'categorias' => $this->core_model->get_all('categorias', array('categoria_ativa' => 1)),
                                                       'fornecedores' => $this->core_model->get_all('fornecedores', array('fornecedor_ativo' => 1))
                                                );
                
//                        echo '<pre>';
//                        print_r($data['produto']);
//                        exit();
//                        
                            $this->load->view('layout/header', $data);
                            $this->load->view('produtos/edit');
                            $this->load->view('layout/footer');
                    }
                
            }
    }
    
      public function add() 
    {
            $this->form_validation->set_rules('produto_descricao', '', 'trim|required|min_length[4]|max_length[145]|is_unique[produtos.produto_descricao]');
             $this->form_validation->set_rules('produto_unidade', 'Unidade', 'trim|max_length[10]|min_length[2]');
             $this->form_validation->set_rules('produto_preco_custo', 'Preço de custo', 'trim|required|max_length[20]');
             $this->form_validation->set_rules('produto_preco_venda', '', 'trim|required|max_length[20]|callback_check_preco_venda');
             $this->form_validation->set_rules('produto_estoque_minimo', 'Estoque mínimo', 'trim|required|max_length[10]|greater_than_equal_to[0]');
             $this->form_validation->set_rules('produto_qtde_estoque', 'Quantidade em estoque', 'trim|required');
             $this->form_validation->set_rules('produto_obs', '', 'trim|max_length[200]');
             $this->form_validation->set_rules('produto_data_alteracao', '', 'trim|max_length[20]');

             if($this->form_validation->run())
             {
                        $data = elements
                                                 (
                                                          array
                                                             (
                                                                  'produto_codigo',  
                                                                  'produto_descricao',
                                                                  'produto_unidade',
                                                                  'produto_categoria_id',
                                                                  'produto_marca_id',
                                                                  'produto_fornecedor_id',
                                                                  'produto_unidade',
                                                                  'produto_data_cadastro',
                                                                  'produto_preco_custo',
                                                                  'produto_preco_venda',
                                                                  'produto_estoque_minimo',
                                                                  'produto_qtde_estoque', 
                                                                  'produto_ativo', 
                                                                  'produto_obs'
                                                             ), $this->input->post()
                                                 );

                        $data = html_escape($data);

                       $this->core_model->inserir('produtos', $data);
                       redirect('produtos'); 

//                            exit('Validado');
             }
             else
             {
                     //Erro de validação
                     $data = array
                                         (
                                                'titulo' => 'Cadastrar produto',
                                                'scripts' => array('vendor/mask/jquery.mask.min.js', 'vendor/mask/masks.js'),
                                                'marcas' => $this->core_model->get_all('marcas', array('marca_ativa' => 1)),
                                                'categorias' => $this->core_model->get_all('categorias', array('categoria_ativa' => 1)),
                                                'fornecedores' => $this->core_model->get_all('fornecedores', array('fornecedor_ativo' => 1)),
                                                'produto_codigo' => $this->core_model->gerar_codigo_unico('produtos', 'numeric', 8, 'produto_codigo')
                                         );

//                        echo '<pre>';
//                        print_r($data['produto']);
//                        exit();
//                        
                     $this->load->view('layout/header', $data);
                     $this->load->view('produtos/add');
                     $this->load->view('layout/footer');
             }
    }
    
      public function del($pro_id = NULL)
    {
           if(!$pro_id || !$this->core_model->get_by_id('produtos', array('produto_id' => $pro_id) ) )
           {
                   $this->session->set_flashdata('error', 'Produto não encontrado');
                   redirect('produtos');
           }
           else
           {
                   // PESQUISAR RESTRIÇÃO PARA APENAS USUÁRIO ADMIN PODER EXCLUIR CLIENTE
                   if($this->core_model->get_by_id('produtos', array('produto_id' => $pro_id, 'produto_ativo' => 1)))
                   {
                       $this->session->set_flashdata('error', 'Produto não pode ser excluído porque está ativo, desative-o antes de excluir!');
                       redirect('produtos');
                   }
                   
                   $this->core_model->apagar('produtos', array('produto_id' => $pro_id) );
                   $this->session->set_flashdata('sucesso', 'Produto apagado com sucesso!');
                   redirect('produtos');
           }
    }
    
    public function check_descricao($pro_desc) 
    {
            $pro_id = $this->input->post('produto_id');
            
            if($this->core_model->get_by_id('produtos', array('produto_descricao' => $pro_desc, 'produto_id !=' => $pro_id)))
            {
                    $this->form_validation->set_message('check_descricao', 'Este produto já existe, ele deve ser único!');
                    return false;
            }
            else
            {
                return true;
            }
    }
    
    public function check_preco_venda($preco_venda) 
    {
           $preco_custo = (float) $this->input->post('produto_preco_custo');

           if($preco_custo > (float) $preco_venda)
            {
                    $this->form_validation->set_message('check_preco_venda', 'Preço de custo deve ser menor ou igual ao de venda!');
                    return false;
            }
            else
            {
                return true;
            } 
    }
}