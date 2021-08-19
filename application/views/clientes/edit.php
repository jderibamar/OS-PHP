
<?php $this->load->view('layout/sidebar'); ?>        

 <!-- Main Content -->
 <div id="content">

   <?php $this->load->view('layout/navbar') ?> 

     <!-- Begin Page Content -->
     <div class="container-fluid">

             <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="<?= base_url('clientes'); ?>"> Clientes </a></li>
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
                                                   <label> Nome </label>
                                                   <input type="text" class="form-control form-control-user" name="cliente_nome" placeholder="Digite seu nome aqui..." value="<?= $cliente->cliente_nome ?>">
                                                   <?= form_error('cliente_nome', '<small class="form-text text-danger" >', '</small>')  ?>
                                               </div>

                                               <div class="col-md-3 form-text mb-1">  
                                                   <label> Sobrenome </label>
                                                   <input type="text" class="form-control form-control-user" name="cliente_sobrenome"  placeholder="Digite seu sobrenome aqui..." value="<?= $cliente->cliente_sobrenome ?>">
                                                   <?= form_error('cliente_sobrenome', '<small class="form-text text-danger" >', '</small>') ; ?>
                                               </div>

                                                 <div class="col-md-3 form-text mb-1"> 
                                                     <label> E-mail </label>
                                                     <input type="email" class="form-control form-control-user" name="cliente_email"  placeholder="Digite seu e-mail aqui..." value="<?= $cliente->cliente_email ?>">
                                                     <?= form_error('cliente_email', '<small class="form-text text-danger" >', '</small>') ; ?>
                                                 </div>

                                                 <div class="col-md-3 form-text mb-1">
                                                     <?php if($cliente->cliente_tipo ==1 ): ?>
                                                               <label> CPF </label>
                                                               <input type="text" class="form-control form-control-user cpf" name="cliente_cpf"  placeholder="<?= ($cliente->cliente_tipo == 1 ? 'CNPJ do cliente...' : 'CPF do cliente...')?>" value="<?= $cliente->cliente_cpf_cnpj ?>">
                                                                <?= form_error('cliente_cpf', '<small class="form-text text-danger" >', '</small>') ; ?>
                                                     <?php else: ?>
                                                                <label> CNPJ </label>
                                                                <input type="text" class="form-control cnpj form-control-user cnpj" name="cliente_cnpj"  placeholder="<?= ($cliente->cliente_tipo == 1 ? 'CNPJ do cliente...' : 'CPF do cliente...')?>" value="<?= $cliente->cliente_cpf_cnpj ?>">
                                                                <?= form_error('cliente_cnpj', '<small class="form-text text-danger" >', '</small>') ; ?>
                                                     <?php endif; ?>
                                               </div>

                                                 <div class="col-md-3 form-text mb-1">
                                                     <?php if($cliente->cliente_tipo == 1 ): ?>
                                                               <label> RG </label>
                                                               <input type="text" class="form-control form-control-user" name="cliente_rg_ie"  placeholder="RG do cliente..." value="<?= $cliente->cliente_rg_ie ?>">
                                                     <?= form_error('cliente_rg_ie', '<small class="form-text text-danger" >', '</small>') ; ?>
                                                     <?php else: ?>
                                                                <label> Inscrição Estadual </label>
                                                                <input type="text" class="form-control form-control-user" name="cliente_rg_ie"  placeholder="I.E do cliente..." value="<?= $cliente->cliente_rg_ie ?>">
                                                                <?= form_error('cliente_rg_ie', '<small class="form-text text-danger" >', '</small>') ; ?>
                                                     <?php endif; ?>
                                                     
                                               </div>

                                                 <div class="col-md-3 form-text mb-1">  
                                                     <label> Data de nascimento </label>
                                                     <input type="text" class="form-control form-control-user" name="cliente_data_nascimento"  value="<?= formata_data_banco_sem_hora($cliente->cliente_data_nascimento) ?>">
                                                     <?= form_error('cliente_data_nascimento', '<small class="form-text text-danger" >', '</small>') ; ?>
                                               </div>

                                               <div class="col-md-3 form-text mb-1">
                                                     <label> Telefone </label>
                                                     <input type="text" class="form-control form-control-user sp_celphones" name="cliente_telefone"  placeholder="Digite seu telefone aqui..." value="<?= $cliente->cliente_telefone ?>">
                                                     <?= form_error('cliente_telefone', '<small class="form-text text-danger" >', '</small>'); ?>
                                               </div>

                                               <div class="col-md-3 form-text mb-1">
                                                     <label> Celular </label>
                                                     <input type="text" class="form-control form-control-user" name="cliente_celular"  placeholder="Digite seu celular aqui..." value="<?= $cliente->cliente_celular ?>">
                                                     <?= form_error('cliente_celular', '<small class="form-text text-danger" >', '</small>') ?>
                                               </div>

                                                <div class="col-md-3 form-text">
                                                       <label> Ativo </label>
                                                       <select class="custom-select" name="cliente_ativo" style="width: 76px;">
                                                           <option value="0" <?= ($cliente->cliente_ativo == 0 ? 'selected' : '') ?> > Não </option>
                                                           <option value="1" <?= ($cliente->cliente_ativo == 1 ? 'selected' : '') ?> > Sim </option>
                                                       </select>
                                                </div>

                                      </div>
                                </fieldset>

                                <fieldset class="mt-2 border p-1">
                                    <legend> <i class="fas fa-map-marker-alt"></i> Endereço </legend>
                                       <div class="form-group row">
                                         <div class="col-md-3 form-text mb-1">
                                                <label> Endereço </label>
                                                <input type="text" class="form-control form-control-user" name="cliente_endereco"  placeholder="Digite seu endereço aqui..." value="<?= $cliente->cliente_endereco ?>">
                                                <?= form_error('cliente_endereco', '<small class="form-text text-danger" >', '</small>') ?>
                                          </div>

                                          <div class="col-md-3 form-text mb-1">
                                                <label> CEP </label>
                                                <input type="text" class="form-control form-control-user cep" name="cliente_cep"  placeholder="Digite seu CEP aqui..." value="<?= $cliente->cliente_cep ?>">
                                                <?= form_error('cliente_cep', '<small class="form-text text-danger" >', '</small>') ?>
                                          </div>

                                          <div class="col-md-3 form-text mb-1">
                                                <label> Número </label>
                                                <input type="text" class="form-control form-control-user" name="cliente_numero_endereco"  placeholder="Digite seu número aqui..." value="<?= $cliente->cliente_numero_endereco ?>">
                                                <?= form_error('cliente_numero_endereco', '<small class="form-text text-danger" >', '</small>') ?>
                                          </div>

                                          <div class="col-md-3 form-text mb-1">
                                                <label> Bairro </label>
                                                <input type="text" class="form-control " name="cliente_bairro"  placeholder="Digite seu bairro aqui..." value="<?= $cliente->cliente_bairro ?>">
                                                <?= form_error('cliente_bairro', '<small class="form-text text-danger" >', '</small>')  ?>
                                          </div>

                                          <div class="col-md-3 form-text mb-1">
                                                <label> Complemento </label>
                                                <input type="text" class="form-control form-control-user" name="cliente_complemento"  placeholder="Digite seu bairro aqui..." value="<?= $cliente->cliente_complemento ?>">
                                                <?= form_error('cliente_complemento', '<small class="form-text text-danger" >', '</small>')  ?>
                                          </div>

                                          <div class="col-md-3 form-text mb-1">
                                                <label> Cidade </label>
                                                <input type="text" class="form-control form-control-user" name="cliente_cidade"  placeholder="Digite sua cidade aqui..." value="<?= $cliente->cliente_cidade ?>">
                                                <?= form_error('cliente_cidade', '<small class="form-text text-danger" >', '</small>')  ?>
                                          </div>

                                          <div class="col-md-3 form-text mb-1">
                                                <label> UF </label>
                                                <input type="text" class="form-control form-control-user uf" name="cliente_estado"  placeholder="Digite seu estado aqui..." value="<?= $cliente->cliente_estado ?>">
                                                <?= form_error('cliente_estado', '<small class="form-text text-danger" >', '</small>')  ?>
                                          </div>

                                             <div class="col-md-3 form-text mb-1">
                                                <label> Observações </label>
                                                <textarea class="form-control form-control-user" name="cliente_obs"  placeholder="Digite sua observação aqui..." >  <?= $cliente->cliente_obs ?>  </textarea>
                                                <?= form_error('cliente_obs', '<small class="form-text text-danger" >', '</small>')  ?>
                                     </div> 

                                       </div>
                                </fieldset>
                             
                                <input  type="hidden" name="cliente_tipo" value="<?= $cliente->cliente_tipo ?>">
                                <input  type="hidden" name="cliente_id" value="<?= $cliente->cliente_id ?>">
                                <button type="submit" class="btn btn-primary btn-sm mt-2"> Salvar </button>
                                <a title="Voltar" href="<?= base_url('clientes'); ?>" class="btn btn-success btn-sm ml-2 mt-2">  Voltar </a>
                                <p class="float-right mt-2"> <strong>  <i class="fas fa-clock">  </i> &nbsp;Última alteração: </strong>  <?= formata_data_banco_com_hora($cliente->cliente_data_alteracao)  ?>  </p>
                        </form>
                     </div>
                 </div>

     </div>
     <!-- /.container-fluid -->

 </div>
 <!-- End of Main Content -->

           