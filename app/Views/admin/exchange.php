<?= $this->extend('templates/index') ?>

<?= $this->section('page-content') ?>
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Student Exchange</h1>
    <div class="card shadow mb-4 err">
        <div class="card-title p-3 text-right">
            <button type="button" class="btn btn-primary btn-user" title="Contact Us" id="contactUs"><i class="fa fa-whatsapp"></i> Contact Us</button>
            <button type="button" class="btn btn-primary btn-user" title="Format Berkas" id="editFormat"><i class="fas fa-edit"></i> File Format</button>
            <button type="button" class="btn btn-info btn-user" title="Tambah Data" id="tambahData"><i class="fas fa-plus-circle"></i> Tambah Data</button>
        </div>
        <div class=" card-body">
            <div class="table-responsive viewdata"></div>
        </div>
    </div>

</div>

<div id="viewModal" style="display: none;"></div>

<script>
    $(document).ready(function() {
        dataFakultas();
        $("#tambahData").click(function(e) {
            e.preventDefault();
            $.ajax({
                url: "<?= site_url("formFakultas") ?>",
                dataType: "JSON",
                success: function(res) {
                    $('#viewModal').html(res.data).show();
                    $('#modalFakultas').modal('show');
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
        });
        $("#editFormat").click(function(e) {
            e.preventDefault();
            $.ajax({
                url: "<?= site_url("editFormat") ?>",
                dataType: "JSON",
                success: function(res) {
                    $('#viewModal').html(res.data).show();
                    $('#modalFormat').modal('show');
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
        });
        $("#contactUs").click(function(e) {
            e.preventDefault();
            $.ajax({
                url: "<?= site_url("editSetting") ?>",
                dataType: "JSON",
                success: function(res) {
                    $('#viewModal').html(res.data).show();
                    $('#modalNomor').modal('show');
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
        });
    });

    function dataFakultas() {
        $.ajax({
            url: "<?= site_url("getFakultas") ?>",
            dataType: "JSON",
            success: function(res) {
                $('.viewdata').html(res.data);
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    }

    function dataDepartement(id) {
        $.ajax({
            type: "POST",
            url: "<?= site_url("modalDepartements") ?>",
            dataType: "JSON",
            data: {
                id
            },
            success: function(res) {
                $('#viewModal').html(res.data).show();
                $('#modalFadep').modal('show');
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    }
</script>
<?= $this->endSection() ?>