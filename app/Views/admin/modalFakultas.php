<div class="modal fade" id="modalFakultas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?= $fakultas ? 'Pembaharuan' : 'Tambah' ?> Fakultas</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="<?= $fakultas ? 'updateFakultas' : 'simpanFakultas' ?>" id="formFakultas" method="post" class="user">
                <?= csrf_field() ?>
                <input type="hidden" name="id" value="<?= $fakultas ? $fakultas['id'] : '' ?>">
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="fakultas" class="col-sm-3 col-form-label">Fakultas</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control form-control-user" id="fakultas" name="fakultas" value="<?= $fakultas ? $fakultas['fakultas'] : '' ?>" placeholder="Fakultas">
                            <div class="invalid-feedback errorFakultas"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="fakultas" class="col-sm-3 col-form-label">Status</label>
                        <div class="col-sm-5">
                            <div class="input-group date " id="expDate">
                                <input type="text" placeholder="DD/MM/YYYY" class="form-control" id="exp_date" name="exp_date" value="<?= $fakultas ? date('d/m/Y', strtotime($fakultas['exp_date'])) : '' ?>" />
                                <div class="input-group-addon input-group-append">
                                    <div class="input-group-text">
                                        <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="invalid-feedback errorDate"></div>
                        </div>
                        <div class="col-sm-4 p-2">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="form_fakultas" name="form_fakultas" value="<?= $fakultas ? $fakultas['fakultas_status'] : 1 ?>" <?= $fakultas ? ($fakultas['fakultas_status'] == 1 ? 'checked' : '') : '' ?>>
                                <label class="custom-control-label" for="form_fakultas">Active</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="ldt" class="col-sm-3 col-form-label">LDT</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control form-control-user" id="ldt" placeholder="Detailed Information" name="ldt" value="<?= $fakultas ? $fakultas['ldt'] : '' ?>">
                            <div class="invalid-feedback errorLdt"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="kuota" class="col-sm-3 col-form-label">Kuota</label>
                        <div class="col-sm-4">
                            <input type="number" class="form-control form-control-user" id="kuota" placeholder="Kuota" name="kuota" value="<?= $fakultas ? $fakultas['kuota'] : '' ?>">
                            <div class="invalid-feedback errorKuota"></div>
                        </div>
                        <div class="col-sm-4 p-2">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="form_kuota" name="form_kuota" value="<?= $fakultas ? $fakultas['kuota_status'] : 1 ?>" <?= $fakultas ? ($fakultas['kuota_status'] == 1 ? 'checked' : '') : '' ?>>
                                <label class="custom-control-label" for="form_kuota">Active</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="cost" class="col-sm-3 col-form-label">COST</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control form-control-user" id="cost" placeholder="Cost" name="cost" value="<?= $fakultas ? $fakultas['cost'] : '' ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="mhs" class="col-sm-3 col-form-label">Peruntukan</label>
                        <div class="col-sm-9">
                            <select class="form-control" id="mhs" name="mhs">
                                <option value="">- Pilih Peruntukan -</option>
                                <option value="2" <?= $fakultas ? ($fakultas['for_exchange'] == 1 ? 'selected' : '') : '' ?>>Mahasiswa UNJ</option>
                                <option value="1" <?= $fakultas ? ($fakultas['for_exchange'] == 2 ? 'selected' : '') : '' ?>>Mahasiswa Asing</option>
                            </select>
                            <div class="invalid-feedback errorMhs"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <?= $fakultas ? '<button class="btn btn-info updateFakultas" type="submit">Update</button>' :
                        '<button class="btn btn-info sendFakultas" type="submit">Simpan</button>' ?>
                    <button class="btn btn-secondary" data-dismiss="modal">Keluar</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
    (function($) {
        $(function() {
            $('#expDate').datetimepicker({
                "allowInputToggle": true,
                "showClose": true,
                "showClear": true,
                "showTodayButton": true,
                "format": "DD/MM/YYYY",
            });
        });

        $("#formFakultas").submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: $(this).attr('action'),
                data: $(this).serialize(),
                dataType: "JSON",
                beforeSend: function() {
                    $('.sendFakultas').attr('disable', 'disabled');
                    $('.sendFakultas').html('<i class="fa fa-spin fa-spinner"></i>');
                    $('.updateFakultas').attr('disable', 'disabled');
                    $('.updateFakultas').html('<i class="fa fa-spin fa-spinner"></i>');
                },
                complete: function() {
                    $('.sendFakultas').removeAttr('disable');
                    $('.sendFakultas').html('Simpan');
                    $('.updateFakultas').removeAttr('disable');
                    $('.updateFakultas').html('Update');
                },
                success: function(res) {
                    if (res.error) {
                        if (res.error.fakultas) {
                            $('#fakultas').addClass('is-invalid');
                            $('.errorFakultas').html(res.error.fakultas);
                        } else {
                            $('#fakultas').removeClass('is-invalid');
                            $('.errorFakultas').html('');
                        }

                        if (res.error.exp_date) {
                            $('#exp_date').addClass('is-invalid');
                            $('.errorDate').html(res.error.exp_date);
                        } else {
                            $('#exp_date').removeClass('is-invalid');
                            $('.errorDate').html('');
                        }

                        if (res.error.ldt) {
                            $('#ldt').addClass('is-invalid');
                            $('.errorLdt').html(res.error.ldt);
                        } else {
                            $('#ldt').removeClass('is-invalid');
                            $('.errorLdt').html('');
                        }

                        if (res.error.mhs) {
                            $('#mhs').addClass('is-invalid');
                            $('.errorMhs').html(res.error.mhs);
                        } else {
                            $('#mhs').removeClass('is-invalid');
                            $('.errorMhs').html('');
                        }

                        if (res.error.kuota) {
                            $('#kuota').addClass('is-invalid');
                            $('.errorKuota').html(res.error.kuota);
                        } else {
                            $('#kuota').removeClass('is-invalid');
                            $('.errorKuota').html('');
                        }
                        console.log(res.error);
                    } else {
                        alert(res.success);

                        $('#modalFakultas').modal('hide');
                        dataFakultas();
                    }

                },
                error: function(xhr, ajaxOptions, thrownError) {
                    $('.viewdata').html(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
        });
    })(jQuery);
</script>