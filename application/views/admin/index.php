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
        <div class="col-xl-3 col-md-6">
            <?php foreach ($jmlbarang as $jb) : ?>
                <div class="card bg-primary text-white mb-4">
                    <div class="card-body">Total barang di inventori</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="medium text-dark stretched-link"><?= $jb['jumlah'] ?></a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-dark stretched-link" href="<?= base_url('barang/databarang') ?>">Lihat</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="col-xl-3 col-md-6">
            <?php foreach ($jmlbrgkeluar as $jbk) : ?>
                <div class="card bg-info text-white mb-4">
                    <div class="card-body">Total barang keluar</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="medium text-dark stretched-link"><?= $jbk['jumlah_barang'] ?></a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-dark stretched-link" href="<?= base_url('user/barangkeluar') ?>">Lihat</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="col-xl-3 col-md-6">
            <?php foreach ($jmlbrgb as $jbb) : ?>
                <div class="card bg-warning text-white mb-4">
                    <div class="card-body">Total modal</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="medium text-dark stretched-link">Rp.<?= number_format($jbb['total_hbeli']) ?>,-</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-dark stretched-link"></a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="col-xl-3 col-md-6">
            <?php foreach ($tbrg as $tb) : ?>
                <div class="card bg-success text-white mb-4">
                    <div class="card-body">Total pendapatan</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="medium text-dark stretched-link">Rp.<?= number_format($tb['harga_total']) ?>,-</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-dark stretched-link"></a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <!-- <div class="col-xl-3 col-md-6">
            <?php foreach ($jmlbrgb as $jbb) : ?>
                <?php foreach ($tbrg as $tb) : ?>
                    <?php $ttlharga = 0; ?>
                    <div class="card bg-danger text-white mb-4">
                        <div class="card-body">Total keuntungan</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="medium text-dark stretched-link">Rp.<?= number_format($ttlharga = $tb['harga_total'] - $jbb['total_hbeli']); ?>,-</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-dark stretched-link"></a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                            <input type="hidden" value="<?= $tb['harga_total'] ?>">
                            <input type="hidden" value="<?= $jbb['total_hbeli'] ?>">
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endforeach; ?>
        </div> -->
    </div>

    <div class="class row">
        <?php foreach ($card as $c) : ?>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"> <?= $c['kategori_barang'] ?></div>
                                <div class="h5 mb-0 text-gray-800">
                                    <p class="card-text"><small><?= $c['jumlah']; ?></small></p>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class=""></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach ?>
    </div>
</div>
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg">
            <?= $this->session->flashdata('message'); ?>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="row">
                        <div class="col-lg-6 py-3">
                            <h6 class="m-0 font-weight-bold text-primary mt-2">Data pengguna</h6>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="tabel-data-barang" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th scope="col">No.</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Peran</th>
                                    <th scope="col">Dibuat</th>
                                    <th scope="col">Aktif</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($datauser as $u) : ?>
                                    <tr>
                                        <th scope="row"><?= $i; ?></th>
                                        <td><?= $u['name']; ?></td>
                                        <td><?= $u['email']; ?></td>
                                        <td><?php if ($u['role_id'] == 1) : ?>
                                                <span class="badge badge-pill badge-primary">Admin</span>
                                            <?php else : ?>
                                                <span class="badge badge-pill badge-info">User</span>
                                            <?php endif; ?>
                                        </td>
                                        <td><?= date('d F Y, H:i', strtotime($u['date_created'])); ?></td>
                                        <td><?php if ($u['is_active'] == 1) : ?>
                                                <span class="badge badge-pill badge-primary">Ya</span>
                                            <?php else : ?>
                                                <span class="badge badge-pill badge-secondary">Tidak</span>
                                            <?php endif; ?>
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
    </div>

    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->