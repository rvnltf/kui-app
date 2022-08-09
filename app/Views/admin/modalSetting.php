<div class="modal fade" id="modalNomor" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Nomor Whatsapp</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <div class="col-lg">
                        <input type="text" class="form-control" name="value" id="value" value="<?= $setting ? $setting['value'] : '' ?>" />
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-info updateSetting" onclick="updateSetting()">Update</button>
                <button class="btn btn-secondary" data-dismiss="modal">Keluar</button>
            </div>
        </div>
    </div>
</div>


<script>
    function updateSetting() {
        $.ajax({
            type: "POST",
            url: "<?= site_url('updateSetting') ?>",
            data: {
                value: $('#value').val()
            },
            dataType: "JSON",
            beforeSend: function() {
                $('.updateSetting').attr('disable', 'disabled');
                $('.updateSetting').html('<i class="fa fa-spin fa-spinner"></i>');
            },
            complete: function() {
                $('.updateSetting').removeAttr('disable');
                $('.updateSetting').html('Update');
            },
            success: function(res) {
                if (res.success) {
                    alert(res.success);
                    $('#modalNomor').modal('hide');
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                $('.viewdata').html(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    }
</script>