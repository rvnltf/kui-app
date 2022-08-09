<div class="modal fade" id="modalFormat" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Status Data</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <div class="col-lg">
                        <textarea class="form-control form-control-user" rows="10" id="file_format" placeholder="File Format" name="file_format"><?= $file_format ? $file_format['file_format'] : '' ?></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-info updateFomat" onclick="updateFormat()">Update</button>
                <button class="btn btn-secondary" data-dismiss="modal">Keluar</button>
            </div>
        </div>
    </div>
</div>


<script>
    function updateFormat() {
        console.log('tes', $('#file_format').val());
        $.ajax({
            type: "POST",
            url: "<?= site_url('updateFormat') ?>",
            data: {
                file_format: $('#file_format').val()
            },
            dataType: "JSON",
            beforeSend: function() {
                $('.updateFomat').attr('disable', 'disabled');
                $('.updateFomat').html('<i class="fa fa-spin fa-spinner"></i>');
            },
            complete: function() {
                $('.updateFomat').removeAttr('disable');
                $('.updateFomat').html('Update');
            },
            success: function(res) {
                if (res.success) {
                    alert(res.success);
                    $('#modalFormat').modal('hide');
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                $('.viewdata').html(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    }
</script>