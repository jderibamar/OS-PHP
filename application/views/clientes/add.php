<?php 
          function obter_endereco($cep) 
        {
                $cep = filter_input(INPUT_GET, "cep");

                if($cep)
                {
                    $cep = str_replace("-", "", $cep);
                    $json = file_get_contents('https://viacep.com.br/ws/'. $cep . '/json/');
                    $jsonToArray = json_decode($json);

                    return $jsonToArray;
                }
        }
        
        $endereco = obter_endereco($this->input->post('cliente_cep'))
?>


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
                         <form method="POST" name="form_add" class="user">
                             
                                <div class="custom-control custom-radio custom-control-inline mt-1">
                                       <input type="radio" id="pessoa_fisica" name="cliente_tipo" class="custom-control-input" value="1" <?php echo set_checkbox('cliente_tipo', '1') ?> checked="">
                                       <label class="custom-control-label pt-1" for="pessoa_fisica">Pessoa física</label>
                               </div>
                             
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="pessoa_juridica" name="cliente_tipo" class="custom-control-input" value="2" <?php echo set_checkbox('cliente_tipo', '2') ?> >
                                    <label class="custom-control-label pt-1" for="pessoa_juridica">Pessoa jurídica</label>
                                </div>
                             
                                <fieldset class="mt-1 border p-1" >
                                    <legend> <i class="fas fa-user-tie"></i>  Dados pessoais  </legend>
                                            <div class="form-group row">

                                               <div class="col-md-3 form-text mb-1">  
                                                   <label> Nome </label>
                                                   <input type="text" class="form-control form-control-user" name="cliente_nome" placeholder="Nome aqui..." value="<?= set_value('cliente_nome')  ?>" autofocus>
                                                   <?= form_error('cliente_nome', '<small class="form-text text-danger" >', '</small>')  ?>
                                               </div>

                                               <div class="col-md-3 form-text mb-1">  
                                                   <label> Sobrenome </label>
                                                   <input type="text" class="form-control form-control-user" name="cliente_sobrenome"  placeholder="Sobrenome aqui..." value="<?= set_value('cliente_sobrenome') ?>">
                                                   <?= form_error('cliente_sobrenome', '<small class="form-text text-danger" >', '</small>') ; ?>
                                               </div>

                                                 <div class="col-md-3 form-text mb-1"> 
                                                     <label> E-mail </label>
                                                     <input type="email" class="form-control form-control-user" name="cliente_email"  placeholder="E-mail aqui..." value="<?= set_value('cliente_email') ?>">
                                                     <?= form_error('cliente_email', '<small class="form-text text-danger" >', '</small>') ; ?>
                                                 </div>

                                                 <div class="col-md-3 form-text mb-1">
                                                     
                                                        <div class="pessoa_fisica">
                                                                <label> CPF </label>
                                                                <input type="text" class="form-control form-control-user cpf" name="cliente_cpf"  placeholder="CPF do cliente..." value="<?= set_value('cliente_cpf') ?>">
                                                                <?= form_error('cliente_cpf', '<small class="form-text text-danger" >', '</small>') ; ?>
                                                        </div>
                                                     
                                                     <div class="pessoa_juridica">
                                                            <label> CNPJ </label>
                                                            <input type="text" class="form-control cnpj form-control-user cnpj" name="cliente_cnpj"  placeholder="CNPJ do cliente..." value="<?= set_value('cliente_cnpj') ?>">
                                                            <?= form_error('cliente_cnpj', '<small class="form-text text-danger" >', '</small>') ; ?>
                                                     </div>
                                               </div>

                                                 <div class="col-md-3 form-text mb-1">
                                                     <label class="pessoa_fisica"> RG </label>
                                                     <label class="pessoa_juridica"> Inscrição Estadual </label>
                                                        <input type="text" class="form-control form-control-user" name="cliente_rg_ie"  value="<?= set_value('cliente_rg_ie') ?>">
                                                       <?= form_error('cliente_rg_ie', '<small class="form-text text-danger" >', '</small>') ; ?>
                                               </div>

                                               <div class="col-md-3 form-text mb-1">
                                                     <label> Telefone </label>
                                                     <input type="text" class="form-control form-control-user sp_celphones" name="cliente_telefone"  placeholder="Telefone aqui..." value="<?= set_value('cliente_telefone') ?>">
                                                     <?= form_error('cliente_telefone', '<small class="form-text text-danger" >', '</small>'); ?>
                                               </div>

                                               <div class="col-md-3 form-text mb-1">
                                                     <label> Celular </label>
                                                     <input type="text" class="form-control form-control-user sp_celphones" name="cliente_celular"  placeholder="Celular aqui..." value="<?= set_value('cliente_celular') ?>">
                                                     <?= form_error('cliente_celular', '<small class="form-text text-danger" >', '</small>') ?>
                                               </div>
                                                
                                               <div class="col-md-3 form-text mb-1">  
                                                     <label class="pessoa_fisica"> Data de nascimento </label>
                                                     <input type="date" class="form-control form-control-user pessoa_fisica" name="cliente_data_nascimento"  value="<?= set_value('cliente_data_nascimento') ?>">
                                                     <?= form_error('cliente_data_nascimento', '<small class="form-text text-danger" >', '</small>') ; ?>
                                               </div>

                                                <div class="col-md-3 form-text">
                                                       <label> Ativo </label>
                                                       <select class="custom-select" name="cliente_ativo" style="width: 76px;">
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
                                                   <label> Endereço </label>
                                                   <input type="text" id="endereco" class="form-control form-control-user" name="cliente_endereco"  placeholder="Endereço aqui..." value="<?= set_value('cliente_endereco') ?>">
                                                   <?= form_error('cliente_endereco', '<small class="form-text text-danger" >', '</small>') ?>
                                             </div>

                                             <div class="col-md-3 form-text mb-1">
                                                   <label> CEP </label>
                                                   <input id="cep" type="text" class="form-control form-control-user cep" name="cliente_cep"  placeholder="CEP aqui..." value="<?= set_value('cliente_cep') ?> ">
                                                   <?= form_error('cliente_cep', '<small class="form-text text-danger" >', '</small>') ?>
                                             </div>

                                             <div class="col-md-3 form-text mb-1">
                                                   <label> Número </label>
                                                   <input type="text" id="numero" class="form-control form-control-user" name="cliente_numero_endereco"  placeholder="Número aqui..." value="<?= set_value('cliente_numero_endereco') ?>">
                                                   <?= form_error('cliente_numero_endereco', '<small class="form-text text-danger" >', '</small>') ?>
                                             </div>

                                             <div class="col-md-3 form-text mb-1">
                                                   <label> Bairro </label>
                                                   <input type="text" id="bairro" class="form-control form-control-user" name="cliente_bairro"  placeholder="Bairro aqui..." value="<?= set_value('cliente_bairro') ?>">
                                                   <?= form_error('cliente_bairro', '<small class="form-text text-danger" >', '</small>')  ?>
                                             </div>

                                             <div class="col-md-3 form-text mb-1">
                                                   <label> Complemento </label>
                                                   <input type="text" class="form-control form-control-user" name="cliente_complemento"  placeholder="Complemento aqui..." value="<?= set_value('cliente_complemento') ?>">
                                                   <?= form_error('cliente_complemento', '<small class="form-text text-danger" >', '</small>')  ?>
                                             </div>

                                             <div class="col-md-3 form-text mb-1">
                                                   <label> Cidade </label>
                                                   <input type="text" id="cidade" class="form-control form-control-user" name="cliente_cidade"  placeholder="Cidade aqui..." value="<?= set_value('cliente_cidade') ?>">
                                                   <?= form_error('cliente_cidade', '<small class="form-text text-danger" >', '</small>')  ?>
                                             </div>

                                             <div class="col-md-3 form-text mb-1">
                                                   <label> Estado </label>
                                                   <input type="text" id="estado"  class="form-control form-control-user uf" name="cliente_estado"  placeholder="Estado aqui..." value="<?= set_value('cliente_estado') ?>">
                                                   <?= form_error('cliente_estado', '<small class="form-text text-danger" >', '</small>')  ?>
                                             </div>

                                             <div class="col-md-3 form-text mb-1">
                                                  <label> Observações </label>
                                                  <textarea class="form-control form-control-user" name="cliente_obs"  placeholder="Digite sua observação aqui...">    </textarea>
                                                  <?= form_error('cliente_obs', '<small class="form-text text-danger" >', '</small>')  ?>
                                             </div> 
                                       </div>
                                </fieldset>
                             
                                <button type="submit" class="btn btn-primary btn-sm mt-2"> Salvar </button>
                                <a title="Voltar" href="<?= base_url('clientes'); ?>" class="btn btn-success btn-sm ml-2 mt-2">  Voltar </a>
                        </form>
                     </div>
                 </div>

     </div>
     <!-- /.container-fluid -->

 </div>
 <!-- End of Main Content -->

           