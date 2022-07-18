<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <?php echo validation_errors(); ?>
    <div class="row">
        <div class="col-lg-6">
            <form class="user" method="POST" action="<?= base_url('detail/editsekolah'); ?>">
            <?php foreach ($detailbarang as $br) : ?>
                <div class="form-group">
                    <label for="Nama_sekolah">Nama barang</label>
                    <input type="text" class="form-control" id="Nama_sekolah" name="Nama_sekolah" value="<?= $br('nama_barang'); ?>">
                </div>
                <div class="form-group">
                    <label for="Alamat">Alamat</label>
                    <textarea class="form-control" id="Alamat" name="Alamat" rows="3" value="<?= $br(''); ?>"></textarea>
                </div>
                <div class="form-group ">
                    <label for="NPSN">NPSN</label>
                    <input type="text" class="form-control" id="NPSN" name="NPSN" value="<?= $br(''); ?>">
                    <?= form_error('NPSN', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <div class="form-group ">
                    <label for="Status_akreditasi">Status Akreditasi</label>
                    <input type="text" class="form-control" id="Status_akreditasi" name="Status_akreditasi" value="<?= $br(''); ?>">
                </div>
                <div class="form-group ">
                    <label for="Asrama">Asrama</label>
                    <input type="text" class="form-control" id="Asrama" name="Asrama" value="<?= $br(''); ?>">
                </div>
                <div class="form-group ">
                    <label for="NSS">NSS</label>
                    <input type="text" class="form-control" id="NSS" name="NSS" value="<?= $br(''); ?>">
                    <?= form_error('NSS', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <div class="form-group ">
                    <label for="Keputusan_dirjen">Keputusan Dirjen</label>
                    <input type="text" class="form-control" id="Keputusan_dirjen" name="Keputusan_dirjen" value="<?= $br(''); ?>">
                </div>
                <button type="submit" class="btn btn-primary btn-user btn-block">
                    Tambah
                </button>
                <?php endforeach;?>
            </form>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!--ini yang gak masuk-->