<div class="modal fade" id="modalDepartement" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?= $departement ? 'Pembaharuan' : 'Tambah' ?> Departement</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="<?= $departement ? 'updateDepartement' : 'simpanDepartement' ?>" id="formDepartement" method="post" class="user">
                <?= csrf_field() ?>
                <input type="hidden" name="id" value="<?= $departement ? $departement['id'] : '' ?>">
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="departement" class="col-sm-3 col-form-label">Departement</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control form-control-user" id="departement" name="departement" value="<?= $departement ? $departement['departement'] : '' ?>" placeholder="Departement">
                            <div class="invalid-feedback errorDepartement"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="desc" class="col-sm-3 col-form-label">Deskripsi</label>
                        <div class="col-sm-9">
                            <textarea type="text" class="form-control" id="desc" name="desc" placeholder="Deskripsi" rows="5"><?= $departement ? $departement['desc'] : '' ?></textarea>
                            <div class="invalid-feedback errorDesc"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <?= $departement ? '<button class="btn btn-info updateDepartement" type="submit">Update</button>' :
                        '<button class="btn btn-info sendDepartement" type="submit">Simpan</button>' ?>
                    <button class="btn btn-secondary" data-dismiss="modal">Keluar</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
    (function($) {
        $("#formDepartement").submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: $(this).attr('action'),
                data: $(this).serialize(),
                dataType: "JSON",
                beforeSend: function() {
                    $('.sendDepartement').attr('disable', 'disabled');
                    $('.sendDepartement').html('<i class="fa fa-spin fa-spinner"></i>');
                    $('.updateDepartement').attr('disable', 'disabled');
                    $('.updateDepartement').html('<i class="fa fa-spin fa-spinner"></i>');
                },
                complete: function() {
                    $('.sendDepartement').removeAttr('disable');
                    $('.sendDepartement').html('Simpan');
                    $('.updateDepartement').removeAttr('disable');
                    $('.updateDepartement').html('Update');
                },
                success: function(res) {
                    if (res.error) {
                        if (res.error.departement) {
                            $('#departement').addClass('is-invalid');
                            $('.errorDepartement').html(res.error.departement);
                        } else {
                            $('#departement').removeClass('is-invalid');
                            $('.errorDepartement').html('');
                        }

                        if (res.error.ldt) {
                            $('#ldt').addClass('is-invalid');
                            $('.errorLdt').html(res.error.ldt);
                        } else {
                            $('#ldt').removeClass('is-invalid');
                            $('.errorLdt').html('');
                        }

                        if (res.error.desc) {
                            $('#desc').addClass('is-invalid');
                            $('.errorDesc').html(res.error.desc);
                        } else {
                            $('#desc').removeClass('is-invalid');
                            $('.errorDesc').html('');
                        }
                    } else {
                        alert(res.success);

                        $('#modalDepartement').modal('hide');
                        dataDepartement();
                    }

                },
                error: function(xhr, ajaxOptions, thrownError) {
                    $('.viewdata').html(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
        });
    })(jQuery);
</script>