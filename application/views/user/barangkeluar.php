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
                            <h6 class="m-0 font-weight-bold text-primary mt-2">Barang keluar</h6>
                        </div>
                        <div class="col-lg py-1">
                            <!-- <a href="<?= base_url('user/transaksi'); ?>" class="btn btn-primary float-right">Tambah transaksi baru</a> -->
                            <!-- <?php if ($this->session->userdata('role_id') == 1) : ?>
                                <a href="" data-toggle="modal" data-target="#resetSemua" class="btn btn-danger"><i class="fas fa-ban"></i>Reset</a></td>
                            <?php else : ?>
                            <?php endif; ?> -->
                            <a href="<?= base_url('user/cetakbarangkeluar') ?>" class="btn btn-primary"><i class="fas fa-book"></i>Cetak</a></td>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="tabel-barang-keluar" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th scope="col">No.</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">kategori</th>
                                    <th scope="col">Harga</th>
                                    <th scope="col">Tanggal dan waktu</th>
                                    <th scope="col">jumlah</th>
                                    <th scope="col">Toal harga</th>
                                    <th scope="col">Aksi</th>
                                    <!--<th scope="col">aksi</th>-->
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                                $ttlkeuntungan = 0; ?>
                                <?php foreach ($brgkeluar as $t) : ?>
                                    <tr>
                                        <th scope="row"><?= $i; ?></th>
                                        <td><?= $t['nama_barang']; ?></td>
                                        <td><?= $t['kategori_barang']; ?></td>
                                        <td>Rp.<?= number_format($t['harga']); ?>,-</td>
                                        <td><?= date('d F Y, H:i', strtotime($t['tanggal'])); ?></td>
                                        <td><?= $t['jumlah_barang']; ?></td>
                                        <td><?= number_format($t['harga_total']); ?></td>
                                        <td>
                                            <a href="" class="btn btn-danger btn-xs ml-2" data-toggle="modal" data-target="#hapusbrgkeluar<?= $t['id_barangkeluar']; ?>"><i class="fas fa-trash-alt"></i></a>
                                        </td>
                                    </tr>
                                    <?php $i++; ?>
                                    <!-- iyalah, totalnya lu itung manual di luar datatable, bukan bjir. Itu lu nambahin sendiri ga dari sananya terus caranya? -->
                                    <?php $ttlkeuntungan += $t['harga_total']; ?>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Reset semua -->
<div class="modal fade" id="resetSemua" tabindex="-1" role="dialog" aria-labelledby="resetSemuaLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="resetSemuaLabel">Yakin ingin hapus?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <!-- <div class="modal-body">Pilih "Hapus" jika ingin menghapus.</div> -->
            <div class="modal-body">
                Semua data akan dihapus!
            </div>
            <div class="modal-footer">
                <button class="btn btn-danger" type="button" data-dismiss="modal">Batal</button>
                <a class="btn btn-warning" href="<?= base_url('user/resetriwayat') ?>">Hapus</a>
            </div>
        </div>
    </div>
</div>

<!-- hapus barang keluar -->
<?php foreach ($brgkeluar as $bk) : ?>
    <div class="modal fade" id="hapusbrgkeluar<?= $bk['id_barangkeluar']; ?>" tabindex="-1" role="dialog" aria-labelledby="hapusbrgkeluarLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="hapusbrgkeluarLabel">Yakin ingin hapus?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <!-- <div class="modal-body">Pilih "Hapus" jika ingin menghapus.</div> -->
                <div class="modal-body">
                    Mau hapus <?= $bk['nama_barang']; ?>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger" type="button" data-dismiss="modal">Batal</button>
                    <a class="btn btn-success" href="<?= base_url('user/hapusbarang/'); ?><?= $bk['id_barangkeluar']; ?>">Hapus</a>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>