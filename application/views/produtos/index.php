

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

             <!-- DataTales Example -->
             <div class="card shadow mb-4">
                 <div class="card-header py-3">
                     <a title="Cadastrar novo produto" href="<?= base_url('produtos/add'); ?>" class="btn btn-success btn-sm float-right"> <i class="fas fa-plus"></i> &nbsp; Novo </a>
                 </div>
                 <div class="card-body">
                     <div class="table-responsive">
                         <table class="table table-bordered dataTable"  width="100%" cellspacing="0">
                             <thead>
                                 <tr>
                                     <th>#</th>
                                     <th> Código </th>
                                     <th> Nome  </th>
                                     <th> Marca </th>
                                     <th> Categoria </th>
                                     <th class="text-center"> Estoque mínimo </th>
                                     <th class="text-center"> Qtde em estoque </th>
                                     <th class="text-center"> Ativo </th>
                                     <th class="text-right no-sort pr-2">Ações</th>                                            
                                 </tr>
                             </thead>                                    
                             <tbody>
                                 <?php foreach($produtos as $produto): ?>
                                     <tr>
                                         <td> <?= $produto->produto_id ?> </td>
                                         <td> <?= $produto->produto_codigo ?> </td>
                                         <td> <?= word_limiter($produto->produto_descricao, 5) ?> </td>
                                         <td> <?= $produto->produto_marca ?> </td>
                                         <td> <?= $produto->produto_categoria ?> </td>
                                         <td class="text-center"> <?= '<span class="badge badge-success btn-sm"> '. $produto->produto_estoque_minimo . '</span>'   ?> </td>
                                         <td class="text-center"> <?= ($produto->produto_qtde_estoque  <= $produto->produto_estoque_minimo ? '<span class="badge badge-danger text-gray-900">' . $produto->produto_qtde_estoque . '</span>' :  '<span class="badge badge-info text-gray-900">' . $produto->produto_qtde_estoque . '</span>') ?> </td>
                                         <td class="text-center"> <?= ($produto->produto_ativo == 1 ? '<span class="badge badge-info"> Sim </span>' : '<span class="badge badge-warning"> Não </span>') ?> </td>

                                         <td class="text-right"> 
                                             <a title="Editar" href="<?= base_url('produtos/edit/' . $produto->produto_id); ?>" class="btn btn-sm btn-primary "> <i class="fas fa-edit"></i>  </a> 
                                             <a  title="Excluir" href="javascript(void)"  data-toggle="modal" data-target="#produto-<?= $produto->produto_id ?>" class="btn btn-sm btn-danger " > <i class="fas fa-trash"></i>  </a> 
                                         </td>
                                     </tr>
                                     
                                         <!-- Logout Modal-->
                                        <div class="modal fade" id="produto-<?= $produto->produto_id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                            aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Confirma exclusão deste produto?</h5>
                                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">×</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body"> Esta operação não pode ser desfeita, <strong> Clique em Sim para confirmar </strong> </div>
                                                    <div class="modal-footer">
                                                        <button class="btn btn-secondary btn-sm" type="button" data-dismiss="modal"> Não </button>
                                                        <a class="btn btn-danger btn-sm" href="<?= base_url('produtos/del/' . $produto->produto_id) ?>"> Sim </a>
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

           