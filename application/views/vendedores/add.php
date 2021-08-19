


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
                         <form method="POST" name="form_add" class="user">
                             
                                <fieldset class="mt-1 border p-1" >
                                    <legend> <i class="fas fa-user-tie"></i>  Dados pessoais  </legend>
                                            <div class="form-group row">

                                               <div class="col-md-3 form-text mb-1">  
                                                   <label> Matrícula </label>
                                                   <input type="text" class="form-control form-control-user" name="vendedor_matricula" placeholder="Matícula aqui..." value="<?= $vendedor_matricula ?>" readonly>
                                               </div>
                                                
                                                 <div class="col-md-3 form-text mb-1">  
                                                   <label> Nome </label>
                                                   <input type="text" class="form-control form-control-user" name="vendedor_nome_completo" placeholder="Nome aqui..." value="<?= set_value('vendedor_nome_completo')  ?>" autofocus>
                                                   <?= form_error('vendedor_nome_completo', '<small class="form-text text-danger" >', '</small>')  ?>
                                               </div>
                                                
                                                <div class="col-md-3 form-text mb-1">  
                                                   <label> Data de cadastro </label>
                                                   <input type="text" class="form-control form-control-user" name="vendedor_data_cadastro"  placeholder="Data de cadastro aqui..." value="<?= date('d/m/Y') ?>" readonly>
                                                   <?= form_error('vendedor_data_cadastro', '<small class="form-text text-danger" >', '</small>') ; ?>
                                               </div>
                                                
                                                 <div class="col-md-3 form-text mb-1"> 
                                                     <label> E-mail </label>
                                                     <input type="email" class="form-control form-control-user" name="vendedor_email"  placeholder="E-mail aqui..." value="<?= set_value('vendedor_email') ?>">
                                                     <?= form_error('vendedor_email', '<small class="form-text text-danger" >', '</small>') ; ?>
                                                 </div>

                                                 <div class="col-md-3 form-text mb-1">
                                                        <label> CPF </label>
                                                        <input type="text" class="form-control form-control-user cpf" name="vendedor_cpf"  placeholder="CPF aqui..." value="<?= set_value('vendedor_cpf') ?>">
                                                        <?= form_error('vendedor_cpf', '<small class="form-text text-danger" >', '</small>') ; ?>
                                                 </div>               
                                                     
                                                 <div class="col-md-3 form-text mb-1">
                                                        <label> RG </label>
                                                        <input type="text" class="form-control form-control-user cpf" name="vendedor_rg"  placeholder="RG aqui..." value="<?= set_value('vendedor_rg') ?>">
                                                        <?= form_error('vendedor_rg', '<small class="form-text text-danger" >', '</small>') ; ?>
                                                 </div>
                                                     
                                                <div class="col-md-3 form-text mb-1">
                                                      <label> Telefone </label>
                                                      <input type="text" class="form-control form-control-user sp_celphones" name="vendedor_telefone"  placeholder="Telefone aqui..." value="<?= set_value('vendedor_telefone') ?>">
                                                      <?= form_error('vendedor_telefone', '<small class="form-text text-danger" >', '</small>'); ?>
                                                </div>

                                               <div class="col-md-3 form-text mb-1">
                                                     <label> Celular </label>
                                                     <input type="text" class="form-control form-control-user sp_celphones" name="vendedor_celular"  placeholder="Celular aqui..." value="<?= set_value('vendedor_celular') ?>">
                                                     <?= form_error('vendedor_celular', '<small class="form-text text-danger" >', '</small>') ?>
                                               </div>

                                                <div class="col-md-3 form-text">
                                                       <label> Ativo </label>
                                                       <select class="custom-select" name="vendedor_ativo">
                                                                 <option value="1"> Sim </option> 
                                                               <option value="0"> Não </option>
                                                       </select>
                                                </div>

                                            </div>
                                </fieldset>

                                <fieldset class="mt-2 border p-1">
                                    <legend> <i class="fas fa-map-marker-alt"></i> Endereço </legend>
                                    
                                       <div class="form-group row">
                                            <div class="col-md-3 form-text mb-1">
                                                   <label> CEP </label>
                                                   <input id="cep" type="text" class="form-control form-control-user cep" name="vendedor_cep"  placeholder="CEP aqui..." >
                                                   <?= form_error('vendedor_cep', '<small class="form-text text-danger" >', '</small>') ?>
                                             </div>
                                           
                                            <div class="col-md-3 form-text mb-1">
                                                   <label> Endereço </label>
                                                   <input type="text" id="endereco" class="form-control form-control-user" name="vendedor_endereco"  placeholder="Endereço aqui..." value="<?= set_value('vendedor_endereco') ?>">
                                                   <?= form_error('vendedor_endereco', '<small class="form-text text-danger" >', '</small>') ?>
                                             </div>

                                             <div class="col-md-3 form-text mb-1">
                                                   <label> Número </label>
                                                   <input type="text" id="numero" class="form-control form-control-user" name="vendedor_numero_endereco"  placeholder="Número aqui..." value="<?= set_value('vendedor_numero_endereco') ?>">
                                                   <?= form_error('vendedor_numero_endereco', '<small class="form-text text-danger" >', '</small>') ?>
                                             </div>

                                             <div class="col-md-3 form-text mb-1">
                                                   <label> Bairro </label>
                                                   <input type="text" id="bairro" class="form-control form-control-user" name="vendedor_bairro"  placeholder="Bairro aqui..." value="<?= set_value('vendedor_bairro') ?>">
                                                   <?= form_error('vendedor_bairro', '<small class="form-text text-danger" >', '</small>')  ?>
                                             </div>

                                             <div class="col-md-3 form-text mb-1">
                                                   <label> Complemento </label>
                                                   <input id="complemento" type="text" class="form-control form-control-user" name="vendedor_complemento"  placeholder="Complemento aqui..." value="<?= set_value('vendedor_complemento') ?>">
                                                   <?= form_error('vendedor_complemento', '<small class="form-text text-danger" >', '</small>')  ?>
                                             </div>

                                             <div class="col-md-3 form-text mb-1">
                                                   <label> Cidade </label>
                                                   <input type="text" id="cidade" class="form-control form-control-user" name="vendedor_cidade"  placeholder="Cidade aqui..." value="<?= set_value('vendedor_cidade') ?>">
                                                   <?= form_error('vendedor_cidade', '<small class="form-text text-danger" >', '</small>')  ?>
                                             </div>

                                             <div class="col-md-3 form-text mb-1">
                                                   <label> UF </label>
                                                   <select class="custom-select" name="vendedor_estado">
                                                          <option value="AC">Acre</option>
                                                            <option value="AL">Alagoas</option>
                                                            <option value="AP">Amapá</option>
                                                            <option value="AM">Amazonas</option>
                                                            <option value="BA">Bahia</option>
                                                            <option value="CE">Ceará</option>
                                                            <option value="DF">Distrito Federal</option>
                                                            <option value="ES">Espírito Santo</option>
                                                            <option value="GO">Goiás</option>
                                                            <option value="MA">Maranhão</option>
                                                            <option value="MT">Mato Grosso</option>
                                                            <option value="MS">Mato Grosso do Sul</option>
                                                            <option value="MG">Minas Gerais</option>
                                                            <option value="PA">Pará</option>
                                                            <option value="PB">Paraíba</option>
                                                            <option value="PR">Paraná</option>
                                                            <option value="PE">Pernambuco</option>
                                                            <option value="PI">Piauí</option>
                                                            <option value="RJ">Rio de Janeiro</option>
                                                            <option value="RN">Rio Grande do Norte</option>
                                                            <option value="RS">Rio Grande do Sul</option>
                                                            <option value="RO">Rondônia</option>
                                                            <option value="RR">Roraima</option>
                                                            <option value="SC">Santa Catarina</option>
                                                            <option value="SP">São Paulo</option>
                                                            <option value="SE">Sergipe</option>
                                                            <option value="TO">Tocantins</option>
                                                   </select>

                                             </div>

                                             <div class="col-md-3 form-text mb-1">
                                                  <label> Observações </label>
                                                  <textarea class="form-control form-control-user" name="vendedor_obs"  placeholder="Digite sua observação aqui...">    </textarea>
                                                  <?= form_error('vendedor_obs', '<small class="form-text text-danger" >', '</small>')  ?>
                                             </div> 
                                       </div>
                                </fieldset>
                             
                                <button type="submit" class="btn btn-primary btn-sm mt-2"> Salvar </button>
                                <a title="Voltar" href="<?= base_url($this->router->fetch_class()) ?>" class="btn btn-success btn-sm ml-2 mt-2">  Voltar </a>
                        </form>
                     </div>
                 </div>

     </div>
     <!-- /.container-fluid -->

 </div>
 <!-- End of Main Content -->

           