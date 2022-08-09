<table class="table table-bordered" id="dataTable">
    <thead>
        <tr>
            <th>No.</th>
            <th>Department</th>
            <th>Deskripsi</th>
            <td>Action</td>
        </tr>
    </thead>
    <tbody>
        <?php $i = 1; ?>
        <?php foreach ($departement as $value) : ?>
            <tr>
                <td><?= $i++ ?></td>
                <td><?= $value["departement"] ?></td>
                <td><?= $value["desc"] ?></td>
                <td class="btn-group">
                    <button type="submit" class="btn btn-info btn-user" title="Edit Departement" onclick="editData(<?= $value['id'] ?>)"><i class="fas fa-edit"></i></button>
                    <button type="submit" class="btn btn-danger btn-user deleteDepartement<?= $value['id'] ?>" title="Delete Departement" onclick="deleteData(<?= $value['id'] ?>)"><i class="fas fa-trash"></i></button>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<script>
    // Call the dataTables jQuery plugin
    $(document).ready(function() {
        $("#dataTable").DataTable({
            autoWidth: false,
        });
    });

    function editData(id) {
        $.ajax({
            type: "POST",
            url: "<?= site_url("formDepartement") ?>",
            dataType: "JSON",
            data: {
                id
            },
            success: function(res) {
                $('#viewModal').html(res.data).show();
                $('#modalDepartement').modal('show');
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
                url: "<?= site_url("deleteDepartement") ?>",
                data: {
                    id
                },
                dataType: "JSON",
                beforeSend: function() {
                    $('.deleteDepartement' + id).attr('disable', 'disabled');
                    $('.deleteDepartement' + id).html('<i class="fa fa-spin fa-spinner"></i>');
                },
                complete: function() {
                    $('.deleteDepartement' + id).removeAttr('disable');
                    $('.deleteDepartement' + id).html('<i class="fas fa-trash"></i>');
                },
                success: function(res) {
                    if (res.success) {
                        alert(res.success);
                        dataDepartement();
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    $('.viewdata').html(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
        }
    }
</script>