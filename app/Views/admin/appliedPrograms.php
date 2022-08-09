<?= $this->extend('templates/index') ?>

<?= $this->section('page-content') ?>
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Applied Program</h1>
    <div class="card shadow mb-4 err">
        <div class="card-title p-3 text-right">
            <button type="submit" class="btn btn-info btn-user" title="Tambah Data" id="tambahData"><i class="fas fa-plus-circle"></i> Tambah Status</button>
        </div>
        <div class="card-body">
            <div class="table-responsive viewdata"></div>
        </div>
    </div>

</div>
<div id="viewModal" style="display: none;"></div>

<script>
    $(document).ready(function() {
        dataExchange();
        $("#tambahData").click(function(e) {
            e.preventDefault();
            $.ajax({
                url: "<?= site_url("modalStatus") ?>",
                dataType: "JSON",
                success: function(res) {
                    $('#viewModal').html(res.data).show();
                    $('#modalStatus').modal('show');
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
        });
    });

    function dataExchange() {
        $.ajax({
            url: "<?= site_url("getExchange") ?>",
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