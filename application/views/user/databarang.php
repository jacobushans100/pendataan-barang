<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <?php foreach ($alert_stok as $alert) : ?>
        <?php if ($alert['jumlah'] < 5) : ?>
            <div class="alert alert-danger" role="alert">
                Stok <?= $alert['nama_barang'] ?> kurang dari 5, segera tambahkan!
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
                        <div class="col-lg-6 py-3">
                            <h6 class="m-0 font-weight-bold text-primary mt-2">Barang masuk</h6>
                        </div>
                        <!-- <div class="col-lg-6 py-1">
                            <a href="" class="btn btn-primary float-right" data-toggle="modal" data-target="#newBarangModal">Tambah barang baru</a>
                        </div> -->
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive col-sm">
                        <table class="table table-bordered" id="tabel-data-barang" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th scope="col">No.</th>
                                    <th scope="col">Nama barang</th>
                                    <th scope="col">kategori barang</th>
                                    <th scope="col">Tersedia</th>
                                    <th scope="col">Harga jual</th>
                                    <th scope="col">tanggal_ditambahkan</th>
                                    <th scope="col">aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                                $ttlharga = 0; ?>
                                <?php foreach ($databarang as $br) : ?>
                                    <tr>
                                        <th scope="row"><?= $i; ?></th>
                                        <td><?= $br['nama_barang']; ?></td>
                                        <td><?= $br['kategori_barang']; ?></td>
                                        <td><?= $br['jumlah']; ?></td>
                                        <input type="hidden" value="<?= $br['total_hbeli']; ?>">
                                        <td>Rp.<?= number_format($br['hargajual']); ?>,-</td>
                                        <td><?= date('d F Y H:i', strtotime($br['tanggal_ditambahkan'])); ?></td>
                                        <td>
                                            <div class="row justify-content-center">
                                                <a href="" class="btn btn-info btn-xs ml-2" data-toggle="modal" data-target="#newinfoModal" id="btn-brginfo" data-id="<?= $br['id']; ?>" data-namabrg="<?= $br['nama_barang']; ?>" data-brgid="<?= $br['kategori_barang']; ?>" data-jmlbrg="<?= $br['jumlah']; ?>" data-hbeli="<?= $br['hargabeli']; ?>" data-hjual="<?= $br['hargajual']; ?>" data-ttlhbeli="<?= $br['total_hbeli']; ?>"><i class="fas fa-info-circle"></i></a>
                                                <a href="" class="btn btn-success btn-xs ml-2" data-toggle="modal" data-target="#newTambalstokModal" id="btn-tmbstkbrg" data-id="<?= $br['id']; ?>" data-namabrg="<?= $br['nama_barang']; ?>" data-brgid="<?= $br['kategori_barang']; ?>" data-jmlbrg="<?= $br['jumlah']; ?>"><i class="fas fa-plus"></i></a>
                                                <a href="" class="btn btn-warning btn-xs ml-2" data-toggle="modal" data-target="#newUbahBarangModal" id="btn-brgedit" data-id="<?= $br['id']; ?>" data-namabrg="<?= $br['nama_barang']; ?>" data-brgid="<?= $br['ktbarang']; ?>" data-jmlbrg="<?= $br['jumlah']; ?>" data-hbeli="<?= $br['hargabeli']; ?>" data-hjual="<?= $br['hargajual']; ?>"><i class="fas fa-edit"></i></a>
                                                <a href="" class="btn btn-danger btn-xs ml-2" data-toggle="modal" data-target="#newHapusBarangModal<?= $br['id']; ?>"><i class="fas fa-trash-alt"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php $i++; ?>
                                    <?php $ttlharga += $br['total_hbeli']; ?>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- <div class="form-group">
                            <div class="row pt-3">
                                 <label class="col-sm-1 col-form-label"><h3>Modal</h3></label>
                                 <label class="col-sm col-form-label" id="totalmodal"><h3>: Rp.<?= number_format($ttlharga); ?>,-</h3></label>
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

<!-- Tambah barang Modal -->
<div class="modal fade" id="newBarangModal" tabindex="-1" aria-labelledby="newBarangModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newBarangModalLabel">Tambah barang baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('user/databarang'); ?>" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="nmbarang" name="nmbarang" placeholder="Nama barang">
                    </div>
                    <div class="form-group">
                        <select name="kd_barang" id="kd_barang" class="form-control">
                            <option value="">Pilih kategori</option>
                            <?php foreach ($ktbarang as $b) : ?>
                                <option value="<?= $b['kategori_barang']; ?>"><?= $b['kategori_barang']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="number" class="form-control" id="jmlbarang" name="jmlbarang" placeholder="Jumlah barang">
                    </div>
                    <!--<div class="form-group">
                        <input type="number" class="form-control" id="hbeli" name="hbeli" placeholder="Harga beli">
                    </div>-->
                    <div class="form-group">
                        <input type="number" class="form-control" id="hjual" name="hjual" placeholder="Harga jual">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-success">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- info barang -->
<div class="modal fade" id="newinfoModal" tabindex="-1" aria-labelledby="newinfoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newinfoModalLabel">Info barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <div class="row pt">
                            <input type="hidden" name="id" id="id">
                            <label for="inputEmail3" class="col-sm-3 col-form-label">Nama barang</label>
                            <label for="inputEmail3" class="col-sm col-form-label" id="namabarang">:</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row pt">
                            <label for="inputEmail3" class="col-sm-3 col-form-label">Kategori</label>
                            <label for="inputEmail3" class="col-sm col-form-label" id="kategori">:</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row pt">
                            <label for="inputEmail3" class="col-sm-3 col-form-label">Harga beli</label>
                            <label for="inputEmail3" class="col-sm col-form-label" id="hbeli">:</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row pt">
                            <label for="inputEmail3" class="col-sm-3 col-form-label">harga jual</label>
                            <label for="inputEmail3" class="col-sm col-form-label" id="hjual">:</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row pt">
                            <label for="inputEmail3" class="col-sm-3 col-form-label">Stok saat ini</label>
                            <label for="inputEmail3" class="col-sm col-form-label" id="jmlbarang">:</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row pt">
                            <label for="inputEmail3" class="col-sm-3 col-form-label">total harga beli</label>
                            <label for="inputEmail3" class="col-sm col-form-label" id="ttlhbeli">:</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Tambah stok -->
<div class="modal fade" id="newTambalstokModal" tabindex="-1" aria-labelledby="newTambalstokModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newTambalstokModalLabel">Tambah stok barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('user/tambahstok'); ?>" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <div class="row pt">
                            <input type="hidden" name="id" id="id">
                            <label for="inputEmail3" class="col-sm-3 col-form-label">Nama barang</label>
                            <label for="inputEmail3" class="col-sm col-form-label" id="namabarang">:</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row pt">
                            <input type="hidden" name="id" id="id">
                            <label for="inputEmail3" class="col-sm-3 col-form-label">Kategori</label>
                            <label for="inputEmail3" class="col-sm col-form-label" id="kategori">:</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row pt">
                            <input type="hidden" name="id" id="id">
                            <label for="inputEmail3" class="col-sm-3 col-form-label">Stok saat ini</label>
                            <label for="inputEmail3" class="col-sm col-form-label" id="jmlbarang">:</label>
                        </div>
                    </div>
                    <div class="row pt-3">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">Masukkan jumlah stok</label>
                        <div class="col-sm">
                            <input type="number" id="jmlstok" name="jmlstok" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-success">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Ubah barang -->
<div class="modal fade" id="newUbahBarangModal" tabindex="-1" aria-labelledby="newUbahBarangModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newUbahBarangModalLabel">Ubah data barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('user/ubahbarang'); ?>" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="hidden" name="id" id="id">
                        <input type="hidden" name="jml" id="jml">
                        <input type="text" class="form-control" id="nama_barang" name="nama_barang" placeholder="Ubah nama barang" required>
                    </div>
                    <div class="form-group">
                        <select name="kd_barang" id="kd_barang" class="form-control">
                            <option value="">Pilih kategori</option>
                            <?php foreach ($ktbarang as $b) : ?>
                                <option value="<?= $b['id']; ?>"><?= $b['kategori_barang']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control hargab" id="hbeli" name="hbeli" placeholder="Harga beli">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control harga" id="hjual" name="hjual" placeholder="Harga jual">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
                    <button type="submit" name="ubah" class="btn btn-success">Ubah</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- hapus data barang -->
<?php foreach ($barang as $b) : ?>
    <div class="modal fade" id="newHapusBarangModal<?= $b['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="newHapusBarangModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="newHapusBarangModalLabel">Yakin ingin hapus?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <!-- <div class="modal-body">Pilih "Hapus" jika ingin menghapus.</div> -->
                <div class="modal-body">
                    Mau hapus <?= $b['nama_barang']; ?>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger" type="button" data-dismiss="modal">Batal</button>
                    <a class="btn btn-success" href="<?= base_url('user/hapusdatabarang/'); ?><?= $b['id']; ?>">Hapus</a>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<script>
    var cleave = new Cleave('.harga', {
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
<script>
    $('input[name=hbeli]').change(function() {
        let hbeli = $(this).val();
        const ttlmodal = +hbeli;

        $("#totalmodal").html(ttlmodal);
        // $("#totalmodal").html("Rp. " + ttlmodal + ",-");
    });
</script>