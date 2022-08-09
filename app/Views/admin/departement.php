<?= $this->extend('templates/index') ?>

<?= $this->section('page-content') ?>
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Department Master</h1>
    <div class="card shadow mb-4">
        <div class="card-title p-3 text-right">
            <button type="submit" class="btn btn-info btn-user" title="Tambah Data" id="tambahData"><i class="fas fa-plus-circle"></i> Tambah Data</button>
        </div>
        <div class="card-body">
            <div class="table-responsive viewdata">
            </div>
        </div>
    </div>
</div>

<div id="viewModal" style="display: none;"></div>
<script>
    $(document).ready(function() {
        dataDepartement();
        $("#tambahData").click(function(e) {
            e.preventDefault();
            $.ajax({
                url: "<?= site_url("formDepartement") ?>",
                dataType: "JSON",
                success: function(res) {
                    $('#viewModal').html(res.data).show();
                    $('#modalDepartement').modal('show');
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
        });
    });

    function dataDepartement() {
        $.ajax({
            url: "<?= site_url("getDepartement") ?>",
            dataType: "JSON",
            success: function(res) {
                $('.viewdata').html(res.data);
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    }
</script>
<?= $this->endSection() ?>