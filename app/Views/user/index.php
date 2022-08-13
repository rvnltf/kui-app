<?= $this->extend('templates/index') ?>

<?= $this->section('page-content') ?>
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Hallo, <?= user()->fullname ?></h1>

    <?php if ($exchange) : ?>
        <div class="card shadow mb-4">
            <div class="card-title pl-3 pt-3 pr-3 row">
                <div class="col-lg-6">
                    <h1 class="h5 text-gray-900">Your Status Exchange</h1>
                </div>
                <div class="col-lg-6 text-right">
                    <a href="https://wa.me/<?= $no_wa['value'] ?>" class="btn btn-light"><i class="fa fa-whatsapp"></i> Contact Us</a>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-4">
                        <p class="h3 text-gray-900 font-weight-bold"><?= $exchange['prodi'] ?></p>
                    </div>
                    <div class="col-sm-2 text-center">
                        <div class="h6 badge-pill badge-<?= $exchange['id_status'] == 7 ? 'success' : ($exchange['id_status'] == 2 ? 'danger' : 'secondary') ?> d-block pt-1 pb-1"><?= $exchange['status'] ?></div>
                        <div class="fas fa-arrow-right"></div>
                    </div>
                    <div class="col-sm-4">
                        <p class="h5 text-gray-900 font-weight-bold"><?= $exchange['fakultas'] ?></p>
                        <p class="h6 text-gray-800"><?= $exchange['departement'] ?></p>
                        <p class="h6 text-gray-800"><?= $exchange['ldt'] ?> - <?= $exchange['cost'] ?></p>
                    </div>
                    <div class="col-sm-2">
                        <?= $exchange['loa'] ? '<a href="' . base_url() . '/LOA/' . $exchange['loa'] . '" class="btn btn-secondary btn-user btn-block">LOA <i class="fas fa-download"></i></a>' : '' ?>
                        <?= $exchange['visa'] ? '<a href="' . base_url() . '/VISA/' . $exchange['visa'] . '" class="btn btn-secondary btn-user btn-block">Visa <i class="fas fa-download"></i></a>' : '' ?>
                        <?= $exchange['kitas'] ? '<a href="' . base_url() . '/KITAS/' . $exchange['kitas'] . '" class="btn btn-secondary btn-user btn-block">Kitas <i class="fas fa-download"></i></a>' : '' ?>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>
<?= $this->endSection() ?>