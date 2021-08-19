

<?php $this->load->view('layout/sidebar'); ?>        

 <!-- Main Content -->
 <div id="content">

   <?php $this->load->view('layout/navbar') ?> 

     <!-- Begin Page Content -->
     <div class="container-fluid">

             <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="<?= base_url('fornecedores'); ?>"> Fornecedores </a></li>
                      <li class="breadcrumb-item active" aria-current="page"> <?= $titulo ?> </li>
                  </ol>
            </nav>

         <!-- DataTales Example -->
                 <div class="card shadow mb-4">
                     <div class="card-header py-3">
                         
                     </div>
                     <div class="card-body">
                         <form method="POST" name="form_edit" class="user">
                                <fieldset class="mt-1 border p-1" >
                                    <legend> <i class="fas fa-user-tag"></i>  Dados do fornecedor </legend>
                                              <div class="form-group row">
                                                        <div class="col-md-6 form-text mb-1">  
                                                            <label> Razão Social </label>
                                                            <input type="text" class="form-control form-control-user" name="fornecedor_razao" placeholder="Digite a razão social aqui..." value="<?= $fornecedor->fornecedor_razao ?>">
                                                            <?= form_error('fornecedor_razao', '<small class="form-text text-danger" >', '</small>')  ?>
                                                        </div>

                                                        <div class="col-md-6 form-text mb-1">  
                                                            <label> Nome Fantasia </label>
                                                            <input type="text" class="form-control form-control-user" name="fornecedor_nome_fantasia"  placeholder="Digite o nome fantasia aqui..." value="<?= $fornecedor->fornecedor_nome_fantasia ?>">
                                                            <?= form_error('fornecedor_nome_fantasia', '<small class="form-text text-danger" >', '</small>') ; ?>
                                                        </div>
                                                </div>
                                    
                                                <div class="form-group row">

                                                         <div class="col-md-3 form-text mb-1"> 
                                                             <label> CNPJ </label>
                                                             <input type="text" class="form-control form-control-user cnpj" name="fornecedor_cnpj"  placeholder="Digite o CNPJ aqui..." value="<?= $fornecedor->fornecedor_cnpj ?>">
                                                             <?= form_error('fornecedor_cnpj', '<small class="form-text text-danger" >', '</small>') ; ?>
                                                         </div>

                                                       <div class="col-md-3 form-text mb-1">
                                                             <label> Inscrição Estadual </label>
                                                             <input type="text" class="form-control form-control-user" name="fornecedor_ie"  placeholder="Digite a I.E aqui..." value="<?= $fornecedor->fornecedor_ie ?>">
                                                             <?= form_error('fornecedor_ie', '<small class="form-text text-danger" >', '</small>'); ?>
                                                       </div>

                                                       <div class="col-md-3 form-text mb-1">
                                                             <label> Telefone fixo </label>
                                                             <input type="text" class="form-control form-control-user phone_with_ddd" name="fornecedor_telefone"  placeholder="Digite o nome do contato aqui..." value="<?= $fornecedor->fornecedor_telefone ?>">
                                                             <?= form_error('fornecedor_telefone', '<small class="form-text text-danger" >', '</small>') ?>
                                                       </div>
                                                      
                                                    <div class="col-md-3 form-text mb-1">
                                                             <label> Celular </label>
                                                             <input type="text" class="form-control form-control-user sp_celphones" name="fornecedor_celular"  placeholder="Digite celular aqui..." value="<?= $fornecedor->fornecedor_celular ?>">
                                                             <?= form_error('fornecedor_celular', '<small class="form-text text-danger" >', '</small>') ?>
                                                       </div>
                                                      
                                                    <div class="col-md-3 form-text mb-1">
                                                             <label> E-mail </label>
                                                             <input type="text" class="form-control form-control-user" name="fornecedor_email"  placeholder="Digite celular aqui..." value="<?= $fornecedor->fornecedor_email ?>">
                                                             <?= form_error('fornecedor_email', '<small class="form-text text-danger" >', '</small>') ?>
                                                       </div>
                                                      
                                                    <div class="col-md-3 form-text mb-1">
                                                             <label> Contato </label>
                                                             <input type="text" class="form-control form-control-user" name="fornecedor_contato"  placeholder="Digite celular aqui..." value="<?= $fornecedor->fornecedor_contato ?>">
                                                             <?= form_error('fornecedor_contato', '<small class="form-text text-danger" >', '</small>') ?>
                                                       </div>

                                                        <div class="col-md-3 form-text">
                                                               <label> Ativo </label>
                                                               <select class="custom-select" name="fornecedor_ativo">
                                                                    <option value="1" <?= ($fornecedor->fornecedor_ativo == 1 ? 'selected' : '') ?> > Sim </option> 
                                                                    <option value="0" <?= ($fornecedor->fornecedor_ativo == 0 ? 'selected' : '') ?> > Não </option>
                                                               </select>
                                                        </div>

                                                </div>
                                </fieldset>

                                <fieldset class="mt-2 border p-1">
                                    <legend> <i class="fas fa-map-marker-alt"></i> Endereço </legend>
                                       <div class="form-group row">
                                         <div class="col-md-3 form-text mb-1">
                                                <label> Endereço </label>
                                                <input type="text" class="form-control form-control-user" name="fornecedor_endereco"  placeholder="Digite seu endereço aqui..." value="<?= $fornecedor->fornecedor_endereco ?> ">
                                                <?= form_error('fornecedor_endereco', '<small class="form-text text-danger" >', '</small>') ?>
                                          </div>

                                          <div class="col-md-3 form-text mb-1">
                                                <label> CEP </label>
                                                <input type="text" class="form-control form-control-user cep" name="fornecedor_cep"  placeholder="Digite seu CEP aqui..." value="<?= $fornecedor->fornecedor_cep ?> ">
                                                <?= form_error('fornecedor_cep', '<small class="form-text text-danger" >', '</small>') ?>
                                          </div>

                                          <div class="col-md-3 form-text mb-1">
                                                <label> Número </label>
                                                <input type="text" class="form-control form-control-user" name="fornecedor_numero_endereco"  placeholder="Digite seu número aqui..." value="<?= $fornecedor->fornecedor_numero_endereco ?> ">
                                                <?= form_error('fornecedor_numero_endereco', '<small class="form-text text-danger" >', '</small>') ?>
                                          </div>

                                          <div class="col-md-3 form-text mb-1">
                                                <label> Bairro </label>
                                                <input type="text" class="form-control form-control-user" name="fornecedor_bairro"  placeholder="Digite seu bairro aqui..." value="<?= $fornecedor->fornecedor_bairro ?> ">
                                                <?= form_error('fornecedor_bairro', '<small class="form-text text-danger" >', '</small>')  ?>
                                          </div>

                                          <div class="col-md-3 form-text mb-1">
                                                <label> Complemento </label>
                                                <input type="text" class="form-control form-control-user" name="fornecedor_complemento"  placeholder="Digite seu bairro aqui..." value="<?= $fornecedor->fornecedor_complemento ?> ">
                                                <?= form_error('fornecedor_complemento', '<small class="form-text text-danger" >', '</small>')  ?>
                                          </div>

                                          <div class="col-md-3 form-text mb-1">
                                                <label> Cidade </label>
                                                <input type="text" class="form-control form-control-user" name="fornecedor_cidade"  placeholder="Digite sua cidade aqui..." value="<?= $fornecedor->fornecedor_cidade ?> ">
                                                <?= form_error('fornecedor_cidade', '<small class="form-text text-danger" >', '</small>')  ?>
                                          </div>
                                           
                                          <div class="col-md-3 form-text mb-1">
                                                <label> UF </label>
                                                <input type="text" class="form-control form-control-user uf" name="fornecedor_estado"  placeholder="Digite seu estado aqui..." value="<?= $fornecedor->fornecedor_estado ?> ">
                                                <?= form_error('fornecedor_estado', '<small class="form-text text-danger" >', '</small>')  ?>
                                          </div>

                                             <div class="col-md-3 form-text mb-1">
                                                <label> Observações </label>
                                                <textarea class="form-control" name="fornecedor_obs"  placeholder="Digite sua observação aqui..." >  <?= $fornecedor->fornecedor_obs ?>  </textarea>
                                                <?= form_error('fornecedor_obs', '<small class="form-text text-danger" >', '</small>')  ?>
                                     </div> 

                                       </div>
                                </fieldset>
                             
                                <input  type="hidden" name="fornecedor_id" value="<?= $fornecedor->fornecedor_id ?>">
                                <button type="submit" class="btn btn-primary btn-sm mt-2"> Salvar </button>
                                
                                <!-- $this->router->fetch_class() esta instrução faz voltar para o index  equivale a: base_url('fornecedores') -->
                                <a title="Voltar" href="<?= base_url($this->router->fetch_class()); ?>" class="btn btn-success btn-sm ml-2 mt-2">  Voltar </a>
                                <p class="float-right mt-2"> <strong>  <i class="fas fa-clock">  </i> &nbsp;Última alteração: </strong>  <?= formata_data_banco_com_hora($fornecedor->fornecedor_data_alteracao)  ?>  </p>
                        </form>
                     </div>
                 </div>

     </div>
     <!-- /.container-fluid -->

 </div>
 <!-- End of Main Content -->

           