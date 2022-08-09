<?= $this->extend('templates/index') ?>

<?= $this->section('page-content') ?>
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Hallo, <?= user()->fullname ?></h1>

    <div class="row">

        <!-- Area Chart -->
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Users Data</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <table class="table table-bordered" id="userData">
                        <thead>
                            <tr>
                                <th>Fullname</th>
                                <th>Progam Studi</th>
                                <th>Activation Account</th>
                                <th>Progress</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>

        <!-- Pie Chart -->
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Users Status</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-pie pt-4 pb-2">
                        <canvas id="userChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<script>
    // Set new default font family and font color to mimic Bootstrap's default styling
    Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
    Chart.defaults.global.defaultFontColor = '#858796';

    // Pie Chart Example
    var ctx = document.getElementById("userChart");
    var userChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: ["Total Number Of Users", "Total Progress Of Applied Student Exchange", "REJECTED", "COMPLETE"],
            datasets: [{
                data: [<?= $user ?>, <?= $exchange ?>, <?= $rejected ?>, <?= $complete ?>],
                backgroundColor: ['#4e73df', '#36b9cc', '#e74a3b', '#1cc88a'],
                hoverBackgroundColor: ['#2e59d9', '#2c9faf', '#e52324', '#17a673'],
                hoverBorderColor: "rgba(234, 236, 244, 1)",
            }],
        },
        options: {
            maintainAspectRatio: false,
            tooltips: {
                backgroundColor: "rgb(255,255,255)",
                bodyFontColor: "#858796",
                borderColor: '#dddfeb',
                borderWidth: 1,
                xPadding: 15,
                yPadding: 15,
                displayColors: false,
                caretPadding: 10,
            },
            legend: {
                display: true
            },
            cutoutPercentage: 80,
        },
    });

    $(document).ready(function() {
        //setting datatables
        $('#userData').DataTable({
            "processing": true,
            "serverSide": true,
            "pageLength": 5,
            "ajax": {
                //panggil method ajax list dengan ajax
                "url": '<?= site_url('getUsersExchange') ?>',
                "type": "POST",
            }
        });
    })
</script>
<?= $this->endSection() ?>