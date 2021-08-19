
<?php $this->load->view('layout/sidebar'); ?>        

 <!-- Main Content -->
 <div id="content">

   <?php $this->load->view('layout/navbar') ?> 

     <!-- Begin Page Content -->
     <div class="container-fluid">

             <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="<?= base_url('pagar'); ?>"> Contas a pagar </a></li>
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

                                          <div class="col-md-4 form-text mb-1"> 
                                                  <label> Fornecedor </label>
                                                  <select class="custom-select contas_pagar" name="conta_pagar_fornecedor_id">
                                                     <?php foreach ($fornecedores as $fornecedor): ?>
                                                              <option value=" <?= $fornecedor->fornecedor_id ?>"> <?= $fornecedor->fornecedor_nome_fantasia ?> </option>
                                                      <?php endforeach; ?>   
                                                  </select>
                                                  <?= form_error('conta_pagar_fornecedor_id', '<small class="form-text text-danger" >', '</small>')  ?>
                                          </div>

                                         <div class="col-md-2 form-text mb-1">  
                                                <label> Data de vencimento </label>
                                                <input type="text" id="data_vencimento" class="form-control form-control-user-date" name="conta_pagar_data_vencimento" value="<?= set_value('conta_pagar_data_vencimento')  ?>" >
                                                <?= form_error('conta_pagar_data_vencimento', '<small class="form-text text-danger" >', '</small>')  ?>
                                         </div>

<!--                                         <div class="col-md-2 form-text mb-1">  
                                                <label> Data de pagamento </label>
                                                <input type="text" class="form-control form-control-user-date" name="conta_pagar_data_pagamento" value="<?= set_value('conta_pagar_data_pagamento') ?>" >
                                                <?= form_error('conta_pagar_data_pagamento', '<small class="form-text text-danger" >', '</small>')  ?>
                                         </div>-->

                                         <div class="col-md-2 form-text mb-1">  
                                                <label> Valor da conta </label>
                                                <input type="text" class="form-control form-control-user money" name="conta_pagar_valor" value="<?= set_value('conta_pagar_valor') ?>" >
                                                <?= form_error('conta_pagar_valor', '<small class="form-text text-danger" >', '</small>')  ?>
                                         </div>

                                           <div class="col-md-2 form-text">
                                                    <label> Status </label>
                                                    <select class="custom-select" name="conta_pagar_status" >
                                                        <option value="0"> Pendente </option>
                                                        <option value="1"> Paga </option>
                                                    </select>
                                             </div>
                                  </div>

                                  <div class="form-group row">
                                         <div class="col-md-12 form-text mb-1">  
                                                <label> Observações </label>
                                                <textarea class="form-control" name="conta_pagar_obs"><?= set_value('conta_pagar_obs') ?></textarea>
                                         </div>
                                  </div>
                                 
                               <input  type="hidden" name="conta_pagar_data_alteracao" value="<?= date('d/m/Y') ?>">
                               <button type="submit" class="btn btn-primary btn-sm mt-2"> Salvar </button>
                               <a title="Voltar" href="<?= base_url($this->router->fetch_class()) ?>" class="btn btn-success btn-sm ml-2 mt-2">  Voltar </a>
                       
                        </form>
                     </div>
                 </div>
     </div>
     <!-- /.container-fluid -->

 </div>
 <!-- End of Main Content -->

           