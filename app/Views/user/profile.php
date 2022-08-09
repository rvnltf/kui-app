<?= $this->extend('templates/index') ?>

<?= $this->section('page-content') ?>
<div class="container-fluid">
    <div class=" row justify-content-center mb-3">
        <div class="profilepic">
            <img class="profilepic__image " src="<?= base_url() ?>/img/<?= user()->user_img; ?>">
            <div class="profilepic__content">
                <span class="profilepic__icon"><i class="fas fa-camera"></i></span>
                <span class="profilepic__text">Edit Profile</span>
                <input type="file" class="input-picture" id="user_img" name="user_img" accept="image/*" onchange="uploadImg()">
            </div>
        </div>
        <div class="upload-img"></div>
    </div>
    <div class="row">
        <div class="col-lg-5"></div>
        <div class="col-lg-2">
            <a href="<?= base_url() ?>/dhs/<?= user()->dhs ?>" class="btn btn-info btn-user btn-block">Lihat DHS</a>
        </div>
        <div class="col-lg-5"></div>
        <div class="col-lg">
            <div class="p-4">
                <form action="updateProfile" method="post" class="user" id="updateProfile">
                    <?= csrf_field() ?>
                    <input type="hidden" name="id" value="<?= old('id') ? old('id') : user()->id  ?>">
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="fullname">Fullname</label>
                            <input type="text" class="form-control form-control-user" id="fullname" name="fullname" placeholder="Fullname" value="<?= old('fullname') ? old('fullname') : user()->fullname  ?>">
                            <div class="invalid-feedback errorFullname"></div>
                        </div>
                        <div class="col-md-6">
                            <label for="nim">NIM</label>
                            <input type="text" class="form-control form-control-user" id="nim" name="nim" placeholder="Nomor Induk Mahasiswa" value="<?= old('nim') ? old('nim') : user()->nim  ?>">
                            <div class="invalid-feedback errorNim"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="username">Username</label>
                            <input type="text" class="form-control form-control-user" id="username" name="username" placeholder="Username" value="<?= old('username') ? old('username') : user()->username  ?>" readonly>
                            <div class="invalid-feedback errorUsername"></div>
                        </div>
                        <div class="col-md-6">
                            <label for="prodi">Program Studi</label>
                            <input type="text" class="form-control form-control-user" id="prodi" name="prodi" placeholder="Program Studi" value="<?= old('prodi') ? old('prodi') : user()->prodi  ?>">
                            <div class="invalid-feedback errorProdi"></div>
                        </div>
                    </div>
                    <div class=" form-group row">
                        <div class="col-md-6">
                            <label for="email">Email</label>
                            <input type="email" class="form-control form-control-user" placeholder="Email" name="email" aria-describedby="emailHelp" value="<?= old('email') ? old('email') : user()->email  ?>" readonly>
                            <div class="invalid-feedback errorEmail"></div>
                        </div>
                        <div class="col-md-6">
                            <!-- <label for="file">Upload DHS</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input custom-file-input-user <?php if (session('errors.dhs')) : ?>is-invalid<?php endif ?>" id="dhs" name="dhs" accept="application/pdf">
                                <label class="custom-file-label" for="dhs">Choose file</label>
                            </div> -->
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4"></div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-info btn-user btn-block btnUpdate">Update Profile</button>
                        </div>
                        <div class="col-md-4"></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $("#updateProfile").submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: $(this).attr('action'),
                data: $(this).serialize(),
                dataType: "JSON",
                beforeSend: function() {
                    $('.btnUpdate').attr('disable', 'disabled');
                    $('.btnUpdate').html('<i class="fa fa-spin fa-spinner"></i>');
                },
                complete: function() {
                    $('.btnUpdate').removeAttr('disable');
                    $('.btnUpdate').html('Update Profile');
                },
                success: function(res) {
                    if (res.error) {
                        if (res.error.fulname) {
                            $('#fulname').addClass('is-invalid');
                            $('.errorFullname').html(res.error.fulname);
                        } else {
                            $('#fulname').removeClass('is-invalid');
                            $('.errorFullname').html('');
                        }

                        // if (res.error.username) {
                        //     $('#username').addClass('is-invalid');
                        //     $('.errorUsername').html(res.error.username);
                        // } else {
                        //     $('#username').removeClass('is-invalid');
                        //     $('.errorUsername').html('');
                        // }

                        if (res.error.nim) {
                            $('#nim').addClass('is-invalid');
                            $('.errorNim').html(res.error.nim);
                        } else {
                            $('#nim').removeClass('is-invalid');
                            $('.errorNim').html('');
                        }

                        // if (res.error.email) {
                        //     $('#email').addClass('is-invalid');
                        //     $('.errorEmail').html(res.error.email);
                        // } else {
                        //     $('#email').removeClass('is-invalid');
                        //     $('.errorEmail').html('');
                        // }

                        if (res.error.prodi) {
                            $('#prodi').addClass('is-invalid');
                            $('.errorProdi').html(res.error.prodi);
                        } else {
                            $('#prodi').removeClass('is-invalid');
                            $('.errorProdi').html('');
                        }
                    } else {
                        alert(res.success);
                        window.location.href = '<?= base_url('profile') ?>';
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    $('.viewdata').html(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
        });
    });

    function uploadImg() {
        var file_data = $('#user_img').prop('files')[0];
        var form_data = new FormData();
        form_data.append('user_img', file_data);
        form_data.append('id', '<?= user()->id ?>');
        $.ajax({
            type: "POST",
            url: '<?= site_url("uploadImg") ?>',
            processData: false,
            contentType: false,
            async: false,
            cache: false,
            data: form_data,
            dataType: 'json',
            beforeSend: function() {
                $('.upload-img').html('<i class="fa fa-spin fa-spinner"></i>');
            },
            complete: function() {
                $('.upload-img').html('');
            },
            success: function(res) {
                if (res.success) {
                    alert(res.success);
                    window.location.href = '<?= base_url('profile') ?>';
                } else {
                    alert(res.error);
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                $('.viewdata').html(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    }
</script>

<?= $this->endSection() ?>