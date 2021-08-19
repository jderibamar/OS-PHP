<?php

defined('BASEPATH') OR exit('Ação não permitida');

class Sistema extends CI_Controller
{
        public function __construct() 
        {
                parent::__construct();
                
                if (!$this->ion_auth->logged_in()) //verifica se o usuário está logado
                {
                      redirect('login');
                }
        }
        
        public function index() 
        {
                $data = array
                                    (
                                        'titulo' => 'Editar informações do sistema',
                                        'scripts' => array('vendor/mask/jquery.mask.min.js', 'vendor/mask/masks.js'),
                                         'sistema'  => $this->core_model->get_by_id('sistema', array('sistema_id' => 1))
                                    );
               
                $this->form_validation->set_rules('sistema_razao_social', 'Razão social', 'trim|required|min_length[10]|max_length[145]');
                $this->form_validation->set_rules('sistema_nome_fantasia', 'Nome fantasa', 'trim|min_length[10]|required|max_length[145]');
                $this->form_validation->set_rules('sistema_cnpj', '', 'trim|required|exact_length[18]');
                $this->form_validation->set_rules('sistema_ie', '', 'trim|max_length[145]');
                $this->form_validation->set_rules('sistema_email', '', 'trim|required|valid_email|max_length[100]');
                $this->form_validation->set_rules('sistema_endereco', '', 'trim|required|min_length[15]|max_length[145]');
                $this->form_validation->set_rules('sistema_numero', '', 'trim|required|max_length[25]');
                $this->form_validation->set_rules('sistema_cidade', 'Cidade', 'trim|required|min_length[3]|max_length[45]');
                $this->form_validation->set_rules('sistema_estado', 'UF', 'trim|required|exact_length[2]');
                $this->form_validation->set_rules('sistema_cep', 'CEP', 'trim|required|max_length[9]');
                $this->form_validation->set_rules('sistema_txt_ordem_servico', 'Texto OS', 'trim|max_length[500]');
                
                if($this->form_validation->run())
                {
                       $data = elements
                                    (
                                          array
                                           (
                                                'sistema_razao_social',
                                                'sistema_nome_fantasia',
                                                'sistema_cnpj',
                                                'sistema_ie',
                                                'sistema_telefone_fixo',
                                                'sistema_telefone_movel',
                                                'sistema_email',
                                                'sistema_site_url',
                                               'sistema_endereco',
                                               'sistema_cep',
                                               'sistema_numero',
                                               'sistema_cidade',
                                               'sistema_estado',
                                               'sistema_txt_ordem_servico'
                                           ), $this->input->post()
                                    );
                       
                        
                        $data = html_escape($data);
                        $this->core_model->atualizar('sistema', $data, array('sistema_id' => 1) );
                        redirect('sistema');
                }
                else
                {
                        $this->load->view('layout/header', $data);
                        $this->load->view('sistema/index');
                        $this->load->view('layout/footer');    
                }
                
                /*
                    (
                        [sistema_id] => 1
                        [sistema_razao_social] => J. de Ribamar Duarte
                        [sistema_nome_fantasia] => Ribamar Informática
                        [sistema_cnpj] => 11.046.887/0001-75
                        [sistema_ie] => 
                        [sistema_telefone_fixo] => 3356-0000
                        [sistema_telefone_movel] => 61-92001-8815
                        [sistema_email] => ribamarinformatica@gmail.com
                        [sistema_site_url] => 
                        [sistema_cep] => 71070649
                        [sistema_endereco] => QE 46, AE 03, BLOCO C
                        [sistema_numero] => 401
                        [sistema_cidade] => GUARÁ
                        [sistema_estado] => DF
                        [sistema_txt_ordem_servico] => 
                        [sistema_data_alteracao] => 2021-07-11 14:53:47
                    )
                 */
                
        }
}

