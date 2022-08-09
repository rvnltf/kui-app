<?= $this->extend('auth/templates/index') ?>
<?= $this->section('content') ?>
<div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg">
                    <div class="p-4">
                        <div class="mb-3">
                            <h1 class="h4 text-gray-900">Create an Account!</h1>
                            <p class="text-gray">Don't have a account. <a class="small" href="<?= url_to('login') ?>">Sign in</a></p>
                        </div>
                        <?= view('Myth\Auth\Views\_message_block') ?>
                        <form action="<?= url_to('register') ?>" method="post" class="user" enctype="multipart/form-data">
                            <?= csrf_field() ?>
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="fullname">Fullname</label>
                                    <input type="text" class="form-control form-control-user <?php if (session('errors.fullname')) : ?>is-invalid<?php endif ?>" id="fullname" name="fullname" placeholder="Fullname" value="<?= old('fullname') ?>">
                                </div>
                                <div class="col-md-6">
                                    <label for="nim">NIM</label>
                                    <input type="text" class="form-control form-control-user <?php if (session('errors.nim')) : ?>is-invalid<?php endif ?>" id="nim" name="nim" placeholder="Nomor Induk Mahasiswa" value="<?= old('nim') ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="username">Username</label>
                                    <input type="text" class="form-control form-control-user <?php if (session('errors.username')) : ?>is-invalid<?php endif ?>" id="username" name="username" placeholder="Username" value="<?= old('username') ?>">
                                </div>
                                <div class="col-md-6">
                                    <label for="prodi">Program Studi</label>
                                    <input type="text" class="form-control form-control-user <?php if (session('errors.prodi')) : ?>is-invalid<?php endif ?>" id="prodi" name="prodi" placeholder="Program Studi" value="<?= old('prodi') ?>">
                                </div>
                            </div>
                            <div class=" form-group row">
                                <div class="col-md-6">
                                    <label for="email"><?= lang('Auth.email') ?></label>
                                    <input type="email" class="form-control form-control-user <?php if (session('errors.email')) : ?>is-invalid<?php endif ?>" placeholder="<?= lang('Auth.email') ?>" name="email" aria-describedby="emailHelp" placeholder="<?= lang('Auth.email') ?>" value="<?= old('email') ?>">
                                </div>
                                <div class="col-md-6">
                                    <label for="file">Upload DHS</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input custom-file-input-user <?php if (session('errors.dhs')) : ?>is-invalid<?php endif ?>" id="dhs" name="dhs" accept="application/pdf">
                                        <label class="custom-file-label" for="dhs" id="label-dhs">Choose file</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row mb-5">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <div class="col-sm-6">
                                            <label for="password"><?= lang('Auth.password') ?></label>
                                            <input type="password" name="password" class="form-control form-control-user <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>" placeholder="<?= lang('Auth.password') ?>" autocomplete="off">
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="pass_confirm"><?= lang('Auth.repeatPassword') ?></label>
                                            <input type="password" name="pass_confirm" class="form-control form-control-user <?php if (session('errors.pass_confirm')) : ?>is-invalid<?php endif ?>" placeholder="<?= lang('Auth.repeatPassword') ?>" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-info btn-user btn-block"><?= lang('Auth.register') ?></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<script>
    $(document).ready(function() {
        $("#dhs").change(function() {
            var filename = this.files[0].name;
            $("#label-dhs").text(filename);
        });
    })
</script>
<?= $this->endSection() ?>