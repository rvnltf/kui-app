<table class="table table-bordered" id="dataTable">
    <thead>
        <tr>
            <th>NIM</th>
            <th>Fullname</th>
            <th>Username</th>
            <th>Email</th>
            <th>Program Studi</th>
            <th>DHS</th>
            <th>Permission</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($users as $value) : ?>
            <?php if ($value->username != user()->username) : ?>
                <tr>
                    <td><?= $value->nim ?></td>
                    <td><?= $value->fullname ?></td>
                    <td><?= $value->username ?></td>
                    <td><?= $value->email ?></td>
                    <td><?= $value->prodi ?></td>
                    <td><?= $value->dhs ? '<a href="' . base_url() . '/dhs/' . $value->dhs . '" class="btn btn-primary btn-user btn-block" title="Lihat DHS' . $value->fullname . '"><i class="fas fa-eye"></a>' : '<button class="btn btn-secondary btn-user btn-block" disabled><i class="fas fa-eye"></button>' ?></td>
                    <td class="text-center">
                        <div class="loading<?= $value->id ?>"></div>
                        <div class="btn-group btn<?= $value->id ?>">
                            <?php if ($value->active == 0) : ?>
                                <button type="submit" class="btn btn-success btn-user" title="Accept User" onclick="modalUser(<?= $value->id ?>)"><i class="fas fa-check"></i></button>
                                <button type="submit" class="btn btn-danger btn-user" title="Decline User"><i class="fas fa-times"></i></button>
                            <?php else : ?>
                                <span class="badge badge-pill badge-success">Actived</span>
                            <?php endif; ?>
                        </div>
                    </td>
                    <td>
                        <!-- <div class="btn-group">
                            <button type="submit" class="btn btn-info btn-user" title="Edit Departement"><i class="fas fa-edit"></i></button> -->
                        <button type="submit" class="btn btn-danger btn-user deleteUser<?= $value->id ?>" title="Delete Departement" onclick="deleteUser(<?= $value->id ?>)"><i class="fas fa-trash"></i></button>
                        <!-- </div> -->
                    </td>
                </tr>
            <?php endif; ?>
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

    function deleteUser(id) {
        var text = "Anda yakin ingin menghapus user ini?";
        if (confirm(text)) {
            $.ajax({
                type: "POST",
                url: "<?= site_url("deleteUser") ?>",
                data: {
                    id
                },
                dataType: "JSON",
                beforeSend: function() {
                    $('.deleteUser' + id).attr('disable', 'disabled');
                    $('.deleteUser' + id).html('<i class="fa fa-spin fa-spinner"></i>');
                },
                complete: function() {
                    $('.deleteUser' + id).removeAttr('disable');
                    $('.deleteUser' + id).html('<i class="fas fa-trash"></i>');
                },
                success: function(res) {
                    if (res.success) {
                        alert(res.success);
                        dataUser();
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    $('.viewdata').html(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
        }
    }
</script>