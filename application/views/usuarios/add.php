

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
                         <form method="POST" name="form_add">
                                    <div class="form-group row">

                                        <div class="col-md-4">  
                                            <label> Nome </label>
                                            <input type="text" class="form-control" name="first_name" placeholder="Digite seu nome aqui" value="<?= set_value('first_name')?> ">
                                            <?= form_error('first_name', '<small class="form-text text-danger" >', '</small>') ; ?>
                                        </div>

                                        <div class="col-md-4">  
                                            <label> Sobrenome </label>
                                            <input type="text" class="form-control" name="last_name"  placeholder="Digite seu sobrenome aqui" value="<?= set_value('last_name')?>">
                                            <?= form_error('last_name', '<small class="form-text text-danger" >', '</small>') ; ?>
                                        </div>

                                          <div class="col-md-4 form-text">  
                                              <label> Email&nbsp;(Login) </label>
                                              <input type="email" class="form-control" name="email"  placeholder="Digite seu sobrenome aqui" value="<?= set_value('email')?>">
                                              <?= form_error('email', '<small class="form-text text-danger" >', '</small>') ; ?>
                                        </div>

                                          <div class="col-md-4 form-text">  
                                              <label> Usuário </label>
                                              <input type="text" class="form-control" name="username"  placeholder="Digite seu usuário aqui" value="<?= set_value('username')?>">
                                              <?= form_error('username', '<small class="form-text text-danger" >', '</small>') ; ?>
                                        </div>

                                       <div class="col-md-4">  
                                               <label> Ativo </label>
                                               <select class="form-control" name="active" style="width: 76px;">
                                                   <option value="0" > Não </option>
                                                   <option value="1" > Sim </option>
                                               </select>
                                       </div>

                                        <div class="col-md-4">  
                                               <label> Perfil de acesso </label>
                                               <select class="form-control" name="perfil" style="width: 150px;">
                                                   <option value="2" > Vendedor </option>
                                                   <option value="1"  > Administrador </option>
                                               </select>
                                       </div>
                                        
                                    </div>
                                 
                                    <div class="form-group row"> 
                                               <div class="col-md-6 form-text">  
                                                    <label> Senha </label>
                                                    <input type="password" class="form-control" name="password"  placeholder="Digite sua senha aqui" >
                                                    <?= form_error('password', '<small class="form-text text-danger" >', '</small>') ; ?>
                                              </div>
                                        
                                               <div class="col-md-6 form-text">  
                                                    <label> Confirmar senha </label>
                                                    <input type="password" class="form-control" name="confirm_password"  placeholder="Confirme sua senha" >
                                                    <?= form_error('confirm_password', '<small class="form-text text-danger" >', '</small>') ; ?>
                                              </div>
                                        </div>
                                 
                                       <button type="submit" class="btn btn-primary btn-sm"> Salvar </button>
                               </form>
                         
                     </div>
                 </div>

     </div>
     <!-- /.container-fluid -->

 </div>
 <!-- End of Main Content -->

           