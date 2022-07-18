<!-- Begin Page Content -->
<div class="container-fluid">
    <?php foreach ($alert_stok as $alert) : ?>
        <?php if ($alert['jumlah'] < 5) : ?>
            <div class="alert alert-danger" role="alert">
                Stok <?= $alert['nama_barang'] ?> kurang dari 5! <a href="<?= base_url('barang/databarang') ?>">Klik untuk menambah stok</a>
            </div>
        <?php endif; ?>
    <?php endforeach; ?>
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <div class="row">
        <div class="col-lg-6">
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
                                    <th scope="col">Kategori</th>
                                    <th scope="col">Harga</th>
                                    <th scope="col">Stok</th>
                                    <th scope="col">aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($barang as $b) : ?>
                                    <tr>
                                        <th scope="row"><?= $i; ?></th>
                                        <td><?= $b['nama_barang']; ?></td>
                                        <td><?= $b['kategori_barang'] ?></td>
                                        <td>Rp.<?= number_format($b['hargajual']); ?>,-</td>
                                        <td><?= $b['jumlah']; ?></td>
                                        <td>
                                            <div class="row justify-content-center">
                                                <a href="<?= base_url('user/beliproduk/') ?><?= $b['id'] ?><?= ('/'); ?><?= $b['hargajual'] ?><?= ('/'); ?><?= $b['ktbarang'] ?>" class="btn btn-primary btn-xs"></i>Pilih</a>
                                                <!-- <a href="#" class="btn btn-primary btn-xs" id="pilih" data-id="<?= $b['id'] ?>" nama="<?= $b['nama_barang'] ?>" jumlah="<?= $b['jumlah'] ?>" jual="<?= $b['harga'] ?>" kategori="<?= $b['ktbarang'] ?>"></i>Pilih</a> -->
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
        <div class="col-lg-6">
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
                            <h6 class="m-0 font-weight-bold text-primary mt-2">Simpan</h6>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive col-sm">
                        <table class="table table-bordered" id="tabel-detailbeli" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th scope="col">No.</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Kategori</th>
                                    <th scope="col">Harga</th>
                                    <th scope="col">jumlah</th>
                                    <th scope="col">total harga</th>
                                    <th scope="col">aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                                $total_harga = 0; ?>
                                <?php foreach ($keranjang as $b) : ?>
                                    <tr>
                                        <th scope="row"><?= $i; ?></th>
                                        <td><?= $b['nama_barang']; ?></td>
                                        <td><?= $b['kategori_barang']; ?></td>
                                        <td>Rp.<?= number_format($b['harga']); ?>,-</td>
                                        <td>
                                            <form method="POST" action="<?= base_url('user/updatebeli'); ?>">
                                                <input type="hidden" id="id" name="id" value="<?= $b['id_simpan']; ?>" class="form-control"></input>
                                                <input type="hidden" id="harga" name="harga" value="<?= $b['harga']; ?>" class="form-control"></input>
                                                <input type="number" id="jml" name="jml" value="<?= $b['jumlahbarang']; ?>" class="form-control"></input>
                                        </td>
                                        <td>RP.<?= number_format($b['total']); ?>,-</td>
                                        <td>
                                            <div class="row justify-content-center">
                                                <button type="submit" class="btn btn-warning">Update</button>
                                                </form>
                                                <a href="<?= base_url('user/hapusbeli/') ?><?= $b['id_simpan'] ?>" class="btn btn-danger btn-xs"></i>Hapus</a>
                                                <!-- <a href="#" class="btn btn-primary btn-xs" id="pilih" data-id="<?= $b['id'] ?>" nama="<?= $b['nama_barang'] ?>" jumlah="<?= $b['jumlah'] ?>" jual="<?= $b['harga'] ?>" kategori="<?= $b['ktbarang'] ?>"></i>Pilih</a> -->
                                            </div>
                                        </td>
                                    </tr>
                                    <?php $i++; ?>
                                    <?php $total_harga += $b['total']; ?>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <!--  -->
                        <!-- emg blm bisa masuk ke db?
                        
                        itu kok data pembeliannya kesimpen?
                        ya yaudah ambil dari sana aja
                        bingung di mana?
                        trus dihapus kalo udh dimasukin ke db yg baru

                        ayoo mikir
                        coba lu udah sampe mana mikirnya?
                         -->
                        <?php foreach ($simpan as $b) : ?>
                            <form method="POST" action="<?= base_url('user/simpanBarangBaru'); ?>">
                                <input type="hidden" name="idproduk" value="<?php echo $b['id_produk']; ?>">
                                <!-- <input type="hidden" name="nmbarang" value="?php echo $b['nama_barang']; ?>"> -->
                                <input type="hidden" name="ktbarang" value="<?php echo $b['kategori_produk']; ?>">
                                <input type="hidden" name="harga" value="<?php echo $b['harga']; ?>">
                                <input type="hidden" name="jml" value="<?php echo $b['jumlahbarang']; ?>">
                                <input type="hidden" name="ttl_harga" value="<?php echo $b['total']; ?>">
                            <?php endforeach; ?>
                            <!-- <tr>
													<td>Total Semua  </td>
													<td><input type="text" class="form-control"  name="total" value="<?= number_format($total_harga); ?>" readonly></td>

													<td>Bayar  </td>
													<td><input type="text" id="bayar" class="form-control bayar" name="bayar" ></td>
												</tr>
                                                <tr>
												<td>Kembali</td>
												<td><input type="text" id="kembali" class="form-control kembalian" name="kembali" readonly></td>
												<td><hr class="sidebar-divider mt-3"></td> -->
                            <div class="row">
                                <div class="col-lg-2 py-3">
                                    <td><button type="submit" id="simpan" class="btn btn-success"><i class="fas fa-notes-medical"></i>Simpan</button></td>
                            </form>
                    </div>
                    <div class="col-lg-6 py-3">
                        <td><a href="<?= base_url('user/resetkeranjang') ?>" class="btn btn-danger"><i class="fas fa-ban"></i>Reset</a></td>
                    </div>
                </div>
                </tr>
            </div>
        </div>
    </div>
</div>



</div>
<!-- /.container-fluid -->

</div>
</div>
<script>
    var cleave = new Cleave('.bayar', {
        numeral: true,
        numeralThousandsGroupStyle: 'thousand',
        onValueChanged: function(e) {
            bayar = e.target.rawValue
            const totalHarga = <?php echo $total_harga; ?>

            kembalian = bayar - totalHarga
            if (kembalian > 0) {
                $('#kembali').val(kembalian)
                $("#simpan").prop('disabled', false);
            } else {
                $('#kembali').val(0)
                $("#simpan").prop('disabled', true);
            }
        }
    });
    // dahlah cari cara sendiri wkwkwk
    // gua mau lanjut tidur
    var cleave2 = new Cleave('.kembalian', {
        numeral: true,
        numeralThousandsGroupStyle: 'thousand',
    });
</script>
<script>
</script>