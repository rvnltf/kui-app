<?= $this->extend('templates/index') ?>

<?= $this->section('page-content') ?>
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Verifikasi User</h1>
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive viewdata">
            </div>
        </div>
    </div>

</div>

<div id="viewModal" style="display: none;"></div>
<script>
    $(document).ready(function() {
        dataUser();
    });

    function dataUser() {
        $.ajax({
            url: "<?= site_url("getUser") ?>",
            dataType: "JSON",
            success: function(res) {
                $('.viewdata').html(res.data);
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    }

    function modalUser(id_user) {
        $.ajax({
            type: "POST",
            url: "<?= site_url("modalUser") ?>",
            dataType: "JSON",
            data: {
                id_user
            },
            success: function(res) {
                $('#viewModal').html(res.data).show();
                $('#modalUser').modal('show');
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    }
</script>

<?= $this->endSection() ?>