<script src="<?= base_url() ?>assets/backend/vendor/jquery/jquery.min.js"></script>
<script src="<?= base_url() ?>assets/backend/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="<?= base_url() ?>assets/backend/vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="<?= base_url() ?>assets/backend/js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="<?= base_url() ?>assets/backend/vendor/chart.js/Chart.min.js"></script>

<!-- Page level custom scripts -->
<script src="<?= base_url() ?>assets/backend/js/demo/chart-area-demo.js"></script>
<script src="<?= base_url() ?>assets/backend/js/demo/chart-pie-demo.js"></script>


<!-- Bootstrap core JavaScript-->
<!-- <script src="<?= base_url('assets/'); ?>vendor/jquery/jquery.min.js"></script> -->

<script src="<?= base_url('assets/backend/'); ?>vendor/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url('assets/backend/'); ?>vendor/datatables/dataTables.bootstrap4.min.js"></script>

<script src="<?= base_url('assets/backend/'); ?>js/demo/datatables-demo.js"></script>

<!-- <script type="text/javascript">
    $(function () {
        $('#datetimepicker2').datetimepicker({
            locale: 'ru'
        });
    });
</script> -->

<script type="text/javascript">
    $(document).ready(function() {
    $('table.display').dataTable();
} );
</script>

<script type="text/javascript">
    $(document).ready(function() {
    $('table.display').DataTable();
} );
</script>


</body>

</html>

<script>
  // selected file show
  $('.custom-file-input').on('change', function() {
    let fileName = $(this).val().split('\\').pop();
    $(this).next('.custom-file-label').addClass("selected").html(fileName);
  });
</script>

</body>

</html>
