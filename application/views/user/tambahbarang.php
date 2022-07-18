<!-- Begin Page Content -->
<div class="container-fluid">
<h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
<?php foreach($alert_stok as $alert ) : ?>
        <?php if($alert['jumlah']<5):?>
        <div class="alert alert-danger" role="alert">
         Stok <?= $alert['nama_barang']?> kurang dari 5! <a href="<?= base_url('barang/databarang')?>">Klik untuk menambah stok</a>
         </div>
         <?php endif ;?>
         <?php endforeach; ?>
    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-4 offset-4">
        <?= $this->session->flashdata('message'); ?>
            <div class="card">
            <div class="card-header bg-success">
            <font color="#ffffff">Tambah barang</font><br>
            </div>
                <div class="card-body">
                    <form class="user" method="POST" action="<?= base_url('barang'); ?>">
                            <!-- <div class="form-group">
                                <input type="text" class="form-control" id="id" name="id" placeholder="kode barang">
                                <?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div> -->
                            <div class="form-group">
                                <select name="ktg_barang" id="ktg_barang" class="form-control">
                                    <option value="">Pilih kategori</option>
                                    <?php foreach ($ktbarang as $b) : ?>
                                        <option value="<?= $b['id']; ?>"><?= $b['kategori_barang']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <?= form_error('ktg_barang', '<small class="text-danger pl-3">', '</small>'); ?>
                             </div>
                            <div class="form-group">
                                <input type="text" class="form-control" id="namabrg" name="namabrg" placeholder="Nama barang">
                                <?= form_error('namabrg', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control hargaj" id="hbeli" name="hbeli" placeholder="Harga beli">
                                <?= form_error('hbeli', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control hargab" id="hjual" name="hjual" placeholder="Harga jual">
                                <?= form_error('hjual', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <input type="number" class="form-control" id="stok" name="stok" placeholder="Masukkan jumlah barang">
                                <?= form_error('stok', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block mt-3">
                                Tambah barang
                            </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
<script>
    var cleave = new Cleave('.hargaj', {
        numeral: true,
        numeralThousandsGroupStyle: 'thousand'
    });
</script>
<script>
    var cleave = new Cleave('.hargab', {
        numeral: true,
        numeralThousandsGroupStyle: 'thousand'
    });
</script>