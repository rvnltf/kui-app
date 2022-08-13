<table class="table table-bordered" id="dataTable">
    <thead>
        <tr>
            <th class="text-center align-middle">Date</th>
            <th class="text-center align-middle">Name</th>
            <th class="text-center align-middle">Departement & Faculty</th>
            <th class="text-center align-middle">Info Student Exchange Applied</th>
            <th class="text-center align-middle">File</th>
            <th class="text-center align-middle">LOA</th>
            <th class="text-center align-middle">VISA</th>
            <th class="text-center align-middle">KITAS</th>
            <th class="text-center align-middle">Cost</th>
            <th class="text-center align-middle">Status</th>
            <th class="text-center align-middle">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php $i = 1; ?>
        <?php foreach ($exchange as $value) : ?>
            <tr>
                <td><?= date('d/m/Y', strtotime($value["created_at"])) ?></td>
                <td><?= $value["fullname"] ?></td>
                <td><?= $value["prodi"] ?></td>
                <td>
                    <p class="font-weight-bold mt-0"><?= $value['fakultas'] ?></p>
                    <p><?= $value['departement'] ?></p>
                </td>
                <td><a href="<?= base_url() ?>/StudentExchange/<?= $value["file"] ?>" class="btn btn-info btn-user" title="Download Berkas"><i class="fas fa-download"></i></a></td>
                <td>
                    <input type="file" id="uploadLoa<?= $value['id'] ?>" name="uploadLoa" hidden accept="application/pdf" onchange="uploadLoa(<?= $value['id'] ?>)" />
                    <label for="uploadLoa<?= $value['id'] ?>" class="btn btn-info btn-user upload-loa<?= $value['id'] ?>" title="Upload LOA"><i class="fas fa-upload"></i></label>
                </td>
                <td>
                    <input type="file" id="uploadVisa<?= $value['id'] ?>" name="uploadVisa" hidden accept="application/pdf" onchange="uploadVisa(<?= $value['id'] ?>)" />
                    <label for="uploadVisa<?= $value['id'] ?>" class="btn btn-info btn-user upload-visa<?= $value['id'] ?>" title="Upload Visa"><i class="fas fa-upload"></i></label>
                </td>
                <td>
                    <input type="file" id="uploadKitas<?= $value['id'] ?>" name="uploadKitas" hidden accept="application/pdf" onchange="uploadKitas(<?= $value['id'] ?>)" />
                    <label for="uploadKitas<?= $value['id'] ?>" class="btn btn-info btn-user upload-kitas<?= $value['id'] ?>" title="Upload KITAS"><i class="fas fa-upload"></i></label>
                </td>
                <td><?= $value["cost"] ?></td>
                <td>
                    <div id="loading-status"></div>
                    <div class="form-group">
                        <select class="form-control form-control-user" id="status" name="status" onchange="updateExchangeStatus(<?= $value['id'] ?>, this.value)">
                            <?php foreach ($status as $stat) : ?>
                                <option value="<?= $stat['id'] ?>" <?= $stat['id'] == $value['status'] ? 'selected' : '' ?>><?= $stat['status'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </td>
                <td>
                    <button type="button" class="btn btn-danger btn-user deleteData" title="Delete Data" onclick="deleteData(<?= $value['id'] ?>)"><i class="fas fa-trash"></i></button>
                </td>
                <!-- <td>
                    <div class="btn-group">
                        <button type="button" class="btn btn-info btn-user" title="Edit Departement" onclick="editData(<?= $value['id'] ?>)"><i class="fas fa-edit"></i></button>
                    </div>
                </td> -->
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<script>
    function updateExchangeStatus(id, value) {
        $.ajax({
            type: "POST",
            url: '<?= site_url('updateExchangeStatus') ?>',
            data: {
                id,
                value
            },
            dataType: "JSON",
            beforeSend: function() {
                $('#loading-status' + id).html('<i class="fa fa-spin fa-spinner"></i>');
            },
            complete: function() {
                $('#loading-status' + id).html('');
            },
            success: function(res) {
                if (res.success) {
                    alert(res.success);
                    dataExchange();
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                $('.viewdata').html(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    }

    function deleteData(id) {
        var text = "Anda yakin ingin menghapus data ini?";
        if (confirm(text)) {
            $.ajax({
                type: "POST",
                url: "<?= site_url("deleteExchange") ?>",
                data: {
                    id
                },
                dataType: "JSON",
                beforeSend: function() {
                    $('.deleteData').attr('disable', 'disabled');
                    $('.deleteData').html('<i class="fa fa-spin fa-spinner"></i>');
                },
                complete: function() {
                    $('.deleteData').removeAttr('disable');
                    $('.deleteData').html('<i class="fas fa-trash">');
                },
                success: function(res) {
                    if (res.success) {
                        alert(res.success);
                        dataExchange();
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    $('.viewdata').html(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
        }
    }


    function uploadLoa(id) {
        var file_data = $('#uploadLoa' + id).prop('files')[0];
        var form_data = new FormData();
        form_data.append('loa', file_data);
        form_data.append('id', id);
        $.ajax({
            type: "POST",
            url: '<?= site_url("updateLoa") ?>',
            processData: false,
            contentType: false,
            async: false,
            cache: false,
            data: form_data,
            dataType: 'json',
            beforeSend: function() {
                $('.upload-loa' + id).attr('disable', 'disabled');
                $('.upload-loa' + id).html('<i class="fa fa-spin fa-spinner"></i>');
            },
            complete: function() {
                $('.upload-loa' + id).removeAttr('disable');
                $('.upload-loa' + id).html('<i class="fas fa-upload"></i>');
            },
            success: function(res) {
                if (res.success) {
                    alert(res.success);
                    dataExchange();
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                $('.viewdata').html(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    }

    function uploadVisa(id) {
        var file_data = $('#uploadVisa' + id).prop('files')[0];
        var form_data = new FormData();
        form_data.append('visa', file_data);
        form_data.append('id', id);
        $.ajax({
            type: "POST",
            url: '<?= site_url("updateVisa") ?>',
            processData: false,
            contentType: false,
            async: false,
            cache: false,
            data: form_data,
            dataType: 'json',
            beforeSend: function() {
                $('.upload-visa' + id).attr('disable', 'disabled');
                $('.upload-visa' + id).html('<i class="fa fa-spin fa-spinner"></i>');
            },
            complete: function() {
                $('.upload-visa' + id).removeAttr('disable');
                $('.upload-visa' + id).html('<i class="fas fa-upload"></i>');
            },
            success: function(res) {
                if (res.success) {
                    alert(res.success);
                    dataExchange();
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                $('.viewdata').html(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    }

    function uploadKitas(id) {
        var file_data = $('#uploadKitas' + id).prop('files')[0];
        var form_data = new FormData();
        form_data.append('kitas', file_data);
        form_data.append('id', id);
        $.ajax({
            type: "POST",
            url: '<?= site_url("updateKitas") ?>',
            processData: false,
            contentType: false,
            async: false,
            cache: false,
            data: form_data,
            dataType: 'json',
            beforeSend: function() {
                $('.upload-kitas' + id).attr('disable', 'disabled');
                $('.upload-kitas' + id).html('<i class="fa fa-spin fa-spinner"></i>');
            },
            complete: function() {
                $('.upload-kitas' + id).removeAttr('disable');
                $('.upload-kitas' + id).html('<i class="fas fa-upload"></i>');
            },
            success: function(res) {
                if (res.success) {
                    alert(res.success);
                    dataExchange();
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                $('.viewdata').html(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    }

    // Call the dataTables jQuery plugin
    $(document).ready(function() {
        $("#dataTable").DataTable({
            autoWidth: false,
        });

    });
</script>