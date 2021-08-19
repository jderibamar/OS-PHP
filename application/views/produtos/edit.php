
<?php $this->load->view('layout/sidebar'); ?>        

 <!-- Main Content -->
 <div id="content">

   <?php $this->load->view('layout/navbar') ?> 

     <!-- Begin Page Content -->
     <div class="container-fluid">

             <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="<?= base_url('produtos'); ?>"> Produtos </a></li>
                      <li class="breadcrumb-item active" aria-current="page"> <?= $titulo ?> </li>
                  </ol>
            </nav>

         <!-- DataTales Example -->
                 <div class="card shadow mb-4">
                     <div class="card-header py-3">
                         
                     </div>
                     <div class="card-body">
                         <form method="POST" name="form_edit" class="user">
                             <fieldset class="mt-2 border p-2"> 
                                 <legend> <i class="fas fa-tablet"></i> &nbsp; Dados principais </legend>
                                        <div class="form-group row">

                                                  <div class="col-md-2 form-text mb-1">  
                                                          <label> Código interno </label>
                                                          <input type="text" class="form-control form-control-user" name="produto_codigo" value="<?= $produto->produto_codigo ?>"  readonly>
                                                  </div>

                                                  <div class="col-md-10 form-text mb-1">  
                                                      <label> Descrição </label>
                                                      <input type="text" class="form-control form-control-user" name="produto_descricao" placeholder="Descrição do produto aqui..." value="<?= $produto->produto_descricao ?>" autofocus>
                                                      <?= form_error('produto_descricao', '<small class="form-text text-danger" >', '</small>')  ?>
                                                  </div>

          <!--                                        <div class="col-md-3 form-text mb-1">  
                                                      <label> Preço </label>
                                                      <input type="text" class="form-control form-control-user" name="produto_preco"  placeholder="Digite o preço aqui..." value="<?= $produto->produto_preco ?>">
                                                      <?= form_error('produto_preco', '<small class="form-text text-danger" >', '</small>') ; ?>
                                                  </div>-->
          <!--                                    
                                                   <div class="col-md-3 form-text">
                                                          <label> Ativo </label>
                                                          <select class="custom-select" name="produto_ativo">
                                                              <option value="1" <?= ($produto->produto_ativo == 1 ? 'selected' : '') ?> > Sim </option>
                                                              <option value="0" <?= ($produto->produto_ativo == 0 ? 'selected' : '') ?> > Não </option>
                                                          </select>
                                                   </div>-->
                                       </div>
                                 
                                        <div class="form-group row">

                                                <div class="col-md-3 form-text mb-1"> 
                                                        <label> Marca </label>
                                                        <select class="custom-select" name="produto_marca_id">
                                                            <?php foreach($marcas as $marca): ?>
                                                            <option value="<?= $marca->marca_id ?>"  <?= ($marca->marca_ativa == 0 ? 'disabled' : '') ?> <?= ($marca->marca_id == $produto->produto_marca_id ?  'selected' : '') ?> >   <?= ($marca->marca_ativa == 0 ? $marca->marca_nome .  ' -> Inativa ' : $marca->marca_nome) ?> </option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                </div>

                                                <div class="col-md-3 form-text mb-1"> 
                                                        <label> Categoria </label>
                                                        <select class="custom-select" name="produto_categoria_id">
                                                            <?php foreach ($categorias as $categoria): ?>
                                                                    <option value=" <?= $categoria->categoria_id?>" <?= ($categoria->categoria_id == $produto->produto_categoria_id ? 'selected' : '') ?>  <?= $categoria->categoria_ativa == 0 ? 'disabled' : '' ?> >   <?= $categoria->categoria_ativa == 0 ? $categoria->categoria_nome . ' -> Inativa' : $categoria->categoria_nome ?> </option>
                                                            <?php endforeach; ?>    
                                                        </select>
                                                </div>

                                                <div class="col-md-3 form-text mb-1"> 
                                                        <label> Fornecedor </label>
                                                        <select class="custom-select" name="produto_fornecedor_id">
                                                           <?php foreach ($fornecedores as $fornecedor): ?>
                                                                    <option value=" <?= $fornecedor->fornecedor_id?>" <?= ($fornecedor->fornecedor_id == $produto->produto_fornecedor_id ? 'selected' : '') ?> <?= $fornecedor->fornecedor_ativo == 0 ? 'disabled' : '' ?> > <?= $fornecedor->fornecedor_ativo == 0 ? $fornecedor->fornecedor_nome_fantasia . '-> Inativo' : $fornecedor->fornecedor_nome_fantasia ?> </option>
                                                            <?php endforeach; ?>   
                                                        </select>
                                                </div>
                                            
                                               <div class="col-md-3 form-text mb-1">  
                                                      <label> Unidade </label>
                                                      <input type="text" class="form-control form-control-user" name="produto_unidade" placeholder="Unidade do produto aqui..." value="<?= $produto->produto_unidade ?>" >
                                                      <?= form_error('produto_unidade', '<small class="form-text text-danger" >', '</small>')  ?>
                                               </div>
                                        </div>
                                 
                             </fieldset>
                             
                             <fieldset class="mt-2 border p-2"> 
                                 <legend> <i class="fas fa-funnel-dollar"></i> &nbsp; Preços e estoque </legend>
                                        <div class="form-group row">

                                            <div class="col-md-3 form-text mb-1">  
                                                      <label> Preço de custo </label>
                                                      <input type="text" class="form-control form-control-user money" name="produto_preco_custo" placeholder="Preço de custo aqui..." value="<?= $produto->produto_preco_custo ?>" >
                                                      <?= form_error('produto_preco_custo', '<small class="form-text text-danger" >', '</small>')  ?>
                                            </div>

                                            <div class="col-md-3 form-text mb-1">  
                                                      <label> Preço de venda </label>
                                                      <input type="text" class="form-control form-control-user money" name="produto_preco_venda" placeholder="Preço de custo aqui..." value="<?= $produto->produto_preco_venda ?>" >
                                                      <?= form_error('produto_preco_venda', '<small class="form-text text-danger" >', '</small>')  ?>
                                            </div>

                                            <div class="col-md-3 form-text mb-1">  
                                                      <label> Estoque mínimo </label>
                                                      <input type="number" class="form-control form-control-user money" name="produto_estoque_minimo" placeholder="Estoque mínimo aqui..." value="<?= $produto->produto_estoque_minimo ?>" >
                                                      <?= form_error('produto_estoque_minimo', '<small class="form-text text-danger" >', '</small>')  ?>
                                            </div>

                                            <div class="col-md-3 form-text mb-1">  
                                                      <label> Estoque atual </label>
                                                      <input type="text" class="form-control form-control-user money" name="produto_qtde_estoque" placeholder="Estoque atual aqui..." value="<?= $produto->produto_qtde_estoque ?>" >
                                                      <?= form_error('produto_qtde_estoque', '<small class="form-text text-danger" >', '</small>')  ?>
                                            </div>
                                       </div>
                                 
                                 <div class="form-group row">
                                        <div class="col-md-3 form-text">
                                                 <label> Ativo </label>
                                                 <select class="custom-select" name="produto_ativo">
                                                     <option value="1" <?= $produto->produto_ativo == 1 ? 'selected' : '' ?> > Sim </option>
                                                     <option value="0" <?= $produto->produto_ativo == 0 ? 'selected' : '' ?> > Não </option>
                                                 </select>
                                          </div>  
                                     
                                          <div class="col-md-9 form-text mb-1">  
                                                <label> Observação </label>
                                                <textarea class="form-control" name="produto_obs">  <?= $produto->produto_obs ?> </textarea>
                                                <?= form_error('produto_obs', '<small class="form-text text-danger" >', '</small>')  ?>
                                          </div>
                                 </div>
                                 
                             </fieldset>
                             
                               <input  type="hidden" name="produto_id" value="<?= $produto->produto_id ?>">
                               <input  type="hidden" name="produto_data_alteracao" value="<?= date('d/m/Y') ?>">
                               <button type="submit" class="btn btn-primary btn-sm mt-2"> Salvar </button>
                               <a title="Voltar" href="<?= base_url($this->router->fetch_class()) ?>" class="btn btn-success btn-sm ml-2 mt-2">  Voltar </a>
                               <p class="float-right mt-2"> <strong>  <i class="fas fa-clock">  </i> &nbsp;Última alteração: </strong>  <?= $produto->produto_data_alteracao  ?>  </p>
                        </form>
                     </div>
                 </div>
     </div>
     <!-- /.container-fluid -->

 </div>
 <!-- End of Main Content -->

           