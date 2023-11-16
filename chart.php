<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="chart.css" rel="stylesheet" type="text">
  <title>Document</title>
</head>

<?php
  // データをJSON形式で出力
  $chartData = [
    'labels' => $labels,
    'data' => $ages,
  ];
  ?>

  <body>
    <canvas id="myChart"></canvas>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
      <?php
      $data = file('data/data.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

      $labels = [];
      $ages = [];

      foreach ($data as $line) {
        $parts = explode(',', $line);
        if (count($parts) === 4) {
          $labels[] = $parts[1];
          $ages[] = intval($parts[3]);
        }
      }
      ?>

      let ctx = document.getElementById('myChart').getContext('2d');
      let myChart = new Chart(ctx, {
        type: 'bar',
        data: {
          labels: <?php echo json_encode($labels); ?>,
          datasets: [{
            label: 'Age Dataset',
            data: <?php echo json_encode($ages); ?>,
            backgroundColor: 'rgba(75, 75, 75, 0.2)',
            borderColor: 'rgba(75, 192, 192, 1)',
            borderWidth: 1
          }]
        }
      });
    </script>

  </body>

</html>