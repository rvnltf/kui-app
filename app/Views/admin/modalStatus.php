<div class="modal fade" id="modalStatus" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Status Data</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered" id="dataTable">
                    <thead>
                        <tr>
                            <th>Status</th>
                            <th>Description</th>
                        </tr>
                    </thead>
                    <tbody id="bodyStatus"></tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-dismiss="modal">Keluar</button>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function() {
        fetch_data();
    });

    function fetch_data() {
        $.ajax({
            url: '<?= site_url("dataStatus") ?>',
            dataType: "JSON",
            success: function(data) {
                var html = '<tr>';
                html += '<td id="status" contenteditable placeholder="Enter Status"></td>';
                html += '<td id="desc" contenteditable placeholder="Enter Description"></td>';
                html += '<td><button type="button" name="btn_add" id="btn_add" class="btn btn-xs btn-success" onclick="addData()"><i class="fas fa-plus"></i></button></td></tr>';
                for (var count = 0; count < data.length; count++) {
                    html += '<tr>';
                    html += '<td class="table_data" data-row_id="' + data[count].id + '" data-column_name="status" contenteditable>' + data[count].status + '</td>';
                    html += '<td class="table_data" data-row_id="' + data[count].id + '" data-column_name="desc" contenteditable>' + data[count].desc + '</td>';
                    html += '<td><button type="button" name="delete_btn" id="' + data[count].id + '" class="btn btn-xs btn-danger btn_delete" onclick="deleteData(' + data[count].id + ')"><i class="fas fa-trash"></i></button></td></tr>';
                }
                $('#bodyStatus').html(html);
            }
        })
    }

    function addData() {
        var status = $('#status').text();
        var desc = $('#desc').text();
        if (status == '') {
            alert('Enter Status');
            return false;
        }
        if (desc == '') {
            alert('Enter Description');
            return false;
        }
        $.ajax({
            url: '<?= site_url("addStatus") ?>',
            method: "POST",
            data: {
                status,
                desc,
            },
            beforeSend: function() {
                $('#btn_add').attr('disable', 'disabled');
                $('#btn_add').html('<i class="fa fa-spin fa-spinner"></i>');
            },
            complete: function() {
                $('#btn_add').removeAttr('disable');
                $('#btn_add').html('<i class="fas fa-trash"></i>');
            },
            success: function(data) {
                fetch_data();
            }
        })
    }

    $('.table_data').blur(function() {
        var id = $(this).data('row_id');
        var table_column = $(this).data('column_name');
        var value = $(this).text();
        $.ajax({
            url: "<?= site_url('updateStatus') ?>",
            method: "POST",
            data: {
                id: id,
                table_column: table_column,
                value: value
            },
            success: function(data) {
                $('#bodyStatus').html(data);
                alert('Data has been updated');
                fetch_data();
            }
        })
    });

    function deleteData(id) {
        if (confirm("Are you sure you want to delete this?")) {
            $.ajax({
                url: "<?= site_url('deleteStatus') ?>",
                method: "POST",
                data: {
                    id
                },
                beforeSend: function() {
                    $('#' + id).attr('disable', 'disabled');
                    $('#' + id).html('<i class="fa fa-spin fa-spinner"></i>');
                },
                complete: function() {
                    $('#' + id).removeAttr('disable');
                    $('#' + id).html('<i class="fas fa-trash"></i>');
                },
                success: function(data) {
                    fetch_data();
                }
            })
        }
    }
</script>