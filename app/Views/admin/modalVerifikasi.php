<div class="modal fade" id="modalUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Status <?= $user->fullname ?></h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="updateUser" method="post" id="formUpdate">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <div class="form-group row">
                        <input type="hidden" name="id_user" value="<?= $user->id ?>" />
                        <input type="hidden" name="email" value="<?= $user->email ?>" />
                        <label for="mhs" class="col-sm-4 col-form-label">Status Mahasiswa</label>
                        <div class="col-sm-8">
                            <select class="form-control " id="mhs" name="mhs">
                                <option value="">- Pilih Status -</option>
                                <option value="1">Mahasiswa UNJ</option>
                                <option value="2">Mahasiswa Asing</option>
                            </select>
                            <div class="invalid-feedback errorStat"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-info sendStatus" type="submit">Simpan</button>
                    <button class="btn btn-secondary" data-dismiss="modal">Keluar</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
    (function($) {
        $("#formUpdate").submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: $(this).attr('action'),
                data: $(this).serialize(),
                dataType: "JSON",
                beforeSend: function() {
                    $('.sendStatus').attr('disable', 'disabled');
                    $('.sendStatus').html('<i class="fa fa-spin fa-spinner"></i>');
                },
                complete: function() {
                    $('.sendStatus').removeAttr('disable');
                    $('.sendStatus').html('Simpan');
                },
                success: function(res) {
                    if (res.success) {
                        alert(res.success);

                        $('#modalUser').modal('hide');
                        dataUser();
                    } else {
                        if (res.error.mhs) {
                            $('#mhs').addClass('is-invalid');
                            $('.errorStat').html(res.error.mhs);
                        } else {
                            $('#mhs').removeClass('is-invalid');
                            $('.errorStat').html('');
                        }
                        if (res.error.email) {
                            alert(res.error.email);
                        }
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    $('.viewdata').html(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });

        });
    })(jQuery);
</script>