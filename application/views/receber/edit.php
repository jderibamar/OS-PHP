
<?php $this->load->view('layout/sidebar'); ?>        

 <!-- Main Content -->
 <div id="content">

   <?php $this->load->view('layout/navbar') ?> 

     <!-- Begin Page Content -->
     <div class="container-fluid">

             <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="<?= base_url('receber'); ?>"> Contas a receber </a></li>
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
                                                  <label> Cliente </label>
                                                  <select class="custom-select contas_receber" name="conta_receber_cliente_id">
                                                     <?php foreach ($clientes as $cliente): ?>
                                                              <option value=" <?= $cliente->cliente_id?>" <?= ($cliente->cliente_id == $conta_receber->conta_receber_cliente_id ? 'selected' : '') ?> > <?= $cliente->cliente_nome ?> </option>
                                                      <?php endforeach; ?>   
                                                  </select>
                                                  <?= form_error('conta_receber_cliente_id', '<small class="form-text text-danger" >', '</small>')  ?>
                                          </div>

                                         <div class="col-md-2 form-text mb-1">  
                                                <label> Data de vencimento </label>
                                                <input type="text" id="data_vencimento" class="form-control form-control-user-date" name="conta_receber_data_vencimento" value="<?= $conta_receber->conta_receber_data_vencimento ?>" >
                                                <?= form_error('conta_receber_data_vencimento', '<small class="form-text text-danger" >', '</small>')  ?>
                                         </div>

                                         <div class="col-md-2 form-text mb-1">  
                                                <label> Data de pagamento </label>
                                                <input type="text" id="data_pagamento" class="form-control form-control-user-date" name="conta_receber_data_pagamento" value="<?= $conta_receber->conta_receber_data_pagamento ?>" >
                                                <?= form_error('conta_receber_data_pagamento', '<small class="form-text text-danger" >', '</small>')  ?>
                                         </div>

                                         <div class="col-md-2 form-text mb-1">  
                                                <label> Valor da conta </label>
                                                <input type="text" class="form-control form-control-user money" name="conta_receber_valor" value="<?= $conta_receber->conta_receber_valor ?>" >
                                                <?= form_error('conta_receber_valor', '<small class="form-text text-danger" >', '</small>')  ?>
                                         </div>

                                           <div class="col-md-2 form-text">
                                                    <label> Status </label>
                                                    <select class="custom-select" name="conta_receber_status" >
                                                        <option value="1" <?= ($conta_receber->conta_receber_status == 1 ? 'selected' : '') ?> > Paga </option>
                                                        <option value="0" <?= ($conta_receber->conta_receber_status == 0 ? 'selected' : '') ?> > Pendente </option>
                                                    </select>
                                             </div>
                                  </div>

                                  <div class="form-group row">
                                         <div class="col-md-12 form-text mb-1">  
                                                <label> Observações </label>
                                                <textarea class="form-control" name="conta_receber_obs"><?= $conta_receber->conta_receber_obs ?></textarea>
                                         </div>
                                  </div>
                             
                               <input  type="hidden" name="conta_receber_id" value="<?= $conta_receber->conta_receber_id ?>">
                               <input  type="hidden" name="conta_receber_data_alteracao" value="<?= date('d/m/Y') ?>">
                               <button type="submit" class="btn btn-primary btn-sm mt-2" <?= $conta_receber->conta_receber_status == 1 ? 'disabled' : '' ?> > <?= $conta_receber->conta_receber_status == 1 ? 'Conta paga' : 'Salvar' ?> </button>
                               <a title="Voltar" href="<?= base_url($this->router->fetch_class()) ?>" class="btn btn-success btn-sm ml-2 mt-2">  Voltar </a>
                               <p class="float-right mt-2"> <strong>  <i class="fas fa-clock">  </i> &nbsp;Última alteração: </strong>  <?= $conta_receber->conta_receber_data_alteracao  ?>  </p>
                        </form>
                     </div>
                 </div>
     </div>
     <!-- /.container-fluid -->

 </div>
 <!-- End of Main Content -->

           