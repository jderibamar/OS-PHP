
<?php $this->load->view('layout/sidebar'); ?>        

 <!-- Main Content -->
 <div id="content">

   <?php $this->load->view('layout/navbar') ?> 

     <!-- Begin Page Content -->
     <div class="container-fluid">

             <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="<?= base_url('categorias'); ?>"> Categorias </a></li>
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
                                        <div class="col-md-8 form-text mb-1">  
                                            <label> Nome</label>
                                            <input type="text" class="form-control form-control-user" name="categoria_nome" placeholder="Nome do categoria aqui..." value="<?= $categoria->categoria_nome ?>" >
                                            <?= form_error('categoria_nome', '<small class="form-text text-danger" >', '</small>')  ?>
                                        </div>

                                         <div class="col-md-4 form-text">
                                                <label> Ativa </label>
                                                <select class="custom-select" name="categoria_ativa">
                                                    <option value="1" <?= ($categoria->categoria_ativa == 1 ? 'selected' : '') ?> > Sim </option>
                                                    <option value="0" <?= ($categoria->categoria_ativa == 0 ? 'selected' : '') ?> > Não </option>
                                                </select>
                                         </div>
                               </div>

                               <input type="hidden" name="categoria_data_alteracao" value="<?= date('d/m/Y') ?>">
                               <input  type="hidden" name="categoria_id" value="<?= $categoria->categoria_id ?>">
                               <button type="submit" class="btn btn-primary btn-sm mt-2"> Salvar </button>
                               <a title="Voltar" href="<?= base_url($this->router->fetch_class()) ?>" class="btn btn-success btn-sm ml-2 mt-2">  Voltar </a>
                               <p class="float-right mt-2"> <strong>  <i class="fas fa-clock">  </i> &nbsp;Última alteração: </strong>  <?= $categoria->categoria_data_alteracao  ?>  </p>
                        </form>
                     </div>
                 </div>
     </div>
     <!-- /.container-fluid -->

 </div>
 <!-- End of Main Content -->

           