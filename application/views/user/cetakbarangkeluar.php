<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <?php foreach ($alert_stok as $alert) : ?>
        <?php if ($alert['jumlah'] < 5) : ?>
            <div class="alert alert-danger" role="alert">
                Stok <?= $alert['nama_barang'] ?> kurang dari 5! <a href="<?= base_url('barang/databarang') ?>">Klik untuk menambah stok</a>
            </div>
        <?php endif; ?>
    <?php endforeach; ?>
    <div class="row">
        <div class="col-lg">
            <?php if (validation_errors()) : ?>
                <div class="alert alert-danger" role="alert">
                    <?= validation_errors(); ?>
                </div>
            <?php endif; ?>
            <?= $this->session->flashdata('message'); ?>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="row">
                        <div class="col-lg-11 py-3">
                            <h6 class="m-0 font-weight-bold text-primary mt-2">Cetak Barang keluar</h6>
                        </div>
                        <div class="col-lg py-1">
                            <a href="<?= base_url('user/barangkeluar') ?>" class="btn btn-primary"><i class="fas fa-back"></i>Kembali</a></td>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="tabel-data-penjualan" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th scope="col">No.</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">kategori</th>
                                    <th scope="col">Harga</th>
                                    <th scope="col">Tanggal dan waktu</th>
                                    <th scope="col">jumlah</th>
                                    <th scope="col">Toal harga</th>
                                    <!--<th scope="col">aksi</th>-->
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                                $ttlkeuntungan = 0; ?>
                                <?php foreach ($transaksi as $t) : ?>
                                    <tr>
                                        <th scope="row"><?= $i; ?></th>
                                        <td><?= $t['nama_barang']; ?></td>
                                        <td><?= $t['kategori']; ?></td>
                                        <td>Rp.<?= number_format($t['harga']); ?>,-</td>
                                        <td><?= date('d F Y, H:i', strtotime($t['tanggal'])); ?></td>
                                        <td><?= $t['jumlah']; ?></td>
                                        <td><?= number_format($t['harga_total']); ?></td>
                                        <!--<td>
                                            <div class="row justify-content-center">
                                                <a href="" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#newUbahBarangModal" id="btn-brgedit" data-id="<?= $t['id_transaksi']; ?>" data-namabrg="<?= $t['nama']; ?>" data-brgid="<?= $t['kategori']; ?>" data-hrg="<?= $t['harga']; ?>" data-tanggal="<?= $t['tanggal']; ?>" data-jmlbrg="<?= $t['jumlah']; ?>"><i class="fas fa-edit"></i>Ubah</a>
                                                <a href="" class="btn btn-danger btn-xs ml-2" data-toggle="modal" data-target="#newHapusBarangModal<?= $t['id_transaksi']; ?>"><i class="fas fa-trash-alt"></i>Hapus</a>
                                            </div>
                                        </td>-->
                                    </tr>
                                    <?php $i++; ?>
                                    <!-- iyalah, totalnya lu itung manual di luar datatable, bukan bjir. Itu lu nambahin sendiri ga dari sananya terus caranya? -->
                                    <?php $ttlkeuntungan += $t['harga_total']; ?>
                                <?php endforeach; ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th>Total</th>
                                    <th></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- <div class="form-group">
                            <div class="row pt-3">
                                 <label class="col-sm-2 col-form-label"><h3>Total pemasukkan</h3></label>
                                 <label class="col-sm col-form-label" id="totalmodal"><h3>: Rp.<?= number_format($ttlkeuntungan); ?>,-</h3></label>
                            </div>
                        </div> -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->