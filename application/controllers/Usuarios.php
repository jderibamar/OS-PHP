<?php

defined('BASEPATH') OR exit('Ação não permitida');

class Usuarios extends CI_Controller
{
    public function __construct()
    {
            parent::__construct();
            
              if (!$this->ion_auth->logged_in())
                {
                        $this->session->set_flashdata('info', 'Sua sessão expirou, faça LOGIN novamente!');
                        redirect('login');
                }
            //definir se há sessão
    }
        
    public function index()
    {
           $usuarios = array
                            (
                               'titulo' => 'Usuários', 
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
                                  'usuarios' =>  $users = $this->ion_auth->users()->result()
                            ); 
           
//                            echo '<pre>';
//                            print_r($usuarios['usuarios']);
//                            exit();
           
                        $this->load->view('layout/header', $usuarios);
                        $this->load->view('usuarios/index');
                        $this->load->view('layout/footer');                        
    }
    
    public function add() 
    {
            $this->form_validation->set_rules('first_name', '','trim|required|min_length[5]|max_length[100]');
            $this->form_validation->set_rules('last_name', '', 'trim|required');
            $this->form_validation->set_rules('email', '', 'trim|required|valid_email|is_unique[users.email]');
            $this->form_validation->set_rules('username', '', 'trim|required|is_unique[users.username]');
            $this->form_validation->set_rules('password', 'SENHA', 'required|min_length[5]|max_length[255]');
            $this->form_validation->set_rules('confirm_password', 'Confirmar senha', 'matches[password]');
            
            if($this->form_validation->run())
            {
                    $username = $this->security->xss_clean($this->input->post('username') );
                    $password =  $this->security->xss_clean($this->input->post('password') );
                    $email = $this->security->xss_clean($this->input->post('email') );
                    $additional_data = array(
                                'first_name' => $this->input->post('first_name'),
                                'last_name' => $this->input->post('last_name'),
                                'username' => $this->input->post('username'),
                                'active' => $this->input->post('active'),
                                );
                    $group = array($this->input->post('perfil') ); // Sets user to admin.
                    
                    $additional_data = $this->security->xss_clean($additional_data);
                    $group = $this->security->xss_clean($group);

                    if($this->ion_auth->register($username, $password, $email, $additional_data, $group))
                    {
                            //primeiro parâmetro da função "set_flashdata" é o nome da mensagem que será capturado no formulário
                            $this->session->set_flashdata('sucesso', 'Novo usuário adicionado com sucesso!');
                    }
                    else 
                    {
                            $this->session->set_flashdata('error', 'Erro ao adicionar novo usuário!'); 
                    }
                    redirect('usuarios');
                    
//                    alterar ion_auth_model na linha 853
            }
            else
            {
                    $data = array
                                (
                                      'titulo' => 'Cadastrar usuário',
                                );
                    
                      $this->load->view('layout/header', $data);
                       $this->load->view('usuarios/add');
                       $this->load->view('layout/footer');
            }
    }
    
    public function edit($u_id = NULL) 
    {
            if(!$u_id || !$user = $this->ion_auth->user($u_id)->row())
            {
                   $this->session->set_flashdata('error', 'Usuário não encontrado') ;
                   redirect('usuarios');
            }
            else 
            {
                     $this->form_validation->set_rules('first_name', '','trim|required|min_length[5]|max_length[100]');
                     $this->form_validation->set_rules('last_name', '', 'trim|required');
                     $this->form_validation->set_rules('email', '', 'trim|required|valid_email|callback_email_check');
                     $this->form_validation->set_rules('username', '', 'trim|required');
                     $this->form_validation->set_rules('password', 'SENHA', 'min_length[5]|max_length[255]');
                     $this->form_validation->set_rules('confirm_password', 'Confirmar senha', 'matches[password]');
                     
                     if($this->form_validation->run())
                     {
                            $data = elements
                                        (
                                               array
                                                       (
                                                            'first_name',
                                                            'last_name',
                                                            'email',
                                                            'username',
                                                            'active',
                                                            'password',
                                                       ), $this->input->post()
                                        );
                            
                            $data = $this->security->xss_clean($data);
                            $pwd = $this->input->post('password');
                            
                            //verifica se foi passado o password ,se não, será removido o campo do array para não gravar uma senha em branco
                            if(!$pwd)
                            {
                                unset($data['password']); 
                            }
                            
                            if($this->ion_auth->update($u_id, $data))
                            {
                                    //se for diferente atualiza o grupo
                                    $perfil_usuario_db = $this->ion_auth->get_users_groups($u_id)->row();
                                    $perfil_usuario_post = $this->input->post('perfil');

                                    if($perfil_usuario_post != $perfil_usuario_db->id)
                                    {
                                            $this->ion_auth->remove_from_group($perfil_usuario_db->id,  $u_id);
                                            $this->ion_auth->add_to_group($perfil_usuario_post, $u_id);
                                    }
                                    
                                    $this->session->set_flashdata('sucesso', 'Dados salvos com sucesso!');                                   
                            }
                            else
                            {
                                    $this->session->set_flashdata('error', 'Erro ao salvar os dados!');
                            }
                             redirect('usuarios');
                            exit('Form validado');
                     }
                     else
                     {
                             $data = array
                                  (
                                        'titulo' => 'Editar usuário',
                                        'usuario'  => $this->ion_auth->user($u_id)->row(),
                                        'perfil' =>  $this->ion_auth->get_users_groups($u_id)->row()
                                  );
                     
                                $this->load->view('layout/header', $data);
                                $this->load->view('usuarios/edit');
                                $this->load->view('layout/footer');
                     }
            }
    }
    
    public function del($u_id = NULL)
    {
            if(!$u_id || !$this->ion_auth->user($u_id) ->row() )
            {
                    $this->session->set_flashdata('error', 'Usuário não encontrado');
                    redirect('usuarios');
            }
           
            if($this->ion_auth->is_admin($u_id) )
            {
                    $this->session->set_flashdata('error', 'O administrador não pode ser excluído!');
                    redirect('usuarios');
            }
            
            if($this->ion_auth->delete_user($u_id))
            {
                    $this->session->set_flashdata('sucesso', 'Usuário apagado com sucesso!');
                    redirect('usuarios');
            }
            else
            {
                    $this->session->set_flashdata('error', 'Não foi possível excluir este usuário!');
                    redirect('usuarios');
            }
    }
    
    public function email_check($email)
    {
            $u_id = $this->input->post('u_id');
            
            if($this->core_model->get_by_id('users', array('email' => $email, 'id !=' => $u_id ))) //se esta condição for verdadeira é porque já existe o e-mail na base de dados
            {
                    $this->form_validation->set_message('email_check', 'Este e-mail já existe, informe outro!');
                    return FALSE;  
            }
            else
            {
                return TRUE;
            }
    }
    
    public function username_check($username)
    {
            $u_id = $this->input->post('u_id');
            
            if($this->core_model->get_by_id('users', array('username' => $username, 'id !=' => $u_id ))) //se esta condição for verdadeira é porque já existe o e-mail na base de dados
            {
                    $this->form_validation->set_message('username_check', 'Este usuário já existe, informe outro!');
                    return FALSE;  
            }
            else
            {
                return TRUE;
            }
    }
}