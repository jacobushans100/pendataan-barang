<!-- Bootstrap core JavaScript-->
<script src="<?= base_url('assets/'); ?>vendor/jquery/jquery.min.js"></script>
<script src="<?= base_url('assets/'); ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="<?= base_url('assets/'); ?>vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="<?= base_url('assets/'); ?>js/sb-admin-2.min.js"></script>

</body>
<script>
    $(document).ready(function() {
        $("#load").fadeOut(500);
        $("#formLogin").submit(function(e) {
            e.preventDefault();
            $("#loading").addClass('overlay');
            $("#loading").html('<i class="fa fa-spinner fa-spin"></i>');
            setInterval(RemoveClass, 100);
        });

        function RemoveClass() {
            $("#loading").RemoveClass('overlay');
            $("#loading").fadeOut();
        }
    });
</script>

</html>