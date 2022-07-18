<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <div class="row">
        <div class="col-lg-7">
            <?= form_error('kode_barang', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
            <?= $this->session->flashdata('message'); ?>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="row">
                        <div class="col-lg-6 py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Data kategori</h6>
                        </div>
                        <div class="col-lg-6 py-1">
                            <a href="" class="btn btn-primary mb-3 float-right" data-toggle="modal" data-target="#newKodebarangModal">Tambah kategori barang baru</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="tabel-data-kategori" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">kategori barang</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <!--<tfoot>
                                <tr>
                                    <th>Name</th>
                                    <th>Position</th>
                                    <th>Office</th>
                                </tr>
                            </tfoot>-->
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($kdbarang as $kb) : ?>
                                    <tr>
                                        <th scope="row"><?= $i; ?></th>
                                        <td><?= $kb['kategori_barang']; ?></td>
                                        <td>
                                            <div class="row justify-content-center">
                                                <a href="" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#newUbahKategoriModal" id="btn-edit" data-id="<?= $kb['id']; ?>" data-kategoribarang="<?= $kb['kategori_barang']; ?>"><i class="fas fa-edit"></i>Ubah</a>
                                                <a href="" class="btn btn-danger btn-xs ml-2" data-toggle="modal" data-target="#newHapusKategoriModal<?= $kb['id']; ?>"><i class=" fas fa-trash-alt"></i>Hapus</a>
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
    </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Modal kode barang -->
<div class="modal fade" id="newKodebarangModal" tabindex="-1" aria-labelledby="newKodebarangModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newKodebarangModalLabel">Tambah kategori barang baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('admin/kategoribarang'); ?>" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="kategoribarang" name="kategoribarang" placeholder="Kategori barang" required>
                    </div>
                    <!--<div class="form-group">
                        <input type="text" class="form-control" name="icon" placeholder="Icon">
                    </div>
                    <div class="form-group">
                        <label for="deskripsi">Deskripsi kategori</label>
                        <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3"></textarea>
                    </div>-->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-success">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Ubah kategori -->
<div class="modal fade" id="newUbahKategoriModal" tabindex="-1" aria-labelledby="newUbahKategoriModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newUbahKategoriModalLabel">Ubah kategori barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('admin/ubahkategori'); ?>" method="POST">
                <div class="modal-body">
                    <input type="hidden" name="id" id="id">
                    <div class="form-group">
                        <input type="text" class="form-control" id="kategoribarang" name="kategoribarang" placeholder="Ubah kategori barang" required>
                    </div>
                    <!-- <div class="form-group">
                        <input type="text" class="form-control" id="icon" name="icon" placeholder="Ubah icon" required>
                    </div>
                    <div class="form-group">
                        <label for="deskripsi">Deskripsi kategori</label>
                        <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3"></textarea>
                    </div>-->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
                    <button type="submit" name="ubah" class="btn btn-success">Ubah</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- 
    Harus looping dulu
    biar dpt IDnya
 -->
<?php foreach ($kdbarang as $hkb) : ?>
    <!-- hapus kategori -->
    <div class="modal fade" id="newHapusKategoriModal<?= $hkb['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="newHapusKategoriModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="newHapusKategoriModalLabel">Yakin ingin hapus?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <!-- <div class="modal-body">Pilih "Hapus" jika ingin menghapus.</div> -->
                <div class="modal-body">
                    Mau hapus <?= $hkb['kategori_barang']; ?>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger" type="button" data-dismiss="modal">Batal</button>
                    <a class="btn btn-success" href="<?= base_url('admin/hapuskategori/'); ?><?= $hkb['id']; ?>">Hapus</a>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>