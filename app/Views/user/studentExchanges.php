<?= $this->extend('templates/index') ?>

<?= $this->section('page-content') ?>
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Student Exchange</h1>
    <div class="card shadow mb-4 err">
        <div class="card-body">
            <div class="table-responsive viewdata"></div>
        </div>
    </div>

</div>


<script>
    $(document).ready(function() {
        dataFakultas();
    });

    function dataFakultas() {
        $.ajax({
            url: "<?= site_url("getFaculty") ?>",
            dataType: "JSON",
            success: function(res) {
                $('.viewdata').html(res.data);
            },
            error: function(xhr, ajaxOptions, thrownError) {
                $('.viewdata').html(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    }
</script>
<?= $this->endSection() ?>