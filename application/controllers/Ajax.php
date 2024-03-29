<?php

defined('BASEPATH') OR exit('Ação não permitida');

class Ajax extends CI_Controller
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
          redirect('/');
    }
    
    public function produtos() 
    {
            if(!$this->input->is_ajax_request())
            {
                    exit('Ação não permitida');
            }
            else
            {
                    $busca = $this->input->post('term');
                    $data['response'] = 'false';
                    
                    $query = $this->core_model->auto_complete_produtos($busca);
                    
                    if($query)
                    {
                            $data['response'] = 'true';
                            $data['message'] = array();
                            
                            //para ser usado em pesquisas de produtos
                            foreach ($query as $row)
                            {
                                   $data['message']  [] = array
                                                                            (
                                                                                 'id' => $row->produto_id,
                                                                                 'value' => $row->produto_descricao,
                                                                                 'produto_preco_venda' => $row->produto_preco_venda,
                                                                                 'produto_qtde_estoque' => $row->produto_qtde_estoque
                                                                            );
                            }
                            
                            echo json_encode($data);
                    }
                    else
                    {
                            echo json_encode($data);
                    }
            }
    }
    
    public function servicos() 
    {
            if(!$this->input->is_ajax_request())
            {
                    exit('Ação não permitida');
            }
            else
            {
                    $busca = $this->input->post('term');
                    $data['response'] = 'false';
                    
                    $query = $this->core_model->auto_complete_servicos($busca);
                    
                    if($query)
                    {
                            $data['response'] = 'true';
                            $data['message'] = array();
                            
                            //para ser usado em pesquisas de produtos
                            foreach ($query as $row)
                            {
                                   $data['message']  [] = array
                                                                            (
                                                                                 'id' => $row->servico_id,
                                                                                 'value' => $row->servico_descricao,
                                                                                 'servico_preco' => $row->servico_preco
                                                                            );
                            }
                            
                            echo json_encode($data);
                    }
                    else
                    {
                            echo json_encode($data);
                    }
            }
    }
    
  
}