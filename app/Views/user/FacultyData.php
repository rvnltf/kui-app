<table class="table table-bordered" id="dataTable">
    <thead>
        <tr>
            <th>No.</th>
            <th><?= $fadep ?? $fadep[0]['for_exchange'] == 2 ? 'Faculty' : 'University' ?></th>
            <th>Faculty Status</th>
            <th>Departement</th>
            <th>Detailed Information</th>
            <th>Quota Status</th>
            <td>Cost</td>
            <td>Action</td>
        </tr>
    </thead>
    <tbody>
        <?php $i = 1; ?>
        <?php foreach ($fadep as $value) : ?>
            <?php $kuota = 0 ?>
            <?php foreach ($exchanges as $exc) : ?>
                <?php if ($exc['id_fakultas'] == $value['id_fakultas']) : ?>
                    <?php $kuota++ ?>
                <?php endif; ?>
            <?php endforeach; ?>
            <?php $exp = array() ?>
            <?php $fakultas = $value['fakultas'] ?>
            <?php if ($value['for_exchange'] == 1) : ?>
                <?php $exp = explode('-', $fakultas) ?>
            <?php endif; ?>
            <tr>
                <td><?= $i++ ?></td>
                <td>
                    <?= count($exp) > 0 ? '
                    <p class="font-weight-bold mt-0">' . $exp[0] . '</p>
                    <p>' . $exp[1] . '</p>' : $value["fakultas"] ?>
                </td>
                <td class="text-center">
                    <span class="badge badge-pill badge-<?= $value["fakultas_status"] ? "success" : "danger" ?>"><?= $value["fakultas_status"] ? "Active" : "Inactive" ?></span>
                    <span class="badge badge-pill badge-warning">Last Regis: <?= date("d/m/Y", strtotime($value["exp_date"])) ?></span>
                </td>
                <td class="text-center"><?= $value["departement"] ?></td>
                <td class="text-center"><?= $value["ldt"] ?></td>
                <td class="text-center">
                    <span class="badge badge-pill badge-<?= $value["kuota_status"] ? "success" : "danger" ?>"><?= $kuota < $value["kuota"] ? 'Active' : ($value["kuota_status"] ? "Active" : "Inactive") ?></span>
                    <span class="badge badge-pill badge-warning"><?= $kuota ?> of <?= $value["kuota"] ?></span>
                </td>
                <td><?= $value["cost"] ?></td>
                <td>
                    <div class="btn-group">
                        <button type="button" class="btn btn-<?= $exchange ? 'secondary' : 'info' ?> btn-user applyExchange<?= $value['id_fakultas'] ?><?= $value['id_departement'] ?>" title="Apply Departement" onclick="modalUpload(<?= $value['id_fakultas'] ?>, <?= $value['id_departement'] ?>, <?= $value['id_fakultas'] ?>)" <?= $exchange ? 'disabled' : ($kuota < $value["kuota"] ? 'Active' : ($value["kuota_status"] ? "Active" : "Inactive")) ?>>Apply</button>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<div id="viewModal" style="display: none;"></div>
<script>
    // Call the dataTables jQuery plugin
    $(document).ready(function() {
        $("#dataTable").DataTable({
            autoWidth: false,
        });
    });


    function modalUpload(id_fakultas, id_departement) {
        $.ajax({
            type: "POST",
            url: "<?= site_url("modalUpload") ?>",
            data: {
                id_fakultas,
                id_departement
            },
            dataType: "JSON",
            success: function(res) {
                $('#viewModal').html(res.data).show();
                $('#modalUpload').modal('show');
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    }
</script>