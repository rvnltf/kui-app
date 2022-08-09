<?= $this->extend('auth/templates/index') ?>
<?= $this->section('content') ?>
<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-xl-10 col-lg-12 col-md-9">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row align-items-center justify-content-center">
                        <div class="col-md-6">
                            <div class="p-5">
                                <div class=" mb-4">
                                    <h1 class="h4 text-gray-900">Welcome Back!</h1>
                                    <p class="text-gray">Don't have a account. <a class="small" href="<?= url_to('register') ?>">Sign up</a></p>
                                </div>
                                <?= view('Myth\Auth\Views\_message_block') ?>
                                <form action="<?= url_to('login') ?>" method="post" class="user">
                                    <?= csrf_field() ?>

                                    <?php if ($config->validFields === ['email']) : ?>
                                        <div class="form-group">
                                            <label for="login"><?= lang('Auth.email') ?></label>
                                            <input type="email" class="form-control form-control-user <?php if (session('errors.login')) : ?>is-invalid<?php endif ?>" name="login" placeholder="<?= lang('Auth.email') ?>">
                                            <div class="invalid-feedback">
                                                <?= session('errors.login') ?>
                                            </div>
                                        </div>
                                    <?php else : ?>
                                        <div class="form-group">
                                            <label for="login"><?= lang('Auth.emailOrUsername') ?></label>
                                            <input type="text" class="form-control form-control-user <?php if (session('errors.login')) : ?>is-invalid<?php endif ?>" name="login" placeholder="<?= lang('Auth.emailOrUsername') ?>">
                                            <div class="invalid-feedback">
                                                <?= session('errors.login') ?>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <div class="form-group">
                                        <label for="password"><?= lang('Auth.password') ?></label>
                                        <input type="password" name="password" class="form-control form-control-user <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>" placeholder="<?= lang('Auth.password') ?>">
                                        <div class="invalid-feedback">
                                            <?= session('errors.password') ?>
                                        </div>
                                    </div>
                                    <?php if ($config->allowRemembering) : ?>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" name="remember" class="custom-control-input" <?php if (old('remember')) : ?> checked <?php endif ?> id="customCheck">
                                                <label class="custom-control-label" for="customCheck"><?= lang('Auth.rememberMe') ?></label>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <button type="submit" class="btn btn-info btn-user btn-block"><?= lang('Auth.loginAction') ?></button>
                                </form>
                            </div>
                        </div>
                        <div class="col-md-auto">
                            <img src="<?= base_url() ?>/img/login.svg" alt="Login Picture" width="300">
                            <p class="text-dark text-center font-weight-bold mt-3">Office of International Affairs</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>

<?= $this->endSection() ?>