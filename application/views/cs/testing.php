<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tes</title>

    <!-- CDN Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <!-- JS Google Chart -->
    <script src="https://www.gstatic.com/charts/loader.js"></script>
</head>

<body>
    <div class="container mt-3" style="width:600px">
        <h4>Testingggg</h4>
        <br />
        <div id="piechart" style="width: 900px; height: 500px;">

        </div>
    </div>

    <script>
    google.charts.load('current', {
        'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Tahun', 'Total'],
            <?php
            foreach ($pieChart as $pie) {
                echo "['" . $pie['gender'] . "'," . $pie['total'] . "],";
            }
            ?>
        ]);
        var options = {
            title: 'Total Siswa Yang Lulus',
            is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
    }
</script>
</body>

</html>