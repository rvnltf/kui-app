<div class="modal fade" id="modalFadep" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Departement</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive dataDepartements"></div>
            </div>
        </div>
    </div>
</div>


<script>
    // Call the dataTables jQuery plugin
    $(document).ready(function() {
        $.ajax({
            type: 'POST',
            url: "<?= site_url("checklistDepartements") ?>",
            dataType: "JSON",
            data: {
                id: '<?= $id ?>'
            },
            success: function(res) {
                $('.dataDepartements').html(res.data);
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    });
</script>