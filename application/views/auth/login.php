<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center mt-5">

        <div class="col-xl-6 col-lg-12 col-md-9">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <!--<div class="col-lg-6 d-none d-lg-block bg-login-image"></div>-->
                        <div class="col-lg">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Halaman login</h1>
                                </div>
                                <?= $this->session->flashdata('message'); ?>
                                <form class="user" method="POST" action="<?= base_url('auth'); ?>">
                                    <div class="input-group is-invalid">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="validatedInputGroupPrepend"><i class="fas fa-user"></i></span>
                                        </div>
                                        <input type="text" class="form-control " id="email" name="email" placeholder="Email " value="<?= set_value('email'); ?>">
                                    </div>
                                    <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                                    <div class="mb-3 mt-4">
                                        <div class="input-group is-invalid">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="validatedInputGroupPrepend"><i class="fas fa-lock"></i></span>
                                            </div>
                                            <input type="password" class="form-control " id="password" name="password" placeholder="Password">
                                        </div>
                                        <?= form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                    <div id="loading">
                                    </div>
                                    <button type="submit" id="formLogin" class="btn btn-primary btn-user btn-block">
                                        Login
                                    </button>
                                </form>
                                <hr>
                                <!--<div class="text-center">
                                    <label for="atau">Atau</label>
                                </div>
                                <div class="form-group row">
                                    <div class="button col-sm-6">
                                        <a class="btn btn-warning btn-user btn-block" href="#">Lupa Password?</a>
                                    </div>-->
                                <!-- <div class="text-center">
                                    <a href="<?= base_url('auth/registration'); ?>">tambah akun!</a>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>

</div>