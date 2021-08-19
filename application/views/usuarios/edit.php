

<?php $this->load->view('layout/sidebar'); ?>        

 <!-- Main Content -->
 <div id="content">

   <?php $this->load->view('layout/navbar') ?> 

     <!-- Begin Page Content -->
     <div class="container-fluid">

             <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="<?= base_url('usuarios'); ?>"> Usuários </a></li>
                      <li class="breadcrumb-item active" aria-current="page"> <?= $titulo ?> </li>
                  </ol>
            </nav>

         <!-- DataTales Example -->
                 <div class="card shadow mb-4">
                     <div class="card-header py-3">
                         <a title="Voltar" href="<?= base_url('usuarios'); ?>" class="btn btn-success btn-sm float-right">  <i class="fas fa-arrow-left"></i> &nbsp; Voltar </a>
                     </div>
                     <div class="card-body">
                         <form method="POST" name="form_edit" class="user">                                    
                                      
                                    <div class="form-group row">
                                            <div class="col-md-3 form-text mb-2">  
                                                <label> Nome </label>
                                                <input type="text" class="form-control form-control-user" name="first_name" placeholder="Digite seu nome aqui" value="<?= $usuario->first_name ;?> ">
                                                <?= form_error('first_name', '<small class="form-text text-danger" >', '</small>') ; ?>
                                            </div>

                                            <div class="col-md-3 form-text mb-2">  
                                                <label> Sobrenome </label>
                                                <input type="text" class="form-control form-control-user" name="last_name"  placeholder="Digite seu sobrenome aqui" value="<?= $usuario->last_name ;?> ">
                                                <?= form_error('last_name', '<small class="form-text text-danger" >', '</small>') ; ?>
                                            </div>

                                              <div class="col-md-3 form-text mb-2">  
                                                  <label> Email&nbsp;(Login) </label>
                                                  <input type="email" class="form-control form-control-user" name="email"  placeholder="Digite seu sobrenome aqui" value="<?= $usuario->email ;?> ">
                                                  <?= form_error('email', '<small class="form-text text-danger" >', '</small>') ; ?>
                                            </div>

                                              <div class="col-md-3 form-text mb-2">
                                                  <label> Usuário </label>
                                                  <input type="text" class="form-control form-control-user" name="username"  placeholder="Digite seu usuário aqui" value="<?= $usuario->username ;?> ">
                                                  <?= form_error('username', '<small class="form-text text-danger" >', '</small>') ; ?>
                                              </div>

                                            <div class="col-md-3 mb-2">
                                                    <label> Ativo </label>
                                                    <select class="custom-select" name="active">
                                                        <option value="0" <?= ($usuario->active == 0 ? 'selected' : '') ?> > Não </option>
                                                        <option value="1"  <?= ($usuario->active == 1 ? 'selected' : '') ?> > Sim </option>
                                                    </select>
                                            </div>

                                             <div class="col-md-3 mb-2">
                                                 <label> Perfil de acesso </label>
                                                    <select class="custom-select" name="perfil" >
                                                        <option value="2" <?= ($perfil)->id == 2 ? 'selected' : ''; ?> > Vendedor </option>
                                                        <option value="1"  <?= ($perfil)->id == 1 ? 'selected' : ''; ?> > Administrador </option>
                                                    </select>
                                            </div>
                                    </div>   
                             
                                     <div class="form-group row">
                                               <div class="col-md-6 form-text mb-2">  
                                                    <label> Senha </label>
                                                    <input type="password" class="form-control form-control-user" name="password"  placeholder="Digite sua senha aqui" >
                                                    <?= form_error('password', '<small class="form-text text-danger" >', '</small>') ; ?>
                                              </div>

                                            <div class="col-md-6 form-text mb-2">  
                                                 <label> Confirmar senha </label>
                                                 <input type="password" class="form-control form-control-user" name="confirm_password"  placeholder="Confirme sua senha" >
                                                 <?= form_error('confirm_password', '<small class="form-text text-danger" >', '</small>') ; ?>
                                           </div>  
                                    </div>
                              
                                       <input  type="hidden" name="u_id"" value="<?= $usuario->id ?>">
                                       <button type="submit" class="btn btn-primary btn-sm"> Salvar </button>
                               </form>
                         
                     </div>
                 </div>

     </div>
     <!-- /.container-fluid -->

 </div>
 <!-- End of Main Content -->

           