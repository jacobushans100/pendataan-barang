<!-- Begin Page Content -->
<div class="container-fluid">
    <?= $this->session->flashdata('message'); ?>
    <!-- Page Heading -->
    <!-- <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <div class="card" style="width: 18rem;">
        <div class="custom-file">
                                <input type="file" class="custom-file-input" id="image" name="image">
                                <label class="custom-file-label" for="image">Cari Foto</label>
              </div>
    </div> -->
    <div class="row">
        <!-- <div class="col-sm-4 mt-1">
            <div class="card">
                <div class="card-body">
                    <div class="row pt-3">
                        <label for="nama" class="col-sm-3 col-form-label">Nama</label>
                        <label for="nama" class="col-sm col-form-label"> : <?= $user['name']; ?></label>
                    </div>
                    <div class="row pt-3">
                        <label for="nama" class="col-sm-3 col-form-label">Email</label>
                        <label for="nama" class="col-sm col-form-label"> : <?= $user['email']; ?></label>
                    </div>
                    <div class="row pt-3">
                        <label for="nama" class="col-sm-3 col-form-label">Tanggal dibuat</label>
                        <label for="nama" class="col-sm col-form-label"> : <?= date('d F Y H:i', strtotime($user['date_created'])); ?></label>
                    </div>
                </div>
            </div>
        </div>  -->
        <div class="col-sm-4 mt-1">
            <div class="card">
                <div class="card-header bg-success">
                    <font color="#ffffff">Profil</font>
                </div>
                <div class="card-body">
                    <center><img src="<?= base_url('assets/img/profile/') . $user['image']; ?>" alt="#" style="width:200px;border:4px solid #ddd;" /></center>
                    <div class="card-body">
                        <div class="row pt-3">
                            <label for="nama" class="col-sm-3 col-form-label">Nama</label>
                            <label for="nama" class="col-sm col-form-label"> : <?= $user['name']; ?></label>
                        </div>
                        <div class="row pt-3">
                            <label for="nama" class="col-sm-3 col-form-label">Email</label>
                            <label for="nama" class="col-sm col-form-label"> : <?= $user['email']; ?></label>
                        </div>
                        <div class="row pt-3">
                            <label for="nama" class="col-sm-3 col-form-label">Tanggal dibuat</label>
                            <label for="nama" class="col-sm col-form-label"> : <?= date('d F Y H:i', strtotime($user['date_created'])); ?></label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-4 mt-1">
            <div class="card">
                <div class="card-header bg-success">
                    <font color="#ffffff">Ubah profil</font>
                </div>
                <div class="card-body">
                    <?= form_open_multipart('user/edit'); ?>
                    <div class="form-group row">
                        <label for="email" class="col-sm-3 col-form-label">Email</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="email" name="email" value="<?= $user['email']; ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="name" class="col-sm-3 col-form-label">Nama Lengkap</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="name" name="name" value="<?= $user['name']; ?>">
                            <?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-2">Foto</div>
                        <div class="col-sm-10">
                            <div class="row">
                                <div class="col-sm-3">
                                    <img src="<?= base_url('assets/img/profile/') . $user['image']; ?>" class="img-thumbnail">
                                </div>
                                <div class="col-sm-9">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="image" name="image">
                                        <label class="custom-file-label" for="image">Cari Foto</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row justify-content-end">
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-primary">Ubah</button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-sm-4 mt-1">
            <div class="card">
                <div class="card-header bg-success">
                    <font color="#ffffff">Ubah password</font>
                </div>
                <div class="card-body">
                    <form action="<?= base_url('user/changepassword'); ?>" method="POST">
                        <div class="mb-3 mt-4">
                            <div class="input-group is-invalid">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="validatedInputGroupPrepend"><i class="fas fa-lock"></i></span>
                                </div>
                                <input type="password" class="form-control " id="current_password" name="current_password" placeholder="Password lama">
                            </div>
                        </div>
                        <div class="mb-3 mt-4">
                            <div class="input-group is-invalid">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="validatedInputGroupPrepend"><i class="fas fa-lock"></i></span>
                                </div>
                                <input type="password" class="form-control " id="new_password1" name="new_password1" placeholder="Password baru">
                            </div>
                            <?= form_error('new_password1', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="mb-3 mt-4">
                            <div class="input-group is-invalid">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="validatedInputGroupPrepend"><i class="fas fa-lock"></i></span>
                                </div>
                                <input type="password" class="form-control " id="new_password2" name="new_password2" placeholder="Konfirmasi password baru">
                            </div>
                            <?= form_error('new_password2', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="form-group row justify-content-end">
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-primary">Ubah</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->