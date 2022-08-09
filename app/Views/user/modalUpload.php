<div class="modal fade" id="modalUpload" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Student Exchange</h5>
                <button class="close" type="button" data-dilgiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="appliedExchange" id="formExchange" method="post" class="user" enctype="multipart/form-data">
                <div class="modal-body">
                    <?= csrf_field() ?>
                    <input type="hidden" name="id_fakultas" value="<?= $id_fakultas ?>">
                    <input type="hidden" name="id_departement" value="<?= $id_departement ?>">
                    <input type="hidden" name="id_user" value="<?= user()->id ?>">
                    <table class="table">
                        <tr>
                            <td>Faculty</td>
                            <td>: <?= $fakultas['fakultas'] ?></td>
                        </tr>
                        <tr>
                            <td>Departement</td>
                            <td>: <?= $departement['departement'] ?></td>
                        </tr>
                        <tr>
                            <td>Detailed Information</td>
                            <td>: <?= $fakultas['ldt'] ?></td>
                        </tr>
                        <tr>
                            <td>File</td>
                            <td>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input custom-file-input-user" id="berkas" name="berkas" accept="application/zip">
                                    <label class="custom-file-label berkasLabel" for="dhs">Choose file</label>
                                </div>
                            </td>
                        </tr>
                    </table>

                    <div class="alert alert-secondary mt-4" role="alert">
                        <?= $file_format['file_format'] ?>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-info sendExchange" type="submit">Apply</button>
                    <button class="btn btn-secondary" data-dismiss="modal">Keluar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $("#berkas").change(function() {
            var filename = this.files[0].name;
            $(".berkasLabel").text(filename);
        });

        $("#formExchange").submit(function(e) {
            var form_data = new FormData($('#formExchange')[0]);
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: $(this).attr('action'),
                processData: false,
                contentType: false,
                async: false,
                cache: false,
                data: form_data,
                dataType: 'json',
                beforeSend: function() {
                    $('.sendExchange').attr('disable', 'disabled');
                    $('.sendExchange').html('<i class="fa fa-spin fa-spinner"></i>');
                },
                complete: function() {
                    $('.sendExchange').removeAttr('disable');
                    $('.sendExchange').html('Upload');
                },
                success: function(res) {
                    if (res.success) {
                        alert(res.success);
                        $('#modalUpload').modal('hide');
                        dataFakultas();
                    } else {
                        alert(res.error.berkas);
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    $('#modalDepartement').modal('hide');
                    $('.viewdata').html(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
        });
    });
</script>