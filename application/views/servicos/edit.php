
<?php $this->load->view('layout/sidebar'); ?>        

 <!-- Main Content -->
 <div id="content">

   <?php $this->load->view('layout/navbar') ?> 

     <!-- Begin Page Content -->
     <div class="container-fluid">

             <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="<?= base_url('servicos'); ?>"> Servicos </a></li>
                      <li class="breadcrumb-item active" aria-current="page"> <?= $titulo ?> </li>
                  </ol>
            </nav>

         <!-- DataTales Example -->
                 <div class="card shadow mb-4">
                     <div class="card-header py-3">
                         
                     </div>
                     <div class="card-body">
                         <form method="POST" name="form_edit" class="user">
                                <div class="form-group row">
                                        <div class="col-md-3 form-text mb-1">  
                                            <label> Nome</label>
                                            <input type="text" class="form-control form-control-user" name="servico_nome" placeholder="Nome do servico aqui..." value="<?= $servico->servico_nome ?>" >
                                            <?= form_error('servico_nome', '<small class="form-text text-danger" >', '</small>')  ?>
                                        </div>

                                        <div class="col-md-3 form-text mb-1">  
                                            <label> Preço </label>
                                            <input type="text" class="form-control form-control-user money" name="servico_preco"  placeholder="Digite o preço aqui..." value="<?= $servico->servico_preco ?>">
                                            <?= form_error('servico_preco', '<small class="form-text text-danger" >', '</small>') ; ?>
                                        </div>
                                    
                                         <div class="col-md-3 form-text">
                                                <label> Ativo </label>
                                                <select class="custom-select" name="servico_ativo">
                                                    <option value="1" <?= ($servico->servico_ativo == 1 ? 'selected' : '') ?> > Sim </option>
                                                    <option value="0" <?= ($servico->servico_ativo == 0 ? 'selected' : '') ?> > Não </option>
                                                </select>
                                         </div>
                               </div>
                             
                                <div class="form-group row">
                                      <div class="col-md-12 form-text mb-1">
                                            <label> Descrição </label>
                                            <textarea class="form-control" name="servico_descricao"  placeholder="Digite descrição aqui..." >  <?= $servico->servico_descricao ?>  </textarea>
                                     </div> 
                               </div>

                               <input  type="hidden" name="servico_id" value="<?= $servico->servico_id ?>">
                               <input type="hidden" name="servico_data_alteracao" value="<?= date('d/m/Y') ?>">
                               <button type="submit" class="btn btn-primary btn-sm mt-2"> Salvar </button>
                               <a title="Voltar" href="<?= base_url($this->router->fetch_class()) ?>" class="btn btn-success btn-sm ml-2 mt-2">  Voltar </a>
                               <p class="float-right mt-2"> <strong>  <i class="fas fa-clock">  </i> &nbsp;Última alteração: </strong>  <?= $servico->servico_data_alteracao  ?>  </p>
                        </form>
                     </div>
                 </div>
     </div>
     <!-- /.container-fluid -->

 </div>
 <!-- End of Main Content -->

           