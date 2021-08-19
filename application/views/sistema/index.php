

<?php $this->load->view('layout/sidebar'); ?>        

 <!-- Main Content -->
 <div id="content">

   <?php $this->load->view('layout/navbar') ?> 

     <!-- Begin Page Content -->
     <div class="container-fluid">

             <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="<?= base_url('home'); ?>"> Home </a></li>
                      <li class="breadcrumb-item active" aria-current="page"> <?= $titulo ?> </li>
                  </ol>
            </nav>

              <?php if($message = $this->session->flashdata('sucesso')): ?>
                             <div class="row">
                                 <div class="col-md-12">
                                         <div class="alert alert-success alert-dismissible fade show" role="alert">
                                             <strong>  <i class="far fa-check-square"></i> &nbsp; <?= $message; ?> </strong>
                                                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                   <span aria-hidden="true">&times;</span>
                                                 </button>
                                       </div>
                                 </div>  
                             </div>
             <?php endif; ?>

             <?php if($message = $this->session->flashdata('error')): ?>
             <div class="row">
                 <div class="col-md-12">
                         <div class="alert alert-danger alert-dismissible fade show" role="alert">
                             <strong>  <i class="fas fa-exclamation-triangle"></i> &nbsp; <?= $message; ?> </strong>
                                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                   <span aria-hidden="true">&times;</span>
                                 </button>
                       </div>
                 </div>  
             </div>

             <?php endif; ?>
         
         <!-- DataTales Example -->
                 <div class="card shadow mb-5">
                     <div class="card-header py-3">
                         <a title="Voltar" href="<?= base_url('home'); ?>" class="btn btn-success btn-sm float-right">  <i class="fas fa-arrow-left"></i> &nbsp; Voltar </a>
                     </div>
                     <div class="card-body">
                         <form method="POST" name="form_edit" class="user">
                                   <div class="form-group row mb-3">

                                        <div class="col-md-3 form-text">  
                                            <label> Razão social </label>
                                            <input type="text" class="form-control form-control-user " name="sistema_razao_social" placeholder="Digite ssua razão social aqui..." value="<?= $sistema->sistema_razao_social ?> ">
                                            <?= form_error('sistema_razao_social', '<small class="form-text text-danger" >', '</small>') ; ?>
                                        </div>

                                        <div class="col-md-3 form-text">  
                                            <label> Nome Fantasia </label>
                                            <input type="text" class="form-control form-control-user " name="sistema_nome_fantasia"  placeholder="Digite seu nome fantasia aqui..." value="<?= $sistema->sistema_nome_fantasia ?> ">
                                            <?= form_error('sistema_nome_fantasia', '<small class="form-text text-danger" >', '</small>') ; ?>
                                        </div>

                                        <div class="col-md-3 form-text">
                                            <label> CNPJ </label>
                                            <input type="text" class="form-control form-control-user cnpj" name="sistema_cnpj"  placeholder="Digite seu CNPJ aqui..." value="<?= $sistema->sistema_cnpj ?> ">
                                            <?= form_error('sistema_cnpj', '<small class="form-text text-danger" >', '</small>') ; ?>
                                        </div>

                                        <div class="col-md-3 form-text">
                                            <label> IE </label>
                                            <input type="text" class="form-control form-control-user " name="sistema_ie"  placeholder="Digite sua IE aqui..." value="<?= $sistema->sistema_ie ?> ">
                                            <?= form_error('sistema_ie', '<small class="form-text text-danger" >', '</small>') ; ?>
                                        </div>

                                        <div class="col-md-3 form-text">
                                            <label> Telefone fixo </label>
                                            <input type="text" class="form-control form-control-user phone_with_ddd" name="sistema_telefone_fixo"  placeholder="Digite seu telefone fixo aqui..." value="<?= $sistema->sistema_telefone_fixo ?> ">
                                            <?= form_error('sistema_telefone_fixo', '<small class="form-text text-danger" >', '</small>') ; ?>
                                        </div>

                                        <div class="col-md-3 form-text">
                                            <label> Telefone móvel </label>
                                            <input type="text" class="form-control form-control-user sp_celphones" name="sistema_telefone_movel"  placeholder="Digite seu telefone fixo aqui..." value="<?= $sistema->sistema_telefone_movel ?> ">
                                            <?= form_error('sistema_telefone_movel', '<small class="form-text text-danger" >', '</small>') ; ?>
                                        </div>

                                        <div class="col-md-3 form-text">
                                            <label> E-mail </label>
                                            <input type="text" class="form-control form-control-user " name="sistema_email"  placeholder="Digite seu email aqui..." value="<?= $sistema->sistema_email ?> ">
                                            <?= form_error('sistema_email', '<small class="form-text text-danger" >', '</small>') ; ?>
                                        </div>

                                        <div class="col-md-3 form-text">
                                            <label> Site </label>
                                            <input type="text" class="form-control form-control-user " name="sistema_site_url"  placeholder="Digite seu site aqui..." value="<?= $sistema->sistema_site_url ?> ">
                                            <?= form_error('sistema_site_url', '<small class="form-text text-danger" >', '</small>') ; ?>
                                        </div>

                                       <div class="col-md-3 form-text">
                                            <label> Endereço </label>
                                            <input type="text" class="form-control form-control-user " name="sistema_endereco"  placeholder="Digite seu endereço aqui..." value="<?= $sistema->sistema_endereco ?> ">
                                            <?= form_error('sistema_endereco', '<small class="form-text text-danger" >', '</small>') ; ?>
                                        </div>
                                       
                                        <div class="col-md-3 form-text">
                                            <label> CEP </label>
                                            <input type="text" class="form-control form-control-user cep" name="sistema_cep"  placeholder="Digite seu CEP aqui..." value="<?= $sistema->sistema_cep ?> ">
                                            <?= form_error('sistema_cep', '<small class="form-text text-danger" >', '</small>') ; ?>
                                        </div>

                                        <div class="col-md-3 form-text">  
                                            <label> Número </label>
                                            <input type="text" class="form-control form-control-user " name="sistema_numero"  placeholder="Digite seu número aqui..." value="<?= $sistema->sistema_numero ?> ">
                                            <?= form_error('sistema_numero', '<small class="form-text text-danger" >', '</small>') ; ?>
                                        </div>
                                        
                                        <div class="col-md-3 form-text">  
                                            <label> Cidade </label>
                                            <input type="text" class="form-control form-control-user " name="sistema_cidade"  placeholder="Digite sua cidade aqui..." value="<?= $sistema->sistema_cidade ?> ">
                                            <?= form_error('sistema_cidade', '<small class="form-text text-danger" >', '</small>') ; ?>
                                        </div>
                                        
                                        <div class="col-md-3 form-text">  
                                            <label> UF </label>
                                            <input type="text" class="form-control form-control-user uf" name="sistema_estado"  placeholder="Digite seu estado aqui..." value="<?= $sistema->sistema_estado ?> ">
                                            <?= form_error('sistema_estado', '<small class="form-text text-danger" >', '</small>') ; ?>
                                        </div>
                                        
                                    </div>
                             
                             
                                   <div class="form-group row mb-3">
                                        <div class="col-md-12 form-text">  
                                            <label> Texto na ordem de serviço </label>
                                            <textarea class="form-control form-control-user " name="sistema_txt_ordem_servico"  placeholder="Digite seu texto da OS aqui..." > <?= $sistema->sistema_txt_ordem_servico ?>  </textarea>
                                            <?= form_error('sistema_txt_ordem_servico', '<small class="form-text text-danger" >', '</small>') ; ?>
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

           