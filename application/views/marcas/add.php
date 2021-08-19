
<?php $this->load->view('layout/sidebar'); ?>        

 <!-- Main Content -->
 <div id="content">

   <?php $this->load->view('layout/navbar') ?> 

     <!-- Begin Page Content -->
     <div class="container-fluid">

             <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="<?= base_url('marcas'); ?>"> Marcas </a></li>
                      <li class="breadcrumb-item active" aria-current="page"> <?= $titulo ?> </li>
                  </ol>
            </nav>

         <!-- DataTales Example -->
                 <div class="card shadow mb-4">
                     <div class="card-header py-3">
                         
                     </div>
                     <div class="card-body">
                         <form method="POST" name="form_add" class="user">
                                <div class="form-group row">
                                        <div class="col-md-3 form-text mb-1">  
                                            <label> Nome</label>
                                            <input type="text" class="form-control form-control-user" name="marca_nome" placeholder="Nome da marca aqui..." value="<?= set_value('marca_nome')  ?>" autofocus>
                                            <?= form_error('marca_nome', '<small class="form-text text-danger" >', '</small>')  ?>
                                        </div>
                                        
                                         <div class="col-md-3 form-text">
                                                <label> Ativa </label>
                                                <select class="custom-select" name="marca_ativa">
                                                    <option value="1"> Sim </option>
                                                    <option value="0" > Não </option>
                                                </select>
                                         </div>
                               </div>
                             
                                <input  type="hidden" name="marca_data_alteracao" value="<?= date('d/m/Y') ?>">
                               <button type="submit" class="btn btn-primary btn-sm mt-2"> Salvar </button>
                               <a title="Voltar" href="<?= base_url($this->router->fetch_class()) ?>" class="btn btn-success btn-sm ml-2 mt-2">  Voltar </a>
                        </form>
                     </div>
                 </div>
     </div>
     <!-- /.container-fluid -->

 </div>
 <!-- End of Main Content -->

           