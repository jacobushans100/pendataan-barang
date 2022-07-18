<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <div class="row">
        <div class="col-lg-6 offset-3">
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
                            <h6 class="m-0 font-weight-bold text-primary mt-2">Tambah data</h6>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form class="user" method="POST" action="<?= base_url('admin/aturuser'); ?>">
                        <div class="form-group">
                            <input type="text" class="form-control" id="name" name="name" placeholder="nama" value="<?= set_value('name'); ?>">
                            <?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="email" name="email" placeholder="Email Address" aria-describedby="emailHelp" value="<?= set_value('email'); ?>">
                            <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <select name="role" id="role" class="form-control">
                                <option value="">Pilih Level</option>
                                <option value="1">Admin</option>
                                <option value="2">User</option>
                            </select>
                            <?= form_error('ktg_barang', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="password" class="form-control" id="password1" name="password1" placeholder="Password">
                                <?= form_error('password1', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="col-sm-6">
                                <input type="password" class="form-control" id="password2" name="password2" placeholder="Ulang Password">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block mt-3">
                            Tambah pengguna
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
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
                                    <th scope="col">aksi</th>
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
                                        <td>
                                            <div class="row justify-content-center">
                                                <a href="" class="btn btn-warning btn-xs ml-2" data-toggle="modal" data-target="#editsuser" id="btn-useredit" data-id="<?= $u['id']; ?>" data-roleid="<?= $u['role_id']; ?>" data-isactive="<?= $u['is_active']; ?>"><i class="fas fa-fw fa-wrench"></i></a>
                                                <a href="" class="btn btn-danger btn-xs ml-2" data-toggle="modal" data-target="#hapususer<?= $u['id']; ?>"><i class="fas fa-trash-alt"></i></a>
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

    <!-- /.container-fluid -->

</div>

<!-- Edit user -->
<div class="modal fade" id="editsuser" tabindex="-1" role="dialog" aria-labelledby="editsuserLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editsuserLabel">Edit user</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="<?= base_url('admin/edituser'); ?>">
                    <div class="form-group">
                        <input type="hidden" name="id" id="id">
                    </div>
                    <div class="form-group">
                        <select name="roleid" id="roleid" class="form-control">
                            <option value="">Pilih level</option>
                            <option value="1">Admin</option>
                            <option value="2">User</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <select name="isactive" id="isactive" class="form-control">
                            <option value="1">Ya</option>
                            <option value="0">Tidak</option>
                        </select>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
                            <button type="submit" name="ubah" class="btn btn-success">Ubah</button>
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>

<!-- Hapus user -->
<?php foreach ($datauser as $us) : ?>
    <div class="modal fade" id="hapususer<?= $us['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="hapususerLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="hapususerLabel">Yakin ingin hapus?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Pilih "Hapus" jika ingin menghapus.</div>
                <div class="modal-body">
                    Mau hapus <?= $us['name']; ?>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger" type="button" data-dismiss="modal">Batal</button>
                    <a class="btn btn-success" href="<?= base_url('admin/hapususer/'); ?><?= $us['id']; ?>">Hapus</a>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>