<?php

defined('BASEPATH') OR exit('Ação não permitida');

class Vendas extends CI_Controller
{
    public function __construct()
    {
            parent::__construct();
            
              if (!$this->ion_auth->logged_in()) //verifica se o usuário está logado
                {
                       $this->session->set_flashdata('info', 'Sua sessão expirou, faça LOGIN novamente!'); 
                       redirect('login');
                }
                
            $this->load->model('vendas_model');
            $this->load->model('produtos_model');
    }
    
     public function index() 
    {
            $data = array
                                (
                                       'titulo' => 'Vendas realizadas',
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
                                         'vendas' =>  $this->vendas_model->get_all()
                                );

//                echo '<pre>';
//                print_r($data['vendas']);
//                exit();

            $this->load->view('layout/header', $data);
            $this->load->view('vendas/index');
            $this->load->view('layout/footer');
    }
    
    public function add()
    {
            $this->form_validation->set_rules('venda_cliente_id', '', 'required');
            $this->form_validation->set_rules('venda_tipo', '', 'required');
            $this->form_validation->set_rules('venda_forma_pagamento_id', '', 'required');
            $this->form_validation->set_rules('venda_vendedor_id', '', 'required');

            if($this->form_validation->run())
            {
                     $vd_vl_total = str_replace('RS', "", trim($this->input->post('venda_valor_total')));
                      $data = elements
                                                (
                                                         array
                                                            (
                                                                 'venda_cliente_id',
                                                                 'venda_forma_pagamento_id',
                                                                 'venda_vendedor_id',
                                                                 'venda_tipo',
                                                                 'venda_data_emissao',
                                                                 'venda_valor_desconto',
                                                                 'venda_valor_total'
                                                            ), $this->input->post()
                                                );

                      $data['venda_valor_total'] = trim(preg_replace('/\$/', '', $vd_vl_total));

                      $data = html_escape($data);

                      $this->core_model->inserir('vendas', $data, TRUE); //TRUE para recuperar o último ID inserido
                      
                      $id_venda = $this->session->userdata('ultimo_id');

                      $produto_id = $this->input->post('produto_id');
                      $produto_qtde = $this->input->post('produto_quantidade');
                      $produto_desconto = str_replace('%', '',  $this->input->post('produto_desconto'));
                      $produto_preco = str_replace('R$', '',  $this->input->post('produto_preco_venda'));
                      $produto_item_total = str_replace('R$', '',  $this->input->post('produto_item_total'));

//                      $produto_preco = str_replace(',',  '', $produto_preco);
//                      $produto_preco = str_replace('.',  '', $produto_preco);
                      $produto_item_total = str_replace(',',  '', $produto_item_total);

                      $qty_produto = count($produto_id); //computa quantidade de produtos na venda

//                             $venda_id = $this->input->post('venda_id');

                      for($i = 0; $i < $qty_produto; $i++) //para gravar os produtos da venda
                      {
                             $data = array
                                                 (
                                                       'venda_produto_id_venda'   => $id_venda,
                                                       'venda_produto_id_produto'   => $produto_id[$i],
                                                       'venda_produto_quantidade'   => $produto_qtde[$i],
                                                       'venda_produto_valor_unitario'   => $produto_preco[$i],
                                                       'venda_produto_desconto'   => $produto_desconto[$i],
                                                       'venda_produto_valor_total'   => $produto_item_total[$i]
                                                 );
                             $data = html_escape($data);

//                                  echo '<pre>';
//                                   print_r($this->input->post());
//                                   exit();

                             $this->core_model->inserir('venda_produtos', $data);

                             //Início atualização do estoqe
                                      //Início atualização do estoqe
                                    $produto_qtde_estoque = 0;
                                    $produto_qtde_estoque += intval($produto_qtde[$i]); //intval -> tranforma em inteiro a quantidade que veio no array $produto_qtde
                                    
                                    $produtos = array
                                                                (
                                                                     'produto_qtde_estoque' => $produto_qtde_estoque
                                                                );
                                    
                                     $this->produtos_model->atualizar($produto_id[$i], $produto_qtde_estoque);
                                    
                             //Fim atualização do estoqe
                      } //Fim do FOR

                      redirect('vendas/imprimir/' . $id_venda);
//                      redirect('vendas');


//                           exit('Validado');
            }
            else
            {
                $data = array
                (
                       'titulo' => 'Cadastrar venda',
                       'styles' => array
                                               (
                                                   'vendor/select2/select2.min.css', //vem primeiro, essa ordem tem que ser seguida se não da erro
                                                   'vendor/autocomplete/jquery-ui.css',
                                                   'vendor/autocomplete/estilos.css',
                                               ),
                       'scripts' => array
                                                 (
                                                     'vendor/autocomplete/jquery-migrate.js', //vem primeiro;
                                                     'vendor/calcx/jquery-calx-sample-2.2.8.min.js',
                                                     'vendor/calcx/venda.js',
                                                      'vendor/select2/select2.min.js',
                                                      'vendor/select2/custom.js',
                                                      'vendor/sweetalert2/sweetalert2.js',
                                                      'vendor/autocomplete/jquery-ui.js' //deve ser o último da lista

                                                 ),
                        'clientes' => $this->core_model->get_all('clientes', array('cliente_ativo' => 1)),
                        'formas_pagamentos' => $this->core_model->get_all('formas_pagamentos', array('forma_pagamento_ativa' => 1)),
                        'vendedores' => $this->core_model->get_all('vendedores', array('vendedor_ativo' => 1)),
                );

//                       echo '<pre>';
//                       print_r($data['venda_produtos']);
//                       exit();
//                       

                $this->load->view('layout/header', $data);
                $this->load->view('vendas/add');
                $this->load->view('layout/footer');
            }
   }
    
       public function edit($vd_id = NULL)
    {
           if(!$vd_id || !$this->core_model->get_by_id('vendas', array('venda_id' => $vd_id)))
           {
                   $this->session->set_flashdata('error', 'Venda não encontrada');
                   redirect('vendas');
           }
           else
           {
//                    $venda_produtos  = $data['venda_produtos'] = $this->vendas_model->get_all_produtos_by_venda($vd_id);
               
                   $this->form_validation->set_rules('venda_cliente_id', '', 'required');
                   $this->form_validation->set_rules('venda_tipo', '', 'required');
                   $this->form_validation->set_rules('venda_forma_pagamento_id', '', 'required');
                   $this->form_validation->set_rules('venda_vendedor_id', '', 'required');
                   
                   if($this->form_validation->run())
                   {
                            $vd_vl_total = str_replace('RS', "", trim($this->input->post('venda_valor_total')));
                             $data = elements
                                                       (
                                                                array
                                                                   (
                                                                        'venda_cliente_id',
                                                                        'venda_forma_pagamento_id',
                                                                        'venda_vendedor_id',
                                                                        'venda_tipo',
                                                                        'venda_data_emissao',
                                                                        'venda_valor_desconto',
                                                                        'venda_valor_total'
                                                                   ), $this->input->post()
                                                       );
                             
                             $data['venda_valor_total'] = trim(preg_replace('/\$/', '', $vd_vl_total));
                             
                             $data = html_escape($data);

                             $this->core_model->atualizar('vendas', $data, array('venda_id' => $vd_id));
                             
                             //Deletando produtos antigos da venda editada                             
                             $this->vendas_model->delete_old_produtos($vd_id);
                             
                             $produto_id = $this->input->post('produto_id');
                             $produto_qtde = $this->input->post('produto_quantidade');
                             $produto_desconto = str_replace('%', '',  $this->input->post('produto_desconto'));
                             $produto_preco = str_replace('R$', '',  $this->input->post('produto_preco_venda'));
                             $produto_item_total = str_replace('R$', '',  $this->input->post('produto_item_total'));
                             
//                             $produto_preco = str_replace(',',  ' ', $produto_preco);
//                             $produto_item_total = str_replace(',',  ' ', $produto_item_total);
                             
                             $qty_produto = count($produto_id); //computa quantidade de produtos na venda
                             
//                             $venda_id = $this->input->post('venda_id');
                             
                             for($i = 0; $i < $qty_produto; $i++) //para gravar os produtos da venda
                             {
                                    $data = array
                                                        (
                                                              'venda_produto_id_venda'   => $vd_id,
                                                              'venda_produto_id_produto'   => $produto_id[$i],
                                                              'venda_produto_quantidade'   => $produto_qtde[$i],
                                                              'venda_produto_valor_unitario'   => $produto_preco[$i],
                                                              'venda_produto_desconto'   => $produto_desconto[$i],
                                                              'venda_produto_valor_total'   => $produto_item_total[$i]
                                                        );
                                    $data = html_escape($data);
                                    
//                                  echo '<pre>';
//                                   print_r($this->input->post());
//                                   exit();
                                    
                                    $this->core_model->inserir('venda_produtos', $data);
                                    
                             
                             } //Fim do FOR
                             
//                             redirect('vendas/imprimir/' . $venda_id);
                             redirect('vendas');
                             

//                           exit('Validado');
                   }
                   else
                   {
                       $data = array
                       (
                              'titulo' => 'Atualizar venda',
                              'styles' => array
                                                      (
                                                          'vendor/select2/select2.min.css', //vem primeiro, essa ordem tem que ser seguida se não da erro
                                                          'vendor/autocomplete/jquery-ui.css',
                                                          'vendor/autocomplete/estilos.css',
                                                      ),
                              'scripts' => array
                                                        (
                                                            'vendor/autocomplete/jquery-migrate.js', //vem primeiro;
                                                            'vendor/calcx/jquery-calx-sample-2.2.8.min.js',
                                                            'vendor/calcx/venda.js',
                                                             'vendor/select2/select2.min.js',
                                                             'vendor/select2/custom.js',
                                                             'vendor/sweetalert2/sweetalert2.js',
                                                             'vendor/autocomplete/jquery-ui.js' //deve ser o último da lista
                                                               
                                                        ),
                               'clientes' => $this->core_model->get_all('clientes', array('cliente_ativo' => 1)),
                               'formas_pagamentos' => $this->core_model->get_all('formas_pagamentos', array('forma_pagamento_ativa' => 1)),
                               'vendedores' => $this->core_model->get_all('vendedores', array('vendedor_ativo' => 1)),
                               'venda_produtos'  => $this->vendas_model->get_all_produtos_by_venda($vd_id),
                               'venda'  => $this->vendas_model->get_by_id($vd_id),
                               'desabilitar' => false //desabilita o botão de submit (salvar)
                       );

//                       echo '<pre>';
//                       print_r($data['venda_produtos']);
//                       exit();
//                       
                       
                       $this->load->view('layout/header', $data);
                       $this->load->view('vendas/edit');
                       $this->load->view('layout/footer');
                   }
           }
   }
   
    public function del($vd_id = null)
    {
           if(!$vd_id || !$this->core_model->get_by_id('vendas', array('venda_id' => $vd_id) ) )
           {
                   $this->session->set_flashdata('error', 'Venda não encontrada');
                   redirect('vendas');
           }
           else
           {
                   // PESQUISAR RESTRIÇÃO PARA APENAS USUÁRIO ADMIN PODER EXCLUIR
                   $this->core_model->apagar('vendas', array('venda_id' => $vd_id) );
                   $this->session->set_flashdata('sucesso', 'Venda apagada com sucesso!');
                   redirect('vendas');
           }
    }
    
       public function imprimir($vd_id = null) 
   {
            if(!$vd_id || !$this->core_model->get_by_id('vendas', array('venda_id' => $vd_id)))
           {
                   $this->session->set_flashdata('error', 'Venda não encontrada');
                   redirect('vendas');
           }
           else
           {
                    $data = array
                                        (
                                                'titulo' => 'Escolha uma opção',
                                                'venda' => $this->core_model->get_by_id('vendas', array('venda_id' => $vd_id))
                                        );
                
               
                    $this->load->view('layout/header', $data);
                    $this->load->view('vendas/imprimir');
                    $this->load->view('layout/footer'); 
           }
   }
   
    public function pdf($vd_id = null) 
   {
           if(!$vd_id || !$this->core_model->get_by_id('vendas', array('venda_id' => $vd_id)))
           {
                   $this->session->set_flashdata('error', 'Venda  não encontrada');
                   redirect('vendas');
           }
           else
           {
                   $empresa = $this->core_model->get_by_id('sistema', array('sistema_id' => 1));
                   
                   $venda = $this->vendas_model->get_by_id($vd_id);
                   $file_name = 'Venda  ' . $venda->venda_id;
                   
                   $html = '<html>';
                   
                        $html .= '<head>';
                                $html .=   '<title>'  . $empresa->sistema_nome_fantasia  .' | Impressão de venda </title>';
                        $html .= '</head>';
                        
                        $html .= '<body style="font-size: 14px;">';
                                $html .=  '<h4 align="center" >
                                                    ' . 'Razão Social: '.  $empresa->sistema_razao_social . ' <br>
                                                    ' . 'CNPJ: ' . $empresa->sistema_cnpj . ' <br>
                                                    ' . 'Endereço: '. $empresa->sistema_endereco . ', ' . $empresa->sistema_numero . ' <br>
                                                    ' . 'Cidade: '. $empresa->sistema_cidade . ', '  . 'CEP: '. $empresa->sistema_cep . ', UF: ' . $empresa->sistema_estado . '<br>
                                                     ' . 'E-mail: ' . $empresa->sistema_email . ' <br>
                                                     ' . 'Telefone: ' . $empresa->sistema_telefone_fixo . ' <br>
                                               </h4>' ;
                                $html .= '<hr>';
                                
                                //Dados da Venda
                                
                                $html .= '<table width="100%" border: solid #ddd 1px>';
                                        $html .= '<tr>';
                                                $html .= '<th> Código </th>';
                                                $html .= '<th> Descrição </th>';
                                                $html .= '<th align="center"> Qtde </th>';
                                                $html .= '<th> Valor unitário </th>';
                                                $html .= '<th> Desconto </th>';
                                                $html .= '<th> Valor total </th>';
                                        
                                        
                                        $html .= '</tr>';
                                                                        
                                        
//                                        $id_vd = $venda->venda_id;

                                        $produtos_venda = $this->vendas_model->get_all_produtos($vd_id);
                                        $valor_final_vd = $this->vendas_model->get_valor_final_venda($vd_id);

//                                        $html .= '<p> O.S Nº ' . $venda->venda_id . '</p>';
//                                       echo '<pre>';
//                                       print_r($produtos_venda);
//                                       exit();

                                        
                                        
                                        foreach ($produtos_venda as $produto):
                                            
                                          $produto_preco = str_replace('.',  ',',  $produto->venda_produto_valor_unitario);
//                                          $produto_preco = str_replace(',',  ' ',  $produto->venda_produto_valor_unitario);
                                          $produto_item_total = str_replace(',',  ' ', $produto->venda_produto_valor_total);
                                          $produto_item_total = str_replace('.',  ',', $produto->venda_produto_valor_total);
                                            
                                                $html .= '<tr>';
                                                        $html .= '<td>' . $produto->venda_produto_id_produto . '</td>';
                                                        $html .= '<td>' . $produto->produto_descricao . '</td>';
                                                        $html .= '<td align="center">' . $produto->venda_produto_quantidade . '</td>';
                                                        $html .= '<td>' .'R$ ' . $produto_preco . '</td>';
                                                        $html .= '<td>' .'% ' . $produto->venda_produto_desconto . '</td>';
                                                        $html .= '<td >' .'RS ' . $produto_item_total . '</td>';
                                                $html .= '</tr>';

                                            endforeach;

                                        $html .= '<th colspan="4">';
                                                $html .= '<td style="border-top: solid #ddd 1px"> <strong> Valor final </strong> </td>';
                                                $html .= '<td style="border-top: solid #ddd 1px">'  .'R$ ' . $valor_final_vd->venda_valor_total . '</td>';
                                        $html .= '</th>'; 
                                
                                        
                                $html .= '</table>';
                                
                                //Dados do cliente
                               
                                 $html .= '<footer style="position:  absolute; bottom: 0; width: 100%; ">';
                                        $html .= '<p>  <strong> Venda Nº </strong>' .  $venda->venda_id . '</p>';
                                        $html .= '<p> <strong> Cliente: </strong> ' .  $venda->cliente_nome . '<br>' .
                                                        '<strong> CPF / CNPJ: </strong>' . $venda->cliente_cpf_cnpj . '<br>' .
                                                        '<strong> Data de emissão: </strong>' . formata_data_banco_sem_hora($venda->venda_data_emissao) . '<br>' .
                                                        '<strong> Forma de pagamento: </strong>' . $venda->forma_pagamento . '<br>' .
                                                        '<strong> Celular: </strong>' . $venda->cliente_celular . '<br>' .
                                                        '<strong> Vendedor: </strong>' . $venda->vendedor . '<br>' .
                                                        '</p>';
                                $html .= '</footer>';
                                    
                        $html .= '</body>';
                   
                   $html .= '</html>';
                   
//                   echo '<pre>';
//                   print_r($html);
//                   exit();
                   
                   $this->pdf->createPDF($html, $file_name, false);
                   //passamos o parâmetro false para abrir o PDF no navegador
           }
   }
}    


//  foreach ($venda_produtos as $venda_p)
//    {
//            if($venda_p->venda_produto_quantidade < $produto_qtde[$i])
//            {
//                    $produto_qtde_estoque = 0;
//
//                    $produto_qtde_estoque += intval($produto_qtde[$i]); //intval -> tranforma em inteiro a quantidade que veio no array $produto_qtde
//                    $diferenca = ($produto_qtde_estoque - $venda_p->venda_produto_quantidade);
//
//                    $this->produtos_model->atualizar($produto_id, $diferenca);
//            }
//    }