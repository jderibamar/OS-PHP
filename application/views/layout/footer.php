<?php if(!$this->router->fetch_class() == 'login'): ?> //não mostra esse trecho do FOOTER quando o controller LOGIN for chamado
         <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Ordem de Serviço  <?= date('Y')?> &nbsp; | Desenvolvido por JDuarte! </span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->
<?php endif; ?>
        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> Deseja realmente sair ?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Para confirmar clique no botão Sair </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal" >   Não </button>
                    <a class="btn btn-primary" href="<?= base_url('login/logout') ?> "> Sair </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="<?php echo base_url('public/vendor/jquery/jquery.min.js'); ?>"></script>
    <script src="<?php echo base_url('public/vendor/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?php  echo base_url('public/vendor/jquery-easing/jquery.easing.min.js'); ?>"></script>
    <script src="http://code.jquery.com/jquery-1.8.2.js"></script>
    <script src="http://code.jquery.com/ui/1.9.0/jquery-ui.js"></script>



    <!-- Custom scripts for all pages-->
    <script src="<?php echo base_url('public/js/sb-admin-2.min.js'); ?>"></script>
    <script src="<?php echo base_url('public/js/util.js'); ?>"></script>
    
    <?php if(isset($scripts)): ?>
        <?php foreach ($scripts as $script): ?>
            <!-- scripts personalizados para este módulo -->
           <script src="<?php echo base_url('public/' . $script); ?>"></script>
         <?php endforeach; ?> 
    <?php endif; ?>
    

</body>

</html>