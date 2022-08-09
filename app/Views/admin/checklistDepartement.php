<table class="table table-bordered" id="dataDepartements">
    <tbody>
        <?php $i = 1; ?>
        <?php foreach ($departements as $value) : ?>
            <?php $checked = '' ?>
            <?php foreach ($fadep as $valueFadep) : ?>
                <?php if ($valueFadep['id_departement'] == $value["id"]) : ?>
                    <?php $checked = 'checked' ?>
                <?php endif; ?>
            <?php endforeach; ?>
            <tr>
                <td>
                    <div class="form-group">
                        <div class="custom-control custom-checkbox small">
                            <div id="loading-dept"></div>
                            <input type="checkbox" name="remember" class="custom-control-input" id="deptCek<?= $value["id"] ?>" <?= $checked ?> onclick="toggleDep(<?= $value['id'] ?>)">
                            <label class="custom-control-label" for="deptCek<?= $value["id"] ?>"></label>
                        </div>
                    </div>
                </td>
                <td><?= $i++ ?></td>
                <td>
                    <label class="text-gray" for="deptCek<?= $value["id"] ?>"><?= $value["departement"] ?></label>
                </td>
                <td>
                    <label class="text-gray" for="deptCek<?= $value["id"] ?>"><?= $value["desc"] ?></label>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<script>
    // Call the dataTables jQuery plugin
    // $(document).ready(function() {
    //     $("#dataDepartements").DataTable({
    //         autoWidth: false,
    //     });
    // });

    function toggleDep(id_departement) {
        var data = $('input[id="deptCek' + id_departement + '"]:checked').val() == "on" ? 1 : 0;
        if (data == 1) {
            $.ajax({
                type: "POST",
                url: '<?= site_url('addFadep') ?>',
                data: {
                    id_fakultas: '<?= $id_fakultas ?>',
                    id_departement
                },
                dataType: "JSON",
                beforeSend: function() {
                    $('input[id="deptCek' + id_departement + '"]').hide();
                    $('#loading-dept' + id_departement).html('<i class="fa fa-spin fa-spinner"></i>');
                },
                complete: function() {
                    $('input[id="deptCek' + id_departement + '"]').show();
                    $('#loading-dept' + id_departement).html('');
                },
                success: function(res) {
                    alert(res.success);
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    $('.viewdata').html(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
        } else {
            $.ajax({
                type: "POST",
                url: '<?= site_url('deleteFadep') ?>',
                data: {
                    id_fakultas: '<?= $id_fakultas ?>',
                    id_departement
                },
                dataType: "JSON",
                beforeSend: function() {
                    $('input[id="deptCek' + id_departement + '"]').hide();
                    $('#loading-dept' + id_departement).html('<i class="fa fa-spin fa-spinner"></i>');
                },
                complete: function() {
                    $('input[id="deptCek' + id_departement + '"]').show();
                    $('#loading-dept' + id_departement).html('');
                },
                success: function(res) {
                    if (res.success) {
                        alert(res.success);
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    $('.viewdata').html(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
        }
    }
</script>