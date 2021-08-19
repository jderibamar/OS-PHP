<?php

defined('BASEPATH') OR exit('Ação não permitida');

class Ordem_servicos extends CI_Controller
{
    public function __construct()
    {
            parent::__construct();
            
              if (!$this->ion_auth->logged_in()) //verifica se o usuário está logado
                {
                       $this->session->set_flashdata('info', 'Sua sessão expirou, faça LOGIN novamente!'); 
                       redirect('login');
                }
                
            $this->load->model('ordem_servicos_model');
    }
    
     public function index() 
    {
            $data = array
                                (
                                       'titulo' => 'Ordem de serviços cadastradas',
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
                                         'ordens_servicos' =>  $this->ordem_servicos_model->get_all()
                                );

            $this->load->view('layout/header', $data);
            $this->load->view('ordem_servicos/index');
            $this->load->view('layout/footer');
    }
       
    public function add()
    {
            $this->form_validation->set_rules('ordem_servico_cliente_id', '', 'required');
            $this->form_validation->set_rules('ordem_servico_equipamento', '', 'trim|required|min_length[2]|max_length[80]');
            $this->form_validation->set_rules('ordem_servico_marca_equipamento', 'Marca', 'trim|required|min_length[2]|max_length[80]');
            $this->form_validation->set_rules('ordem_servico_modelo_equipamento', 'Modelo', 'trim|required|min_length[2]|max_length[80]');
            $this->form_validation->set_rules('ordem_servico_acessorios', 'Acessórios', 'trim|required|max_length[300]');
            $this->form_validation->set_rules('ordem_servico_defeito', 'Defeito', 'trim|required|max_length[700]');

            if($this->form_validation->run())
            {
                     $os_vl_total = str_replace('RS', "", trim($this->input->post('ordem_servico_valor_total')));
                      $data = elements
                                                (
                                                         array
                                                            (
                                                                 'ordem_servico_cliente_id',
                                                                 'ordem_servico_status',
                                                                 'ordem_servico_equipamento',
                                                                 'ordem_servico_marca_equipamento',
                                                                 'ordem_servico_modelo_equipamento',
                                                                 'ordem_servico_acessorios',
                                                                 'ordem_servico_defeito',
                                                                 'ordem_servico_valor_desconto',
                                                                 'ordem_servico_valor_total',
                                                                 'ordem_servico_obs'
                                                            ), $this->input->post()
                                                );
                      $data['ordem_servico_valor_total'] = trim(preg_replace('/\$/', '', $os_vl_total));

//                             echo '<pre>';
//                             print_r($this->input->post());
//                             exit();

                      $data = html_escape($data);
                      
                      $this->core_model->inserir('ordens_servicos', $data, true); //TRUE para inserir na sessão o último ID
                      
                      //Recuperar o último ID que foi inserido na sessão
                      $ultimo_id = $this->session->userdata('ultimo_id');

                      $servico_id = $this->input->post('servico_id');
                      $servico_qtde = $this->input->post('servico_quantidade');
                      $servico_desconto = str_replace('%', '',  $this->input->post('servico_desconto'));
                      $servico_preco = str_replace('R$', '',  $this->input->post('servico_preco'));
                      $servico_item_total = str_replace('R$', '',  $this->input->post('servico_item_total'));

                      $servico_preco = str_replace(',',  '', $servico_preco);
                      $servico_item_total = str_replace(',',  '', $servico_item_total);

                      $qty_servico = count($servico_id);
                      $ordem_servico_id = $this->input->post('ordem_servico_id');

                      for($i = 0; $i < $qty_servico; $i++) //para gravar os serviços da OS
                      {
                             $data = array
                                                 (
                                                       'ordem_ts_id_ordem_servico'   => $ultimo_id,
                                                       'ordem_ts_id_servico'   => $servico_id[$i],
                                                       'ordem_ts_quantidade'   => $servico_qtde[$i],
                                                       'ordem_ts_valor_unitario'   => $servico_preco[$i],
                                                       'ordem_ts_valor_desconto'   => $servico_desconto[$i],
                                                       'ordem_ts_valor_total'   => $servico_item_total[$i]
                                                 );
                             $data = html_escape($data);

                             $this->core_model->inserir('ordem_tem_servicos', $data);
                      }

                      //CRIAR RECURSO PDF

                      redirect('os/imprimir/' . $ultimo_id);


//                           exit('Validado');
            }
            else
            {
                $data = array
                (
                       'titulo' => 'Cadastrar ordem de serviço',
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
                                                     'vendor/calcx/os.js',
                                                      'vendor/select2/select2.min.js',
                                                      'vendor/select2/custom.js',
                                                      'vendor/sweetalert2/sweetalert2.js',
                                                      'vendor/autocomplete/jquery-ui.js' //deve ser o último da lista

                                                 ),
                        'clientes' => $this->core_model->get_all('clientes', array('cliente_ativo' => 1)),
                );

//                       $ordem_servico =  $data['ordem_servico']  = $this->ordem_servicos_model->get_by_id($os_id);
//                       echo '<pre>';
//                       print_r($data['ordem_servico']);
//                       exit();
//                       

                $this->load->view('layout/header', $data);
                $this->load->view('ordem_servicos/add');
                $this->load->view('layout/footer');
            }
   }
       
    public function edit($os_id = NULL)
    {
           if(!$os_id || !$this->core_model->get_by_id('ordens_servicos', array('ordem_servico_id' => $os_id)))
           {
                   $this->session->set_flashdata('error', 'Ordem de serviço não encontrada');
                   redirect('os');
           }
           else
           {
                   $os_status = $this->input->post('ordem_servico_status') ;
                   
                   if($os_status == 1)
                   {
                            $this->form_validation->set_rules('ordem_servico_forma_pagamento_id', '', 'required');
                   }
                   
                   $this->form_validation->set_rules('ordem_servico_cliente_id', '', 'required');
                   $this->form_validation->set_rules('ordem_servico_equipamento', '', 'trim|required|min_length[2]|max_length[80]');
                   $this->form_validation->set_rules('ordem_servico_marca_equipamento', 'Marca', 'trim|required|min_length[2]|max_length[80]');
                   $this->form_validation->set_rules('ordem_servico_modelo_equipamento', 'Modelo', 'trim|required|min_length[2]|max_length[80]');
                   $this->form_validation->set_rules('ordem_servico_acessorios', 'Acessórios', 'trim|required|max_length[300]');
                   $this->form_validation->set_rules('ordem_servico_defeito', 'Defeito', 'trim|required|max_length[700]');
                   
                   if($this->form_validation->run())
                   {
                            $os_vl_total = str_replace('RS', "", trim($this->input->post('ordem_servico_valor_total')));
                             $data = elements
                                                       (
                                                                array
                                                                   (
                                                                        'ordem_servico_forma_pagamento_id',
                                                                        'ordem_servico_cliente_id',
                                                                        'ordem_servico_status',
                                                                        'ordem_servico_equipamento',
                                                                        'ordem_servico_marca_equipamento',
                                                                        'ordem_servico_modelo_equipamento',
                                                                        'ordem_servico_acessorios',
                                                                        'ordem_servico_defeito',
                                                                        'ordem_servico_valor_desconto',
                                                                        'ordem_servico_valor_total',
                                                                        'ordem_servico_obs'
                                                                   ), $this->input->post()
                                                       );
                             
                                if($os_status == 0)
                                {
                                        unset($data['ordem_servico_forma_pagamento_id']); //remove esse valor do array na hora de salvar
                                }
                             
                             $data['ordem_servico_valor_total'] = trim(preg_replace('/\$/', '', $os_vl_total));
                             
                             $data = html_escape($data);

                             $this->core_model->atualizar('ordens_servicos', $data, array('ordem_servico_id' => $os_id));
                             
                             //apagar os serviços antigos da ordem editada
                             $this->ordem_servicos_model->delete_old_services($os_id);
                             
                             $servico_id = $this->input->post('servico_id');
                             $servico_qtde = $this->input->post('servico_quantidade');
                             $servico_desconto = str_replace('%', '',  $this->input->post('servico_desconto'));
                             $servico_preco = str_replace('R$', '',  $this->input->post('servico_preco'));
                             $servico_item_total = str_replace('R$', '',  $this->input->post('servico_item_total'));
                             
                             $servico_preco = str_replace(',',  ' ', $servico_preco);
                             $servico_item_total = str_replace(',',  ' ', $servico_item_total);
                             
                             $qty_servico = count($servico_id);
                             $ordem_servico_id = $this->input->post('ordem_servico_id');
                             
                             for($i = 0; $i < $qty_servico; $i++) //para gravar os serviços da OS
                             {
                                    $data = array
                                                        (
                                                              'ordem_ts_id_ordem_servico'   => $ordem_servico_id,
                                                              'ordem_ts_id_servico'   => $servico_id[$i],
                                                              'ordem_ts_quantidade'   => $servico_qtde[$i],
                                                              'ordem_ts_valor_unitario'   => $servico_preco[$i],
                                                              'ordem_ts_valor_desconto'   => $servico_desconto[$i],
                                                              'ordem_ts_valor_total'   => $servico_item_total[$i]
                                                        );
                                    $data = html_escape($data);
                                    
                                    $this->core_model->inserir('ordem_tem_servicos', $data);
                             }
                             
                             //CRIAR RECURSO PDF
                             
                             redirect('os/imprimir/' . $ordem_servico_id);
                             

//                           exit('Validado');
                   }
                   else
                   {
                       $data = array
                       (
                              'titulo' => 'Atualizar ordem de serviço',
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
                                                            'vendor/calcx/os.js',
                                                             'vendor/select2/select2.min.js',
                                                             'vendor/select2/custom.js',
                                                             'vendor/sweetalert2/sweetalert2.js',
                                                             'vendor/autocomplete/jquery-ui.js' //deve ser o último da lista
                                                               
                                                        ),
                               'ordem_servico'  => $this->ordem_servicos_model->get_by_id($os_id),
                               'clientes' => $this->core_model->get_all('clientes', array('cliente_ativo' => 1)),
                               'formas_pagamentos' => $this->core_model->get_all('formas_pagamentos', array('forma_pagamento_ativa' => 1)),
                               'os_tem_servicos' => $this->ordem_servicos_model->get_all_servicos_by_ordem($os_id)
                       );

//                       $ordem_servico =  $data['ordem_servico']  = $this->ordem_servicos_model->get_by_id($os_id);
//                       echo '<pre>';
//                       print_r($data['ordem_servico']);
//                       exit();
//                       
                       
                       $this->load->view('layout/header', $data);
                       $this->load->view('ordem_servicos/edit');
                       $this->load->view('layout/footer');
                   }
           }
   }
   
   public function del($os_id = NULL) 
   {
           if(!$os_id || !$this->core_model->get_by_id('ordens_servicos', array('ordem_servico_id' => $os_id)))
           {
                   $this->session->set_flashdata('error', 'Ordem de serviço não encontrada');
                   redirect('os');
           }
           else
           {
                  if($this->core_model->get_by_id('ordens_servicos', array('ordem_servico_id' => $os_id, 'ordem_servico_status' => 0)))  
                  {
                        $this->session->set_flashdata('info', 'Ordem de serviço não pode ser excluída porque está em aberto!');
                        redirect('os');
                  }
              
                  $this->core_model->apagar('ordens_servicos', array('ordem_servico_id' => $os_id));
                  $this->session->set_flashdata('sucesso', 'Ordem de serviço apagada com sucesso!');
                  redirect('os');
           }
   }
   
   public function imprimir($os_id = null) 
   {
            if(!$os_id || !$this->core_model->get_by_id('ordens_servicos', array('ordem_servico_id' => $os_id)))
           {
                   $this->session->set_flashdata('error', 'Ordem de serviço não encontrada');
                   redirect('os');
           }
           else
           {
                    $data = array
                                        (
                                                'titulo' => 'Escolha uma opção',
                                                'ordem_servico' => $this->core_model->get_by_id('ordens_servicos', array('ordem_servico_id' => $os_id))
                                        );
                
               
                    $this->load->view('layout/header', $data);
                    $this->load->view('ordem_servicos/imprimir');
                    $this->load->view('layout/footer'); 
           }
   }
   
   public function pdf($os_id = null) 
   {
           if(!$os_id || !$this->core_model->get_by_id('ordens_servicos', array('ordem_servico_id' => $os_id)))
           {
                   $this->session->set_flashdata('error', 'Ordem de serviço não encontrada');
                   redirect('os');
           }
           else
           {
                   $empresa = $this->core_model->get_by_id('sistema', array('sistema_id' => 1));
                   
                   $ordem_servico = $this->ordem_servicos_model->get_by_id($os_id);
                   $file_name = 'O.S ' . $ordem_servico->ordem_servico_id;
                   
                   $html = '<html>';
                   
                        $html .= '<head>';
                                $html .=   '<title>' . $empresa->sistema_nome_fantasia  .' | Impressão de O.S </title>';
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
                                
                                //Dados da OS
                                
                                $html .= '<table width="100%" border: solid #ddd 1px>';
                                        $html .= '<tr>';
                                                $html .= '<th> Serviço </th>';
                                                $html .= '<th align="center"> Qtde </th>';
                                                $html .= '<th> Valor unitário </th>';
                                                $html .= '<th> Desconto </th>';
                                                $html .= '<th> Valor total </th>';
                                        
                                        
                                        $html .= '</tr>';
                                                                        
                                        
                                        $id_os = $ordem_servico->ordem_servico_id;

                                        $servicos_ordem = $this->ordem_servicos_model->get_all_servicos($id_os);
                                        $valor_final_os = $this->ordem_servicos_model->get_valor_final_os($id_os);

//                                        $html .= '<p> O.S Nº ' . $ordem_servico->ordem_servico_id . '</p>';
//                                       echo '<pre>';
//                                       print_r($servicos_ordem);
//                                       exit();

                                        foreach ($servicos_ordem as $servico):
                                                $html .= '<tr>';
                                                        $html .= '<td>' . $servico->servico_nome . '</td>';
                                                        $html .= '<td align="center">' . $servico->ordem_ts_quantidade . '</td>';
                                                        $html .= '<td>' . 'R$ ' . $servico->ordem_ts_valor_unitario . '</td>';
                                                        $html .= '<td>' .'% ' . $servico->ordem_ts_valor_desconto . '</td>';
                                                        $html .= '<td>' .'RS ' . $servico->ordem_ts_valor_total . '</td>';
                                                $html .= '</tr>';

                                            endforeach;

                                        $html .= '<th colspan="3">';
                                                $html .= '<td style="border-top: solid #ddd 1px"> <strong> Valor final </strong> </td>';
                                                $html .= '<td style="border-top: solid #ddd 1px">'  .'R$ ' . $valor_final_os->os_valor_total . '</td>';
                                        $html .= '</th>'; 
                                
                                        
                                $html .= '</table>';
                                
                                //Dados do cliente
                               
                                 $html .= '<footer style="position:  absolute; bottom: 0; width: 100%; ">';
                                        $html .= '<p>  <strong> O.S Nº: </strong>' .  $ordem_servico->ordem_servico_id . '</p>';
                                        $html .= '<p> <strong> Cliente: </strong> ' .  $ordem_servico->cliente_nome . '<br>' .
                                                        '<strong> CPF / CNPJ: </strong>' . $ordem_servico->cliente_cpf_cnpj . '<br>' .
                                                        '<strong> Data de emissão: </strong>' . formata_data_banco_sem_hora($ordem_servico->ordem_servico_data_emissao) . '<br>' .
                                                        '<strong> Forma de pagamento: </strong>' . ($ordem_servico->ordem_servico_status == 1 ? $ordem_servico->forma_pagamento : 'Em aberto ') . '<br>' .
                                                        '<strong> Celular: </strong>' . $ordem_servico->cliente_celular . '<br>' .
                                                        '</p>';
                                $html .= '</footer>';
                                    
                        $html .= '</body>';
                   
                   $html .= '</html>';
                   
                   $this->pdf->createPDF($html, $file_name, false);
                   //passamos o parâmetro false para abrir o PDF no navegador
                   
//                   echo '<pre>';
//                   print_r($html);
//                   exit();
                   
           }
   }
}    