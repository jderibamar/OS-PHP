
<?php $this->load->view('layout/sidebar'); ?>        

 <!-- Main Content -->
 <div id="content">

   <?php $this->load->view('layout/navbar') ?> 

     <!-- Begin Page Content -->
     <div class="container-fluid">

             <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="<?= base_url('vendedores'); ?>"> Vendedores </a></li>
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
                                    <legend> <i class="fas fa-user-tie"></i>  Dados pessoais  </legend>
                                            <div class="form-group row">

                                               <div class="col-md-3 form-text mb-1">  
                                                   <label> Matricula </label>
                                                   <input type="text" class="form-control form-control-user" name="vendedor_matricula" placeholder="Matrícula do vendedor aqui..." value="<?= $vendedor->vendedor_matricula ?>" readonly>
                                                   <?= form_error('vendedor_matricula', '<small class="form-text text-danger" >', '</small>')  ?>
                                               </div>

                                               <div class="col-md-3 form-text mb-1">  
                                                   <label> Nome Completo </label>
                                                   <input type="text" class="form-control form-control-user" name="vendedor_nome_completo"  placeholder="Digite seu sobrenome aqui..." value="<?= $vendedor->vendedor_nome_completo ?>">
                                                   <?= form_error('vendedor_nome_completo', '<small class="form-text text-danger" >', '</small>') ; ?>
                                               </div>

                                                 <div class="col-md-3 form-text mb-1"> 
                                                     <label> E-mail </label>
                                                     <input type="email" class="form-control form-control-user" name="vendedor_email"  placeholder="Digite seu e-mail aqui..." value="<?= $vendedor->vendedor_email ?>">
                                                     <?= form_error('vendedor_email', '<small class="form-text text-danger" >', '</small>') ; ?>
                                                 </div>

                                                 <div class="col-md-3 form-text mb-1">
                                                        <label> CPF </label>
                                                        <input type="text" class="form-control form-control-user cpf" name="vendedor_cpf"  placeholder="CPF do vendedor..." value="<?= $vendedor->vendedor_cpf ?>">
                                                        <?= form_error('vendedor_cpf', '<small class="form-text text-danger" >', '</small>') ; ?>  
                                               </div>

                                                 <div class="col-md-3 form-text mb-1">
                                                        <label> RG </label>
                                                        <input type="text" class="form-control form-control-user rg" name="vendedor_rg"  placeholder="RG do vendedor..." value="<?= $vendedor->vendedor_rg ?>">
                                                        <?= form_error('vendedor_rg', '<small class="form-text text-danger" >', '</small>') ; ?>  
                                               </div>

                                                 <div class="col-md-3 form-text mb-1">  
                                                     <label> Data de cadastro </label>
                                                     <input type="text" class="form-control form-control-user" name="vendedor_data_cadastro"  value="<?= $vendedor->vendedor_data_cadastro ?>">
                                                     <?= form_error('vendedor_data_cadastro', '<small class="form-text text-danger" >', '</small>') ; ?>
                                               </div>

                                               <div class="col-md-3 form-text mb-1">
                                                     <label> Telefone </label>
                                                     <input type="text" class="form-control form-control-user sp_celphones" name="vendedor_telefone"  placeholder="Digite o telefone aqui..." value="<?= $vendedor->vendedor_telefone ?>">
                                                     <?= form_error('vendedor_telefone', '<small class="form-text text-danger" >', '</small>'); ?>
                                               </div>

                                               <div class="col-md-3 form-text mb-1">
                                                     <label> Celular </label>
                                                     <input type="text" class="form-control form-control-user" name="vendedor_celular"  placeholder="Digite o celular aqui..." value="<?= $vendedor->vendedor_celular ?>">
                                                     <?= form_error('vendedor_celular', '<small class="form-text text-danger" >', '</small>') ?>
                                               </div>

                                                <div class="col-md-3 form-text">
                                                       <label> Ativo </label>
                                                       <select class="custom-select" name="vendedor_ativo">
                                                           <option value="1" <?= ($vendedor->vendedor_ativo == 1 ? 'selected' : '') ?> > Sim </option>
                                                           <option value="0" <?= ($vendedor->vendedor_ativo == 0 ? 'selected' : '') ?> > Não </option>
                                                       </select>
                                                </div>

                                      </div>
                                </fieldset>

                                <fieldset class="mt-2 border p-1">
                                    <legend> <i class="fas fa-map-marker-alt"></i> Endereço </legend>
                                       <div class="form-group row">
                                         <div class="col-md-3 form-text mb-1">
                                                <label> Endereço </label>
                                                <input type="text" class="form-control form-control-user" name="vendedor_endereco"  placeholder="Digite seu endereço aqui..." value="<?= $vendedor->vendedor_endereco ?>">
                                                <?= form_error('vendedor_endereco', '<small class="form-text text-danger" >', '</small>') ?>
                                          </div>

                                          <div class="col-md-3 form-text mb-1">
                                                <label> CEP </label>
                                                <input type="text" class="form-control form-control-user cep" name="vendedor_cep"  placeholder="Digite seu CEP aqui..." value="<?= $vendedor->vendedor_cep ?>">
                                                <?= form_error('vendedor_cep', '<small class="form-text text-danger" >', '</small>') ?>
                                          </div>

                                          <div class="col-md-3 form-text mb-1">
                                                <label> Número </label>
                                                <input type="text" class="form-control form-control-user" name="vendedor_numero_endereco"  placeholder="Digite seu número aqui..." value="<?= $vendedor->vendedor_numero_endereco ?>">
                                                <?= form_error('vendedor_numero_endereco', '<small class="form-text text-danger" >', '</small>') ?>
                                          </div>

                                          <div class="col-md-3 form-text mb-1">
                                                <label> Bairro </label>
                                                <input type="text" class="form-control " name="vendedor_bairro"  placeholder="Digite seu bairro aqui..." value="<?= $vendedor->vendedor_bairro ?>">
                                                <?= form_error('vendedor_bairro', '<small class="form-text text-danger" >', '</small>')  ?>
                                          </div>

                                          <div class="col-md-3 form-text mb-1">
                                                <label> Complemento </label>
                                                <input type="text" class="form-control form-control-user" name="vendedor_complemento"  placeholder="Digite seu bairro aqui..." value="<?= $vendedor->vendedor_complemento ?>">
                                                <?= form_error('vendedor_complemento', '<small class="form-text text-danger" >', '</small>')  ?>
                                          </div>

                                          <div class="col-md-3 form-text mb-1">
                                                <label> Cidade </label>
                                                <input type="text" class="form-control form-control-user" name="vendedor_cidade"  placeholder="Digite sua cidade aqui..." value="<?= $vendedor->vendedor_cidade ?>">
                                                <?= form_error('vendedor_cidade', '<small class="form-text text-danger" >', '</small>')  ?>
                                          </div>

                                          <div class="col-md-3 form-text mb-1">
                                                <label> UF </label>
                                                <input type="text" class="form-control form-control-user uf" name="vendedor_estado"  placeholder="Digite seu estado aqui..." value="<?= $vendedor->vendedor_estado ?>">
                                                <?= form_error('vendedor_estado', '<small class="form-text text-danger" >', '</small>')  ?>
                                          </div>

                                             <div class="col-md-3 form-text mb-1">
                                                <label> Observações </label>
                                                <textarea class="form-control form-control-user" name="vendedor_obs"  placeholder="Digite sua observação aqui..." >  <?= $vendedor->vendedor_obs ?>  </textarea>
                                                <?= form_error('vendedor_obs', '<small class="form-text text-danger" >', '</small>')  ?>
                                     </div> 

                                       </div>
                                </fieldset>
                             
                                <input  type="hidden" name="vendedor_id" value="<?= $vendedor->vendedor_id ?>">
                                <button type="submit" class="btn btn-primary btn-sm mt-2"> Salvar </button>
                                <a title="Voltar" href="<?= base_url('vendedores'); ?>" class="btn btn-success btn-sm ml-2 mt-2">  Voltar </a>
                                <p class="float-right mt-2"> <strong>  <i class="fas fa-clock">  </i> &nbsp;Última alteração: </strong>  <?= formata_data_banco_com_hora($vendedor->vendedor_data_alteracao)  ?>  </p>
                        </form>
                     </div>
                 </div>

     </div>
     <!-- /.container-fluid -->

 </div>
 <!-- End of Main Content -->

           