

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
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
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
                     <a title="Cadastrar conta a receber" href="<?= base_url('receber/add'); ?>" class="btn btn-success btn-sm float-right"> <i class="fas fa-plus"></i> &nbsp; Nova </a>
                 </div>
                 <div class="card-body">
                     <div class="table-responsive">
                         <table class="table table-bordered dataTable"  width="100%" cellspacing="0">
                             <thead>
                                 <tr>
                                     <th>#</th>
                                     <th> Cliente </th>
                                     <th> Observação </th>
                                     <th> Valor  </th>
                                     <th> Vencimento </th>
                                     <th> Pagamento </th>
                                     <th class="text-center"> Status </th>
                                     <th class="text-right no-sort pr-2">Ações</th>                                            
                                 </tr>
                             </thead>                                    
                             <tbody>
                      
                                 <?php foreach($contas_receber as $receber): ?>
                                     <tr>
                                         <td> <?= $receber->conta_receber_id ?> </td>
                                         <td> <?= $receber->cliente_nome ?> </td>
                                         <td> <?= word_limiter($receber->conta_receber_obs, 8) ?>  </td>
                                         <td> <?= 'R$ ' . $receber->conta_receber_valor ?> </td>
                                         <td> <?= $receber->conta_receber_data_vencimento  ?>  </td>
                                         <td> <?= $receber->conta_receber_data_pagamento  ?> </td>
                                         <td class="text-center"> 
                                                <?php
                                                
                                                            $data_atual = date('d/m/Y');
                                                            $dia_atual = substr($data_atual, 0, 2);
                                                            $mes_atual = substr($data_atual, 3, 2);
                                                            $ano_atual = substr($data_atual, 6, 4);
                                                            
                                                            $dia_vcto = substr($receber->conta_receber_data_vencimento, 0, 2);
                                                            $mes_vcto = substr($receber->conta_receber_data_vencimento, 3, 2);
                                                            $ano_vcto = substr($receber->conta_receber_data_vencimento, 6, 4);
                                                            
                                                            if($receber->conta_receber_status == 1)
                                                            {
                                                                    echo '<span class="badge badge-success"> Paga </span>';
                                                            }
                                                            else if ($dia_vcto > $dia_atual && $mes_vcto >= $mes_atual && $ano_vcto >= $ano_atual)
                                                            {
                                                                    echo '<span class="badge badge-secondary"> Pendente </span>';
                                                            }
                                                            else if ($receber->conta_receber_data_vencimento  == date('d/m/Y')) 
                                                            {
                                                                    echo '<span class="badge badge-warning"> Vence hoje </span>';
                                                            }
                                                            else
                                                            {
                                                                    echo '<span class="badge badge-danger"> Vencida </span>';
                                                            }
                                                
//                                                            if($receber->conta_receber_status == 1)
//                                                            {
//                                                                    echo '<span class="badge badge-success"> Paga </span>';
//                                                            }
//                                                            else if ($receber->conta_receber_data_vencimento  > date('Y-m-d')) 
//                                                            {
//                                                                    echo '<span class="badge badge-secondary"> Pendente </span>';
//                                                            }
//                                                            else if ($receber->conta_receber_data_vencimento  == date('Y-m-d')) 
//                                                            {
//                                                                    echo '<span class="badge badge-warning"> Vence hoje </span>';
//                                                            }
//                                                            else
//                                                            {
//                                                                    echo '<span class="badge badge-danger"> Vencida </span>';
//                                                            }
                                                  ?> 
                                         </td>

                                         <td class="text-right"> 
                                             <a title="Editar" href="<?= base_url('receber/edit/' . $receber->conta_receber_id); ?>" class="btn btn-sm btn-primary "> <i class="fas fa-edit"></i>  </a> 
                                             <a  title="Excluir" href="javascript(void)"  data-toggle="modal" data-target="#receber-<?= $receber->conta_receber_id ?>" class="btn btn-sm btn-danger " > <i class="fas fa-trash"></i>  </a> 
                                         </td>
                                     </tr>
                                     
                                         <!-- Logout Modal-->
                                        <div class="modal fade" id="receber-<?= $receber->conta_receber_id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                            aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Confirma exclusão deste receber?</h5>
                                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">×</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body"> Esta operação não pode ser desfeita, <strong> Clique em Sim para confirmar </strong> </div>
                                                    <div class="modal-footer">
                                                        <button class="btn btn-secondary btn-sm" type="button" data-dismiss="modal"> Não </button>
                                                        <a class="btn btn-danger btn-sm" href="<?= base_url('receber/del/' . $receber->conta_receber_id) ?>"> Sim </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                             
                                        <?php
//                                                $dts_vctos = [];
//                                                array_push($dts_vctos, $receber->conta_receber_data_pagamento);
//                                                print_r($receber->conta_receber_data_pagamento);
//                                                echo $dts_vctos;
                                        ?>
                             
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

           