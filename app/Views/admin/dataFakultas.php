<table class="table table-bordered" id="dataTable">
    <thead>
        <tr>
            <th>No.</th>
            <th>Fakultas</th>
            <th>Status</th>
            <th>Departement</th>
            <th>Detailed Information</th>
            <th>Kuota Status</th>
            <td>Cost</td>
            <td>Action</td>
        </tr>
    </thead>
    <tbody>
        <?php $i = 1; ?>
        <?php foreach ($fakultas as $value) : ?>
            <?php $kuota = 0 ?>
            <?php foreach ($exchange as $exc) : ?>
                <?php if ($exc['id_fakultas'] == $value['id']) : ?>
                    <?php $kuota++ ?>
                <?php endif; ?>
            <?php endforeach; ?>
            <tr>
                <td><?= $i++ ?></td>
                <td><?= $value["fakultas"] ?></td>
                <td class="text-center">
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" onchange="toggleFakultas(<?= $value['id'] ?>)" id="fakultas_status<?= $value['id'] ?>" <?= $value["fakultas_status"] ? "checked" : "" ?>>
                        <label class="custom-control-label" id="fakultas_label<?= $value['id'] ?>" for="fakultas_status<?= $value['id'] ?>"><?= $value["fakultas_status"] ? "Active" : "Inactive" ?><i id="loading-fakultas<?= $value['id'] ?>"></i></label>
                    </div>
                    <span class="badge badge-pill badge-info">Last Regis: <?= date("d/m/Y", strtotime($value["exp_date"])) ?></span>
                </td>
                <td class="text-center"><button type="submit" class="btn btn-info btn-user" title="Lihat Departement" onclick="dataDepartement(<?= $value['id'] ?>)"><i class="fas fa-list"></i></button></td>
                <td class="text-center"><?= $value["ldt"] ?></td>
                <td class="text-center">
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" onchange="toggleKuota(<?= $value['id'] ?>)" id="kuota_status<?= $value['id'] ?>" <?= $value["kuota_status"] ? "checked" : "" ?>>
                        <label class="custom-control-label" id="kuota_label<?= $value['id'] ?>" for="kuota_status<?= $value['id'] ?>"><?= $value["kuota_status"] ? "Active" : "Inactive" ?><i id="loading-kuota<?= $value['id'] ?>"></i></label>
                    </div>
                    <span class="badge badge-pill badge-info"><?= $kuota ?> of <?= $value["kuota"] ?></span>
                </td>
                <td><?= $value["cost"] ?></td>
                <td>
                    <div class="btn-group">
                        <button type="button" class="btn btn-info btn-user" title="Edit Departement" onclick="editData(<?= $value['id'] ?>)"><i class="fas fa-edit"></i></button>
                        <button type="button" class="btn btn-danger btn-user deleteUser" title="Delete Departement" onclick="deleteData(<?= $value['id'] ?>)"><i class="fas fa-trash"></i></button>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<script>
    function toggleFakultas(id) {
        var data = $('input[id="fakultas_status' + id + '"]:checked').val() == "on" ? 1 : 0;
        $.ajax({
            type: "POST",
            url: '<?= site_url('toggleFakultas') ?>',
            data: {
                id,
                data
            },
            dataType: "JSON",
            beforeSend: function() {
                $('#loading-fakultas' + id).html('<i class="fa fa-spin fa-spinner"></i>');
            },
            complete: function() {
                $('#loading-fakultas' + id).html('');
            },
            success: function(res) {
                if (res.success) {
                    if (data) {
                        $("#fakultas_label" + id).text("Active");
                    } else {
                        $("#fakultas_label" + id).text("Inactive");
                    }
                    dataFakultas();
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                $('.viewdata').html(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    }


    function toggleKuota(id) {
        var data = $('input[id="kuota_status' + id + '"]:checked').val() == "on" ? 1 : 0;
        $.ajax({
            type: "POST",
            url: '<?= site_url('toggleKuota') ?>',
            data: {
                id,
                data
            },
            dataType: "JSON",
            beforeSend: function() {
                $('#loading-kuota' + id).html('<i class="fa fa-spin fa-spinner"></i>');
            },
            complete: function() {
                $('#loading-kuota' + id).html('');
            },
            success: function(res) {
                if (res.success) {
                    if (data) {
                        $("#kuota_label" + id).text("Active");
                    } else {
                        $("#kuota_label" + id).text("Inactive");
                    }
                    dataFakultas();
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                $('.viewdata').html(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    }

    function editData(id) {
        $.ajax({
            type: "POST",
            url: "<?= site_url("formFakultas") ?>",
            dataType: "JSON",
            data: {
                id
            },
            success: function(res) {
                $('#viewModal').html(res.data).show();
                $('#modalFakultas').modal('show');
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    }

    function deleteData(id) {
        var text = "Anda yakin ingin menghapus data ini?";
        if (confirm(text)) {
            $.ajax({
                type: "POST",
                url: "<?= site_url("deleteFakultas") ?>",
                data: {
                    id
                },
                dataType: "JSON",
                beforeSend: function() {
                    $('.deleteUser').attr('disable', 'disabled');
                    $('.deleteUser').html('<i class="fa fa-spin fa-spinner"></i>');
                },
                complete: function() {
                    $('.deleteUser').removeAttr('disable');
                    $('.deleteUser').html('<i class="fas fa-trash">');
                },
                success: function(res) {
                    if (res.success) {
                        alert(res.success);
                        dataFakultas();
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    $('.viewdata').html(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
        }
    }

    // Call the dataTables jQuery plugin
    $(document).ready(function() {
        $("#dataTable").DataTable({
            autoWidth: false,
        });
    });
</script>