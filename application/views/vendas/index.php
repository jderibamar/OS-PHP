

    <?php $this->load->view('layout/sidebar'); ?>

     <!-- Main Content -->
     <div id="content">

       <?php $this->load->view('layout/navbar') ?> 

         <!-- Begin Page Content -->
         <div class="container-fluid">

        <nav aria-label="breadcrumb">
             <ol class="breadcrumb">
                 <li class="breadcrumb-item"><a href="<?= base_url('/'); ?>">Home</a></li>
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
                                        <button type="button" class="clvendae" data-dismiss="alert" aria-label="Clvendae">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                              </div>
                        </div>  
                    </div>
              <?php endif; ?>

             <?php if($message = $this->session->flashdata('info')): ?>
                    <div class="row">
                        <div class="col-md-12">
                                <div class="alert alert-info alert-dismissible fade show" role="alert">
                                    <strong>  <i class="fas fa-exclamation-triangle"></i> &nbsp; <?= $message; ?> </strong>
                                        <button type="button" class="clvendae" data-dismiss="alert" aria-label="Clvendae">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                              </div>
                        </div>  
                    </div>
             <?php endif; ?>

             <!-- DataTales Example -->
             <div class="card shadow mb-4">
                 <div class="card-header py-3">
                     <a title="Cadastrar nova venda" href="<?= base_url('vendas/add'); ?>" class="btn btn-success btn-sm float-right"> <i class="fas fa-plus"></i> &nbsp; Nova </a>
                 </div>
                 <div class="card-body">
                     <div class="table-responsive">
                         <table class="table table-bordered dataTable"  width="100%" cellspacing="0">
                             <thead>
                                 <tr>
                                     <th>#</th>
                                     <th> Cliente  </th>
                                     <th> F. de pagamento </th>
                                     <th> Data </th>
                                     <th> Vendedor </th>
                                     <th> Valor total </th>
                                     <th class="text-right no-sort pr-2">Ações</th>                                            
                                 </tr>
                             </thead>                                    
                             <tbody>
                                 <?php foreach($vendas as $venda): ?>
                                     <tr>
                                         <td> <?= $venda->venda_id?> </td>
                                         <td> <?= $venda->cliente_nome  ?> </td>
                                         <td> <?= $venda->forma_pagamento  ?> </td>
                                         <td> <?= $venda->venda_data_emissao ?> </td>
                                         <td> <?= $venda->vendedor_nome_completo ?> </td>
                                         <td> <?= 'R$ ' . $venda->venda_valor_total ?> </td>
                                         <!--<td class="text-center"> <?= $venda->venda_status == 1 ? '<span class="badge badge-info btn-sm"> Fechada </span>' : '<span class="badge badge-warning btn-sm"> Em aberto </span>' ?> </td>-->

                                         <td class="text-right"> 
                                             <a title="Imprimir" href="<?= base_url('vendas/pdf/' . $venda->venda_id); ?>" class="btn btn-sm btn-secondary" target="_blank"> <i class="fas fa-print"></i>  </a> 
                                             <a title="Editar" href="<?= base_url('vendas/edit/' . $venda->venda_id); ?>" class="btn btn-sm btn-primary "> <i class="fas fa-edit"></i>  </a> 
                                             <a  title="Excluir" href="javascript(void)"  data-toggle="modal" data-target="#venda-<?= $venda->venda_id?>" class="btn btn-sm btn-danger " > <i class="fas fa-trash"></i>  </a> 
                                         </td>
                                     </tr>
                                     
                                         <!-- Logout Modal-->
                                        <div class="modal fade" id="venda-<?= $venda->venda_id?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                            aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Confirma exclusão desta venda?</h5>
                                                        <button class="clvendae" type="button" data-dismiss="modal" aria-label="Clvendae">
                                                            <span aria-hidden="true">×</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body"> Esta operação não pode ser desfeita, <strong> Clieque em Sim para confirmar </strong> </div>
                                                    <div class="modal-footer">
                                                        <button class="btn btn-secondary btn-sm" type="button" data-dismiss="modal"> Não </button>
                                                        <a class="btn btn-danger btn-sm" href="<?= base_url('vendas/del/' . $venda->venda_id) ?>"> Sim </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                     
                                 <?php endforeach; ?>
                                 </tbody>
                         </table>
                     </div>
                 </div>
             </div>

         </div>
         <!-- /.container-fluid -->

     </div>
     <!-- End of Main Content -->

           