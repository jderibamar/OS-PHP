<?php $this->load->view('layout/sidebar'); ?>        

 <!-- Main Content -->
 <div id="content">

   <?php $this->load->view('layout/navbar') ?> 

     <!-- Begin Page Content -->
     <div class="container-fluid">

             <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="<?= base_url('vendas'); ?>"> Vendas </a></li>
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
         
         <!-- DataTales Example -->
                 <div class="card shadow mb-4">
                     <div class="card-header py-3">
                         
                         <div class="row">
                             <div class="col-md-4">
                                 <a title="Imprimir Venda" href="<?= base_url('vendas/pdf/' . $venda->venda_id) ?>" target="_blank" class="btn btn-secondary btn-icon-split btn-lg">
                                            <span class="icon text-white-50">
                                                <i class="fas fa-print"></i>
                                            </span>
                                            <span class="text"> Imprimir Venda </span>
                                    </a>   
                             </div>
                             
                             <div class="col-md-4">
                                    <a href="<?= base_url('vendas/add') ?>" class="btn btn-success btn-icon-split btn-lg">
                                            <span class="icon text-white-50">
                                                <i class="fas fa-plus"></i>
                                            </span>
                                            <span class="text"> Cadastrar Venda </span>
                                    </a>   
                             </div>   
                             
                             <div class="col-md-4">
                                    <a href="<?= base_url('vendas') ?>" class="btn btn-info btn-icon-split btn-lg">
                                            <span class="icon text-white-50">
                                                <i class="fas fa-list-ol"></i>
                                            </span>
                                            <span class="text"> Listar Vendas </span>
                                    </a>   
                             </div>   
                         </div>
                         
                     </div>
                     <div class="card-body">
                            
                     </div>
                 </div>
     </div>
     <!-- /.container-fluid -->

 </div>
 <!-- End of Main Content -->

           