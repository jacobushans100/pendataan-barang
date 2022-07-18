<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <div class="row">
        <div class="col-lg-5">
            <?php if (validation_errors()) : ?>
                <div class="alert alert-danger" role="alert">
                    <?= validation_errors(); ?>
                </div>
            <?php endif; ?>
            <?= $this->session->flashdata('message'); ?>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="row">
                        <div class="col-lg-6 py-3">
                            <h6 class="m-0 font-weight-bold text-primary mt-2">Data barang</h6>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive col-sm">
                        <table class="table table-bordered" id="tabel-data-barang" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th scope="col">No.</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($barang as $b) : ?>
                                    <tr>
                                        <th scope="row"><?= $i; ?></th>
                                        <td><?= $b['nama_barang']; ?></td>
                                        <td>
                                            <div class="row justify-content-center">
                                                <a href="#" class="btn btn-primary btn-xs" id="pilih" data-id="<?= $b['id'] ?>" nama="<?= $b['nama_barang'] ?>" jumlah="<?= $b['jumlah'] ?>" jual="<?= $b['harga'] ?>" kategori="<?= $b['ktbarang'] ?>"></i>Pilih</a>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php $i++; ?>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="row">
                        <div class="col-lg-6 py-3">
                            <h6 class="m-0 font-weight-bold text-primary mt-2">Buat transaksi</h6>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form method="POST" action="<?= base_url('user/catatTransaksi') ?>">
                        <input type="hidden" name="id" id="id">
                        <div class="row">
                            <label for="inputEmail3" class="col-sm-3 col-form-label">Nama barang</label>
                            <div class="col-sm">
                                <fieldset>
                                    <input type="text" id="namaBarang" name="namaBarang" class="form-control" placeholder="Nama barang" readonly>
                                </fieldset>
                            </div>
                        </div>
                            <input type="hidden" id="kategoriBarang" name="kategoriBarang" class="form-control" placeholder="Kategori barang" readonly>
                        <!-- <div class="row pt-3">
                            <label for="inputEmail3" class="col-sm-3 col-form-label">Kategori barang</label>
                            <div class="col-sm">
                                <fieldset>
                                </fieldset>
                            </div>
                        </div> -->
                        <div class="row pt-3">
                            <label for="inputEmail3" class="col-sm-3 col-form-label">Harga</label>
                            <div class="col-sm">
                                <fieldset a>
                                    <input type="number" id="hargaJual" name="hargaJual" class="form-control" placeholder="Harga" readonly>
                                </fieldset>
                            </div>
                        </div>
                        <div class="row pt-3">
                            <label for="inputEmail3" class="col-sm-3 col-form-label">Stok</label>
                            <div class="col-sm">
                                <fieldset readonly>
                                    <input type="text" id="jumlah_barang" name="jumlah_barang" class="form-control" placeholder="Jumlah stok" readonly>
                                </fieldset>
                            </div>
                        </div>
                        <!--<div class="row pt-3">
                            <label for="inputEmail3" class="col-sm-3 col-form-label">tanggal</label>
                            <div class="col-sm">
                                <input type="date" id="tanggal" name="tanggal" class="form-control">
                            </div>
                        </div>-->
                        <div class="row pt-3">
                            <label for="inputEmail3" class="col-sm-3 col-form-label">Jumlah dibeli</label>
                            <div class="col-sm">
                                <input type="number" id="qty" name="qty" class="form-control">
                            </div>
                        </div>
                        <div class="row pt-3">
                            <label for="inputEmail3" class="col-sm-3 col-form-label">Jumlah uang</label>
                            <div class="col-sm">
                                <input type="number" id="ttluang" name="ttluang" class="form-control ">
                            </div>
                        </div>
                        <div class="row pt-3">
                            <label for="inputEmail3" class="col-sm-3 col-form-label">total Harga</label>
                            <div class="col-sm">
                                <fieldset>
                                    <input type="number" id="totalHarga" name="totalHarga" class="form-control" readonly>
                                </fieldset>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row pt-3">
                                <label for="inputEmail3" class="col-sm-3 col-form-label">Total kembalian</label>
                                <label for="inputEmail3" class="col-sm col-form-label" id="uangKembali">:</label>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <button type="submit" class="btn btn-success offset-2" id="buatTransaksi">Buat</button>
                            <a href="<?= base_url('user/transaksi'); ?>" class="btn btn-danger ml-3">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->

</div>
</div>
<!-- End of Main Content -->
<script>
    var cleave = new Cleave('.hnumber', {
        numeral: true,
        numeralThousandsGroupStyle: 'thousand'
    });
</script>